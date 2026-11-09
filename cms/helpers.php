<?php
/**
 * Vel Pharmacy College CMS - Helper Functions & Data Storage Interfacing
 */

require_once __DIR__ . '/auth.php';

/**
 * Get all faculties data
 */
function cms_get_faculties(): array {
    $file = CMS_DATA_DIR . '/faculties.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return [];
}

/**
 * Save faculties data
 */
function cms_save_faculties(array $faculties): bool {
    $file = CMS_DATA_DIR . '/faculties.json';
    return (bool)@file_put_contents($file, json_encode($faculties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

/**
 * Get editable page content
 */
function cms_get_content(): array {
    $file = CMS_DATA_DIR . '/pages_content.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return [];
}

/**
 * Save editable page content
 */
function cms_save_content(array $content): bool {
    $file = CMS_DATA_DIR . '/pages_content.json';
    return (bool)@file_put_contents($file, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

/**
 * Get PCI NEP 2020 B.Pharm Curriculum & Syllabus Dataset
 */
function cms_get_syllabus(): array {
    $file = dirname(__DIR__) . '/includes/syllabus_nep2020.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return [];
}

/**
 * Save PCI NEP 2020 B.Pharm Curriculum & Syllabus Dataset
 */
function cms_save_syllabus(array $data): bool {
    $file = dirname(__DIR__) . '/includes/syllabus_nep2020.json';
    return (bool)@file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

/**
 * Get SEO, GEO & AEO dataset
 */
function cms_get_seo(): array {
    $file = CMS_DATA_DIR . '/seo_geo_aeo.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return [];
}

/**
 * Save SEO, GEO & AEO dataset
 */
function cms_save_seo(array $seo_data): bool {
    $file = CMS_DATA_DIR . '/seo_geo_aeo.json';
    return (bool)@file_put_contents($file, json_encode($seo_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

/**
 * Get Traffic Analytics dataset
 */
function cms_get_traffic(): array {
    $file = CMS_DATA_DIR . '/traffic_analytics.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return [];
}

/**
 * Record a public page view in the traffic analytics
 */
function cms_record_visit(string $page_slug): void {
    // Avoid recording visits inside the CMS dashboard or from bots
    if (strpos($page_slug, '/cms') === 0 || strpos($page_slug, '/admin') === 0) return;

    $file = CMS_DATA_DIR . '/traffic_analytics.json';
    if (!file_exists($file)) return;

    $data = json_decode(file_get_contents($file), true) ?: [];
    if (!isset($data['summary'])) return;

    $data['summary']['total_pageviews']++;
    $data['summary']['last_updated'] = date('Y-m-d H:i:s');

    // Detect AI Referrers
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    if (!empty($referer)) {
        if (stripos($referer, 'perplexity.ai') !== false || stripos($referer, 'chatgpt.com') !== false || stripos($referer, 'claude.ai') !== false) {
            $data['summary']['ai_engine_referrals'] = ($data['summary']['ai_engine_referrals'] ?? 0) + 1;
        }
    }

    // Keep atomic write
    @file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

/**
 * Handle secure image upload
 */
function cms_upload_image(array $file_input, string $target_subfolder = 'Faculty'): array {
    $allowed_mimes = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp'
    ];

    if (!isset($file_input['error']) || is_array($file_input['error'])) {
        return ['success' => false, 'message' => 'Invalid parameters.'];
    }

    if ($file_input['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload error code: ' . $file_input['error']];
    }

    // Enforce 10MB maximum limit
    if ($file_input['size'] > 10 * 1024 * 1024) {
        return ['success' => false, 'message' => 'File size exceeds maximum allowed 10MB.'];
    }

    // Verify MIME type using finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file_input['tmp_name']);

    if (!isset($allowed_mimes[$mime])) {
        return ['success' => false, 'message' => 'Invalid file format. Only JPEG, PNG, and WebP are allowed.'];
    }

    $ext = $allowed_mimes[$mime];
    $clean_original = pathinfo($file_input['name'], PATHINFO_FILENAME);
    $clean_original = preg_replace('/[^a-zA-Z0-9_\-\. ]/', '', $clean_original);
    $clean_original = trim($clean_original);
    if (empty($clean_original)) $clean_original = 'image_' . time();

    $destination_dir = dirname(__DIR__) . '/assets/images/' . trim($target_subfolder, '/');
    if (!is_dir($destination_dir)) {
        mkdir($destination_dir, 0755, true);
    }

    $filename = $clean_original . '.' . $ext;
    $target_filepath = $destination_dir . '/' . $filename;

    // If file exists, add timestamp suffix to avoid overwriting unless intended
    if (file_exists($target_filepath)) {
        $filename = $clean_original . '_' . time() . '.' . $ext;
        $target_filepath = $destination_dir . '/' . $filename;
    }

    if (!move_uploaded_file($file_input['tmp_name'], $target_filepath)) {
        return ['success' => false, 'message' => 'Failed to save uploaded file.'];
    }

    $relative_path = 'assets/images/' . ($target_subfolder ? trim($target_subfolder, '/') . '/' : '') . $filename;

    cms_audit_log('image_upload', "Uploaded image: {$filename} ({$mime})", 'info');

    return [
        'success' => true,
        'filepath' => $relative_path,
        'filename' => $filename,
        'message' => 'Image uploaded successfully.'
    ];
}

/**
 * Scan media directory for media gallery
 */
function cms_list_media(): array {
    $base_dir = dirname(__DIR__) . '/assets/images';
    $images = [];

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base_dir, FilesystemIterator::SKIP_DOTS));
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $ext = strtolower($fileinfo->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $pathname = $fileinfo->getPathname();
                $rel_path = 'assets/images' . str_replace('\\', '/', substr($pathname, strlen($base_dir)));
                $images[] = [
                    'name' => $fileinfo->getFilename(),
                    'path' => $rel_path,
                    'size' => round($fileinfo->getSize() / 1024, 1) . ' KB',
                    'mtime' => date('Y-m-d H:i', $fileinfo->getMTime())
                ];
            }
        }
    }

    usort($images, fn($a, $b) => strcmp($b['mtime'], $a['mtime']));
    return $images;
}
