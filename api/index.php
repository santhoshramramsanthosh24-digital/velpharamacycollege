<?php
/**
 * Vercel Serverless Function Entrypoint
 * Vel Pharmacy College Portal & Unified Academic CMS
 */

// Define Vercel environment flag
if (!defined('VERCEL_ENV') && (getenv('VERCEL') || isset($_SERVER['VERCEL']))) {
    define('VERCEL_ENV', true);
}

// Ensure working directory is always the project root
$rootDir = dirname(__DIR__);
chdir($rootDir);

// Normalize standard CGI/Serverless superglobals
if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = '/';
}
if (!isset($_SERVER['REQUEST_METHOD'])) {
    $_SERVER['REQUEST_METHOD'] = 'GET';
}
if (!isset($_SERVER['REMOTE_ADDR'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '127.0.0.1';
}

// Delegate request handling to the unified router
require $rootDir . '/router.php';
