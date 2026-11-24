<?php
/**
 * Vel Pharmacy College - Reusable Header Component
 * Full SEO, GEO, and AEO optimization
 */

$site_name = "Vel Pharmacy College";
$base_url = "https://velpharmacycollege.com";

// Dynamic CMS Hook: Load SEO, GEO & AEO Configuration
$cms_seo_file = __DIR__ . '/../data/seo_geo_aeo.json';
$cms_seo = null;
if (file_exists($cms_seo_file)) {
  $cms_seo = json_decode(file_get_contents($cms_seo_file), true);
}

// Global CMS Content Load
$cms_content_file = __DIR__ . '/../data/pages_content.json';
$cms_content = [];
if (file_exists($cms_content_file)) {
  $cms_content = json_decode(file_get_contents($cms_content_file), true) ?: [];
}
$gen_settings = $cms_content['general_settings'] ?? [];
$gen_contact = $cms_content['general_contact'] ?? [];
$preloader_video = !empty($gen_settings['preloader_video']) ? $gen_settings['preloader_video'] : 'assets/videos/vel-pharmacy-logo-animation.mp4';

// Map current page or detect from script name
if (!isset($current_page)) {
  $script_base = basename($_SERVER['SCRIPT_NAME'] ?? '', '.php');
  $current_page = ($script_base === 'index' || empty($script_base)) ? 'home' : $script_base;
}

// Fallback to CMS configuration if present
if ($cms_seo) {
  $page_cfg = $cms_seo['pages'][$current_page] ?? null;
  $global_cfg = $cms_seo['global_seo'] ?? [];

  if ($page_cfg) {
    if (!isset($page_title) || empty($page_title))
      $page_title = $page_cfg['title'] ?? $global_cfg['default_title'];
    if (!isset($page_description) || empty($page_description))
      $page_description = $page_cfg['description'] ?? $global_cfg['default_description'];
    $page_keywords = $page_cfg['keywords'] ?? $global_cfg['default_keywords'];
    if (!isset($canonical_url) || empty($canonical_url))
      $canonical_url = $page_cfg['canonical'] ?? $base_url . '/' . ($current_page === 'home' ? '' : $current_page);
    if (!isset($og_image) || empty($og_image))
      $og_image = $base_url . '/' . ($page_cfg['og_image'] ?? $global_cfg['og_image']);
  } else {
    if (!isset($page_title))
      $page_title = $global_cfg['default_title'] ?? "Vel Pharmacy College | B.Pharm Admissions | Approved by PCI";
    if (!isset($page_description))
      $page_description = $global_cfg['default_description'] ?? "Vel Pharmacy College, an off-campus center of VISTAS Deemed University located at VMCH Campus, Manjankaranai.";
    $page_keywords = $global_cfg['default_keywords'] ?? "Vel Pharmacy College, B.Pharm, PCI approved";
  }
}

