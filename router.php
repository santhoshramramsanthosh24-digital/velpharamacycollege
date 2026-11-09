<?php
/**
 * Local Development Router for PHP Built-in Server
 * Usage: php -S localhost:8000 router.php
 * Note: In Apache/cPanel production, .htaccess handles rewrites automatically.
 */

$raw_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = urldecode($raw_path);

// Security: Block direct HTTP access to data folder
if (strpos($uri, '/data') === 0) {
    http_response_code(403);
    echo "403 Forbidden: Direct data access is prohibited.";
    exit;
}

$file = __DIR__ . $uri;

// If requesting an actual static file (CSS, JS, images, PDFs, etc.) - never intercept PHP scripts
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if ($uri !== '/' && $ext !== 'php' && file_exists($file) && !is_dir($file)) {
    if (php_sapi_name() === 'cli-server' && !defined('VERCEL_ENV')) {
        return false; // serve as-is in PHP built-in server
    }
    // Stream static asset with proper MIME type in serverless/production runtimes
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'webp'  => 'image/webp',
        'ico'   => 'image/x-icon',
        'pdf'   => 'application/pdf',
        'mp4'   => 'video/mp4',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'txt'   => 'text/plain',
        'xml'   => 'application/xml'
    ];
    $contentType = $mimes[$ext] ?? 'application/octet-stream';
    header('Content-Type: ' . $contentType);
    header('Content-Length: ' . filesize($file));
    header('Cache-Control: public, max-age=86400');
    readfile($file);
    exit;
}

$clean_slug = trim($uri, '/');

// Alias /admin -> /cms
if ($clean_slug === 'admin') {
    header('Location: /cms/');
    exit;
}

// Dedicated CMS Routing
if ($clean_slug === 'cms') {
    require __DIR__ . '/cms/index.php';
    exit;
}

if (strpos($clean_slug, 'cms/') === 0) {
    $cms_subpath = substr($clean_slug, 4); // strip "cms/"
    if (empty($cms_subpath)) {
        require __DIR__ . '/cms/index.php';
        exit;
    }
    if (file_exists(__DIR__ . '/cms/' . $cms_subpath)) {
        if (!is_dir(__DIR__ . '/cms/' . $cms_subpath)) {
            require __DIR__ . '/cms/' . $cms_subpath;
            exit;
        }
    }
    if (file_exists(__DIR__ . '/cms/' . $cms_subpath . '.php')) {
        require __DIR__ . '/cms/' . $cms_subpath . '.php';
        exit;
    }
    require __DIR__ . '/cms/index.php';
    exit;
}

// Log public visits to analytics (avoid logging static assets or 404s, and skip on serverless read-only environments)
if (file_exists(__DIR__ . '/cms/helpers.php') && !defined('VERCEL_ENV')) {
    require_once __DIR__ . '/cms/helpers.php';
    cms_record_visit($uri);
}

// Root request or front-controller entrypoints
if (empty($clean_slug) || $clean_slug === 'index' || $clean_slug === 'index.php' || $clean_slug === 'api' || $clean_slug === 'api/index' || $clean_slug === 'api/index.php') {
    require __DIR__ . '/index.php';
    exit;
}

// Clean extensionless URL or .php URL matching a script file
$base_name = preg_replace('/\.php$/i', '', $clean_slug);
if (file_exists(__DIR__ . '/' . $base_name . '.php')) {
    require __DIR__ . '/' . $base_name . '.php';
    exit;
}

// 404 fallback
http_response_code(404);
require __DIR__ . '/404.php';
exit;
