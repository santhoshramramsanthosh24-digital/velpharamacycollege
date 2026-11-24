<?php
$current_page = 'about';
$page_title = "About Us | VEL Pharmacy College | History, Vision & Mission";
$page_description = "Learn about VEL Pharmacy College, established in 2024–25 at the VMCH Medical Campus, Manjankaranai under VISTAS Deemed University. Discover our founding legacy, vision, mission, and principal's address.";
$canonical_url = "https://velpharmacycollege.com/about-us";

// Breadcrumb Schema
$custom_schema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => [
        [
            "@type" => "ListItem",
            "position" => 1,
            "name" => "Home",
            "item" => "https://velpharmacycollege.com/"
        ],
        [
            "@type" => "ListItem",
            "position" => 2,
            "name" => "About Us",
            "item" => "https://velpharmacycollege.com/about-us"
        ]
    ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$about_cms = $cms_content['about_us'] ?? [];

include __DIR__ . '/includes/header.php';

$banner = $about_cms['banner'] ?? [];
$welcome = $about_cms['welcome'] ?? [];
$versatility = $about_cms['career_versatility'] ?? [];
$legacy = $about_cms['legacy'] ?? [];
$vision = $about_cms['vision'] ?? [];
$mission = $about_cms['mission'] ?? [];
$principal = $about_cms['principal_address'] ?? [];
$sisters = $about_cms['sister_institutions'] ?? [];
$cta = $about_cms['cta_banner'] ?? [];
?>

<!-- PAGE BANNER WITH BREADCRUMB & RELATED IMAGE BOX -->
<section class="page-banner" aria-label="Page Title Banner">
  <div class="container-wide">
    <div class="page-banner-box">
      <div class="page-banner-content">
        <nav class="breadcrumb" aria-label="Breadcrumbs">
          <a href="/">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">About Us</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($banner['title'] ?? 'About VEL Pharmacy College') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($banner['subtitle'] ?? 'An off-campus center of VELS Institute of Science, Technology & Advanced Studies (VISTAS Deemed University), dedicated to excellence in pharmaceutical sciences, clinical training, and healthcare ethics.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($banner['image'] ?? 'assets/images/campus-front.jpg') ?>" alt="<?= htmlspecialchars($banner['title'] ?? 'VEL Pharmacy College') ?>" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 1: WELCOME & THE PHARMACY PROFESSION -->
<section class="section" aria-labelledby="overviewTitle">
  <div class="container">
    <div class="about-welcome-grid">
      <div class="about-welcome-content fade-up">
        <span class="section-subtitle"><?= htmlspecialchars($welcome['subtitle'] ?? 'A Noble Calling in Healthcare') ?></span>
        <h2 class="section-title" id="overviewTitle" style="text-align: left; margin-bottom: 1.25rem;">
          <?= htmlspecialchars($welcome['title'] ?? 'Welcome To VEL Pharmacy College') ?>
        </h2>
        <p style="font-size: 1.05rem; line-height: 1.75; color: var(--color-text-main); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($welcome['paragraph_1'] ?? '') ?>
        </p>
        <p style="line-height: 1.7; color: var(--color-text-muted); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($welcome['paragraph_2'] ?? '') ?>
        </p>
        <p style="line-height: 1.7; color: var(--color-text-muted);">
          <?= htmlspecialchars($welcome['paragraph_3'] ?? '') ?>
        </p>
      </div>

      <div class="about-welcome-card fade-up delay-2">
        <div class="career-versatility-card">
          <h3 class="career-versatility-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            <span><?= htmlspecialchars($versatility['heading'] ?? 'Career Versatility') ?></span>
          </h3>
          <ul class="career-versatility-list">
            <?php if (!empty($versatility['items'])): ?>
              <?php foreach ($versatility['items'] as $vIdx => $vItem): ?>
                <li class="career-versatility-item">
                  <span class="badge-tag <?= ($vIdx % 2 === 0) ? 'badge-tag-primary' : 'badge-tag-secondary' ?>"><?= htmlspecialchars($vItem['tag'] ?? '') ?></span>
                  <span class="career-versatility-text"><?= htmlspecialchars($vItem['text'] ?? '') ?></span>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: GENESIS & FOUNDING LEGACY -->
<section class="section section-alt" aria-labelledby="historyTitle">
  <div class="container-wide" style="max-width: 1480px;">
    <div class="section-header fade-up">
      <span class="section-subtitle"><?= htmlspecialchars($legacy['subtitle'] ?? 'Heritage & Foundation') ?></span>
      <h2 class="section-title" id="historyTitle"><?= htmlspecialchars($legacy['title'] ?? 'Our Institutional Journey') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($legacy['description'] ?? 'From a pioneering pharmacy college founded in 1992 to a Deemed University off-campus center of excellence.') ?>
      </p>
    </div>

    <div class="about-legacy-grid fade-up">
      <!-- Left Side: College Image (Landscape Orientation) -->
      <div class="about-legacy-image-wrap">
        <img src="<?= htmlspecialchars($legacy['image'] ?? 'assets/images/campus-front.jpg') ?>" alt="VEL Pharmacy College Campus" loading="lazy" width="600" height="500">
        <div class="about-legacy-badge">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <span>30+ Years Academic Legacy • VISTAS Campus</span>
        </div>
      </div>

      <!-- Right Side: White Legacy Box -->
      <div class="about-legacy-card">
        <div class="about-legacy-heading">
          <?= htmlspecialchars($legacy['card_heading'] ?? 'A Legacy Built on Educational Philanthropy & Academic Vision') ?>
        </div>
        <p class="about-legacy-paragraph">
          <?= htmlspecialchars($legacy['p1'] ?? '') ?>
        </p>
        <p class="about-legacy-paragraph">
          <?= htmlspecialchars($legacy['p2'] ?? '') ?>
        </p>
        <p class="about-legacy-paragraph">
          <?= htmlspecialchars($legacy['p3'] ?? '') ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VISION AND MISSION -->
<section class="section" aria-labelledby="vmTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle">Guiding Principles</span>
      <h2 class="section-title" id="vmTitle">Vision and Mission</h2>
      <p class="section-description">
        Our educational philosophy is centered on empowering future pharmacists with intellectual rigor, ethical values, and societal commitment.
      </p>
    </div>

    <div class="vm-grid">
      <!-- Vision Card -->
      <div class="vm-card vision fade-up delay-1">
        <div class="vm-icon-wrap">
          <svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
        </div>
        <h3 class="vm-title"><?= htmlspecialchars($vision['title'] ?? 'Our Vision') ?></h3>
        <p class="vm-text">
          <?= htmlspecialchars($vision['description'] ?? '') ?>
        </p>
      </div>

      <!-- Mission Card -->
      <div class="vm-card mission fade-up delay-2">
        <div class="vm-icon-wrap">
          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        </div>
        <h3 class="vm-title"><?= htmlspecialchars($mission['title'] ?? 'Our Mission') ?></h3>
        <p class="vm-text">
          <?= htmlspecialchars($mission['description'] ?? '') ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: PRINCIPAL'S MESSAGE -->
<section class="section section-alt" aria-labelledby="principalTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle"><?= htmlspecialchars($principal['subtitle'] ?? 'Academic Leadership') ?></span>
      <h2 class="section-title" id="principalTitle"><?= htmlspecialchars($principal['title'] ?? 'Principal\'s Address') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($principal['description'] ?? 'Message from the head of the institution welcoming the next generation of pharmaceutical professionals.') ?>
      </p>
    </div>

    <div class="principal-spotlight-card fade-up">
      <div class="principal-media">
        <img src="<?= htmlspecialchars($principal['image'] ?? 'assets/images/Faculty/Dr. G. Saravanan.png') ?>" alt="<?= htmlspecialchars($principal['name'] ?? 'Principal') ?>" loading="lazy" width="450" height="520">
      </div>
      <div class="principal-body">
        <div class="principal-quote">
          ❝ <?= nl2br(htmlspecialchars($principal['quote'] ?? '')) ?> ❞
        </div>
        <div class="principal-info">
          <h3><?= htmlspecialchars($principal['name'] ?? 'Dr. G. Saravanan') ?></h3>
          <span><?= htmlspecialchars($principal['qualification'] ?? '') ?> &bull; <?= htmlspecialchars($principal['designation'] ?? 'Professor & Principal') ?></span>
          <div class="principal-badges" style="margin-top: 0.85rem; display: flex; flex-wrap: wrap; gap: 0.65rem; align-items: center;">
            <span class="badge-tag badge-tag-primary"><?= htmlspecialchars($principal['department'] ?? 'Department of Pharmaceutical Chemistry') ?></span>
            <span class="badge-tag"><?= htmlspecialchars($principal['experience'] ?? '18.5 Years Experience') ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: OUR GROUPS (13 SISTER INSTITUTIONS) -->
<section class="section" aria-labelledby="groupsTitle">
  <div class="container-wide">
    <div class="section-header fade-up">
      <span class="section-subtitle"><?= htmlspecialchars($sisters['subtitle'] ?? 'Vels Group Network') ?></span>
      <h2 class="section-title" id="groupsTitle"><?= htmlspecialchars($sisters['title'] ?? 'Our Sister Institutions') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($sisters['description'] ?? 'VEL Pharmacy College is proud to be part of the renowned Vels Group of Institutions.') ?>
      </p>
    </div>

    <div class="groups-grid">
      <?php if (!empty($sisters['list'])): ?>
        <?php foreach ($sisters['list'] as $sIdx => $inst): ?>
          <div class="group-card fade-up <?= ($sIdx % 3 === 1) ? 'delay-1' : (($sIdx % 3 === 2) ? 'delay-2' : '') ?>">
            <div class="group-num"><?= htmlspecialchars($inst['sno'] ?? str_pad($sIdx + 1, 2, '0', STR_PAD_LEFT)) ?></div>
            <div class="group-content">
              <h4><?= htmlspecialchars($inst['name'] ?? '') ?></h4>
              <span class="group-location">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"/></svg>
                <?= htmlspecialchars($inst['location'] ?? '') ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="section" style="padding-top: 0; padding-bottom: 5.5rem; background: #FFFFFF;">
  <div class="container">
    <div class="cta-banner fade-up">
      <h2><?= htmlspecialchars($cta['title'] ?? 'Join an Institution of Proven Academic Excellence') ?></h2>
      <p>
        <?= htmlspecialchars($cta['subtitle'] ?? 'Admissions are open for the B.Pharm 2024–2025 batch. Contact our counselors today or submit your enquiry online.') ?>
      </p>
      <div class="cta-buttons">
        <a href="<?= htmlspecialchars($cta['btn1_link'] ?? 'enquiry') ?>" class="btn btn-primary" style="background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <span><?= htmlspecialchars($cta['btn1_text'] ?? 'Online Enquiry Form') ?></span>
        </a>
        <a href="<?= htmlspecialchars($cta['btn2_link'] ?? 'courses') ?>" class="btn btn-outline-white">
          <span><?= htmlspecialchars($cta['btn2_text'] ?? 'View B.Pharm Syllabus') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>