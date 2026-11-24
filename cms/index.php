<?php
/**
 * VEL Pharmacy College - Complete Enterprise Academic CMS
 * Full Multi-Page Content Management, Faculty Directory, Media Library,
 * and Dedicated SEO / GEO / AEO Intelligence & Search Traffic Hub.
 */

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/helpers.php';

// Enforce login
cms_require_auth();

$current_user = $_SESSION['cms_user'] ?? ['name' => 'Academic Administrator', 'role' => 'Super Admin'];
$faculties = cms_get_faculties();
$content = cms_get_content();
$seo_data = cms_get_seo();
$traffic = cms_get_traffic();
$audit_log_file = CMS_DATA_DIR . '/security_log.json';
$audit_trail = file_exists($audit_log_file) ? (json_decode(file_get_contents($audit_log_file), true)['audit_trail'] ?? []) : [];
$media_files = cms_list_media();
$csrf_token = cms_csrf_token();

// Fallbacks for content sections
$home_data = $content['home'] ?? ($content['home_hero'] ?? []);
$gen_contact = $content['general_contact'] ?? [];
$gen_settings = $content['general_settings'] ?? [];
$about_data = $content['about_us'] ?? [];
$leadership_data = $content['leadership'] ?? [];
$courses_data = $content['courses'] ?? [];
$facilities_data = $content['facilities'] ?? [];
$highlights_data = $content['highlights'] ?? [];
$nep_syllabus_cms = cms_get_syllabus();
$faculties_page_data = $content['faculties_page'] ?? [];
$antiragging_data = $content['anti_ragging'] ?? [];
$contact_page_data = $content['contact_us'] ?? [];
$enquiry_data = $content['enquiry'] ?? [];
?>
<?php
if (!function_exists('cms_render_image_field')) {
  function cms_render_image_field(string $label, string $input_id, string $current_val, string $help_text = '')
  {
    $val = htmlspecialchars($current_val ?: 'assets/images/placeholder.jpg');
    $img_src = !empty($current_val) ? '/' . ltrim($current_val, '/') : '/assets/images/campus-front.jpg';
    ?>
    <div class="cms-form-group">
      <label class="cms-form-label"><?= htmlspecialchars($label) ?></label>
      <div class="cms-image-field-wrap">
        <img src="<?= $img_src ?>" id="<?= $input_id ?>_preview" class="cms-img-thumb" alt="Preview"
          onerror="this.src='/assets/images/campus-front.jpg'">
        <div style="flex-grow: 1;">
          <div style="display: flex; gap: 0.5rem; align-items: center;">
            <input type="text" id="<?= $input_id ?>" class="cms-form-control cms-img-input"
              value="<?= htmlspecialchars($current_val) ?>"
              oninput="document.getElementById('<?= $input_id ?>_preview').src = this.value ? ('/' + this.value.replace(/^\//, '')) : '/assets/images/campus-front.jpg';">
            <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-open-media-picker"
              data-target="<?= $input_id ?>" title="Select from Media Assets">
              📁 Choose
            </button>
            <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-quick-upload-btn"
              data-target="<?= $input_id ?>" title="Upload Image File">
              ⬆️ Upload
            </button>
          </div>
          <?php if ($help_text): ?>
            <div style="font-size: 0.72rem; color: #64748B; margin-top: 0.25rem;"><?= htmlspecialchars($help_text) ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS Management Portal • VEL Pharmacy College</title>
  <meta name="robots" content="noindex, nofollow">
  <meta name="csrf-token" content="<?= htmlspecialchars($csrf_token) ?>">

  <!-- Google Fonts: Inter & Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Core CMS Stylesheet -->
  <link rel="stylesheet" href="/cms/assets/css/cms.css?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="/assets/images/logo-icon.png">
</head>

<body>

  <div class="cms-app">

    <!-- ========================================================================
       SIDEBAR NAVIGATION
       ======================================================================== -->
    <aside class="cms-sidebar" id="cmsSidebar">
      <!-- Brand Header -->
      <div class="cms-brand">
        <a href="/" class="login-logo-box" title="Return to VEL Pharmacy College Website">
          <img src="/assets/images/VPC NEW LOGO.jpeg" alt="VEL Pharmacy College Logo" width="220" height="56" loading="eager">
        </a>
        <div class="cms-brand-meta">
          <span class="cms-brand-status">
            <span class="cms-status-dot"></span>
            <span>CMS Portal</span>
          </span>
          <span class="cms-badge-pro">Enterprise 2026</span>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="cms-nav">
        <div class="cms-nav-group-title">Main Portal</div>
        <a href="#overview" class="cms-nav-link active" data-tab="overview"
          data-title="Website CMS Overview &amp; Live Status">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
          </svg>
          <span>Dashboard</span>
        </a>

        <div class="cms-nav-group-title">Website Content &amp; Pages</div>
        <a href="#content" class="cms-nav-link" data-tab="content"
          data-title="Website Pages &amp; Banners Content Editor">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
          </svg>
          <span>Pages &amp; Banners</span>
          <span class="badge-indicator" style="background: rgba(37, 99, 235, 0.25); color: #93C5FD;">9 Pages</span>
        </a>

        <a href="#faculties" class="cms-nav-link" data-tab="faculties"
          data-title="Faculty Directory &amp; Photo Management">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span>Faculty Directory</span>
          <span class="badge-indicator"
            style="background: rgba(16, 185, 129, 0.25); color: #6EE7B7;"><?= count($faculties) ?></span>
        </a>

        <a href="#media" class="cms-nav-link" data-tab="media" data-title="Media Asset Library &amp; Image Uploader">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
          <span>Media Library</span>
          <span class="badge-indicator"
            style="background: rgba(245, 158, 11, 0.25); color: #FCD34D;"><?= count($media_files) ?></span>
        </a>

        <div class="cms-nav-group-title">Search Intelligence &amp; Traffic</div>
        <!-- DEDICATED SEO, GEO, AEO & SEARCH TRAFFIC MENU (ONLY HERE DOES SEO SHOW!) -->
        <a href="#seo_geo_aeo" class="cms-nav-link" data-tab="seo_geo_aeo"
          data-title="SEO, GEO, AEO &amp; Traffic Command Center">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          </svg>
          <span>SEO / GEO / AEO Hub</span>
          <span class="badge-indicator" style="background: #FDE68A; color: #92400E;">96%</span>
        </a>

        <div class="cms-nav-group-title">Administration</div>
        <a href="#security" class="cms-nav-link" data-tab="security"
          data-title="System Security, Audit Trail &amp; Passwords">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span>Security &amp; Logs</span>
        </a>
      </nav>

      <!-- Sidebar Footer -->
      <div class="cms-sidebar-footer">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <div class="cms-user-avatar">
            <?= strtoupper(substr($current_user['name'], 0, 1)) ?>
          </div>
          <div>
            <div style="font-size: 0.85rem; font-weight: 600; color: #FFFFFF;">
              <?= htmlspecialchars($current_user['name']) ?></div>
            <div style="font-size: 0.72rem; color: #94A3B8;"><?= htmlspecialchars($current_user['role']) ?></div>
          </div>
        </div>
        <a href="/cms/logout.php" title="Sign Out" style="color: #94A3B8; transition: color 0.2s;"
          onmouseover="this.style.color='#EF4444'" onmouseout="this.style.color='#94A3B8'">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
        </a>
      </div>
    </aside>

    <!-- ========================================================================
       MAIN CONTENT CONTAINER
       ======================================================================== -->
    <main class="cms-main">

      <!-- Header Bar -->
      <header class="cms-header">
        <div class="cms-header-title">
          <button type="button" id="cmsSidebarToggle" class="cms-btn cms-btn-secondary cms-btn-sm"
            style="display: none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="3" y1="12" x2="21" y2="12"></line>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
          </button>
          <h1 id="cmsPageTitle">Website CMS Overview &amp; Live Status</h1>
        </div>

        <div class="cms-header-actions">
          <!-- Live Website Link -->
          <a href="/" target="_blank" class="cms-btn cms-btn-secondary cms-btn-sm">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
              <polyline points="15 3 21 3 21 9"></polyline>
              <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
            <span>View Public Website</span>
          </a>

          <!-- Quick Add Faculty Action -->
          <button type="button" class="cms-btn cms-btn-primary cms-btn-sm" id="addFacultyBtn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>New Faculty</span>
          </button>
        </div>
      </header>

      <!-- Body Content Area -->
      <div class="cms-body">

        <!-- ====================================================================
           TAB 1: OVERVIEW & DASHBOARD (NO SEO WIDGETS! FOCUSED ON CONTENT)
           ==================================================================== -->
        <section id="tab-overview" class="cms-tab-content active">
          <!-- Pure Website & CMS Metric Cards -->
          <div class="cms-metrics-grid">
            <div class="cms-stat-card">
              <div class="cms-stat-info">
                <span>Managed Website Pages</span>
                <h3>9 Pages</h3>
                <div class="cms-stat-badge" style="background: #EFF6FF; color: #1D4ED8;">
                  <span>100% Editable in CMS</span>
                </div>
              </div>
              <div class="cms-stat-icon" style="background: #EFF6FF; color: #2563EB;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
              </div>
            </div>

            <div class="cms-stat-card">
              <div class="cms-stat-info">
                <span>Full-Time Faculty</span>
                <h3><?= count($faculties) ?></h3>
                <div class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">
                  <span>100% PCI Approved</span>
                </div>
              </div>
              <div class="cms-stat-icon" style="background: #F0FDF4; color: #16A34A;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                </svg>
              </div>
            </div>

            <div class="cms-stat-card">
              <div class="cms-stat-info">
                <span>Media Assets &amp; Photos</span>
                <h3><?= count($media_files) ?></h3>
                <div class="cms-stat-badge" style="background: #FFFBEB; color: #B45309;">
                  <span>High-Res Scans</span>
                </div>
              </div>
              <div class="cms-stat-icon" style="background: #FFFBEB; color: #D97706;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                  <circle cx="8.5" cy="8.5" r="1.5"></circle>
                  <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
              </div>
            </div>

            <div class="cms-stat-card">
              <div class="cms-stat-info">
                <span>Security System Status</span>
                <h3>Active</h3>
                <div class="cms-stat-badge" style="background: #F5F3FF; color: #7C3AED;">
                  <span>Brute-Force &amp; CSRF Shield</span>
                </div>
              </div>
              <div class="cms-stat-icon" style="background: #F5F3FF; color: #8B5CF6;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Master Website Pages & Content Manager Grid -->
          <div class="cms-panel">
            <div class="cms-panel-header">
              <div>
                <div class="cms-panel-title">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--cms-accent)"
                    stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                  </svg>
                  <h3>Website Pages &amp; Content Management (All 9 Pages)</h3>
                </div>
                <p style="font-size: 0.85rem; color: var(--cms-text-muted); margin-top: 0.25rem;">
                  Select any page to edit text, banners, hero copy, faculty cards, and images live on the public site.
                </p>
              </div>
              <button type="button" class="cms-btn cms-btn-primary cms-btn-sm"
                onclick="document.querySelector('[data-tab=content]').click()">
                Open Full Content Editor &rarr;
              </button>
            </div>
            <div class="cms-panel-body">
              <div class="cms-pages-grid">

                <!-- Page 1: Home Page -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">🏠</div>
                      <span class="cms-stat-badge" style="background: #EFF6FF; color: #1D4ED8;">Route: /</span>
                    </div>
                    <div class="cms-page-card-title">Home Page</div>
                    <div class="cms-page-card-desc">
                      Cinematic video hero headline, admissions marquee notice, Principal Dr. Saravanan's spotlight, and
                      live college stats.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('home')">Edit Home Content</button>
                  </div>
                </div>

                <!-- Page 2: About Us -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">📖</div>
                      <span class="cms-stat-badge" style="background: #F0FDF4; color: #15803D;">Route: /about-us</span>
                    </div>
                    <div class="cms-page-card-title">About Us &amp; Vision</div>
                    <div class="cms-page-card-desc">
                      Founding history, Vision &amp; Mission statements, 30+ year legacy of Vels Group (VISTAS), and
                      career versatility scope.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('about')">Edit About Us</button>
                  </div>
                </div>

                <!-- Page 3: Leadership -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">🏛️</div>
                      <span class="cms-stat-badge" style="background: #FFFBEB; color: #B45309;">Route:
                        /leadership</span>
                    </div>
                    <div class="cms-page-card-title">Leadership &amp; Governance</div>
                    <div class="cms-page-card-desc">
                      Founder-Chancellor Dr. Ishari K. Ganesh's address, university syndicate governance oversight, and
                      academic deans.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('leadership')">Edit Leadership</button>
                  </div>
                </div>

                <!-- Page 4: Courses -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">🎓</div>
                      <span class="cms-stat-badge" style="background: #F5F3FF; color: #6D28D9;">Route: /courses</span>
                    </div>
                    <div class="cms-page-card-title">B.Pharm Courses &amp; Syllabus</div>
                    <div class="cms-page-card-desc">
                      4-Year (8 Semesters) NEP 2020 CBCS curriculum, 193 Credits, eligibility criteria (+2 science), and
                      industrial career tracks.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('courses')">Edit Courses</button>
                  </div>
                </div>

                <!-- Page 5: Campus Facilities -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">🔬</div>
                      <span class="cms-stat-badge" style="background: #EFF6FF; color: #1D4ED8;">Route:
                        /facilities</span>
                    </div>
                    <div class="cms-page-card-title">Campus &amp; Laboratories</div>
                    <div class="cms-page-card-desc">
                      15+ PCI laboratories, HPLC &amp; UV instrumentation center, Pharmaceutics machine room, digital
                      library, and 300+ bed VMCH hospital.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('facilities')">Edit Facilities</button>
                  </div>
                </div>

                <!-- Page 6: Faculty Directory -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">👨‍🏫</div>
                      <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Route: /faculties</span>
                    </div>
                    <div class="cms-page-card-title">Faculty Directory</div>
                    <div class="cms-page-card-desc">
                      Full collegiate roster of 11 approved faculty mentors, doctorate credentials, designations,
                      department tags, and photo management.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● 11 Mentors</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="document.querySelector('[data-tab=faculties]').click()">Manage Directory</button>
                  </div>
                </div>

                <!-- Page 7: Anti-Ragging -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">🛡️</div>
                      <span class="cms-stat-badge" style="background: #FEF2F2; color: #991B1B;">Route:
                        /anti-ragging</span>
                    </div>
                    <div class="cms-page-card-title">Anti-Ragging Safety</div>
                    <div class="cms-page-card-desc">
                      Supreme Court zero-tolerance policy declaration, 24x7 National Toll-Free Helpline (1800-180-5522),
                      and campus squad cell.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('antiragging')">Edit Safety Info</button>
                  </div>
                </div>

                <!-- Page 8: Contact & Location -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">📍</div>
                      <span class="cms-stat-badge" style="background: #F0FDF4; color: #15803D;">Route:
                        /contact-us</span>
                    </div>
                    <div class="cms-page-card-title">Contact &amp; Location</div>
                    <div class="cms-page-card-desc">
                      Official address (VMCH Campus, Manjankaranai), telephone lines, admissions emails, operating
                      hours, and transit directions from Chennai.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('contact')">Edit Contacts</button>
                  </div>
                </div>

                <!-- Page 9: Admissions Enquiry -->
                <div class="cms-page-card">
                  <div>
                    <div class="cms-page-card-header">
                      <div class="cms-page-card-icon">📝</div>
                      <span class="cms-stat-badge" style="background: #FFFBEB; color: #92400E;">Route: /enquiry</span>
                    </div>
                    <div class="cms-page-card-title">Admissions Enquiry</div>
                    <div class="cms-page-card-desc">
                      B.Pharm online candidate application form guidelines, counseling desk phone (+91 812 261 3300),
                      and admission cycle instructions.
                    </div>
                  </div>
                  <div class="cms-page-card-footer">
                    <span style="font-size: 0.8rem; color: #10B981; font-weight: 600;">● Active &amp; Live</span>
                    <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                      onclick="openPageEditor('enquiry')">Edit Enquiry Desk</button>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- Recent Activity Audit Log Preview -->
          <div class="cms-panel">
            <div class="cms-panel-header">
              <div class="cms-panel-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
                <h3>Recent Security &amp; Content Audit Trail</h3>
              </div>
              <a href="#security" onclick="document.querySelector('[data-tab=security]').click()"
                class="cms-btn cms-btn-secondary cms-btn-sm">View All Logs</a>
            </div>
            <div class="cms-table-wrapper">
              <table class="cms-table">
                <thead>
                  <tr>
                    <th>Timestamp</th>
                    <th>Event</th>
                    <th>User / IP</th>
                    <th>Action Details</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (array_slice($audit_trail, 0, 5) as $log): ?>
                    <tr>
                      <td style="color: #64748B; font-size: 0.825rem; white-space: nowrap;">
                        <?= htmlspecialchars($log['timestamp']) ?></td>
                      <td><strong style="color: var(--cms-primary-dark);"><?= htmlspecialchars($log['event']) ?></strong>
                      </td>
                      <td><?= htmlspecialchars($log['username']) ?> <span
                          style="font-size: 0.75rem; color: #94A3B8;">(<?= htmlspecialchars($log['ip']) ?>)</span></td>
                      <td><?= htmlspecialchars($log['details']) ?></td>
                      <td>
                        <span class="cms-stat-badge"
                          style="background: <?= $log['severity'] === 'danger' ? '#FEE2E2; color:#991B1B;' : ($log['severity'] === 'warning' ? '#FEF3C7; color:#92400E;' : '#ECFDF5; color:#047857;') ?>">
                          <?= strtoupper(htmlspecialchars($log['severity'])) ?>
                        </span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- ====================================================================
           TAB 2: FACULTY DIRECTORY & PHOTO MANAGEMENT
           ==================================================================== -->
        <section id="tab-faculties" class="cms-tab-content">
          <div class="cms-panel">
            <div class="cms-panel-header">
              <div class="cms-panel-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                </svg>
                <h3>College Faculty Cadre (<?= count($faculties) ?> Approved Mentors)</h3>
              </div>
              <div style="display: flex; gap: 0.75rem; align-items: center;">
                <input type="text" id="facultySearchInput" class="cms-form-control"
                  placeholder="Search faculty name, dept..."
                  style="width: 240px; padding: 0.45rem 0.75rem; font-size: 0.85rem;">
                <button type="button" class="cms-btn cms-btn-primary cms-btn-sm"
                  onclick="document.getElementById('addFacultyBtn').click()">+ Add Faculty</button>
              </div>
            </div>

            <div class="cms-table-wrapper">
              <table class="cms-table" id="facultiesTable">
                <thead>
                  <tr>
                    <th style="width: 60px;">Photo</th>
                    <th style="width: 50px;">S.No</th>
                    <th>Faculty Name &amp; Title</th>
                    <th>Department</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Cadre Type</th>
                    <th style="text-align: right;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($faculties as $fac): ?>
                    <tr data-faculty-row="<?= strtolower(htmlspecialchars($fac['name'] . ' ' . $fac['department'])) ?>">
                      <td>
                        <img src="/<?= htmlspecialchars($fac['image']) ?>" alt="<?= htmlspecialchars($fac['name']) ?>"
                          class="cms-faculty-thumb" onerror="this.src='/assets/images/Faculty/Dr. G. Saravanan.png'">
                      </td>
                      <td style="font-weight: 600; color: #64748B;"><?= (int) $fac['sno'] ?></td>
                      <td>
                        <strong
                          style="color: var(--cms-primary-dark); font-size: 0.95rem;"><?= htmlspecialchars($fac['name']) ?></strong>
                        <div style="font-size: 0.78rem; color: var(--cms-secondary); font-weight: 500;">
                          <?= htmlspecialchars($fac['designation']) ?></div>
                      </td>
                      <td>
                        <span class="badge-tag"
                          style="background: #F1F5F9; color: #1E293B; font-size: 0.78rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 4px;">
                          <?= htmlspecialchars($fac['department']) ?>
                        </span>
                      </td>
                      <td style="font-size: 0.85rem; color: #334155;"><?= htmlspecialchars($fac['qualification']) ?></td>
                      <td style="font-weight: 700; color: var(--cms-accent); font-size: 0.85rem;">
                        <?= htmlspecialchars($fac['experience']) ?></td>
                      <td>
                        <?php if (!empty($fac['is_doctorate'])): ?>
                          <span class="cms-stat-badge" style="background: #FEF3C7; color: #B45309;">Ph.D. / Doctorate</span>
                        <?php else: ?>
                          <span class="cms-stat-badge" style="background: #F1F5F9; color: #475569;">Senior Cadre</span>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: right;">
                        <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm edit-faculty-btn"
                          data-faculty='<?= htmlspecialchars(json_encode($fac), ENT_QUOTES, 'UTF-8') ?>'
                          style="padding: 0.35rem 0.65rem;">
                          Edit
                        </button>
                        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm delete-faculty-btn"
                          data-id="<?= htmlspecialchars($fac['id']) ?>" data-name="<?= htmlspecialchars($fac['name']) ?>"
                          style="padding: 0.35rem 0.5rem; margin-left: 4px;">
                          &times;
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- ====================================================================
           TAB 3: COMPLETE WEBSITE CONTENT & BANNERS (ALL 9 PAGES)
           ==================================================================== -->
        <section id="tab-content" class="cms-tab-content">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
              <h2 style="font-family: var(--cms-font-heading); font-size: 1.35rem; color: var(--cms-primary-dark);">
                Website Pages &amp; Content Editor</h2>
              <p style="font-size: 0.875rem; color: var(--cms-text-muted);">Select any page below to edit live content,
                copy, banners, cards, and photos across every single corner of the website.</p>
            </div>
          </div>

          <!-- 10-Page/Section Selector Sub-Nav -->
          <div class="page-subnav">
            <button type="button" class="page-subnav-btn active" data-subtab="page-global">🌐 Global Header &amp;
              Footer</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-home">🏠 Home Page</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-about">📖 About Us</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-leadership">🏛️ Leadership</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-courses">🎓 Courses &amp; B.Pharm</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-facilities">🔬 Campus &amp; Labs</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-highlights">📢 Highlights &amp;
              Circulars</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-faculties">👨‍🏫 Faculty Banner</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-antiragging">🛡️ Anti-Ragging</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-contact">📍 Contact &amp; Location</button>
            <button type="button" class="page-subnav-btn" data-subtab="page-enquiry">📝 Admissions Enquiry</button>
          </div>

          <!-- ====================================================================
       SUBTAB 0: GLOBAL HEADER, FOOTER & BRANDING
       ==================================================================== -->
          <div id="subtab-page-global" class="cms-subtab-pane active">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
              <span style="font-size: 0.9rem; color: #64748B;">Configures site-wide branding, header contact bar, footer
                badges, floating tabs, and social media.</span>
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('global')">
                <span>Save Global Header &amp; Footer Changes</span>
              </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
              <!-- Branding & Main Contacts -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>College Identity &amp; Header Contact Info</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">College Name</label>
                    <input type="text" id="gs_college_name" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['college_name'] ?? 'VEL Pharmacy College') ?>">
                  </div>
                  <?php cms_render_image_field('Header & Navigation Logo', 'gs_logo_img', $gen_settings['logo_img'] ?? 'assets/images/logo.png', 'Transparent PNG or SVG recommended'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Preloader Logo Animation Video (.mp4)</label>
                    <input type="text" id="gs_preloader_video" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['preloader_video'] ?? 'assets/videos/vel-pharmacy-logo-animation.mp4') ?>"
                      placeholder="assets/videos/vel-pharmacy-logo-animation.mp4">
                    <small style="color: var(--cms-text-muted); font-size: 0.75rem;">Path to MP4 video played inside the
                      initial page preloader</small>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Admissions Direct Phone</label>
                      <input type="text" id="gs_phone_primary" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['contact_phone'] ?? '+91 812 261 3300') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Campus Landline</label>
                      <input type="text" id="gs_phone_secondary" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_contact['phone_secondary'] ?? '+91 44 2266 2500') ?>">
                    </div>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Admissions Email</label>
                      <input type="text" id="gs_email_admissions" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_contact['email_admissions'] ?? 'admission@velpharmacycollege.com') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">General Enquiries Email</label>
                      <input type="text" id="gs_email_primary" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['contact_email'] ?? 'vels@vistas.ac.in') ?>">
                    </div>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">National Toll-Free Helpline</label>
                    <input type="text" id="gs_toll_free" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['toll_free_helpline'] ?? '1800-180-5522') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Header Navigation 'Apply' Button Label</label>
                    <input type="text" id="gs_header_cta_text" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['header_cta']['text'] ?? 'Apply Now') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Header Navigation 'Apply' Button URL</label>
                    <input type="text" id="gs_header_cta_url" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['header_cta']['url'] ?? 'enquiry') ?>">
                  </div>
                </div>
              </div>

              <!-- Campus Address, Social Links & Footer -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Addresses, Social Channels &amp; Footer Badges</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Campus Short Address (Footer)</label>
                    <input type="text" id="gs_address_short" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['address_short'] ?? 'VMCH Campus, Manjankaranai, Tiruvallur – 601102') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Full Campus Postal Address</label>
                    <textarea id="gs_address_full" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($gen_settings['address_full'] ?? 'VMCH Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Tiruvallur District – 601102, Tamil Nadu.') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Facebook URL</label>
                      <input type="text" id="gs_social_fb" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['social_links']['facebook'] ?? 'https://facebook.com/vels') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Instagram URL</label>
                      <input type="text" id="gs_social_ig" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['social_links']['instagram'] ?? 'https://instagram.com/vels') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">YouTube URL</label>
                      <input type="text" id="gs_social_yt" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['social_links']['youtube'] ?? 'https://youtube.com/vels') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">LinkedIn URL</label>
                      <input type="text" id="gs_social_li" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['social_links']['linkedin'] ?? 'https://linkedin.com/school/vels') ?>">
                    </div>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Twitter / X URL</label>
                    <input type="text" id="gs_social_tw" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['social_links']['twitter'] ?? 'https://twitter.com/vels') ?>">
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Footer NAAC Badge Text</label>
                      <input type="text" id="gs_badge_naac" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['footer_badges']['naac'] ?? 'NAAC Grade A') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Footer PCI Badge Text</label>
                      <input type="text" id="gs_badge_pci" class="cms-form-control"
                        value="<?= htmlspecialchars($gen_settings['footer_badges']['pci'] ?? 'PCI Approved') ?>">
                    </div>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Footer Copyright Text</label>
                    <input type="text" id="gs_copyright_text" class="cms-form-control"
                      value="<?= htmlspecialchars($gen_settings['copyright_text'] ?? '© 2024 VEL Pharmacy College. All Rights Reserved.') ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ====================================================================
       SUBTAB 1: HOME PAGE CONTENT
       ==================================================================== -->
          <div id="subtab-page-home" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('home')">
                <span>Save All Home Page Changes</span>
              </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
              <!-- Hero Banner & Announcement -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    </svg>
                    <h3>Home Hero Banner &amp; Notice Marquee</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Top Pill Badge Text</label>
                    <input type="text" id="h_pill_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['pill_badge'] ?? 'PCI Approved • VISTAS Deemed University') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Headline Main</label>
                    <input type="text" id="h_title_main" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['title_main'] ?? 'Empowering Future Pharmacists') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Headline Highlighted Gold Text</label>
                    <input type="text" id="h_title_highlight" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['title_highlight'] ?? '& Healthcare Innovators') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Description Subtitle</label>
                    <textarea id="h_description" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($home_data['description'] ?? 'VEL Pharmacy College at VMCH Campus, Manjankaranai blends academic rigor, state-of-the-art laboratory discovery, and hospital-integrated clinical rounds.') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Primary CTA Label</label>
                      <input type="text" id="h_cta_primary_text" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['cta_primary_text'] ?? 'Apply for B.Pharm 2024–2025') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Primary CTA Link</label>
                      <input type="text" id="h_cta_primary_link" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['cta_primary_link'] ?? 'enquiry') ?>">
                    </div>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Secondary CTA Label</label>
                      <input type="text" id="h_cta_secondary_text" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['cta_secondary_text'] ?? 'Explore Curriculum') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Secondary CTA Link</label>
                      <input type="text" id="h_cta_secondary_link" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['cta_secondary_link'] ?? 'courses') ?>">
                    </div>
                  </div>
                  <?php cms_render_image_field('Hero Background Image', 'h_hero_image', $home_data['hero_image'] ?? 'assets/images/campus-front.jpg'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Hero Cinema Video URL (.mp4)</label>
                    <input type="text" id="h_hero_video" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['hero_video'] ?? ($home_data['video_mp4'] ?? 'assets/videos/VMCH VIDEO - SUBBHIKRISHNAN.mp4')) ?>"
                      placeholder="assets/videos/VMCH VIDEO - SUBBHIKRISHNAN.mp4">
                    <small style="color: var(--cms-text-muted); font-size: 0.75rem;">Autoplaying cinematic college video
                      background in hero section</small>
                  </div>
                  <?php cms_render_image_field('Hero Video Poster / Fallback Image', 'h_video_poster', $home_data['hero_video_poster'] ?? ($home_data['hero_image'] ?? 'assets/images/campus-front.jpg'), 'Fallback cover displayed before video loads or on mobile data saver'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Notice Ticker Announcement Text</label>
                    <input type="text" id="h_announcement" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['announcement_text'] ?? 'Admission Open for 2024–2025 Batch: 4-Year B.Pharm Degree Program (PCI Approved)') ?>">
                  </div>
                </div>
              </div>

              <!-- Welcome Section & Chancellor Desk -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Welcome Section &amp; Chancellor Message</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Subtitle</label>
                    <input type="text" id="h_welcome_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['welcome']['subtitle'] ?? 'Academic Sanctuary in Healthcare') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Title</label>
                    <input type="text" id="h_welcome_title" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['welcome']['title'] ?? 'Welcome to VEL Pharmacy College') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Paragraph 1</label>
                    <textarea id="h_welcome_desc_1" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($home_data['welcome']['desc_1'] ?? 'Pharmacy is the profession concerned with the art and science of preparing from natural and synthetic sources suitable and convenient materials for distribution and use in the treatment and prevention of diseases.') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Paragraph 2</label>
                    <textarea id="h_welcome_desc_2" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($home_data['welcome']['desc_2'] ?? 'It embraces knowledge of the identification, selection, pharmacological action, preservation, combination, analysis, and standardization of drugs and medicines.') ?></textarea>
                  </div>
                  <?php cms_render_image_field('Welcome Section Image', 'h_welcome_image', $home_data['welcome']['image'] ?? 'assets/images/about-group-pharmacy.jpg'); ?>
                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Chancellor / Founder Name</label>
                      <input type="text" id="h_quote_speaker_name" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['founder_quote']['speaker_name'] ?? 'Dr. Ishari K. Ganesh') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Chancellor Title</label>
                      <input type="text" id="h_quote_speaker_title" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['founder_quote']['speaker_title'] ?? 'Founder, Chancellor & Chairman, Vels Group') ?>">
                    </div>
                    <?php cms_render_image_field('Chancellor Portrait Photo', 'h_quote_speaker_img', $home_data['founder_quote']['speaker_img'] ?? 'assets/images/chancellor-ishari-ganesh-vistas.jpg'); ?>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Chancellor Message / Quote</label>
                      <textarea id="h_quote_text" class="cms-form-control"
                        rows="3"><?= htmlspecialchars($home_data['founder_quote']['quote_text'] ?? 'Our mission at VEL Pharmacy College is to foster ethical, industry-ready healthcare leaders empowered with scientific expertise, compassionate clinical perspective, and groundbreaking research capability.') ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- 4 Strategic Pillars & Course Spotlight -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-top: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>4 Core Strategic Pillars (Home Cards)</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <?php
                  $pillars = $home_data['pillars'] ?? [];
                  for ($i = 0; $i < 4; $i++):
                    $p = $pillars[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1rem;">
                      <span style="font-size: 0.8rem; font-weight: 700; color: var(--cms-primary);">Pillar
                        #<?= $i + 1 ?></span>
                      <div class="cms-form-group" style="margin-top: 0.5rem;">
                        <label class="cms-form-label">Card Title</label>
                        <input type="text" id="h_pillar_<?= $i ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($p['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Description</label>
                        <textarea id="h_pillar_<?= $i ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($p['desc'] ?? '') ?></textarea>
                      </div>
                      <?php cms_render_image_field("Pillar #" . ($i + 1) . " Photo", "h_pillar_{$i}_img", $p['image'] ?? ''); ?>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>

              <!-- Section 3: Upcoming Events & Highlights -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <h3>Section 3: Upcoming Events &amp; College Highlights (Dual-Column)</h3>
                  </div>
                  <span class="cms-stat-badge" style="background: #EAF4F0; color: var(--cms-primary-dark);">Home Section
                    3</span>
                </div>
                <div class="cms-panel-body">
                  <?php $eh = $home_data['events_highlights'] ?? []; ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Subtitle</label>
                    <input type="text" id="h_eh_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($eh['subtitle'] ?? 'Campus Life & Key Milestones') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Main Title</label>
                    <input type="text" id="h_eh_title" class="cms-form-control"
                      value="<?= htmlspecialchars($eh['title'] ?? 'Upcoming Events & Institutional Highlights') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Description</label>
                    <textarea id="h_eh_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($eh['description'] ?? 'Stay connected with upcoming academic conferences, hands-on clinical workshops, and premier institutional achievements shaping pharmaceutical education at VEL Pharmacy College.') ?></textarea>
                  </div>

                  <!-- Top Row Controls for Events -->
                  <div
                    style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #EEF2F6; padding-bottom: 0.6rem; margin: 1.5rem 0 0.85rem;">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--cms-primary-dark); margin: 0;">
                      Upcoming Events (Left Column)</h4>
                    <button type="button" class="cms-btn cms-btn-primary cms-btn-sm" onclick="addHomeEvent()"
                      style="display: inline-flex; align-items: center; gap: 0.4rem;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg>
                      <span>+ Add Event</span>
                    </button>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.85rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Events Header Title</label>
                      <input type="text" id="h_eh_events_title" class="cms-form-control"
                        value="<?= htmlspecialchars($eh['events_title'] ?? 'Upcoming Events') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Events Badge Text</label>
                      <input type="text" id="h_eh_events_badge" class="cms-form-control"
                        value="<?= htmlspecialchars($eh['events_badge'] ?? 'Academic Calendar 2026') ?>">
                    </div>
                  </div>

                  <!-- All Upcoming Events Cards (Dynamic Container) -->
                  <div style="margin-bottom: 1.5rem;">
                    <p style="font-size: 0.82rem; color: #64748B; margin-bottom: 0.75rem;">
                      Dates with past timestamps automatically transition to 'Concluded Event Highlight' on the website.
                    </p>
                    <div id="homeEventsContainer" style="display: grid; grid-template-columns: 1fr; gap: 0.85rem;">
                      <?php
                      $eh_events = $eh['events'] ?? [];
                      foreach ($eh_events as $evIdx => $ev):
                        ?>
                        <div class="cms-event-card"
                          style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem;">
                          <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span class="badge-tag cms-event-card-num"
                              style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700;">Upcoming Event
                              #<?= $evIdx + 1 ?></span>
                            <button type="button" class="cms-btn cms-btn-danger cms-btn-sm"
                              onclick="removeHomeEvent(this)"
                              style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;"
                              title="Delete this event">
                              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                              </svg>
                              <span>Delete</span>
                            </button>
                          </div>
                          <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr; gap: 0.6rem;">
                            <div class="cms-form-group">
                              <label class="cms-form-label">Event Date</label>
                              <input type="date" id="h_ev_<?= $evIdx ?>_date" class="cms-form-control ev-date"
                                value="<?= htmlspecialchars($ev['date'] ?? '') ?>">
                            </div>
                            <div class="cms-form-group">
                              <label class="cms-form-label">Category Tag</label>
                              <input type="text" id="h_ev_<?= $evIdx ?>_cat" class="cms-form-control ev-cat"
                                value="<?= htmlspecialchars($ev['category'] ?? '') ?>"
                                placeholder="e.g. National Symposium">
                            </div>
                            <div class="cms-form-group">
                              <label class="cms-form-label">Color Theme</label>
                              <select id="h_ev_<?= $evIdx ?>_cat_color" class="cms-form-control ev-cat-color">
                                <option value="blue" <?= (($ev['category_color'] ?? '') === 'blue') ? 'selected' : '' ?>>Blue
                                </option>
                                <option value="amber" <?= (($ev['category_color'] ?? '') === 'amber') ? 'selected' : '' ?>>
                                  Amber</option>
                                <option value="maroon" <?= (($ev['category_color'] ?? '') === 'maroon') ? 'selected' : '' ?>>
                                  Maroon</option>
                                <option value="green" <?= (($ev['category_color'] ?? '') === 'green') ? 'selected' : '' ?>>
                                  Green</option>
                              </select>
                            </div>
                          </div>
                          <div class="cms-form-group">
                            <label class="cms-form-label">Event Headline / Title</label>
                            <input type="text" id="h_ev_<?= $evIdx ?>_title" class="cms-form-control ev-title"
                              value="<?= htmlspecialchars($ev['title'] ?? '') ?>">
                          </div>
                          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem;">
                            <div class="cms-form-group">
                              <label class="cms-form-label">Time Schedule</label>
                              <input type="text" id="h_ev_<?= $evIdx ?>_time" class="cms-form-control ev-time"
                                value="<?= htmlspecialchars($ev['time'] ?? '') ?>" placeholder="e.g. 09:30 AM – 03:30 PM">
                            </div>
                            <div class="cms-form-group">
                              <label class="cms-form-label">Venue / Hall</label>
                              <input type="text" id="h_ev_<?= $evIdx ?>_venue" class="cms-form-control ev-venue"
                                value="<?= htmlspecialchars($ev['venue'] ?? '') ?>" placeholder="e.g. Seminar Hall">
                            </div>
                          </div>
                          <div class="cms-form-group">
                            <label class="cms-form-label">Description / Summary</label>
                            <textarea id="h_ev_<?= $evIdx ?>_desc" class="cms-form-control ev-desc"
                              rows="2"><?= htmlspecialchars($ev['description'] ?? '') ?></textarea>
                          </div>
                          <div class="cms-form-group" style="margin-bottom: 0;">
                            <label class="cms-form-label">Button Target Link</label>
                            <input type="text" id="h_ev_<?= $evIdx ?>_link" class="cms-form-control ev-link"
                              value="<?= htmlspecialchars($ev['link'] ?? 'enquiry') ?>">
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div style="margin-top: 0.85rem; display: flex; justify-content: flex-start;">
                      <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm" onclick="addHomeEvent()"
                        style="display: inline-flex; align-items: center; gap: 0.4rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2.5">
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>+ Add Another Upcoming Event</span>
                      </button>
                    </div>
                  </div>

                  <!-- Top Row Controls for Highlights -->
                  <div
                    style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #EEF2F6; padding-bottom: 0.6rem; margin: 1.75rem 0 0.85rem;">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--cms-primary-dark); margin: 0;">College
                      Highlights (Right Column)</h4>
                    <button type="button" class="cms-btn cms-btn-primary cms-btn-sm" onclick="addHomeHighlight()"
                      style="display: inline-flex; align-items: center; gap: 0.4rem;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg>
                      <span>+ Add Highlight</span>
                    </button>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.85rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Highlights Header Title</label>
                      <input type="text" id="h_eh_highlights_title" class="cms-form-control"
                        value="<?= htmlspecialchars($eh['highlights_title'] ?? 'College Highlights') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Highlights Badge Text</label>
                      <input type="text" id="h_eh_highlights_badge" class="cms-form-control"
                        value="<?= htmlspecialchars($eh['highlights_badge'] ?? 'Institutional Prestige') ?>">
                    </div>
                  </div>

                  <!-- College Highlights Cards (Dynamic Container) -->
                  <div style="margin-top: 1rem;">
                    <p style="font-size: 0.82rem; color: #64748B; margin-bottom: 0.75rem;">
                      Institutional highlights featured alongside upcoming events in the dual-column display.
                    </p>
                    <div id="homeHighlightsContainer"
                      style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
                      <?php
                      $eh_highlights = $eh['highlights'] ?? [];
                      foreach ($eh_highlights as $hlIdx => $hlCard):
                        ?>
                        <div class="cms-highlight-card"
                          style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem;">
                          <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span class="badge-tag cms-hl-card-num"
                              style="background: #FEF3C7; color: #B45309; font-weight: 700;">College Highlight
                              #<?= $hlIdx + 1 ?></span>
                            <button type="button" class="cms-btn cms-btn-danger cms-btn-sm"
                              onclick="removeHomeHighlight(this)"
                              style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;"
                              title="Delete this highlight">
                              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                              </svg>
                              <span>Delete</span>
                            </button>
                          </div>
                          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.6rem;">
                            <div class="cms-form-group">
                              <label class="cms-form-label">Tag Category</label>
                              <input type="text" id="h_hl_<?= $hlIdx ?>_tag" class="cms-form-control hl-tag"
                                value="<?= htmlspecialchars($hlCard['tag'] ?? '') ?>" placeholder="e.g. Accreditation">
                            </div>
                            <div class="cms-form-group">
                              <label class="cms-form-label">Badge Text</label>
                              <input type="text" id="h_hl_<?= $hlIdx ?>_badge" class="cms-form-control hl-badge"
                                value="<?= htmlspecialchars($hlCard['badge'] ?? '') ?>" placeholder="e.g. PCI Approved">
                            </div>
                            <div class="cms-form-group">
                              <label class="cms-form-label">Card Icon</label>
                              <select class="cms-form-control hl-icon">
                                <option value="shield" <?= (($hlCard['icon'] ?? '') === 'shield') ? 'selected' : '' ?>>🛡️
                                  Shield</option>
                                <option value="flask" <?= (($hlCard['icon'] ?? '') === 'flask') ? 'selected' : '' ?>>🧪 Flask
                                  / Lab</option>
                                <option value="award" <?= (($hlCard['icon'] ?? '') === 'award') ? 'selected' : '' ?>>🏆 Award
                                </option>
                                <option value="users" <?= (($hlCard['icon'] ?? '') === 'users') ? 'selected' : '' ?>>👥
                                  Students / Faculty</option>
                                <option value="hospital" <?= (($hlCard['icon'] ?? '') === 'hospital') ? 'selected' : '' ?>>🏥
                                  Hospital / Clinical</option>
                                <option value="book" <?= (($hlCard['icon'] ?? '') === 'book') ? 'selected' : '' ?>>📚 Book /
                                  Curriculum</option>
                                <option value="star" <?= (($hlCard['icon'] ?? '') === 'star' || empty($hlCard['icon'])) ? 'selected' : '' ?>>⭐ Star / Prestige</option>
                                <option value="check" <?= (($hlCard['icon'] ?? '') === 'check') ? 'selected' : '' ?>>✓ Check
                                  / Verified</option>
                              </select>
                            </div>
                          </div>
                          <div class="cms-form-group">
                            <label class="cms-form-label">Highlight Title</label>
                            <input type="text" id="h_hl_<?= $hlIdx ?>_title" class="cms-form-control hl-title"
                              value="<?= htmlspecialchars($hlCard['title'] ?? '') ?>">
                          </div>
                          <?php cms_render_image_field("Highlight Photo", "h_hl_{$hlIdx}_img", $hlCard['image'] ?? ''); ?>
                          <div class="cms-form-group">
                            <label class="cms-form-label">Description</label>
                            <textarea id="h_hl_<?= $hlIdx ?>_desc" class="cms-form-control hl-desc"
                              rows="2"><?= htmlspecialchars($hlCard['desc'] ?? '') ?></textarea>
                          </div>
                          <div class="cms-form-group" style="margin-bottom: 0;">
                            <label class="cms-form-label">Target Link</label>
                            <input type="text" id="h_hl_<?= $hlIdx ?>_link" class="cms-form-control hl-link"
                              value="<?= htmlspecialchars($hlCard['link'] ?? 'about-us') ?>">
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div style="margin-top: 0.85rem; display: flex; justify-content: flex-start;">
                      <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm" onclick="addHomeHighlight()"
                        style="display: inline-flex; align-items: center; gap: 0.4rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2.5">
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>+ Add Another College Highlight</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Vision, Mission &amp; Course Spotlight</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Vision Title</label>
                    <input type="text" id="h_vision_title" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['vision_mission']['vision_title'] ?? 'Our Vision') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Vision Description</label>
                    <textarea id="h_vision_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($home_data['vision_mission']['vision_desc'] ?? 'To be a premier institution in pharmaceutical education and research, imparting knowledge, developing skills, and inculcating professional ethics in pharmacy graduates to serve the global healthcare sector.') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Mission Title</label>
                    <input type="text" id="h_mission_title" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['vision_mission']['mission_title'] ?? 'Our Mission') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Mission Description</label>
                    <textarea id="h_mission_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($home_data['vision_mission']['mission_desc'] ?? 'To provide value-based quality pharmaceutical education through state-of-the-art infrastructure, experienced faculty, and industry-institution collaboration to meet global healthcare standards.') ?></textarea>
                  </div>

                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Course Spotlight Subtitle</label>
                      <input type="text" id="h_cs_subtitle" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['course_spotlight']['subtitle'] ?? 'Our Flagship Degree') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Course Spotlight Title</label>
                      <input type="text" id="h_cs_title" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['course_spotlight']['title'] ?? 'Bachelor of Pharmacy (B.Pharm) — 4-Year Full-Time Degree') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Course Spotlight Badge</label>
                      <input type="text" id="h_cs_badge" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['course_spotlight']['badge'] ?? 'PCI Approved & NEP 2020 Aligned') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Course Spotlight Description</label>
                      <textarea id="h_cs_desc" class="cms-form-control"
                        rows="3"><?= htmlspecialchars($home_data['course_spotlight']['desc'] ?? 'The Bachelor of Pharmacy (B.Pharm) is a four-year professional undergraduate course designed to impart in-depth knowledge of drug manufacturing, formulation development, clinical pharmacy, and pharmacology.') ?></textarea>
                    </div>
                    <?php cms_render_image_field('Course Spotlight Image', 'h_cs_image', $home_data['course_spotlight']['image'] ?? 'assets/images/pharmacy-lab-main.jpg'); ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Campus Facilities 6 Cards & Why Choose -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-top: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Campus Facilities Preview (6 Cards)</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <?php
                  $h_fac_cards = $home_data['facilities']['cards'] ?? [];
                  for ($i = 0; $i < 6; $i++):
                    $fc = $h_fac_cards[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem; margin-bottom: 0.85rem;">
                      <span style="font-size: 0.75rem; font-weight: 700; color: #D97706;">Facility Card
                        #<?= $i + 1 ?></span>
                      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: 0.4rem;">
                        <div class="cms-form-group">
                          <label class="cms-form-label">Title</label>
                          <input type="text" id="h_fac_<?= $i ?>_title" class="cms-form-control"
                            value="<?= htmlspecialchars($fc['title'] ?? '') ?>">
                        </div>
                        <div class="cms-form-group">
                          <label class="cms-form-label">Tag / Badge</label>
                          <input type="text" id="h_fac_<?= $i ?>_tag" class="cms-form-control"
                            value="<?= htmlspecialchars($fc['tag'] ?? '') ?>">
                        </div>
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Description</label>
                        <textarea id="h_fac_<?= $i ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($fc['desc'] ?? '') ?></textarea>
                      </div>
                      <?php cms_render_image_field("Facility #" . ($i + 1) . " Photo", "h_fac_{$i}_img", $fc['image'] ?? ''); ?>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Why Choose VPC &amp; Placements</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin-bottom: 0.75rem;">
                    Why Choose VEL Pharmacy College (4 Cards)</h4>
                  <?php
                  $why_cards = $home_data['why_choose']['cards'] ?? [];
                  for ($i = 0; $i < 4; $i++):
                    $wc = $why_cards[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Card #<?= $i + 1 ?> Title</label>
                        <input type="text" id="h_why_<?= $i ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($wc['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Description</label>
                        <textarea id="h_why_<?= $i ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($wc['desc'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>

                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; color: #15803D; margin-bottom: 0.75rem;">Placements
                      &amp; Career Statistics</h4>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Placement Section Heading</label>
                      <input type="text" id="h_place_heading" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['placements']['heading'] ?? 'Placements @ VISTAS') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Description</label>
                      <textarea id="h_place_desc" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($home_data['placements']['desc'] ?? 'VEL Pharmacy College is supported by the comprehensive placement network of VISTAS Deemed University.') ?></textarea>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label" style="font-size: 0.7rem;">Placement Support</label>
                        <input type="text" id="h_place_support" class="cms-form-control"
                          value="<?= htmlspecialchars($home_data['placements']['support_pct'] ?? '90%') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label" style="font-size: 0.7rem;">Placed Count</label>
                        <input type="text" id="h_place_count" class="cms-form-control"
                          value="<?= htmlspecialchars($home_data['placements']['placed_annually'] ?? '3,000+') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label" style="font-size: 0.7rem;">Highest Package</label>
                        <input type="text" id="h_place_highest" class="cms-form-control"
                          value="<?= htmlspecialchars($home_data['placements']['highest_pkg'] ?? '₹8.0 LPA') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label" style="font-size: 0.7rem;">Average Package</label>
                        <input type="text" id="h_place_avg" class="cms-form-control"
                          value="<?= htmlspecialchars($home_data['placements']['avg_pkg'] ?? '₹5.0 LPA') ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- FAQs & Bottom CTA Banner -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-top: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Frequently Asked Questions (5 FAQs)</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <?php
                  $faqs = $home_data['faqs'] ?? [];
                  for ($i = 0; $i < 5; $i++):
                    $faq = $faqs[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Question #<?= $i + 1 ?></label>
                        <input type="text" id="h_faq_<?= $i ?>_q" class="cms-form-control"
                          value="<?= htmlspecialchars($faq['q'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Answer</label>
                        <textarea id="h_faq_<?= $i ?>_a" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($faq['a'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Bottom Admission CTA Banner</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Banner Headline</label>
                    <input type="text" id="h_cta_title" class="cms-form-control"
                      value="<?= htmlspecialchars($home_data['bottom_cta']['title'] ?? 'Begin Your Journey in Pharmaceutical Excellence') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Banner Subtitle</label>
                    <textarea id="h_cta_desc" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($home_data['bottom_cta']['desc'] ?? 'Admissions are open for the 2024–2025 academic batch. Secure your seat in our PCI-approved B.Pharm program.') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button Text</label>
                      <input type="text" id="h_cta_btn_text" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['bottom_cta']['btn_text'] ?? 'Apply for B.Pharm 2024–2025') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button Link</label>
                      <input type="text" id="h_cta_btn_link" class="cms-form-control"
                        value="<?= htmlspecialchars($home_data['bottom_cta']['btn_link'] ?? 'enquiry') ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ====================================================================
       SUBTAB 2: ABOUT US PAGE CONTENT
       ==================================================================== -->
          <div id="subtab-page-about" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('about_us')">
                <span>Save About Us Changes</span>
              </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>About Us Banner &amp; Welcome</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Page Title</label>
                    <input type="text" id="ab_banner_title" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['banner']['title'] ?? 'About VEL Pharmacy College') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Subtitle</label>
                    <textarea id="ab_banner_subtitle" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($about_data['banner']['subtitle'] ?? 'An off-campus center of VELS Institute of Science, Technology & Advanced Studies...') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Badge Text</label>
                    <input type="text" id="ab_banner_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['banner']['badge'] ?? '30+ Years Educational Legacy') ?>">
                  </div>
                  <?php cms_render_image_field('Banner Image', 'ab_banner_image', $about_data['banner']['image'] ?? 'assets/images/campus-front.jpg'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Section Subtitle</label>
                    <input type="text" id="ab_welcome_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['welcome']['subtitle'] ?? 'A Noble Calling in Healthcare') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Section Title</label>
                    <input type="text" id="ab_welcome_title" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['welcome']['title'] ?? 'Welcome To VEL Pharmacy College') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Paragraph 1</label>
                    <textarea id="ab_welcome_p1" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($about_data['welcome']['paragraph_1'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Welcome Paragraph 2</label>
                    <textarea id="ab_welcome_p2" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($about_data['welcome']['paragraph_2'] ?? '') ?></textarea>
                  </div>
                  <?php cms_render_image_field('Welcome Side Image', 'ab_welcome_img', $about_data['welcome']['image'] ?? 'assets/images/about-group-pharmacy.jpg'); ?>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Versatility Cards &amp; Institutional Legacy</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin-bottom: 0.75rem;">5
                    Versatility Items (Cards)</h4>
                  <?php
                  $vers_items = $about_data['versatility']['items'] ?? [];
                  for ($i = 0; $i < 5; $i++):
                    $v = $vers_items[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.65rem; margin-bottom: 0.65rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Item #<?= $i + 1 ?> Title</label>
                        <input type="text" id="ab_vers_<?= $i ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($v['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Text</label>
                        <textarea id="ab_vers_<?= $i ?>_text" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($v['text'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>

                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Genesis &amp; Legacy Title</label>
                      <input type="text" id="ab_legacy_title" class="cms-form-control"
                        value="<?= htmlspecialchars($about_data['genesis']['title'] ?? 'Genesis of VEL Pharmacy College') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Genesis Paragraph 1</label>
                      <textarea id="ab_legacy_desc_1" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($about_data['genesis']['desc_1'] ?? '') ?></textarea>
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Genesis Paragraph 2</label>
                      <textarea id="ab_legacy_desc_2" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($about_data['genesis']['desc_2'] ?? '') ?></textarea>
                    </div>
                    <?php cms_render_image_field('Genesis Campus Image', 'ab_legacy_img', $about_data['genesis']['image'] ?? 'assets/images/campus-front.jpg'); ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Principal's Address & Sister Institutions -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-top: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Principal's Address &amp; Vision/Mission</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Principal Name</label>
                    <input type="text" id="ab_princ_name" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['principal_address']['name'] ?? 'Dr. G. Saravanan') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Principal Designation</label>
                    <input type="text" id="ab_princ_desig" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['principal_address']['designation'] ?? 'Principal & Professor, VEL Pharmacy College') ?>">
                  </div>
                  <?php cms_render_image_field('Principal Portrait Photo', 'ab_princ_img', $about_data['principal_address']['image'] ?? 'assets/images/Faculty/Dr. G. Saravanan.png'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Address / Message to Students</label>
                    <textarea id="ab_princ_msg" class="cms-form-control"
                      rows="4"><?= htmlspecialchars($about_data['principal_address']['message'] ?? '') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Vision Title</label>
                      <input type="text" id="ab_vision_title" class="cms-form-control"
                        value="<?= htmlspecialchars($about_data['vision']['title'] ?? 'Our Vision') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Mission Title</label>
                      <input type="text" id="ab_mission_title" class="cms-form-control"
                        value="<?= htmlspecialchars($about_data['mission']['title'] ?? 'Our Mission') ?>">
                    </div>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Vision Statement</label>
                    <textarea id="ab_vision_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($about_data['vision']['description'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Mission Statement</label>
                    <textarea id="ab_mission_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($about_data['mission']['description'] ?? '') ?></textarea>
                  </div>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Sister Institutions of Vels Group &amp; Bottom CTA</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Sister Institutions Heading</label>
                    <input type="text" id="ab_sister_title" class="cms-form-control"
                      value="<?= htmlspecialchars($about_data['sister_institutions']['title'] ?? 'Sister Institutions of Vels Group') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Description</label>
                    <textarea id="ab_sister_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($about_data['sister_institutions']['desc'] ?? 'A comprehensive educational ecosystem founded by Dr. Ishari K. Ganesh:') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Institutions List (One per line)</label>
                    <textarea id="ab_sister_list" class="cms-form-control"
                      rows="6"><?= htmlspecialchars(implode("\n", $about_data['sister_institutions']['institutions'] ?? [])) ?></textarea>
                  </div>
                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Bottom CTA Banner Title</label>
                      <input type="text" id="ab_cta_title" class="cms-form-control"
                        value="<?= htmlspecialchars($about_data['bottom_cta']['title'] ?? 'Experience Educational Excellence at VEL Pharmacy College') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">CTA Description</label>
                      <textarea id="ab_cta_desc" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($about_data['bottom_cta']['desc'] ?? 'Connect with our admissions desk to schedule a personalized campus tour.') ?></textarea>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Button Text</label>
                        <input type="text" id="ab_cta_btn_text" class="cms-form-control"
                          value="<?= htmlspecialchars($about_data['bottom_cta']['btn_text'] ?? 'Apply for B.Pharm 2024–2025') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Button Link</label>
                        <input type="text" id="ab_cta_btn_link" class="cms-form-control"
                          value="<?= htmlspecialchars($about_data['bottom_cta']['btn_link'] ?? 'enquiry') ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ====================================================================
       SUBTAB 3: LEADERSHIP PAGE CONTENT
       ==================================================================== -->
          <div id="subtab-page-leadership" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('leadership')">
                <span>Save Leadership Changes</span>
              </button>
            </div>

            <div class="cms-panel">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>Leadership Page Banner &amp; Header</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                  <div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Banner Page Title</label>
                      <input type="text" id="lead_banner_title" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['banner']['title'] ?? 'Leadership & Governance') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Banner Subtitle</label>
                      <textarea id="lead_banner_subtitle" class="cms-form-control"
                        rows="3"><?= htmlspecialchars($leadership_data['banner']['subtitle'] ?? 'Guided by visionary educational pioneers...') ?></textarea>
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Banner Badge Text</label>
                      <input type="text" id="lead_banner_badge" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['banner']['badge'] ?? 'Visionary Leadership') ?>">
                    </div>
                  </div>
                  <div>
                    <?php cms_render_image_field('Banner Image URL', 'lead_banner_image', $leadership_data['banner']['image'] ?? 'assets/images/Group_pic.jpg'); ?>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Section Subtitle</label>
                      <input type="text" id="lead_sec_subtitle" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['section_header']['subtitle'] ?? 'Governance & Academic Stewardship') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Section Title</label>
                      <input type="text" id="lead_sec_title" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['section_header']['title'] ?? 'Our Leadership Team') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Section Description</label>
                      <textarea id="lead_sec_desc" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($leadership_data['section_header']['description'] ?? 'Meet the esteemed trustees, university chancellors, and academic deans...') ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- 8 Leadership Profiles Grid -->
            <h3
              style="font-family: var(--cms-font-heading); font-size: 1.15rem; color: var(--cms-primary-dark); margin: 1.5rem 0 1rem;">
              All 8 University &amp; Collegiate Leaders</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
              <?php
              $leaders_list = $leadership_data['leaders'] ?? [];
              for ($i = 0; $i < 8; $i++):
                $ldr = $leaders_list[$i] ?? [];
                $badges_str = is_array($ldr['badges'] ?? null) ? implode(', ', $ldr['badges']) : ($ldr['badges'] ?? '');
                ?>
                <div class="cms-panel" style="margin-bottom: 0;">
                  <div class="cms-panel-header">
                    <div class="cms-panel-title">
                      <h4 style="font-size: 0.95rem; margin: 0; color: #FFFFFF;">Leader #<?= $i + 1 ?>:
                        <?= htmlspecialchars($ldr['tag'] ?? 'Leadership Member') ?></h4>
                    </div>
                  </div>
                  <div class="cms-panel-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Full Name</label>
                        <input type="text" id="lead_ldr_<?= $i ?>_name" class="cms-form-control"
                          value="<?= htmlspecialchars($ldr['name'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Role Tag / Pill</label>
                        <input type="text" id="lead_ldr_<?= $i ?>_tag" class="cms-form-control"
                          value="<?= htmlspecialchars($ldr['tag'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Official Designation &amp; Institution</label>
                      <input type="text" id="lead_ldr_<?= $i ?>_title" class="cms-form-control"
                        value="<?= htmlspecialchars($ldr['title'] ?? '') ?>">
                    </div>
                    <?php cms_render_image_field('Portrait Photo', "lead_ldr_{$i}_img", $ldr['image'] ?? ''); ?>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Inspirational Quote / Vision</label>
                      <textarea id="lead_ldr_<?= $i ?>_quote" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($ldr['quote'] ?? '') ?></textarea>
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Badges / Key Focus Tags (comma-separated)</label>
                      <input type="text" id="lead_ldr_<?= $i ?>_badges" class="cms-form-control"
                        value="<?= htmlspecialchars($badges_str) ?>"
                        placeholder="e.g. Visionary Pioneer, Statutory Oversight">
                    </div>
                  </div>
                </div>
              <?php endfor; ?>
            </div>

            <!-- Governance Philosophy & Admissions CTA -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
              <!-- Governance Philosophy -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Governance Philosophy (3 Cards)</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Subtitle</label>
                    <input type="text" id="lead_gov_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($leadership_data['governance_philosophy']['subtitle'] ?? 'Ethical Foundation') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Title</label>
                    <input type="text" id="lead_gov_title" class="cms-form-control"
                      value="<?= htmlspecialchars($leadership_data['governance_philosophy']['title'] ?? 'Our Governance Philosophy') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Description</label>
                    <textarea id="lead_gov_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($leadership_data['governance_philosophy']['description'] ?? 'VEL Pharmacy College operates under strict regulatory compliance with the Pharmacy Council of India (PCI) and UGC guidelines.') ?></textarea>
                  </div>

                  <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">3
                    Governance Pillars</h4>
                  <?php
                  $gov_cards = $leadership_data['governance_philosophy']['cards'] ?? [];
                  for ($cIdx = 0; $cIdx < 3; $cIdx++):
                    $gCard = $gov_cards[$cIdx] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Card #<?= $cIdx + 1 ?> Title</label>
                        <input type="text" id="lead_gov_c_<?= $cIdx ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($gCard['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Card #<?= $cIdx + 1 ?> Description</label>
                        <textarea id="lead_gov_c_<?= $cIdx ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($gCard['desc'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>

              <!-- Admissions CTA Banner -->
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Leadership Page Bottom CTA</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Heading</label>
                    <input type="text" id="lead_cta_title" class="cms-form-control"
                      value="<?= htmlspecialchars($leadership_data['cta_banner']['title'] ?? 'Begin Your Journey in Pharmaceutical Excellence') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Subtitle</label>
                    <textarea id="lead_cta_sub" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($leadership_data['cta_banner']['subtitle'] ?? 'Enroll in the 4-year B.Pharm degree program at VEL Pharmacy College and learn under the guidance of visionary academic mentors.') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button 1 Label</label>
                      <input type="text" id="lead_cta_b1_text" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['cta_banner']['btn1_text'] ?? 'Apply for Admissions') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button 1 Link</label>
                      <input type="text" id="lead_cta_b1_link" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['cta_banner']['btn1_link'] ?? 'enquiry') ?>">
                    </div>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button 2 Label</label>
                      <input type="text" id="lead_cta_b2_text" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['cta_banner']['btn2_text'] ?? 'Contact Admissions Office') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Button 2 Link</label>
                      <input type="text" id="lead_cta_b2_link" class="cms-form-control"
                        value="<?= htmlspecialchars($leadership_data['cta_banner']['btn2_link'] ?? 'contact-us') ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- ====================================================================
       SUBTAB 4: COURSES & B.PHARM PAGE CONTENT
       ==================================================================== -->
          <div id="subtab-page-courses" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('courses')">
                <span>Save Courses Page Changes</span>
              </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>B.Pharm Program Banner &amp; 6 Quick Highlights</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Page Banner Title</label>
                    <input type="text" id="c_crs_title" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['banner']['title'] ?? 'Bachelor of Pharmacy (B.Pharm)') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Page Subtitle</label>
                    <textarea id="c_crs_subtitle" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($courses_data['banner']['subtitle'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Badge Text</label>
                    <input type="text" id="c_crs_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['banner']['badge'] ?? 'PCI NEP 2020 Regulation') ?>">
                  </div>
                  <?php cms_render_image_field('Banner Image URL', 'c_crs_image', $courses_data['banner']['image'] ?? 'assets/images/pharmacy-lab-main.jpg'); ?>

                  <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">6
                    Quick Strip Highlights</h4>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Program Level</label>
                      <input type="text" id="c_crs_level" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['level'] ?? 'Undergraduate (UG)') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Duration</label>
                      <input type="text" id="c_crs_duration" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['duration'] ?? '4 Years (8 Semesters)') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Total Credits</label>
                      <input type="text" id="c_crs_credits" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['credits'] ?? '193 Credits (CBCS)') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Statutory Approval Body</label>
                      <input type="text" id="c_crs_approval" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['approval'] ?? 'Pharmacy Council of India (PCI)') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Curriculum Model</label>
                      <input type="text" id="c_crs_curriculum" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['curriculum'] ?? 'NEP 2020 Aligned') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Medium of Instruction</label>
                      <input type="text" id="c_crs_medium" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['highlights']['medium'] ?? 'English') ?>">
                    </div>
                  </div>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Program Overview &amp; Eligibility Criteria</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Subtitle</label>
                    <input type="text" id="c_ov_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['overview']['subtitle'] ?? 'Excellence in Pharmaceutical Education') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Title</label>
                    <input type="text" id="c_ov_title" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['overview']['title'] ?? 'Courses Offered - B.Pharm') ?>">
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Overview Badge</label>
                      <input type="text" id="c_ov_badge" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['overview']['badge'] ?? 'Off-Campus Center & Hospital') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Overview Location Pill</label>
                      <input type="text" id="c_ov_pill" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['overview']['pill'] ?? 'VMCH Campus, Manjankaranai, Tiruvallur') ?>">
                    </div>
                  </div>
                  <?php cms_render_image_field('Overview Lab Image', 'c_ov_image', $courses_data['overview']['image'] ?? 'assets/images/pharmacy-lab-main.jpg'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Paragraph 1</label>
                    <textarea id="c_ov_desc_p1" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($courses_data['overview']['desc_p1'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Paragraph 2</label>
                    <textarea id="c_ov_desc_p2" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($courses_data['overview']['desc_p2'] ?? '') ?></textarea>
                  </div>

                  <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Eligibility Heading</label>
                      <input type="text" id="c_crs_el_title" class="cms-form-control"
                        value="<?= htmlspecialchars($courses_data['eligibility']['title'] ?? 'Eligibility for Admission') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">10+2 Requirement</label>
                      <textarea id="c_crs_hsc" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($courses_data['eligibility']['hsc_requirement'] ?? '') ?></textarea>
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Lateral Entry Criteria</label>
                      <textarea id="c_crs_lateral" class="cms-form-control"
                        rows="2"><?= htmlspecialchars($courses_data['eligibility']['lateral_entry'] ?? '') ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Courses Page Bottom CTA Banner -->
            <div class="cms-panel" style="margin-top: 1.5rem; margin-bottom: 1.5rem;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>Courses Page Admissions CTA Banner</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem;">
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Pill Badge</label>
                    <input type="text" id="c_cta_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['badge'] ?? 'Admissions Open • B.Pharm Program') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">CTA Heading</label>
                    <input type="text" id="c_cta_title" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['title'] ?? 'Join VEL Pharmacy College Under the Modern NEP 2020 Framework') ?>">
                  </div>
                </div>
                <div class="cms-form-group">
                  <label class="cms-form-label">CTA Description</label>
                  <textarea id="c_cta_sub" class="cms-form-control"
                    rows="2"><?= htmlspecialchars($courses_data['cta_banner']['subtitle'] ?? 'Merit-based admissions for +2 passed students (PCM/PCB) and lateral entry for D.Pharm holders. Connect with our admissions desk to secure your academic future today.') ?></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 0.75rem;">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Primary Button Text</label>
                    <input type="text" id="c_cta_b1_text" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['btn1_text'] ?? 'Submit Online Admission Enquiry') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Primary Button Link</label>
                    <input type="text" id="c_cta_b1_link" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['btn1_link'] ?? 'enquiry') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Phone Button Text</label>
                    <input type="text" id="c_cta_b2_text" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['btn2_text'] ?? 'Call: +91 812 261 3300') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Phone Button Link</label>
                    <input type="text" id="c_cta_b2_link" class="cms-form-control"
                      value="<?= htmlspecialchars($courses_data['cta_banner']['btn2_link'] ?? 'tel:+918122613300') ?>">
                  </div>
                </div>
              </div>
            </div>

            <!-- PCI Graduate Attributes (GA-01 to GA-10) Editor -->
            <div class="cms-panel" style="margin-bottom: 1.5rem;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>PCI Graduate Attributes (GA-01 to GA-10) &amp; Pharmacist's Oath</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 1rem;">10 Outcome-Based Educational
                  objectives mandated by Pharmacy Council of India (PCI) NEP 2020 curriculum.</p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                  <?php
                  $ga_list = $nep_syllabus_cms['graduate_attributes'] ?? [];
                  for ($gaIdx = 0; $gaIdx < 10; $gaIdx++):
                    $ga = $ga_list[$gaIdx] ?? [];
                    $gaNum = str_pad($gaIdx + 1, 2, '0', STR_PAD_LEFT);
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem;">
                      <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span class="badge-tag"
                          style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700;">GA ·
                          <?= $gaNum ?></span>
                        <input type="hidden" id="crs_ga_<?= $gaIdx ?>_num" value="<?= $gaNum ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Attribute Title</label>
                        <input type="text" id="crs_ga_<?= $gaIdx ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($ga['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Description / Educational Objective</label>
                        <textarea id="crs_ga_<?= $gaIdx ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($ga['desc'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>

                <div style="border-top: 1px dashed #E2E8F0; padding-top: 1rem; margin-top: 1rem;">
                  <div class="cms-form-group">
                    <label class="cms-form-label">The Pharmacist's Oath (PCI Code of Ethics)</label>
                    <textarea id="crs_ga_oath_text" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($nep_syllabus_cms['pharmacist_oath']['text'] ?? 'I swear by the code of ethics of Pharmacy Council of India, in relation to the community and shall act as an integral part of health care team... I shall endeavour to discover and manufacture drugs of quality to alleviate sufferings of humanity.') ?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- 8 Semesters Full Course Modules Editor -->
            <div class="cms-panel" style="margin-bottom: 0;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>Full 8-Semester NEP 2020 Curriculum Modules (All 88 Subjects)</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 1.25rem;">
                  Edit subject codes, course titles, delivery types (Theory/Practical), categories (Core/AEC/SEC/VAC),
                  teaching hours, and credit values across all 8 academic semesters.
                </p>

                <?php
                $semesters_data = $nep_syllabus_cms['semesters'] ?? [];
                for ($s = 1; $s <= 8; $s++):
                  $semKey = "sem{$s}";
                  $sem = $semesters_data[$semKey] ?? [];
                  $courses = $sem['courses'] ?? [];
                  ?>
                  <div
                    style="border: 1px solid #CBD5E1; border-radius: var(--radius-md); margin-bottom: 1.25rem; overflow: hidden;">
                    <div
                      style="background: #F1F5F9; padding: 0.75rem 1rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #CBD5E1;">
                      <div>
                        <strong
                          style="color: var(--cms-primary-dark); font-size: 1rem;"><?= htmlspecialchars($sem['title'] ?? "Semester {$s}") ?></strong>
                        <span style="font-size: 0.8rem; color: #64748B; margin-left: 0.75rem;">(<?= count($courses) ?>
                          Course Modules)</span>
                      </div>
                      <div style="display: flex; gap: 0.75rem; align-items: center;">
                        <span class="badge-tag" style="background: #FEF3C7; color: #B45309; font-weight: 700;">
                          <?= htmlspecialchars($sem['total_credits'] ?? '') ?>
                        </span>
                        <span class="badge-tag" style="background: #E2E8F0; color: #334155;">
                          <?= htmlspecialchars($sem['total_hours'] ?? '') ?>
                        </span>
                      </div>
                    </div>

                    <div style="padding: 0.75rem; overflow-x: auto;">
                      <table class="cms-table" style="width: 100%; font-size: 0.82rem; margin-bottom: 0;">
                        <thead>
                          <tr style="background: #F8FAFC;">
                            <th style="width: 12%;">Code</th>
                            <th style="width: 38%;">Course Title</th>
                            <th style="width: 16%;">Type</th>
                            <th style="width: 14%;">Category</th>
                            <th style="width: 10%;">Hours</th>
                            <th style="width: 10%;">Credits</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($courses as $cIdx => $c): ?>
                            <tr>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_code" class="cms-form-control"
                                  style="font-weight: 700; font-size: 0.8rem; padding: 0.35rem 0.5rem;"
                                  value="<?= htmlspecialchars($c['code'] ?? '') ?>">
                              </td>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_title" class="cms-form-control"
                                  style="font-size: 0.82rem; padding: 0.35rem 0.5rem;"
                                  value="<?= htmlspecialchars($c['title'] ?? '') ?>">
                              </td>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_type" class="cms-form-control"
                                  style="font-size: 0.8rem; padding: 0.35rem 0.5rem;"
                                  value="<?= htmlspecialchars($c['type'] ?? '') ?>">
                              </td>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_cat" class="cms-form-control"
                                  style="font-size: 0.8rem; padding: 0.35rem 0.5rem;"
                                  value="<?= htmlspecialchars($c['category'] ?? '') ?>">
                              </td>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_hrs" class="cms-form-control"
                                  style="font-size: 0.8rem; padding: 0.35rem 0.5rem; text-align: center;"
                                  value="<?= htmlspecialchars($c['hours'] ?? '') ?>">
                              </td>
                              <td>
                                <input type="text" id="crs_s_<?= $semKey ?>_c_<?= $cIdx ?>_crd" class="cms-form-control"
                                  style="font-size: 0.8rem; padding: 0.35rem 0.5rem; font-weight: 700; text-align: center;"
                                  value="<?= htmlspecialchars($c['credits'] ?? '') ?>">
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php endfor; ?>

              </div>
            </div>
          </div> <!-- ====================================================================
       SUBTAB 5: CAMPUS FACILITIES & LABS
       ==================================================================== -->
          <div id="subtab-page-facilities" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('facilities')">
                <span>Save Facilities Changes</span>
              </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Facilities Banner &amp; Campus Overview</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Title</label>
                    <input type="text" id="fac_banner_title" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['banner']['title'] ?? 'Campus Facilities & Laboratories') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Subtitle</label>
                    <textarea id="fac_banner_subtitle" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($facilities_data['banner']['subtitle'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Banner Badge Text</label>
                    <input type="text" id="fac_banner_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['banner']['badge'] ?? 'High-Tech Laboratories') ?>">
                  </div>
                  <?php cms_render_image_field('Banner Image URL', 'fac_banner_image', $facilities_data['banner']['image'] ?? 'assets/images/library-main.jpg'); ?>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Subtitle</label>
                    <input type="text" id="fac_ov_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['overview']['subtitle'] ?? 'Infrastructure That Inspires Learning') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Title</label>
                    <input type="text" id="fac_ov_title" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['overview']['title'] ?? 'Modern Infrastructure In a Serene Green Campus') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Description 1</label>
                    <textarea id="fac_ov_desc1" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($facilities_data['overview']['description_1'] ?? '') ?></textarea>
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Overview Description 2</label>
                    <textarea id="fac_ov_desc2" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($facilities_data['overview']['description_2'] ?? '') ?></textarea>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Lab Count Badge</label>
                      <input type="text" id="fac_lab_count" class="cms-form-control"
                        value="<?= htmlspecialchars($facilities_data['overview']['lab_count'] ?? '15+ Laboratories') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Hospital Info Badge</label>
                      <input type="text" id="fac_hospital_info" class="cms-form-control"
                        value="<?= htmlspecialchars($facilities_data['overview']['hospital_info'] ?? 'VMCH Hospital') ?>">
                    </div>
                  </div>
                  <?php cms_render_image_field('Campus Front Showcase Photo', 'fac_front_img', $facilities_data['overview']['campus_front_img'] ?? 'assets/images/campus-front.jpg'); ?>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Amenities Header &amp; All 9 Campus Amenities</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Amenities Section Subtitle</label>
                    <input type="text" id="fac_am_subtitle" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['amenities_header']['subtitle'] ?? 'Academic & Living Amenities') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Amenities Section Title</label>
                    <input type="text" id="fac_am_title" class="cms-form-control"
                      value="<?= htmlspecialchars($facilities_data['amenities_header']['title'] ?? 'Comprehensive Campus Amenities') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Amenities Section Description</label>
                    <textarea id="fac_am_desc" class="cms-form-control"
                      rows="2"><?= htmlspecialchars($facilities_data['amenities_header']['description'] ?? '') ?></textarea>
                  </div>

                  <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">
                    All 9 Amenities Cards (with Photos)</h4>
                  <?php
                  $amenities = $facilities_data['amenities'] ?? [];
                  for ($i = 0; $i < 9; $i++):
                    $am = $amenities[$i] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Amenity #<?= $i + 1 ?> Title</label>
                        <input type="text" id="fac_am_<?= $i ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($am['title'] ?? '') ?>">
                      </div>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Description</label>
                        <textarea id="fac_am_<?= $i ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($am['desc'] ?? '') ?></textarea>
                      </div>
                      <?php cms_render_image_field("Amenity #" . ($i + 1) . " Photo", "fac_am_{$i}_img", $am['image'] ?? ''); ?>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>

            <!-- 8 Specialized Pharmaceutical Research Laboratories -->
            <div class="cms-panel" style="margin-top: 1.5rem; margin-bottom: 1.5rem;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>8 Specialized Research Laboratories (with Photos &amp; Specs)</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 1rem;">
                  PCI-mandated pharmaceutical research laboratory suites with instruments, precision machinery, and
                  safety apparatus.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                  <?php
                  $spec_labs = $facilities_data['specialized_labs'] ?? [];
                  for ($lIdx = 0; $lIdx < 8; $lIdx++):
                    $lab = $spec_labs[$lIdx] ?? [];
                    ?>
                    <div
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem;">
                      <div class="cms-form-group">
                        <label class="cms-form-label">Lab #<?= $lIdx + 1 ?> Title</label>
                        <input type="text" id="fac_lab_<?= $lIdx ?>_title" class="cms-form-control"
                          value="<?= htmlspecialchars($lab['title'] ?? '') ?>">
                      </div>
                      <?php cms_render_image_field("Lab #" . ($lIdx + 1) . " Photo", "fac_lab_{$lIdx}_img", $lab['image'] ?? ''); ?>
                      <div class="cms-form-group">
                        <label class="cms-form-label">Equipment &amp; Facilities Description</label>
                        <textarea id="fac_lab_<?= $lIdx ?>_desc" class="cms-form-control"
                          rows="2"><?= htmlspecialchars($lab['description'] ?? '') ?></textarea>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>

            <!-- Placements @ VISTAS Section -->
            <div class="cms-panel" style="margin-bottom: 0;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>Placements @ VISTAS Statistics &amp; Recruitment</h3>
                </div>
              </div>
              <div class="cms-panel-body">
                <?php $pl = $facilities_data['placements'] ?? []; ?>
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem;">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Badge Tag</label>
                    <input type="text" id="fac_pl_badge" class="cms-form-control"
                      value="<?= htmlspecialchars($pl['badge'] ?? 'Career Growth & Industry Alignment') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Section Heading</label>
                    <input type="text" id="fac_pl_title" class="cms-form-control"
                      value="<?= htmlspecialchars($pl['title'] ?? 'Placements @ VISTAS') ?>">
                  </div>
                </div>
                <div class="cms-form-group">
                  <label class="cms-form-label">Overview Description</label>
                  <textarea id="fac_pl_desc1" class="cms-form-control"
                    rows="2"><?= htmlspecialchars($pl['description_1'] ?? 'Vels Institute of Science, Technology and Advanced Studies (VISTAS) is a representation of knowledge and possibilities. It is one of the prestigious, high-grade multidisciplinary Universities in Chennai, securing the highest number of placement offers in the region.') ?></textarea>
                </div>

                <h4 style="font-size: 0.85rem; font-weight: 700; color: #15803D; margin: 1rem 0 0.5rem;">4 Placement
                  Achievement Counters</h4>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem;">
                  <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.65rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 1 Value</label>
                      <input type="text" id="fac_pl_s1_val" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_1_val'] ?? '90%') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 1 Label</label>
                      <input type="text" id="fac_pl_s1_lbl" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_1_lbl'] ?? 'Assured Placement Support') ?>">
                    </div>
                  </div>
                  <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.65rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 2 Value</label>
                      <input type="text" id="fac_pl_s2_val" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_2_val'] ?? '3000+') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 2 Label</label>
                      <input type="text" id="fac_pl_s2_lbl" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_2_lbl'] ?? 'Students Placed Annually') ?>">
                    </div>
                  </div>
                  <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.65rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 3 Value</label>
                      <input type="text" id="fac_pl_s3_val" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_3_val'] ?? '₹8.0 LPA') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 3 Label</label>
                      <input type="text" id="fac_pl_s3_lbl" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_3_lbl'] ?? 'Highest Salary Package') ?>">
                    </div>
                  </div>
                  <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.65rem;">
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 4 Value</label>
                      <input type="text" id="fac_pl_s4_val" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_4_val'] ?? '₹5.0 LPA') ?>">
                    </div>
                    <div class="cms-form-group">
                      <label class="cms-form-label">Stat 4 Label</label>
                      <input type="text" id="fac_pl_s4_lbl" class="cms-form-control"
                        value="<?= htmlspecialchars($pl['stat_4_lbl'] ?? 'Average Salary Standard') ?>">
                    </div>
                  </div>
                </div>

                <div class="cms-form-group" style="margin-top: 1rem;">
                  <label class="cms-form-label">Training &amp; Recruiter Network Description</label>
                  <textarea id="fac_pl_desc2" class="cms-form-control"
                    rows="2"><?= htmlspecialchars($pl['description_2'] ?? 'Being the top-ranked university in Chennai, VISTAS provides comprehensive placement coaching and essential soft-skills training to students. High-level product-based companies and prominent pharmaceutical leaders are our prime recruiters. Specially designed Employability Skill Development Programs ensure every graduate enters the industry career-ready.') ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Button Label</label>
                    <input type="text" id="fac_pl_btn_text" class="cms-form-control"
                      value="<?= htmlspecialchars($pl['btn_text'] ?? 'Apply Now for B.Pharm 2024-25') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Button Link</label>
                    <input type="text" id="fac_pl_btn_link" class="cms-form-control"
                      value="<?= htmlspecialchars($pl['btn_link'] ?? 'enquiry') ?>">
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- ====================================================================
       SUBTAB: HIGHLIGHTS, CIRCULARS & NOTICES PAGE CONTENT
       ==================================================================== -->
          <div id="subtab-page-highlights" class="cms-subtab-pane">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
              <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('highlights')">
                <span>Save Highlights &amp; Circulars Changes</span>
              </button>
            </div>

            <!-- Page Banner & Intro Bar -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-bottom: 1.5rem;">
              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Highlights Hero Banner</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Page Title</label>
                    <input type="text" id="hl_banner_title" class="cms-form-control"
                      value="<?= htmlspecialchars($highlights_data['banner']['title'] ?? 'Institutional Highlights & Official Circulars') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Subtitle</label>
                    <textarea id="hl_banner_sub" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($highlights_data['banner']['subtitle'] ?? 'Statutory PCI approvals, official academic circulars, advanced research laboratory suites, and proceedings of concluded healthcare symposiums at VEL Pharmacy College.') ?></textarea>
                  </div>
                  <?php cms_render_image_field('Hero Media Image', 'hl_banner_img', $highlights_data['banner']['image'] ?? 'assets/images/campus-front.jpg'); ?>
                </div>
              </div>

              <div class="cms-panel" style="margin-bottom: 0;">
                <div class="cms-panel-header">
                  <div class="cms-panel-title">
                    <h3>Document Repository Intro</h3>
                  </div>
                </div>
                <div class="cms-panel-body">
                  <div class="cms-form-group">
                    <label class="cms-form-label">Intro Bar Heading</label>
                    <input type="text" id="hl_intro_title" class="cms-form-control"
                      value="<?= htmlspecialchars($highlights_data['intro']['title'] ?? 'Institutional Documents & Milestone Archive') ?>">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-form-label">Intro Bar Subtitle</label>
                    <textarea id="hl_intro_sub" class="cms-form-control"
                      rows="3"><?= htmlspecialchars($highlights_data['intro']['subtitle'] ?? 'Explore official gazette notifications, laboratory facility commissioning records, and past academic proceedings with preview notice images.') ?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- Circulars & Highlights List (Dynamic Container) -->
            <div class="cms-panel" style="margin-bottom: 0;">
              <div class="cms-panel-header">
                <div class="cms-panel-title">
                  <h3>Official Circulars, Lab Notices &amp; Concluded Events (<span
                      id="highlightsItemsCount"><?= count($highlights_data['items'] ?? []) ?></span> Items)</h3>
                </div>
                <button type="button" class="cms-btn cms-btn-primary cms-btn-sm" onclick="addHighlightsPageItem()"
                  style="display: inline-flex; align-items: center; gap: 0.4rem;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                  <span>+ Add Notice / Circular</span>
                </button>
              </div>
              <div class="cms-panel-body">
                <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 1rem;">
                  Edit circular numbers, release dates, badges, notice preview images, summaries, and action button
                  links.
                </p>

                <div id="highlightsItemsContainer" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                  <?php
                  $hl_items = $highlights_data['items'] ?? [];
                  foreach ($hl_items as $hIdx => $it):
                    ?>
                    <div class="cms-hl-item-card"
                      style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem;">
                      <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span class="badge-tag cms-hl-item-num"
                          style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700;">Item
                          #<?= $hIdx + 1 ?></span>
                        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm"
                          onclick="removeHighlightsPageItem(this)"
                          style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;"
                          title="Delete this notice item">
                          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                          </svg>
                          <span>Delete</span>
                        </button>
                      </div>
                      <input type="hidden" id="hl_it_<?= $hIdx ?>_id" class="hl-it-id"
                        value="<?= htmlspecialchars($it['id'] ?? 'hl-' . ($hIdx + 1)) ?>">
                      <input type="hidden" id="hl_it_<?= $hIdx ?>_slug" class="hl-it-slug"
                        value="<?= htmlspecialchars($it['slug'] ?? ($it['id'] ?? 'hl-' . ($hIdx + 1))) ?>">
                      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
                        <div class="cms-form-group">
                          <label class="cms-form-label">Item #<?= $hIdx + 1 ?> Title</label>
                          <input type="text" id="hl_it_<?= $hIdx ?>_title" class="cms-form-control hl-it-title"
                            value="<?= htmlspecialchars($it['title'] ?? '') ?>">
                        </div>
                        <div class="cms-form-group">
                          <label class="cms-form-label">Category Filter</label>
                          <select id="hl_it_<?= $hIdx ?>_cat" class="cms-form-control hl-it-cat">
                            <option value="pci" <?= (($it['category'] ?? '') === 'pci') ? 'selected' : '' ?>>PCI Statutory
                            </option>
                            <option value="curriculum" <?= (($it['category'] ?? '') === 'curriculum') ? 'selected' : '' ?>>
                              Curriculum</option>
                            <option value="infrastructure" <?= (($it['category'] ?? '') === 'infrastructure') ? 'selected' : '' ?>>Infrastructure</option>
                            <option value="concluded" <?= (($it['category'] ?? '') === 'concluded') ? 'selected' : '' ?>>
                              Concluded Event</option>
                          </select>
                        </div>
                      </div>

                      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        <div class="cms-form-group">
                          <label class="cms-form-label">Badge Pill Text</label>
                          <input type="text" id="hl_it_<?= $hIdx ?>_badge" class="cms-form-control hl-it-badge"
                            value="<?= htmlspecialchars($it['badge'] ?? '') ?>">
                        </div>
                        <div class="cms-form-group">
                          <label class="cms-form-label">Circular / Reference No.</label>
                          <input type="text" id="hl_it_<?= $hIdx ?>_ref" class="cms-form-control hl-it-ref"
                            value="<?= htmlspecialchars($it['circular_no'] ?? '') ?>">
                        </div>
                      </div>

                      <div class="cms-form-group">
                        <label class="cms-form-label">Official Publication Date</label>
                        <input type="text" id="hl_it_<?= $hIdx ?>_date" class="cms-form-control hl-it-date"
                          value="<?= htmlspecialchars($it['date'] ?? '') ?>">
                      </div>

                      <?php cms_render_image_field("Notice Document / Facility Photo", "hl_it_{$hIdx}_img", $it['notice_image'] ?? ''); ?>

                      <div class="cms-form-group">
                        <label class="cms-form-label">Notice Summary</label>
                        <textarea id="hl_it_<?= $hIdx ?>_summary" class="cms-form-control hl-it-summary"
                          rows="2"><?= htmlspecialchars($it['summary'] ?? '') ?></textarea>
                      </div>

                      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        <div class="cms-form-group">
                          <label class="cms-form-label">Action Button Label</label>
                          <input type="text" id="hl_it_<?= $hIdx ?>_btn_text" class="cms-form-control hl-it-btn-text"
                            value="<?= htmlspecialchars($it['primary_btn_text'] ?? 'View Details') ?>">
                        </div>
                        <div class="cms-form-group">
                          <label class="cms-form-label">Action Button Link</label>
                          <input type="text" id="hl_it_<?= $hIdx ?>_btn_link" class="cms-form-control hl-it-btn-link"
                            value="<?= htmlspecialchars($it['primary_btn_link'] ?? '') ?>">
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
                  <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm" onclick="addHighlightsPageItem()"
                    style="display: inline-flex; align-items: center; gap: 0.4rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2.5">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>+ Add Another Notice / Circular</span>
                  </button>
                  <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('highlights')">
                    <span>Save Highlights &amp; Circulars Changes</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>

  <!-- ====================================================================
       SUBTAB 6: FACULTY PAGE BANNER & INTRO
       ==================================================================== -->
  <div id="subtab-page-faculties" class="cms-subtab-pane">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
      <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('faculties_page')">
        <span>Save Faculty Banner Changes</span>
      </button>
    </div>
    <div class="cms-panel" style="max-width: 860px;">
      <div class="cms-panel-header">
        <div class="cms-panel-title">
          <h3>Faculty Directory Hero Banner &amp; Introduction</h3>
        </div>
      </div>
      <div class="cms-panel-body">
        <div class="cms-form-group">
          <label class="cms-form-label">Page Banner Title</label>
          <input type="text" id="facp_banner_title" class="cms-form-control"
            value="<?= htmlspecialchars($faculties_page_data['banner']['title'] ?? 'Faculty Directory & Academic Mentors') ?>">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Page Subtitle</label>
          <textarea id="facp_banner_subtitle" class="cms-form-control"
            rows="3"><?= htmlspecialchars($faculties_page_data['banner']['subtitle'] ?? '') ?></textarea>
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Banner Badge Text</label>
          <input type="text" id="facp_banner_badge" class="cms-form-control"
            value="<?= htmlspecialchars($faculties_page_data['banner']['badge'] ?? 'PCI Approved Cadre') ?>">
        </div>
        <?php cms_render_image_field('Banner Image URL', 'facp_banner_image', $faculties_page_data['banner']['image'] ?? 'assets/images/Faculty/Dr. G. Saravanan.png'); ?>
        <div class="cms-form-group">
          <label class="cms-form-label">Intro Heading</label>
          <input type="text" id="facp_intro_title" class="cms-form-control"
            value="<?= htmlspecialchars($faculties_page_data['intro']['title'] ?? 'Experienced Faculty Dedicated to Student Success') ?>">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Intro Description</label>
          <textarea id="facp_intro_desc" class="cms-form-control"
            rows="3"><?= htmlspecialchars($faculties_page_data['intro']['description'] ?? '') ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- ====================================================================
       SUBTAB 7: ANTI-RAGGING SAFETY PAGE CONTENT
       ==================================================================== -->
  <div id="subtab-page-antiragging" class="cms-subtab-pane">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
      <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('anti_ragging')">
        <span>Save Anti-Ragging Changes</span>
      </button>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Banner, Helplines &amp; Zero-Tolerance Stance</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Page Banner Title</label>
            <input type="text" id="ar_banner_title" class="cms-form-control"
              value="<?= htmlspecialchars($antiragging_data['banner']['title'] ?? 'Anti-Ragging & Student Safety') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Subtitle</label>
            <textarea id="ar_banner_subtitle" class="cms-form-control"
              rows="3"><?= htmlspecialchars($antiragging_data['banner']['subtitle'] ?? '') ?></textarea>
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Badge Text</label>
            <input type="text" id="ar_banner_badge" class="cms-form-control"
              value="<?= htmlspecialchars($antiragging_data['banner']['badge'] ?? 'Zero-Tolerance Policy') ?>">
          </div>
          <?php cms_render_image_field('Banner Image URL', 'ar_banner_image', $antiragging_data['banner']['image'] ?? 'assets/images/seminar-hall.jpg'); ?>

          <h4 style="font-size: 0.85rem; font-weight: 700; color: #DC2626; margin: 1rem 0 0.5rem;">Helplines</h4>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">National Toll-Free Helpline</label>
              <input type="text" id="ar_tollfree" class="cms-form-control"
                value="<?= htmlspecialchars($antiragging_data['helpline']['national_tollfree'] ?? '1800-180-5522') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">National Web Portal</label>
              <input type="text" id="ar_portal" class="cms-form-control"
                value="<?= htmlspecialchars($antiragging_data['helpline']['national_portal'] ?? 'www.antiragging.in') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Campus Emergency Cell Phone</label>
              <input type="text" id="ar_campus_cell" class="cms-form-control"
                value="<?= htmlspecialchars($antiragging_data['helpline']['campus_cell'] ?? '+91 812 261 3300') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Anti-Ragging Squad Email</label>
              <input type="text" id="ar_email" class="cms-form-control"
                value="<?= htmlspecialchars($antiragging_data['helpline']['email'] ?? 'antiragging@velpharmacycollege.com') ?>">
            </div>
          </div>
        </div>
      </div>

      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Zero-Tolerance Policy, Legal Sanctions &amp; 3 Cells</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Policy Heading</label>
            <input type="text" id="ar_pol_title" class="cms-form-control"
              value="<?= htmlspecialchars($antiragging_data['policy']['title'] ?? 'Our Unwavering Anti-Ragging Stance') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Zero-Tolerance Quote</label>
            <textarea id="ar_pol_quote" class="cms-form-control"
              rows="3"><?= htmlspecialchars($antiragging_data['policy']['quote'] ?? '') ?></textarea>
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Policy Details Paragraph 1</label>
            <textarea id="ar_pol_p1" class="cms-form-control"
              rows="2"><?= htmlspecialchars($antiragging_data['policy']['p1'] ?? '') ?></textarea>
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Legal Consequences (One per line)</label>
            <textarea id="ar_pol_consequences" class="cms-form-control"
              rows="4"><?= htmlspecialchars(implode("\n", $antiragging_data['policy']['consequences'] ?? [])) ?></textarea>
          </div>

          <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">3
            Statutory Protection Cells</h4>
          <?php
          $cells = $antiragging_data['cells'] ?? [];
          for ($i = 0; $i < 3; $i++):
            $c = $cells[$i] ?? [];
            ?>
            <div
              style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                <div class="cms-form-group">
                  <label class="cms-form-label">Cell Badge</label>
                  <input type="text" id="ar_cell_<?= $i ?>_badge" class="cms-form-control"
                    value="<?= htmlspecialchars($c['badge'] ?? '') ?>">
                </div>
                <div class="cms-form-group">
                  <label class="cms-form-label">Cell Title</label>
                  <input type="text" id="ar_cell_<?= $i ?>_title" class="cms-form-control"
                    value="<?= htmlspecialchars($c['title'] ?? '') ?>">
                </div>
              </div>
              <div class="cms-form-group">
                <label class="cms-form-label">Description</label>
                <textarea id="ar_cell_<?= $i ?>_desc" class="cms-form-control"
                  rows="2"><?= htmlspecialchars($c['desc'] ?? '') ?></textarea>
              </div>
              <div class="cms-form-group">
                <label class="cms-form-label">PDF Download Document Path</label>
                <input type="text" id="ar_cell_<?= $i ?>_link" class="cms-form-control"
                  value="<?= htmlspecialchars($c['doc_link'] ?? '') ?>">
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- ====================================================================
       SUBTAB 8: CONTACT US & LOCATION PAGE CONTENT
       ==================================================================== -->
  <div id="subtab-page-contact" class="cms-subtab-pane">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
      <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('contact_us')">
        <span>Save Contact Details</span>
      </button>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Contact Banner &amp; 4 Contact Cards</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Page Title</label>
            <input type="text" id="ct_banner_title" class="cms-form-control"
              value="<?= htmlspecialchars($contact_page_data['banner']['title'] ?? 'Contact & Campus Location') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Subtitle</label>
            <textarea id="ct_banner_subtitle" class="cms-form-control"
              rows="3"><?= htmlspecialchars($contact_page_data['banner']['subtitle'] ?? '') ?></textarea>
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Badge Text</label>
            <input type="text" id="ct_banner_badge" class="cms-form-control"
              value="<?= htmlspecialchars($contact_page_data['banner']['badge'] ?? 'Admissions Helpdesk') ?>">
          </div>
          <?php cms_render_image_field('Banner Image URL', 'ct_banner_image', $contact_page_data['banner']['image'] ?? 'assets/images/campus-front.jpg'); ?>

          <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">4 Contact
            Cards Details</h4>
          <div
            style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Card 1: Location Title &amp; Address</label>
              <input type="text" id="ct_card_loc_title" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['address_card']['title'] ?? 'Campus Location') ?>"
                style="margin-bottom: 0.35rem;">
              <textarea id="ct_card_loc_addr" class="cms-form-control"
                rows="2"><?= htmlspecialchars($contact_page_data['address_card']['address'] ?? '') ?></textarea>
            </div>
          </div>
          <div
            style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Card 2: Admissions Phone Number</label>
              <input type="text" id="ct_card_phone_num" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['phone_card']['phone'] ?? '+91 812 261 3300') ?>"
                style="margin-bottom: 0.35rem;">
              <input type="text" id="ct_card_phone_hrs" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['phone_card']['hours'] ?? '') ?>">
            </div>
          </div>
          <div
            style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Card 3: Email Address</label>
              <input type="text" id="ct_card_email_val" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['email_card']['email'] ?? 'vels@vistas.ac.in') ?>">
            </div>
          </div>
          <div
            style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Card 4: Office Working Hours</label>
              <input type="text" id="ct_card_hrs_wd" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['hours_card']['weekday'] ?? 'Monday – Friday: 8:30 AM – 4:30 PM') ?>"
                style="margin-bottom: 0.35rem;">
              <input type="text" id="ct_card_hrs_sat" class="cms-form-control"
                value="<?= htmlspecialchars($contact_page_data['hours_card']['saturday'] ?? 'Saturday: 8:30 AM – 1:30 PM') ?>">
            </div>
          </div>
        </div>
      </div>

      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Interactive Map Embed &amp; 3 Commute Routes</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Map Embed URL (Google Maps Iframe)</label>
            <input type="text" id="ct_map_url" class="cms-form-control"
              value="<?= htmlspecialchars($contact_page_data['map']['embed_url'] ?? '') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">GPS Coordinates Display Text</label>
            <input type="text" id="ct_map_gps" class="cms-form-control"
              value="<?= htmlspecialchars($contact_page_data['map']['gps'] ?? '13.2921° N, 80.0894° E • Periyapalayam High Road') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">'Get Directions' External Google Maps URL</label>
            <input type="text" id="ct_map_dir" class="cms-form-control"
              value="<?= htmlspecialchars($contact_page_data['map']['direction_link'] ?? '') ?>">
          </div>

          <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">3 Commute
            Guide Cards</h4>
          <?php
          $commute = $contact_page_data['commute']['cards'] ?? [];
          for ($i = 0; $i < 3; $i++):
            $c = $commute[$i] ?? [];
            ?>
            <div
              style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
              <div class="cms-form-group">
                <label class="cms-form-label">Commute #<?= $i + 1 ?> Title</label>
                <input type="text" id="ct_com_<?= $i ?>_title" class="cms-form-control"
                  value="<?= htmlspecialchars($c['title'] ?? '') ?>">
              </div>
              <div class="cms-form-group">
                <label class="cms-form-label">Description</label>
                <textarea id="ct_com_<?= $i ?>_desc" class="cms-form-control"
                  rows="2"><?= htmlspecialchars($c['desc'] ?? '') ?></textarea>
              </div>
              <div class="cms-form-group">
                <label class="cms-form-label">Location Chip</label>
                <input type="text" id="ct_com_<?= $i ?>_chip" class="cms-form-control"
                  value="<?= htmlspecialchars($c['chip'] ?? '') ?>">
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- ====================================================================
       SUBTAB 9: ADMISSIONS ENQUIRY PAGE CONTENT
       ==================================================================== -->
  <div id="subtab-page-enquiry" class="cms-subtab-pane">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
      <button type="button" class="cms-btn cms-btn-success" onclick="savePageContent('enquiry')">
        <span>Save Enquiry Page Changes</span>
      </button>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem;">
      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Admissions Enquiry Banner &amp; Candidate Guidelines</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Page Title</label>
            <input type="text" id="enq_banner_title" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['banner']['title'] ?? 'Admission Enquiry Form 2024–2025') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Subtitle</label>
            <textarea id="enq_banner_subtitle" class="cms-form-control"
              rows="3"><?= htmlspecialchars($enquiry_data['banner']['subtitle'] ?? '') ?></textarea>
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Banner Badge Text</label>
            <input type="text" id="enq_banner_badge" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['banner']['badge'] ?? 'Batch 2024–2025 Open') ?>">
          </div>
          <?php cms_render_image_field('Banner Image URL', 'enq_banner_image', $enquiry_data['banner']['image'] ?? 'assets/images/hero-pharmacy-showcase.jpg'); ?>
          <div class="cms-form-group">
            <label class="cms-form-label">Form Section Badge Pill</label>
            <input type="text" id="enq_intro_badge" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['intro']['badge_pill'] ?? 'Batch 2024–2025') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Form Section Heading</label>
            <input type="text" id="enq_intro_title" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['intro']['title'] ?? 'B.Pharm Candidate Application & Enquiry') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Form Description / Guidelines</label>
            <textarea id="enq_intro_desc" class="cms-form-control"
              rows="2"><?= htmlspecialchars($enquiry_data['intro']['description'] ?? 'Please complete all required fields (*). Merit-based seats are allocated on a rolling basis per PCI norms.') ?></textarea>
          </div>
        </div>
      </div>

      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <h3>Admissions Helpdesk &amp; Why Choose VPC Cards</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <div class="cms-form-group">
            <label class="cms-form-label">Direct Admissions Line</label>
            <input type="text" id="enq_help_phone" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['helpdesk']['phone'] ?? '+91 812 261 3300') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Admissions Email</label>
            <input type="text" id="enq_help_email" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['helpdesk']['email'] ?? 'admission@velpharmacycollege.com') ?>">
          </div>
          <div class="cms-form-group">
            <label class="cms-form-label">Helpdesk Hours</label>
            <input type="text" id="enq_help_hours" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['helpdesk']['hours'] ?? 'Monday - Saturday: 8:30 AM - 5:00 PM') ?>">
          </div>

          <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--cms-primary); margin: 1rem 0 0.5rem;">Why Choose
            VEL Pharmacy College (Sidebar)</h4>
          <div class="cms-form-group">
            <label class="cms-form-label">Why Choose Heading</label>
            <input type="text" id="enq_why_title" class="cms-form-control"
              value="<?= htmlspecialchars($enquiry_data['why_apply']['title'] ?? 'Why Choose VEL Pharmacy College?') ?>">
          </div>
          <?php
          $why_apply = $enquiry_data['why_apply']['items'] ?? [];
          for ($i = 0; $i < 4; $i++):
            $item = $why_apply[$i] ?? [];
            ?>
            <div
              style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.75rem; margin-bottom: 0.75rem;">
              <div class="cms-form-group">
                <label class="cms-form-label">Point #<?= $i + 1 ?> Title</label>
                <input type="text" id="enq_why_<?= $i ?>_title" class="cms-form-control"
                  value="<?= htmlspecialchars($item['title'] ?? '') ?>">
              </div>
              <div class="cms-form-group">
                <label class="cms-form-label">Description</label>
                <textarea id="enq_why_<?= $i ?>_desc" class="cms-form-control"
                  rows="2"><?= htmlspecialchars($item['desc'] ?? '') ?></textarea>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>

  </section>


  <!-- ====================================================================
           TAB 4: MEDIA ASSET LIBRARY & IMAGE UPLOADER
           ==================================================================== -->
  <section id="tab-media" class="cms-tab-content">
    <div class="cms-panel">
      <div class="cms-panel-header">
        <div class="cms-panel-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
          <h3>Media Asset Library (<?= count($media_files) ?> Assets)</h3>
        </div>
        <button type="button" class="cms-btn cms-btn-primary cms-btn-sm"
          onclick="document.getElementById('mediaFileInput').click()"
          style="display: inline-flex; align-items: center; gap: 0.4rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
          </svg>
          <span>+ Upload New Image</span>
        </button>
      </div>
      <div class="cms-panel-body">
        <!-- Drag & Drop Zone -->
        <div class="cms-dropzone" id="mediaDropzone" style="margin-bottom: 1.5rem;">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--cms-accent)" stroke-width="2">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="17 8 12 3 7 8"></polyline>
            <line x1="12" y1="3" x2="12" y2="15"></line>
          </svg>
          <h4>Drag &amp; drop photos here or click to browse</h4>
          <p>Supports high-resolution PNG, JPG, and WebP up to 10MB.</p>
          <input type="file" id="mediaFileInput" accept="image/png, image/jpeg, image/webp" style="display: none;">
        </div>

        <!-- Media Search & Filter Toolbar -->
        <div class="cms-media-toolbar">
          <div class="cms-media-search-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"
              style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%);">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="search" id="mediaTabSearch" class="cms-media-search-input"
              placeholder="Search uploaded photos by filename (e.g. campus, lab, logo, faculty)..." autocomplete="off">
          </div>
          <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
            <span class="badge-tag" id="mediaTabCount"
              style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700; padding: 0.35rem 0.75rem; border-radius: var(--radius-full);">
              <?= count($media_files) ?> Assets Found
            </span>
          </div>
        </div>

        <!-- Media Gallery Grid -->
        <div class="cms-media-grid" id="mediaLibraryGrid">
          <?php foreach ($media_files as $mf):
            $ext = strtoupper(pathinfo($mf['name'], PATHINFO_EXTENSION));
            ?>
            <div class="cms-media-item" data-name="<?= htmlspecialchars(strtolower($mf['name'])) ?>">
              <div class="cms-media-thumb">
                <img src="/<?= htmlspecialchars($mf['path']) ?>" alt="<?= htmlspecialchars($mf['name']) ?>"
                  loading="lazy">
                <span class="cms-media-badge-ext"><?= htmlspecialchars($ext) ?></span>
              </div>
              <div class="cms-media-item-info">
                <div>
                  <span class="cms-media-item-name"
                    title="<?= htmlspecialchars($mf['name']) ?>"><?= htmlspecialchars($mf['name']) ?></span>
                  <div class="cms-media-item-meta">
                    <span><?= htmlspecialchars($mf['size'] ?? '') ?></span>
                    <span><?= htmlspecialchars($mf['mtime'] ?? '') ?></span>
                  </div>
                </div>
                <div class="cms-media-actions">
                  <button type="button" class="cms-btn-copy-path copy-path-btn"
                    data-path="<?= htmlspecialchars($mf['path']) ?>" title="Copy Image Relative Path to Clipboard">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                      <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                    <span>Copy Path</span>
                  </button>
                  <a href="/<?= htmlspecialchars($mf['path']) ?>" target="_blank" rel="noopener noreferrer"
                    class="cms-btn-preview-img" title="Open Full-Resolution Photo in New Tab">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                      <polyline points="15 3 21 3 21 9"></polyline>
                      <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ====================================================================
           TAB 5: DEDICATED SEO, GEO, AEO & SEARCH TRAFFIC INTELLIGENCE HUB
           (ONLY SHOWN WHEN THE USER CLICKS THE SEO MENU!)
           ==================================================================== -->
  <section id="tab-seo_geo_aeo" class="cms-tab-content">
    <!-- Top Unified Search Intelligence Banner -->
    <div class="cms-seo-hub-banner">
      <div
        style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
        <div>
          <div class="cms-seo-hub-pill">Next-Gen Search Intelligence</div>
          <h2
            style="font-family: var(--cms-font-heading); font-size: 1.85rem; font-weight: 800; color: #FFFFFF; margin-bottom: 0.35rem;">
            SEO, GEO &amp; AEO Unified Command Center
          </h2>
          <p style="color: #CBD5E1; font-size: 0.925rem; max-width: 680px; line-height: 1.5;">
            Optimize VEL Pharmacy College for traditional Google search (SEO), Generative AI search engines like ChatGPT
            &amp; Perplexity (GEO), and direct Voice Answer engines like Siri &amp; Google Assistant (AEO).
          </p>
        </div>
        <button type="button" class="cms-btn cms-btn-success" id="saveSeoBtn"
          style="box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Publish SEO / GEO / AEO Changes</span>
        </button>
      </div>

      <!-- Score Cards -->
      <div class="cms-seo-cards-row">
        <div class="cms-seo-metric-card">
          <div class="cms-seo-card-label">SEO (Search Engines)</div>
          <div class="cms-seo-card-score">98<span>/100</span></div>
          <div class="cms-seo-card-desc">Meta tags, Sitemap, OpenGraph &amp; Core Web Vitals</div>
          <span class="cms-stat-badge" style="background: rgba(16, 185, 129, 0.2); color: #6EE7B7;">Optimal</span>
        </div>

        <div class="cms-seo-metric-card">
          <div class="cms-seo-card-label">GEO (Generative Engines)</div>
          <div class="cms-seo-card-score">96<span>/100</span></div>
          <div class="cms-seo-card-desc">Knowledge Graph Entity, AI Bots &amp; Citation Anchors</div>
          <span class="cms-stat-badge" style="background: rgba(245, 158, 11, 0.2); color: #FCD34D;">AI Verified</span>
        </div>

        <div class="cms-seo-metric-card">
          <div class="cms-seo-card-label">AEO (Answer &amp; Voice)</div>
          <div class="cms-seo-card-score">94<span>/100</span></div>
          <div class="cms-seo-card-desc">Speakable Schema &amp; Google Featured Snippets Q&amp;A</div>
          <span class="cms-stat-badge" style="background: rgba(139, 92, 246, 0.2); color: #C4B5FD;">Direct
            Answers</span>
        </div>
      </div>
    </div>

    <!-- Mode Toggle Bar: Engine Settings vs. Search Traffic -->
    <div class="seo-mode-tabs">
      <button type="button" class="seo-mode-btn active" data-seomode="config">⚙️ SEO, GEO &amp; AEO Engine
        Settings</button>
      <button type="button" class="seo-mode-btn" data-seomode="traffic">📊 Real-Time Search Traffic &amp; GEO
        Map</button>
    </div>

    <!-- =============================================================
             VIEW 1: ENGINE SETTINGS (META, AI BOTS, KNOWLEDGE GRAPH, AEO)
             ============================================================= -->
    <div id="seoEnginePane">
      <!-- 1. Page Meta Tags & Canonical URLs -->
      <div class="cms-panel">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <h3 id="seoMetaEditorHeading">Page Meta Tags &amp; Canonical URLs (Home Page)</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <!-- Page Selector Tabs for SEO -->
          <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem; overflow-x: auto; padding-bottom: 0.5rem;">
            <?php foreach ($seo_data['pages'] as $pkey => $pcfg): ?>
              <button type="button"
                class="cms-btn cms-btn-sm <?= $pkey === 'home' ? 'cms-btn-primary' : 'cms-btn-secondary' ?> seo-page-tab-btn"
                data-page-key="<?= htmlspecialchars($pkey) ?>" style="border-radius: var(--radius-full);">
                <?= htmlspecialchars($pcfg['page_name']) ?>
              </button>
            <?php endforeach; ?>
          </div>

          <!-- Hidden JSON Store for SEO Form -->
          <input type="hidden" id="currentSeoPageKey" value="home">
          <textarea id="fullSeoDataStore"
            style="display: none;"><?= htmlspecialchars(json_encode($seo_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) ?></textarea>

          <div class="cms-form-group">
            <label class="cms-form-label">Page &lt;title&gt; Tag (50-60 characters recommended)</label>
            <input type="text" id="seoInputTitle" class="cms-form-control"
              value="<?= htmlspecialchars($seo_data['pages']['home']['title'] ?? '') ?>">
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">Meta Description (140-160 characters recommended)</label>
            <textarea id="seoInputDesc" class="cms-form-control"
              rows="3"><?= htmlspecialchars($seo_data['pages']['home']['description'] ?? '') ?></textarea>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Meta Keywords</label>
              <input type="text" id="seoInputKeywords" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['pages']['home']['keywords'] ?? '') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Canonical URL</label>
              <input type="text" id="seoInputCanonical" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['pages']['home']['canonical'] ?? '') ?>">
            </div>
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">OpenGraph Social Share Image Path</label>
            <input type="text" id="seoInputOgImage" class="cms-form-control"
              value="<?= htmlspecialchars($seo_data['pages']['home']['og_image'] ?? 'assets/images/campus-front.jpg') ?>">
          </div>
        </div>
      </div>

      <!-- 2. GEO: AI Crawler Directives & Knowledge Graph Entity -->
      <div class="cms-panel">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--cms-gold)" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
            </svg>
            <h3>GEO: AI Crawler Directives &amp; Knowledge Graph Entity</h3>
          </div>
          <span class="cms-stat-badge" style="background: #FEF3C7; color: #92400E;">AI Search Shield Active</span>
        </div>
        <div class="cms-panel-body">
          <h4 style="font-size: 0.9rem; font-weight: 700; color: var(--cms-primary-dark); margin-bottom: 0.5rem;">AI
            Search Bots &amp; LLM Web Crawlers Access Control</h4>
          <p style="font-size: 0.825rem; color: var(--cms-text-muted); margin-bottom: 1.25rem;">
            Enabling AI crawlers ensures ChatGPT Search, Perplexity AI, and Claude cite VEL Pharmacy College when
            students search queries like <em>"Best PCI pharmacy colleges in Tiruvallur"</em>.
          </p>

          <div
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <?php foreach (($seo_data['geo_engine']['ai_crawler_permissions'] ?? []) as $bot => $allowed): ?>
              <label class="cms-checkbox-label">
                <input type="checkbox" class="ai-bot-toggle" data-bot="<?= htmlspecialchars($bot) ?>" <?= $allowed ? 'checked' : '' ?>>
                <span><?= htmlspecialchars($bot) ?></span>
              </label>
            <?php endforeach; ?>
          </div>

          <h4 style="font-size: 0.9rem; font-weight: 700; color: var(--cms-primary-dark); margin-bottom: 1rem;">
            Institutional Knowledge Graph Entity Parameters</h4>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Legal Name of Institution</label>
              <input type="text" id="kg_legal_name" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['legal_name'] ?? 'VEL Pharmacy College') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Recognized Brand Name / Short Code</label>
              <input type="text" id="kg_brand_name" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['brand_name'] ?? 'VEL Pharmacy College (VPC)') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Parent Sponsoring Organization</label>
              <input type="text" id="kg_parent_org" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['parent_organization'] ?? 'Vels Institute of Science, Technology & Advanced Studies (VISTAS Deemed-to-be University)') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Accrediting Statutory Body</label>
              <input type="text" id="kg_accreditation" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['accreditation'] ?? 'Pharmacy Council of India (PCI), New Delhi') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Founder &amp; Chancellor Entity</label>
              <input type="text" id="kg_chancellor" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['founder_chancellor'] ?? 'Dr. Ishari K. Ganesh') ?>">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Collegiate Head / Principal Entity</label>
              <input type="text" id="kg_principal" class="cms-form-control"
                value="<?= htmlspecialchars($seo_data['geo_engine']['knowledge_graph_entity']['principal'] ?? 'Dr. G. Saravanan, M.Pharm., Ph.D., FAPP') ?>">
            </div>
          </div>
        </div>
      </div>

      <!-- 3. AEO: Direct Voice Search Answers & Google Featured Snippets -->
      <div class="cms-panel">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--cms-accent)" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <h3>AEO: Direct Voice Search Answers &amp; Google Featured Snippets</h3>
          </div>
          <span class="cms-stat-badge" style="background: #F5F3FF; color: #7C3AED;">Voice AI Snippets Ready</span>
        </div>
        <div class="cms-panel-body">
          <p style="font-size: 0.825rem; color: var(--cms-text-muted); margin-bottom: 1.5rem;">
            Answer Engine Optimization formats institutional questions into concise, 40–50 word micro-answers formatted
            to appear in Google's "People Also Ask" cards, Google Assistant, Siri, and Alexa responses.
          </p>

          <?php foreach (($seo_data['aeo_engine']['featured_qna_snippets'] ?? []) as $idx => $qna): ?>
            <div
              style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-lg); padding: 1.25rem 1.5rem; margin-bottom: 1.25rem;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <strong style="color: var(--cms-primary-dark); font-size: 0.95rem;">Q<?= $idx + 1 ?>:
                  <?= htmlspecialchars($qna['question']) ?></strong>
                <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Voice Friendly</span>
              </div>
              <textarea class="cms-form-control aeo-answer-input" data-qna-id="<?= htmlspecialchars($qna['id']) ?>"
                rows="3"
                style="font-size: 0.9rem; line-height: 1.6; background: #FFFFFF;"><?= htmlspecialchars($qna['direct_answer']) ?></textarea>
              <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <?php foreach ($qna['keywords'] as $kw): ?>
                  <span
                    style="font-size: 0.75rem; background: #E2E8F0; color: #475569; padding: 0.15rem 0.5rem; border-radius: 4px;">#<?= htmlspecialchars($kw) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- =============================================================
             VIEW 2: REAL-TIME SEARCH TRAFFIC & GEO MAP
             ============================================================= -->
    <div id="seoTrafficPane" style="display: none;">
      <!-- Metric KPI Summary Cards -->
      <div class="cms-metrics-grid">
        <div class="cms-stat-card">
          <div class="cms-stat-info">
            <span>Unique Visitors (30D)</span>
            <h3><?= number_format($traffic['summary']['unique_visitors'] ?? 6940) ?></h3>
            <div class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">
              <span>Verified Organic</span>
            </div>
          </div>
        </div>

        <div class="cms-stat-card">
          <div class="cms-stat-info">
            <span>Avg Session Duration</span>
            <h3><?= htmlspecialchars($traffic['summary']['avg_session_duration'] ?? '3m 42s') ?></h3>
            <div class="cms-stat-badge" style="background: #EFF6FF; color: #1D4ED8;">
              <span>High Engagement</span>
            </div>
          </div>
        </div>

        <div class="cms-stat-card">
          <div class="cms-stat-info">
            <span>Bounce Rate</span>
            <h3><?= htmlspecialchars($traffic['summary']['bounce_rate'] ?? '34.2%') ?></h3>
            <div class="cms-stat-badge" style="background: #F0FDF4; color: #16A34A;">
              <span>Industry Benchmark</span>
            </div>
          </div>
        </div>

        <div class="cms-stat-card">
          <div class="cms-stat-info">
            <span>Mobile Traffic</span>
            <h3>68.4%</h3>
            <div class="cms-stat-badge" style="background: #F5F3FF; color: #7C3AED;">
              <span>Smartphone First</span>
            </div>
          </div>
        </div>
      </div>

      <!-- GEO Visitor Distribution & Referral Channels -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-bottom: 2rem;">
        <!-- GEO Distribution -->
        <div class="cms-panel" style="margin-bottom: 0;">
          <div class="cms-panel-header">
            <div class="cms-panel-title">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"></path>
              </svg>
              <h3>Geographic Visitor Distribution (GEO)</h3>
            </div>
          </div>
          <div class="cms-panel-body">
            <div class="cms-traffic-source-list">
              <?php foreach ($traffic['geo_distribution'] as $geo): ?>
                <div class="cms-traffic-source-item">
                  <div class="cms-traffic-source-header">
                    <span
                      style="font-weight: 600; color: var(--cms-primary-dark); font-size: 0.9rem;"><?= htmlspecialchars($geo['city']) ?>
                      (<?= htmlspecialchars($geo['region']) ?>)</span>
                    <span
                      style="font-size: 0.85rem; font-weight: 700; color: var(--cms-accent);"><?= number_format($geo['visits']) ?>
                      visits (<?= $geo['percentage'] ?>%)</span>
                  </div>
                  <div class="cms-progress-track">
                    <div class="cms-progress-fill" style="width: <?= $geo['percentage'] * 2.2 ?>%; background: #1E6A4D;">
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Referral Channels -->
        <div class="cms-panel" style="margin-bottom: 0;">
          <div class="cms-panel-header">
            <div class="cms-panel-title">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
              </svg>
              <h3>Referral Channels &amp; AI Search Engines</h3>
            </div>
          </div>
          <div class="cms-panel-body">
            <div class="cms-traffic-source-list">
              <?php foreach ($traffic['traffic_sources'] as $src): ?>
                <div class="cms-traffic-source-item">
                  <div class="cms-traffic-source-header">
                    <span
                      style="font-weight: 600; color: var(--cms-primary-dark); font-size: 0.9rem;"><?= htmlspecialchars($src['source']) ?></span>
                    <span
                      style="font-size: 0.85rem; font-weight: 700; color: <?= htmlspecialchars($src['color']) ?>;"><?= number_format($src['visits']) ?>
                      (<?= $src['percentage'] ?>%)</span>
                  </div>
                  <div class="cms-progress-track">
                    <div class="cms-progress-fill"
                      style="width: <?= $src['percentage'] * 2 ?>%; background: <?= htmlspecialchars($src['color']) ?>;">
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Top Organic Search Keywords Table -->
      <div class="cms-panel">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h3>Top Organic Search Keywords &amp; Ranking Positions</h3>
          </div>
        </div>
        <div class="cms-table-wrapper">
          <table class="cms-table">
            <thead>
              <tr>
                <th>Keyword / Search Term</th>
                <th>Organic Clicks</th>
                <th>Avg Google Position</th>
                <th>Click-Through Rate (CTR)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($traffic['top_keywords'] as $kw): ?>
                <tr>
                  <td><strong style="color: var(--cms-primary-dark);"><?= htmlspecialchars($kw['keyword']) ?></strong>
                  </td>
                  <td style="font-weight: 700; color: var(--cms-accent);"><?= number_format($kw['clicks']) ?></td>
                  <td>
                    <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857; font-weight: 700;">
                      Rank #<?= htmlspecialchars($kw['position']) ?>
                    </span>
                  </td>
                  <td style="color: #334155; font-weight: 600;"><?= htmlspecialchars($kw['ctr']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </section>

  <!-- ====================================================================
           TAB 6: SECURITY, AUDIT LOG & PASSWORDS
           ==================================================================== -->
  <section id="tab-security" class="cms-tab-content">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.75rem; margin-bottom: 2rem;">
      <!-- Password Management -->
      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <h3>Change Admin Master Password</h3>
          </div>
        </div>
        <div class="cms-panel-body">
          <form id="changePasswordForm">
            <div class="cms-form-group">
              <label class="cms-form-label">Current Master Password</label>
              <input type="password" id="currentPasswordInput" class="cms-form-control" required
                placeholder="Enter current password">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">New Password (min 8 characters)</label>
              <input type="password" id="newPasswordInput" class="cms-form-control" required
                placeholder="Enter new strong password">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Confirm New Password</label>
              <input type="password" id="confirmPasswordInput" class="cms-form-control" required
                placeholder="Re-enter new password">
            </div>
            <button type="submit" class="cms-btn cms-btn-primary" style="margin-top: 0.5rem;">Update Password</button>
          </form>
        </div>
      </div>

      <!-- Brute-Force & Session Security Information -->
      <div class="cms-panel" style="margin-bottom: 0;">
        <div class="cms-panel-header">
          <div class="cms-panel-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
            <h3>Security Shield &amp; Defense Core</h3>
          </div>
          <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Shield Active</span>
        </div>
        <div class="cms-panel-body">
          <div class="cms-ai-engine-row" style="margin-bottom: 0.75rem;">
            <div>
              <strong>Brute-Force Lockout Defense</strong>
              <div style="font-size: 0.8rem; color: #64748B;">5 failed attempts triggers automatic 15-minute IP freeze.
              </div>
            </div>
            <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Enabled</span>
          </div>

          <div class="cms-ai-engine-row" style="margin-bottom: 0.75rem;">
            <div>
              <strong>CSRF Cryptographic Protection</strong>
              <div style="font-size: 0.8rem; color: #64748B;">Strict token verification on all POST/PUT/DELETE
                mutations.</div>
            </div>
            <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Enabled</span>
          </div>

          <div class="cms-ai-engine-row" style="margin-bottom: 0.75rem;">
            <div>
              <strong>Session Hijacking Shield</strong>
              <div style="font-size: 0.8rem; color: #64748B;">Strict User-Agent binding with HTTP-only cookie
                parameters.</div>
            </div>
            <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Enforced</span>
          </div>

          <div class="cms-ai-engine-row">
            <div>
              <strong>Data Directory Isolation</strong>
              <div style="font-size: 0.8rem; color: #64748B;">Direct HTTP requests to /data/ blocked with 403 Forbidden.
              </div>
            </div>
            <span class="cms-stat-badge" style="background: #ECFDF5; color: #047857;">Protected</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Complete Audit Log Table -->
    <div class="cms-panel">
      <div class="cms-panel-header">
        <div class="cms-panel-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          </svg>
          <h3>Complete Activity &amp; Authentication Audit Trail</h3>
        </div>
      </div>
      <div class="cms-table-wrapper">
        <table class="cms-table">
          <thead>
            <tr>
              <th>Timestamp</th>
              <th>Event</th>
              <th>User</th>
              <th>IP Address</th>
              <th>Action Details</th>
              <th>Severity</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (array_reverse($audit_trail) as $log): ?>
              <tr>
                <td style="color: #64748B; font-size: 0.825rem; white-space: nowrap;">
                  <?= htmlspecialchars($log['timestamp']) ?></td>
                <td><strong style="color: var(--cms-primary-dark);"><?= htmlspecialchars($log['event']) ?></strong></td>
                <td><?= htmlspecialchars($log['username']) ?></td>
                <td style="font-family: monospace; font-size: 0.825rem;"><?= htmlspecialchars($log['ip']) ?></td>
                <td><?= htmlspecialchars($log['details']) ?></td>
                <td>
                  <span class="cms-stat-badge"
                    style="background: <?= $log['severity'] === 'danger' ? '#FEE2E2; color:#991B1B;' : ($log['severity'] === 'warning' ? '#FEF3C7; color:#92400E;' : '#ECFDF5; color:#047857;') ?>">
                    <?= strtoupper(htmlspecialchars($log['severity'])) ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  </div><!-- End cms-body -->
  </main>
  </div><!-- End cms-app -->

  <!-- ========================================================================
     MODAL: ADD / EDIT FACULTY MEMBER
     ======================================================================== -->
  <div class="cms-modal-backdrop" id="facultyModal">
    <div class="cms-modal">
      <div class="cms-modal-header">
        <h3 class="cms-modal-title" id="facultyModalTitle">Edit Faculty Member</h3>
        <button type="button" class="cms-modal-close" id="closeFacultyModal">&times;</button>
      </div>
      <form id="facultyForm">
        <div class="cms-modal-body">
          <input type="hidden" id="facultyFormId" name="id" value="">
          <input type="hidden" id="facultyFormSno" name="sno" value="1">

          <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; align-items: center;">
            <div
              style="width: 100px; height: 120px; border-radius: var(--radius-md); overflow: hidden; border: 2px solid var(--cms-border); flex-shrink: 0; background: #F8FAFC;">
              <img id="facultyImgPreview" src="assets/images/Faculty/Dr. G. Saravanan.png"
                style="width: 100%; height: 100%; object-fit: cover; object-position: top center; display: block;">
            </div>
            <div style="flex-grow: 1;">
              <label class="cms-form-label">Portrait Image</label>
              <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                <input type="text" id="facultyFormImage" name="image" class="cms-form-control"
                  value="assets/images/Faculty/Dr. G. Saravanan.png">
                <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm"
                  onclick="document.getElementById('facultyImgFileInput').click()">Browse</button>
              </div>
              <input type="file" id="facultyImgFileInput" accept="image/png, image/jpeg, image/webp"
                style="display: none;">
              <p style="font-size: 0.75rem; color: #64748B;">Upload clean portrait (PNG/JPG). Uniformly scaled to 330px
                height.</p>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Full Name &amp; Academic Title *</label>
              <input type="text" id="facultyFormName" name="name" class="cms-form-control" required
                placeholder="e.g. Dr. G. Saravanan">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Qualifications *</label>
              <input type="text" id="facultyFormQual" name="qualification" class="cms-form-control" required
                placeholder="e.g. M. Pharm., Ph.D., FAPP">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Collegiate Designation *</label>
              <input type="text" id="facultyFormDesig" name="designation" class="cms-form-control" required
                placeholder="e.g. Professor & Principal">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Department *</label>
              <input type="text" id="facultyFormDept" name="department" class="cms-form-control" required
                placeholder="e.g. Pharmaceutical Chemistry">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Department Filter Slug</label>
              <select id="facultyFormDeptSlug" name="dept_slug" class="cms-form-control">
                <option value="chemistry">Pharmaceutical Chemistry</option>
                <option value="pharmaceutics">Pharmaceutics</option>
                <option value="pharmacology">Pharmacology</option>
                <option value="pharmacognosy">Pharmacognosy</option>
                <option value="analysis">Pharmaceutical Analysis</option>
              </select>
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Teaching &amp; Research Experience</label>
              <input type="text" id="facultyFormExp" name="experience" class="cms-form-control"
                placeholder="e.g. 18.5+ Years">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Badge Label (optional)</label>
              <input type="text" id="facultyFormBadge" name="badge" class="cms-form-control"
                placeholder="e.g. Principal & Head">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Cadre Level</label>
              <input type="text" id="facultyFormCadre" name="cadre" class="cms-form-control"
                placeholder="e.g. Collegiate Head">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="cms-form-group">
              <label class="cms-form-label">Official Email</label>
              <input type="email" id="facultyFormEmail" name="email" class="cms-form-control"
                placeholder="e.g. principal@velpharmacycollege.com">
            </div>
            <div class="cms-form-group">
              <label class="cms-form-label">Office Location</label>
              <input type="text" id="facultyFormOffice" name="office" class="cms-form-control"
                placeholder="e.g. Administrative Wing, Room 101">
            </div>
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">Comprehensive Bio &amp; Research Description</label>
            <textarea id="facultyFormDesc" name="description" class="cms-form-control" rows="3"></textarea>
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">Specializations (one per line)</label>
            <textarea id="facultyFormSpecs" name="specializations" class="cms-form-control" rows="3"></textarea>
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">Subjects Taught (one per line)</label>
            <textarea id="facultyFormSubjects" name="subjects" class="cms-form-control" rows="2"></textarea>
          </div>

          <div class="cms-form-group">
            <label class="cms-form-label">Key Achievements (one per line)</label>
            <textarea id="facultyFormAchieve" name="achievements" class="cms-form-control" rows="2"></textarea>
          </div>

          <div style="display: flex; gap: 1.5rem; margin-top: 1rem;">
            <label class="cms-checkbox-label">
              <input type="checkbox" id="facultyFormDoctorate" name="is_doctorate" value="1">
              <span>Holds Ph.D. / Doctorate</span>
            </label>
            <label class="cms-checkbox-label">
              <input type="checkbox" id="facultyFormFeatured" name="featured" value="1">
              <span>Featured Leadership Card</span>
            </label>
          </div>

        </div>
        <div class="cms-modal-footer">
          <button type="button" class="cms-btn cms-btn-secondary" id="cancelFacultyModal">Cancel</button>
          <button type="submit" class="cms-btn cms-btn-primary">Save Faculty Profile</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ========================================================================
     TOAST NOTIFICATIONS
     ======================================================================== -->
  <div class="cms-toast" id="cmsToast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <polyline points="20 6 9 17 4 12"></polyline>
    </svg>
    <span id="cmsToastMsg">Action completed successfully.</span>
  </div>

  <!-- Interactive CMS Client Controller -->
  <script src="/cms/assets/js/cms.js?v=<?= time() ?>"></script>
  <!-- ========================================================================
     MEDIA PICKER & DIRECT IMAGE UPLOADER MODAL
     ======================================================================== -->
  <input type="file" id="cmsQuickFileInput" accept="image/png, image/jpeg, image/webp" style="display: none;">

  <div class="cms-modal-backdrop" id="mediaPickerModal">
    <div class="cms-modal-card" style="max-width: 920px;">
      <div class="cms-modal-header">
        <div style="display: flex; align-items: center; gap: 0.65rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
          <h3 style="font-size: 1.15rem; color: #FFFFFF; margin: 0;">Interactive Media Library &bull; Click Any Photo to
            Select</h3>
        </div>
        <button type="button" class="cms-modal-close" id="closeMediaPickerModal"
          style="background: none; border: none; color: #FFFFFF; font-size: 1.5rem; cursor: pointer;">&times;</button>
      </div>
      <div class="cms-modal-body">
        <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem; align-items: center; flex-wrap: wrap;">
          <div style="flex-grow: 1; position: relative;">
            <input type="search" id="mediaPickerSearch" class="cms-form-control"
              placeholder="Search photos by filename (e.g. lab, campus, faculty, hostel)..." autocomplete="off"
              style="padding-left: 2.25rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"
              style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%);">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </div>
          <button type="button" class="cms-btn cms-btn-primary cms-btn-sm" id="mediaPickerUploadBtn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="12" y1="19" x2="12" y2="5"></line>
              <polyline points="5 12 12 5 19 12"></polyline>
            </svg>
            <span>Upload From Computer</span>
          </button>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
          <span style="font-size: 0.8rem; font-weight: 600; color: #64748B;">Target Input: <strong
              id="mediaPickerTargetLabel" style="color: var(--cms-primary-dark);">None</strong></span>
          <span id="mediaPickerCount" style="font-size: 0.8rem; color: #64748B;"><?= count($media_files) ?>
            Assets</span>
        </div>

        <div class="cms-media-picker-grid" id="mediaPickerGrid">
          <?php foreach ($media_files as $mf): ?>
            <div class="cms-picker-item" data-path="<?= htmlspecialchars($mf['path']) ?>"
              data-name="<?= htmlspecialchars(strtolower($mf['name'])) ?>"
              title="Click to choose <?= htmlspecialchars($mf['name']) ?>">
              <img src="/<?= htmlspecialchars($mf['path']) ?>" alt="<?= htmlspecialchars($mf['name']) ?>" loading="lazy">
              <span class="cms-picker-item-name"><?= htmlspecialchars($mf['name']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="cms-modal-footer" style="display: flex; justify-content: space-between; align-items: center;">
        <span style="font-size: 0.825rem; color: #64748B;">💡 Tip: Click any photo above to immediately select and
          update the image input field.</span>
        <button type="button" class="cms-btn cms-btn-secondary" id="cancelMediaPickerModal">Close</button>
      </div>
    </div>
  </div>

</body>

</html>