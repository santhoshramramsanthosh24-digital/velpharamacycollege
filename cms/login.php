<?php
/**
 * VEL Pharmacy College CMS - High-Security Login Screen
 */

require_once __DIR__ . '/auth.php';

// If already authenticated, redirect immediately to dashboard
if (cms_is_logged_in()) {
  header('Location: /cms/');
  exit;
}

$error_msg = '';
$ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$lock_check = cms_is_ip_locked($ip);

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  if (!cms_verify_csrf()) {
    $error_msg = 'Security token expired. Please try submitting again.';
  } elseif ($lock_check['locked']) {
    $error_msg = "Security Lockout: Too many failed login attempts. Please wait {$lock_check['minutes_left']} minute(s).";
  } else {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
      $error_msg = 'Please enter both your username and password.';
    } else {
      $result = cms_login($username, $password);
      if ($result['success']) {
        header('Location: /cms/');
        exit;
      } else {
        $error_msg = $result['message'];
        $lock_check = cms_is_ip_locked($ip);
      }
    }
  }
}

$csrf_token = cms_csrf_token();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS Portal Login | VEL Pharmacy College</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/cms.css?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="/assets/images/logo-icon.png">
  <style>
    body {
      background: #1E6A4D;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      position: relative;
      overflow: hidden;
    }

    .login-ambient-grid {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: none;
      background-size: 100% 100%, 100% 100%, 45px 45px, 45px 45px;
      pointer-events: none;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      border-radius: 28px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.2);
      width: 100%;
      max-width: 440px;
      overflow: hidden;
      position: relative;
      z-index: 10;
    }

    .login-header {
      background: #1E6A4D;
      color: #F5F7F4;
      padding: 2.25rem 2rem 2rem;
      text-align: center;
      border-bottom: 3px solid var(--cms-gold);
    }

    .login-logo-box {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #F5F7F4;
      border-radius: 14px;
      padding: 8px 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.25);
      margin-bottom: 1.15rem;
      max-width: 290px;
      width: auto;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      text-decoration: none;
    }

    .login-logo-box:hover {
      transform: translateY(-2px);
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.38), 0 0 0 1px rgba(255, 255, 255, 0.45);
    }

    .login-logo-box img {
      width: auto;
      max-width: 100%;
      height: 56px;
      object-fit: contain;
      display: block;
    }

    .login-body {
      padding: 2.25rem 2rem;
    }

    .security-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      background: #ECFDF5;
      color: #047857;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 0.25rem 0.65rem;
      border-radius: 9999px;
      margin-top: 0.5rem;
    }

    .demo-credentials-box {
      background: #EFF6FF;
      border: 1px dashed #93C5FD;
      border-radius: var(--radius-md);
      padding: 0.85rem 1rem;
      font-size: 0.8rem;
      color: #1E40AF;
      margin-top: 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }
  </style>
</head>

<body>

  <div class="login-ambient-grid"></div>

  <div class="login-card">
    <!-- Header -->
    <div class="login-header">
      <a href="/" class="login-logo-box" title="Return to VEL Pharmacy College Website">
        <img src="/assets/images/VPC NEW LOGO.jpeg" alt="VEL Pharmacy College Logo" width="220" height="56" loading="eager">
      </a>
      <h1 style="font-family: var(--cms-font-heading); font-size: 1.5rem; font-weight: 700; letter-spacing: -0.01em;">
        VEL Pharmacy College
      </h1>
      <p style="font-size: 0.85rem; color: #CBD5E1; margin-top: 0.25rem;">
        Unified Academic CMS &bull; SEO/GEO/AEO Hub
      </p>
      <div class="security-badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
        </svg>
        <span>PCI Compliant &bull; 256-Bit SSL Encrypted</span>
      </div>
    </div>

    <!-- Form Body -->
    <div class="login-body">

      <?php if (!empty($error_msg)): ?>
        <div
          style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 0.85rem 1rem; border-radius: var(--radius-md); font-size: 0.875rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.65rem;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            style="flex-shrink:0;">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
          <span><?= htmlspecialchars($error_msg) ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" action="/cms/login.php" style="display: flex; flex-direction: column; gap: 1.25rem;">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <div class="cms-form-group">
          <label class="cms-form-label" for="username">Admin Username or Email</label>
          <input type="text" id="username" name="username" class="cms-form-control" required autocomplete="username"
            placeholder="e.g. admin" value="<?= htmlspecialchars($_POST['username'] ?? 'admin') ?>">
        </div>

        <div class="cms-form-group">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
            <label class="cms-form-label" for="password" style="margin-bottom: 0;">Password</label>
            <span style="font-size: 0.75rem; color: var(--cms-accent); cursor: pointer;"
              onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">Show/Hide</span>
          </div>
          <input type="password" id="password" name="password" class="cms-form-control" required
            autocomplete="current-password" placeholder="••••••••••••">
        </div>

        <button type="submit" class="cms-btn cms-btn-primary"
          style="width: 100%; justify-content: center; padding: 0.85rem; font-size: 0.95rem; margin-top: 0.5rem; background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
            <polyline points="10 17 15 12 10 7"></polyline>
            <line x1="15" y1="12" x2="3" y2="12"></line>
          </svg>
          <span>Secure Authenticate</span>
        </button>
      </form>

      <!-- Pre-configured Credentials Reminder for Administrator -->
      <!--<div class="demo-credentials-box">
      <div style="font-weight: 700; display: flex; align-items: center; gap: 0.35rem;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        <span>Administrative Access:</span>
      </div>
      <div><strong>Username:</strong> <code>admin</code></div>
      <div><strong>Password:</strong> <code>VelPharmacy@2025</code></div>
    </div> -->

      <div style="text-align: center; margin-top: 1.5rem;">
        <a href="/" style="font-size: 0.825rem; color: var(--cms-text-muted); text-decoration: none;">&larr; Return to
          Public Website</a>
      </div>

    </div>
  </div>

</body>

</html>