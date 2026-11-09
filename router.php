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

// If requesting an actual static file (CSS, JS, images, PDFs, etc.)
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // serve as-is
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

// Log public visits to analytics (avoid logging static assets or 404s)
if (file_exists(__DIR__ . '/cms/helpers.php')) {
    require_once __DIR__ . '/cms/helpers.php';
    cms_record_visit($uri);
}

// Root request
if (empty($clean_slug)) {
    require __DIR__ . '/index.php';
    exit;
}

// Clean extensionless URL matching a .php file
if (file_exists(__DIR__ . '/' . $clean_slug . '.php')) {
    require __DIR__ . '/' . $clean_slug . '.php';
    exit;
}

// 404 fallback
http_response_code(404);
require __DIR__ . '/404.php';
exit;
