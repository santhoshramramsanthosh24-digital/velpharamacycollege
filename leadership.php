<?php
$current_page = 'leadership';
$page_title = "Leadership & Governance | Vel Pharmacy College | VISTAS";
$page_description = "Meet the esteemed leadership team of Vel Pharmacy College and VISTAS Deemed University, headed by Founder-Chancellor Dr. Ishari K. Ganesh and visionary academic leaders.";
$canonical_url = "https://velpharmacycollege.com/leadership";

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
      "name" => "Leadership",
      "item" => "https://velpharmacycollege.com/leadership"
    ]
  ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$lead_cms = $cms_content['leadership'] ?? [];

include __DIR__ . '/includes/header.php';

$banner = $lead_cms['banner'] ?? [];
$header = $lead_cms['section_header'] ?? [];
$leaders = $lead_cms['leaders'] ?? [];
$gov = $lead_cms['governance_philosophy'] ?? [];
$cta = $lead_cms['cta_banner'] ?? [];
?>

<!-- PAGE BANNER WITH BREADCRUMB & RELATED IMAGE BOX -->
<section class="page-banner" aria-label="Page Title Banner">
  <div class="container-wide">
    <div class="page-banner-box">
      <div class="page-banner-content">
        <nav class="breadcrumb" aria-label="Breadcrumbs">
          <a href="/">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">Leadership</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($banner['title'] ?? 'Leadership & Governance') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($banner['subtitle'] ?? 'Guided by visionary educational pioneers and dedicated administrators who steer Vel Pharmacy College toward global academic distinction and ethical healthcare leadership.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($banner['image'] ?? 'assets/images/Group_pic.jpg') ?>"
            alt="<?= htmlspecialchars($banner['title'] ?? 'Leadership') ?>" class="page-banner-img" loading="eager"
            width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 1: UNIVERSITY & COLLEGIATE LEADERSHIP -->
<section class="section" aria-labelledby="leadershipHeading">
  <div class="container">
    <div class="text-center" style="max-width: 780px; margin: 0 auto 3.5rem;">
      <span
        class="section-subtitle"><?= htmlspecialchars($header['subtitle'] ?? 'Governance & Academic Stewardship') ?></span>
      <h2 class="section-title" id="leadershipHeading">
        <?= htmlspecialchars($header['title'] ?? 'Our Leadership Team') ?>
      </h2>
      <p class="section-description">
        <?= htmlspecialchars($header['description'] ?? 'Meet the distinguished visionary leaders, university statutory officers, and collegiate administrators steering VISTAS and Vel Pharmacy College.') ?>
      </p>
    </div>

    <?php if (!empty($leaders)): ?>
      <?php foreach ($leaders as $lIdx => $ldr): ?>
        <div class="principal-spotlight-card fade-up">
          <div class="principal-media">
            <img src="<?= htmlspecialchars($ldr['image'] ?? 'assets/images/chancellor-ishari-ganesh-vistas.jpg') ?>"
              alt="<?= htmlspecialchars($ldr['name'] ?? '') ?>" loading="lazy" width="450" height="520">
          </div>
          <div class="principal-body">
            <?php if (!empty($ldr['tag'])): ?>
              <div style="margin-bottom: 0.75rem;">
                <span class="badge-tag <?= ($lIdx % 2 === 0) ? 'badge-tag-primary' : '' ?>"
                  style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;"><?= htmlspecialchars($ldr['tag']) ?></span>
              </div>
            <?php endif; ?>
            <div class="principal-quote">
              ❝ <?= nl2br(htmlspecialchars($ldr['quote'] ?? '')) ?> ❞
            </div>
            <div class="principal-info">
              <h3><?= htmlspecialchars($ldr['name'] ?? '') ?></h3>
              <span><?= htmlspecialchars($ldr['title'] ?? '') ?></span>
              <?php if (!empty($ldr['badges'])): ?>
                <div style="margin-top: 0.75rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                  <?php foreach ($ldr['badges'] as $bIdx => $badgeTxt): ?>
                    <span
                      class="badge-tag <?= ($bIdx === 0) ? 'badge-tag-primary' : '' ?>"><?= htmlspecialchars($badgeTxt) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</section>

<!-- SECTION 2: CORE GOVERNANCE PRINCIPLES -->
<section class="section section-alt" aria-labelledby="principlesHeading">
  <div class="container">
    <div class="text-center" style="max-width: 720px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle"><?= htmlspecialchars($gov['subtitle'] ?? 'Ethical Foundation') ?></span>
      <h2 class="section-title" id="principlesHeading">
        <?= htmlspecialchars($gov['title'] ?? 'Our Governance Philosophy') ?>
      </h2>
      <p class="section-description">
        <?= htmlspecialchars($gov['description'] ?? 'Vel Pharmacy College operates under strict regulatory compliance with the Pharmacy Council of India (PCI) and UGC guidelines.') ?>
      </p>
    </div>

    <div class="governance-cards-grid">
      <?php if (!empty($gov['cards'])): ?>
        <?php foreach ($gov['cards'] as $gIdx => $gCard): ?>
          <div class="feature-card fade-up <?= ($gIdx === 1) ? 'delay-1' : (($gIdx === 2) ? 'delay-2' : '') ?>">
            <div class="feature-icon" style="background: var(--color-primary-subtle); color: var(--color-primary);">
              <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>
            <h3 class="feature-title"><?= htmlspecialchars($gCard['title'] ?? '') ?></h3>
            <p class="feature-text">
              <?= htmlspecialchars($gCard['desc'] ?? '') ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- SECTION 3: CALL TO ACTION -->
<section class="section" style="background: #FFFFFF; padding-top: 1.5rem; padding-bottom: 5.5rem;"
  aria-label="Admissions Call to Action">
  <div class="container">
    <div class="cta-banner fade-up">
      <h2><?= htmlspecialchars($cta['title'] ?? 'Begin Your Journey in Pharmaceutical Excellence') ?></h2>
      <p style="margin: 0 auto 2rem;">
        <?= htmlspecialchars($cta['subtitle'] ?? 'Enroll in the 4-year B.Pharm degree program at Vel Pharmacy College and learn under the guidance of visionary academic mentors.') ?>
      </p>
      <div class="cta-buttons">
        <a href="<?= htmlspecialchars($cta['btn1_link'] ?? 'enquiry') ?>" class="btn btn-primary" style="background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <span><?= htmlspecialchars($cta['btn1_text'] ?? 'Apply for Admissions') ?></span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>
        <a href="<?= htmlspecialchars($cta['btn2_link'] ?? 'contact-us') ?>" class="btn btn-outline-white">
          <span><?= htmlspecialchars($cta['btn2_text'] ?? 'Contact Admissions Office') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>