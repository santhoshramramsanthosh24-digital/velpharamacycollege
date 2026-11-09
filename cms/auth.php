<?php
/**
 * Vel Pharmacy College CMS - High-Security Authentication & Protection Module
 * Includes Session Security, Password Hashing, CSRF Defense, Brute-Force Throttling & Audit Logging
 */

if (session_status() === PHP_SESSION_NONE) {
    // Enforce hardened session cookies
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Strict');
    session_start();
}

define('CMS_DATA_DIR', dirname(__DIR__) . '/data');
define('CMS_MAX_FAILED_ATTEMPTS', 5);
define('CMS_LOCKOUT_MINUTES', 15);

/**
 * Generate or retrieve current CSRF token
 */
function cms_csrf_token(): string {
    if (empty($_SESSION['cms_csrf_token'])) {
        $_SESSION['cms_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['cms_csrf_token'];
}

/**
 * Verify CSRF token
 */
function cms_verify_csrf(?string $token = null): bool {
    if ($token === null) {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    }
    return !empty($token) && !empty($_SESSION['cms_csrf_token']) && hash_equals($_SESSION['cms_csrf_token'], $token);
}

/**
 * Check if current client IP is locked out due to brute force
 */
function cms_is_ip_locked(string $ip): array {
    $log_file = CMS_DATA_DIR . '/security_log.json';
    if (!file_exists($log_file)) return ['locked' => false];
    
    $data = json_decode(file_get_contents($log_file), true) ?: [];
    $lockouts = $data['lockouts'] ?? [];
    
    if (isset($lockouts[$ip])) {
        $lock_time = strtotime($lockouts[$ip]);
        $remaining = (CMS_LOCKOUT_MINUTES * 60) - (time() - $lock_time);
        if ($remaining > 0) {
            return [
                'locked' => true,
                'minutes_left' => ceil($remaining / 60)
            ];
        } else {
            // Lockout expired, clear it
            unset($data['lockouts'][$ip]);
            unset($data['failed_attempts'][$ip]);
            @file_put_contents($log_file, json_encode($data, JSON_PRETTY_PRINT));
        }
    }
    return ['locked' => false];
}

/**
 * Record a failed login attempt and apply brute-force lockout if threshold reached
 */
function cms_record_failed_attempt(string $username, string $ip): int {
    $log_file = CMS_DATA_DIR . '/security_log.json';
    $data = file_exists($log_file) ? json_decode(file_get_contents($log_file), true) : [];
    if (!$data) $data = ['failed_attempts' => [], 'lockouts' => [], 'audit_trail' => []];

    $attempts = ($data['failed_attempts'][$ip] ?? 0) + 1;
    $data['failed_attempts'][$ip] = $attempts;

    if ($attempts >= CMS_MAX_FAILED_ATTEMPTS) {
        $data['lockouts'][$ip] = date('Y-m-d H:i:s');
        cms_audit_log('brute_force_lockout', "IP {$ip} locked out for 15 minutes after {$attempts} failed attempts on user '{$username}'", 'danger');
    } else {
        cms_audit_log('login_failed', "Failed login attempt for username '{$username}' from IP {$ip} (Attempt {$attempts}/5)", 'warning');
    }

    @file_put_contents($log_file, json_encode($data, JSON_PRETTY_PRINT));
    return $attempts;
}

/**
 * Clear failed attempts after successful login
 */
function cms_clear_failed_attempts(string $ip): void {
    $log_file = CMS_DATA_DIR . '/security_log.json';
    if (file_exists($log_file)) {
        $data = json_decode(file_get_contents($log_file), true) ?: [];
        unset($data['failed_attempts'][$ip]);
        unset($data['lockouts'][$ip]);
        @file_put_contents($log_file, json_encode($data, JSON_PRETTY_PRINT));
    }
}

/**
 * Append entry to security audit trail
 */
function cms_audit_log(string $event, string $details, string $severity = 'info'): void {
    $log_file = CMS_DATA_DIR . '/security_log.json';
    $data = file_exists($log_file) ? json_decode(file_get_contents($log_file), true) : [];
    if (!$data) $data = ['failed_attempts' => [], 'lockouts' => [], 'audit_trail' => []];

    $entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'event' => $event,
        'username' => $_SESSION['cms_user']['username'] ?? 'guest',
        'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
        'details' => $details,
        'severity' => $severity
    ];

    array_unshift($data['audit_trail'], $entry);
    // Keep last 150 entries
    $data['audit_trail'] = array_slice($data['audit_trail'], 0, 150);

    @file_put_contents($log_file, json_encode($data, JSON_PRETTY_PRINT));
}

/**
 * Attempt user authentication
 */
function cms_login(string $username, string $password): array {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    // Check if IP is currently locked
    $lock_check = cms_is_ip_locked($ip);
    if ($lock_check['locked']) {
        return [
            'success' => false,
            'message' => "Security Lockout: Too many failed login attempts. Please wait {$lock_check['minutes_left']} minute(s) before trying again."
        ];
    }

    $users_file = CMS_DATA_DIR . '/admin_users.json';
    if (!file_exists($users_file)) {
        return ['success' => false, 'message' => 'Admin database configuration error.'];
    }

    $users = json_decode(file_get_contents($users_file), true) ?: [];
    $matched_user = null;

    foreach ($users as $u) {
        if (strcasecmp($u['username'], $username) === 0 || strcasecmp($u['email'], $username) === 0) {
            $matched_user = $u;
            break;
        }
    }

    if (!$matched_user || !password_verify($password, $matched_user['password_hash'])) {
        $attempts = cms_record_failed_attempt($username, $ip);
        $remaining = CMS_MAX_FAILED_ATTEMPTS - $attempts;
        $msg = $remaining > 0 
            ? "Invalid username or password. ({$remaining} attempt" . ($remaining > 1 ? 's' : '') . " remaining)"
            : "Account locked out for 15 minutes due to multiple failed attempts.";
        return ['success' => false, 'message' => $msg];
    }

    // Login successful
    cms_clear_failed_attempts($ip);
    session_regenerate_id(true);

    $_SESSION['cms_logged_in'] = true;
    $_SESSION['cms_user'] = [
        'id' => $matched_user['id'],
        'username' => $matched_user['username'],
        'name' => $matched_user['name'],
        'email' => $matched_user['email'],
        'role' => $matched_user['role'],
        'login_time' => time()
    ];

    cms_audit_log('login_success', "User '{$matched_user['username']}' authenticated successfully", 'success');

    return ['success' => true, 'message' => 'Login successful.'];
}

/**
 * Check if active session is authenticated
 */
function cms_is_logged_in(): bool {
    if (!empty($_SESSION['cms_logged_in']) && !empty($_SESSION['cms_user'])) {
        // Enforce 60-minute inactivity auto-logout
        $login_time = $_SESSION['cms_user']['login_time'] ?? 0;
        if (time() - $login_time > 3600) {
            cms_logout();
            return false;
        }
        // Refresh activity
        $_SESSION['cms_user']['login_time'] = time();
        return true;
    }
    return false;
}

/**
 * Enforce authentication for protected CMS pages
 */
function cms_require_auth(): void {
    if (!cms_is_logged_in()) {
        header('Location: /cms/login.php');
        exit;
    }
}

/**
 * Terminate session
 */
function cms_logout(): void {
    if (!empty($_SESSION['cms_user']['username'])) {
        cms_audit_log('logout', "User '{$_SESSION['cms_user']['username']}' logged out", 'info');
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

/**
 * Update password securely for logged-in user
 */
function cms_change_password(string $current_pwd, string $new_pwd): array {
    if (!cms_is_logged_in()) {
        return ['success' => false, 'message' => 'Unauthorized'];
    }

    if (strlen($new_pwd) < 8) {
        return ['success' => false, 'message' => 'New password must be at least 8 characters long.'];
    }

    $users_file = CMS_DATA_DIR . '/admin_users.json';
    $users = json_decode(file_get_contents($users_file), true) ?: [];
    $user_id = $_SESSION['cms_user']['id'];
    $found = false;

    foreach ($users as &$u) {
        if ($u['id'] == $user_id) {
            if (!password_verify($current_pwd, $u['password_hash'])) {
                return ['success' => false, 'message' => 'Current password does not match our records.'];
            }
            $u['password_hash'] = password_hash($new_pwd, PASSWORD_DEFAULT);
            $u['last_password_change'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }

    if ($found) {
        file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
        cms_audit_log('password_change', "User '{$_SESSION['cms_user']['username']}' changed their password", 'warning');
        return ['success' => true, 'message' => 'Password updated successfully.'];
    }

    return ['success' => false, 'message' => 'User record not found.'];
}
