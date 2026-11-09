<?php
/**
 * Vel Pharmacy College CMS - Secure REST API Endpoint
 * Handles AJAX requests for Faculty, Content, SEO/GEO/AEO, Media, and Security
 */

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/helpers.php';

header('Content-Type: application/json; charset=utf-8');

// Enforce authentication for all API endpoints
if (!cms_is_logged_in()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized session. Please log in again.']);
    exit;
}

// Enforce CSRF verification for all state-modifying requests
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!cms_verify_csrf()) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'CSRF Security validation failed. Please refresh the page and try again.']);
        exit;
    }
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    // -------------------------------------------------------------
    // FACULTY CRUD
    // -------------------------------------------------------------
    case 'save_faculty':
        $faculties = cms_get_faculties();
        $id = trim($_POST['id'] ?? '');
        $is_new = empty($id);

        if ($is_new) {
            $name = trim($_POST['name'] ?? '');
            $clean_slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
            $id = $clean_slug . '-' . time();
        }

        $specializations = array_filter(array_map('trim', explode("\n", $_POST['specializations'] ?? '')));
        $subjects = array_filter(array_map('trim', explode("\n", $_POST['subjects'] ?? '')));
        $achievements = array_filter(array_map('trim', explode("\n", $_POST['achievements'] ?? '')));

        $faculty_entry = [
            'sno' => (int)($_POST['sno'] ?? count($faculties) + 1),
            'id' => $id,
            'name' => trim($_POST['name'] ?? ''),
            'qualification' => trim($_POST['qualification'] ?? ''),
            'designation' => trim($_POST['designation'] ?? ''),
            'department' => trim($_POST['department'] ?? ''),
            'dept_slug' => trim($_POST['dept_slug'] ?? 'chemistry'),
            'dept_color' => trim($_POST['dept_color'] ?? '#1E2368'),
            'experience' => trim($_POST['experience'] ?? ''),
            'image' => trim($_POST['image'] ?? ''),
            'featured' => !empty($_POST['featured']),
            'is_doctorate' => !empty($_POST['is_doctorate']),
            'badge' => trim($_POST['badge'] ?? ''),
            'cadre' => trim($_POST['cadre'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'office' => trim($_POST['office'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'specializations' => array_values($specializations),
            'subjects' => array_values($subjects),
            'achievements' => array_values($achievements)
        ];

        $updated = false;
        foreach ($faculties as $key => $fac) {
            if ($fac['id'] === $id) {
                $faculties[$key] = $faculty_entry;
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            $faculties[] = $faculty_entry;
        }

        // Keep SNO sorted
        usort($faculties, fn($a, $b) => $a['sno'] <=> $b['sno']);

        cms_save_faculties($faculties);
        cms_audit_log('faculty_update', ($is_new ? "Added new" : "Updated") . " faculty member: {$faculty_entry['name']}", 'info');

        echo json_encode(['success' => true, 'message' => 'Faculty member saved successfully.', 'faculty' => $faculty_entry]);
        break;

    case 'delete_faculty':
        $id = trim($_POST['id'] ?? '');
        $faculties = cms_get_faculties();
        $found_name = '';

        $filtered = array_filter($faculties, function($f) use ($id, &$found_name) {
            if ($f['id'] === $id) {
                $found_name = $f['name'];
                return false;
            }
            return true;
        });

        // Re-index SNO
        $i = 1;
        $reindexed = [];
        foreach ($filtered as $f) {
            $f['sno'] = $i++;
            $reindexed[] = $f;
        }

        cms_save_faculties($reindexed);
        cms_audit_log('faculty_delete', "Deleted faculty member: {$found_name} (ID: {$id})", 'warning');

        echo json_encode(['success' => true, 'message' => "Faculty member {$found_name} deleted successfully."]);
        break;

    // -------------------------------------------------------------
    // IMAGE & MEDIA UPLOADER
    // -------------------------------------------------------------
    case 'upload_media':
        if (!isset($_FILES['file'])) {
            echo json_encode(['success' => false, 'message' => 'No file received for upload.']);
            exit;
        }
        $subfolder = $_POST['subfolder'] ?? 'Faculty';
        $res = cms_upload_image($_FILES['file'], $subfolder);
        echo json_encode($res);
        break;

    // -------------------------------------------------------------
    // CONTENT & BANNERS (Supports All 9 Website Pages)
    // -------------------------------------------------------------
    case 'save_content':
        $raw_data = $_POST['content'] ?? null;
        $page_key = trim($_POST['page'] ?? '');
        if (!$raw_data) {
            echo json_encode(['success' => false, 'message' => 'No content payload received.']);
            exit;
        }
        $content = json_decode($raw_data, true);
        if (!$content) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON structure for content payload.']);
            exit;
        }

        $all_content = cms_get_content();
        if ($page_key === 'global') {
            if (isset($content['general_settings'])) {
                $all_content['general_settings'] = array_replace_recursive($all_content['general_settings'] ?? [], $content['general_settings']);
            }
            if (isset($content['general_contact'])) {
                $all_content['general_contact'] = array_replace_recursive($all_content['general_contact'] ?? [], $content['general_contact']);
            }
            cms_save_content($all_content);
            cms_audit_log('content_update', "Updated Global Header, Footer & Contact Settings", 'info');
            echo json_encode(['success' => true, 'message' => "Global Header, Footer and Branding updated live!"]);
            break;
        }

        if ($page_key === 'courses') {
            // Save Syllabus Semesters & Course Lists to syllabus_nep2020.json
            if (isset($content['syllabus']) && is_array($content['syllabus'])) {
                $current_syl = cms_get_syllabus();
                if (isset($content['syllabus']['semesters']) && is_array($content['syllabus']['semesters'])) {
                    foreach ($content['syllabus']['semesters'] as $semKey => $semVal) {
                        if (isset($current_syl['semesters'][$semKey])) {
                            if (isset($semVal['courses'])) {
                                $current_syl['semesters'][$semKey]['courses'] = $semVal['courses'];
                            }
                        } else {
                            $current_syl['semesters'][$semKey] = $semVal;
                        }
                    }
                }
                if (isset($content['syllabus']['graduate_attributes']) && is_array($content['syllabus']['graduate_attributes'])) {
                    $current_syl['graduate_attributes'] = $content['syllabus']['graduate_attributes'];
                }
                if (isset($content['syllabus']['pharmacist_oath'])) {
                    $current_syl['pharmacist_oath'] = $content['syllabus']['pharmacist_oath'];
                }
                cms_save_syllabus($current_syl);
                unset($content['syllabus']);
            }
        }

        if ($page_key === 'home') {
            if (isset($content['events_highlights'])) {
                if (!isset($all_content['home']['events_highlights'])) {
                    $all_content['home']['events_highlights'] = [];
                }
                foreach (['subtitle', 'title', 'description', 'events_title', 'events_badge', 'highlights_title', 'highlights_badge'] as $ehKey) {
                    if (isset($content['events_highlights'][$ehKey])) {
                        $all_content['home']['events_highlights'][$ehKey] = $content['events_highlights'][$ehKey];
                    }
                }
                if (isset($content['events_highlights']['events'])) {
                    $all_content['home']['events_highlights']['events'] = $content['events_highlights']['events'];
                }
                if (isset($content['events_highlights']['highlights'])) {
                    $all_content['home']['events_highlights']['highlights'] = $content['events_highlights']['highlights'];
                }
                unset($content['events_highlights']);
            }
            if (isset($content['pillars'])) {
                $all_content['home']['pillars'] = $content['pillars'];
                unset($content['pillars']);
            }
            if (isset($content['facilities'])) {
                $all_content['home']['facilities'] = $content['facilities'];
                unset($content['facilities']);
            }
            if (isset($content['why_choose'])) {
                $all_content['home']['why_choose'] = $content['why_choose'];
                unset($content['why_choose']);
            }
            if (isset($content['faqs'])) {
                $all_content['home']['faqs'] = $content['faqs'];
                unset($content['faqs']);
            }
        }

        if (!empty($page_key)) {
            // For pages with dynamic arrays (leadership leaders, facilities amenities, etc.) replace cleanly
            if (isset($content['leaders']) || isset($content['amenities']) || isset($content['specialized_labs']) || isset($content['items']) || isset($content['career_versatility'])) {
                $all_content[$page_key] = array_merge($all_content[$page_key] ?? [], $content);
            } elseif (isset($all_content[$page_key]) && is_array($all_content[$page_key]) && is_array($content)) {
                $all_content[$page_key] = array_replace_recursive($all_content[$page_key], $content);
            } else {
                $all_content[$page_key] = $content;
            }
            cms_save_content($all_content);
            $page_name = ucwords(str_replace('_', ' ', $page_key));
            cms_audit_log('content_update', "Updated content & banners for {$page_name} page", 'info');
            echo json_encode(['success' => true, 'message' => "Content for {$page_name} saved successfully and updated live on the website!"]);
        } else {
            $merged = array_replace_recursive($all_content, $content);
            cms_save_content($merged);
            cms_audit_log('content_update', "Updated website pages content and banners across multiple pages", 'info');
            echo json_encode(['success' => true, 'message' => 'Website content & banners updated successfully across all pages!']);
        }
        break;

    // -------------------------------------------------------------
    // SEO, GEO & AEO SAVING
    // -------------------------------------------------------------
    case 'save_seo':
        $raw_data = $_POST['seo_data'] ?? null;
        if (!$raw_data) {
            echo json_encode(['success' => false, 'message' => 'No SEO data received.']);
            exit;
        }
        $seo_data = json_decode($raw_data, true);
        if (!$seo_data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON format for SEO payload.']);
            exit;
        }

        cms_save_seo($seo_data);
        cms_audit_log('seo_update', "Updated SEO, GEO, and AEO configurations", 'info');
        echo json_encode(['success' => true, 'message' => 'SEO, GEO & AEO configurations updated successfully!']);
        break;

    // -------------------------------------------------------------
    // SECURITY: PASSWORD CHANGE
    // -------------------------------------------------------------
    case 'change_password':
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $res = cms_change_password($current, $new);
        echo json_encode($res);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid or unrecognized API action.']);
        break;
}