if (!isset($page_title)) {
  $page_title = "Vel Pharmacy College | B.Pharm Admissions 2024-2025 | Approved by PCI";
}
if (!isset($page_description)) {
  $page_description = "Vel Pharmacy College, an off-campus center of VISTAS Deemed University located at VMCH Campus, Manjankaranai, Tiruvallur. Offering 4-year B.Pharm degree approved by Pharmacy Council of India.";
}
if (!isset($canonical_url)) {
  $canonical_url = $base_url . "/";
}
if (!isset($og_image)) {
  $og_image = $base_url . "/assets/images/campus-front.jpg";
}
if (!isset($page_keywords)) {
  $page_keywords = "Vel Pharmacy College, B.Pharm admission, PCI approved pharmacy college, VISTAS deemed university, Manjankaranai, Tiruvallur";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Primary SEO Tags -->
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="keywords" content="<?= htmlspecialchars($page_keywords) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="author" content="Vel Pharmacy College">

  <!-- GEO Location Tags for Local SEO & Voice Search -->
  <meta name="geo.region" content="IN-TN">
  <meta name="geo.placename" content="Manjankaranai, Tiruvallur District, Tamil Nadu">
  <meta name="geo.position" content="13.3158;79.9882">
  <meta name="ICBM" content="13.3158, 79.9882">

  <!-- AI Generative Engine Directives (GEO) -->
  <meta name="ai-search-bot" content="all">
  <meta name="google-site-verification" content="VPC-PCI-2026-VISTAS-VERIFY">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
  <meta property="og:site_name" content="Vel Pharmacy College">
  <meta property="og:locale" content="en_IN">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($og_image) ?>">
  <meta name="twitter:site" content="@VelsUniversity">

  <!-- Preconnect & Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Outfit:wght@500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Core CSS Stylesheet with cache-busting -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">

  <?php
  $show_site_preloader = empty($disable_preloader) && empty($_GET['no_preloader']);
  ?>
  <?php if ($show_site_preloader): ?>
    <!-- Preload Logo Animation Video for Instant Playback -->
    <link rel="preload" href="<?= htmlspecialchars($preloader_video) ?>" as="video" type="video/mp4">
  <?php endif; ?>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/logo-icon.png">
  <link rel="apple-touch-icon" href="assets/images/logo-icon.png">

  <!-- GEO & Knowledge Graph Schema (Dynamic from CMS) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "CollegeOrUniversity",
    "name": "Vel Pharmacy College",
    "alternateName": ["Vels Pharmacy College", "VPC Manjankaranai"],
    "url": "https://velpharmacycollege.com",
    "logo": "https://velpharmacycollege.com/assets/images/VPC NEW LOGO.png",
    "image": "https://velpharmacycollege.com/assets/images/campus-front.jpg",
    "description": "Vel Pharmacy College is an off-campus center of Vels Institute of Science, Technology & Advanced Studies (VISTAS) located at VMCH Campus, Manjankaranai, Tiruvallur, offering PCI-approved B.Pharm degree program.",
    "telephone": "+918122613300",
    "email": "vels@vistas.ac.in",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "VMCH Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Uthukottai Taluk",
      "addressLocality": "Tiruvallur District",
      "addressRegion": "Tamil Nadu",
      "postalCode": "601102",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 13.3158,
      "longitude": 79.9882
    },
    "sameAs": [
      "https://vistas.ac.in",
      "https://www.facebook.com/VelsUniversityOfficial/",
      "https://www.instagram.com/velsuniversity/",
      "https://en.wikipedia.org/wiki/Vels_Institute_of_Science,_Technology_%26_Advanced_Studies"
    ],
    "parentOrganization": {
      "@type": "EducationalOrganization",
      "name": "VELS INSTITUTE OF SCIENCE TECHNOLOGY AND ADVANCED STUDIES (VISTAS)",
      "url": "https://vistas.ac.in"
    }
  }
  </script>

  <?php if (!empty($cms_seo['aeo_engine']['featured_qna_snippets'])): ?>
    <!-- AEO Voice Search & Direct Answer Engine Schema (FAQPage) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        <?php
        $qnas = $cms_seo['aeo_engine']['featured_qna_snippets'];
        $qna_items = [];
        foreach ($qnas as $q) {
          $qna_items[] = json_encode([
            "@type" => "Question",
            "name" => $q['question'],
            "acceptedAnswer" => [
              "@type" => "Answer",
              "text" => $q['direct_answer']
            ]
          ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        echo implode(",\n      ", $qna_items);
        ?>
      ]
    }
    </script>
  <?php endif; ?>

  <?php if (isset($custom_schema) && !empty($custom_schema)): ?>
    <!-- Page Specific Schema (e.g. Course, FAQ, Breadcrumbs) -->
    <script type="application/ld+json">
      <?= json_encode($custom_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
      </script>
  <?php endif; ?>
  <?php if ($show_site_preloader): ?>
    <!-- Starting Page Loading Screen: Official Logo Animation Video (Displays ONLY on first site entry or browser refresh) -->
    <script>
      (function () {
        var isReload = false;
        try {
          var navEntries = performance.getEntriesByType('navigation');
          if (navEntries && navEntries.length > 0) {
            isReload = (navEntries[0].type === 'reload');
          } else if (window.performance && window.performance.navigation) {
            isReload = (window.performance.navigation.type === 1);
          }
        } catch (e) { }

        var isFirstEntry = false;
        try {
          if (!sessionStorage.getItem('vpc_site_entered')) {
            isFirstEntry = true;
          }
        } catch (e) {
          isFirstEntry = true;
        }

        // ONLY show the loading video when first entering the website OR when clicking browser refresh
        if (isReload || isFirstEntry) {
          document.documentElement.classList.add('show-preloader');
          try {
            sessionStorage.setItem('vpc_site_entered', 'true');
          } catch (e) { }
        } else {
          document.documentElement.classList.remove('show-preloader');
        }
      })();
    </script>
  <?php endif; ?>
</head>

<body>

  <?php if ($show_site_preloader): ?>
    <!-- Starting Page Loading Screen: Official Logo Animation Video -->
    <div id="sitePreloader" class="site-preloader" role="dialog" aria-modal="true"
      aria-label="Loading Vel Pharmacy College">
      <div class="preloader-content">
        <div class="preloader-video-wrapper">
          <video id="preloaderVideo" class="preloader-video" playsinline muted autoplay preload="auto">
            <source src="<?= htmlspecialchars($preloader_video) ?>" type="video/mp4">
          </video>
        </div>
        <div class="preloader-progress-bar">
          <div class="preloader-progress-fill" id="preloaderProgress"></div>
        </div>
      </div>
      <button type="button" class="preloader-skip-btn" id="preloaderSkip" aria-label="Skip intro animation">
        <span>Skip</span>
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <polygon points="5 4 15 12 5 20 5 4" />
          <line x1="19" y1="5" x2="19" y2="19" />
        </svg>
      </button>
    </div>
    <noscript>
      <style>
        .site-preloader {
          display: none !important;
        }

        body.preloader-active {
          overflow: auto !important;
        }
      </style>
    </noscript>
  <?php endif; ?>

  <?php include __DIR__ . '/nav.php'; ?>
  <main id="mainContent">