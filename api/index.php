<?php
/**
 * Vercel Serverless Function Entrypoint
 * Vel Pharmacy College Portal & Unified Academic CMS
 */

// Force display errors for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

if (isset($_GET['debug_ping'])) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "PHP_OK: " . PHP_VERSION . " SAPI: " . php_sapi_name();
    exit;
}

if (isset($_GET['debug_files'])) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "CURRENT_DIR: " . __DIR__ . "\n";
    echo "PARENT_DIR: " . dirname(__DIR__) . "\n";
    echo "CWD: " . getcwd() . "\n";
    echo "FILES_IN_PARENT: " . (is_dir(dirname(__DIR__)) ? implode(', ', scandir(dirname(__DIR__))) : 'NOT_A_DIR') . "\n";
    echo "FILES_IN_CURRENT: " . (is_dir(__DIR__) ? implode(', ', scandir(__DIR__)) : 'NOT_A_DIR') . "\n";
    exit;
}

// Mark Vercel environment
if (!defined('VERCEL_ENV')) {
    define('VERCEL_ENV', true);
}

// Ensure session files use writable /tmp on serverless runtime
if (is_dir('/tmp') && is_writable('/tmp')) {
    @session_save_path('/tmp');
}

// Locate project root directory
$rootDir = dirname(__DIR__);
if (!file_exists($rootDir . '/router.php')) {
    $rootDir = __DIR__;
}

if (!file_exists($rootDir . '/router.php')) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "CRITICAL: router.php was not found.\n";
    echo "Parent directory: " . dirname(__DIR__) . "\n";
    echo "Files in parent: " . (is_dir(dirname(__DIR__)) ? implode(', ', scandir(dirname(__DIR__))) : 'NOT_A_DIR') . "\n";
    echo "Files in current: " . (is_dir(__DIR__) ? implode(', ', scandir(__DIR__)) : 'NOT_A_DIR') . "\n";
    exit;
}

chdir($rootDir);

// Normalize standard CGI/Serverless superglobals
if (!isset($_SERVER['REQUEST_URI']) || empty($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = '/';
}
if (!isset($_SERVER['REQUEST_METHOD'])) {
    $_SERVER['REQUEST_METHOD'] = 'GET';
}
if (!isset($_SERVER['REMOTE_ADDR'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '127.0.0.1';
}

// Delegate request handling to the unified router with exception catching
try {
    require $rootDir . '/router.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><title>System Error</title></head><body>';
    echo '<h2>Application Initialization Error</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</body></html>';
}
