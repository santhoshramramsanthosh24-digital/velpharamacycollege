<?php
$current_page = 'highlights';
$disable_preloader = true;
$page_title = "Institutional Highlights, Circulars & Concluded Events | VEL Pharmacy College";
$page_description = "Official repository of PCI statutory approvals, university circulars, research laboratory suites, and proceedings of concluded symposiums at VEL Pharmacy College.";
$canonical_url = "https://velpharmacycollege.com/highlights";

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
      "name" => "Highlights & Circulars",
      "item" => "https://velpharmacycollege.com/highlights"
    ]
  ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$highlights_cms = $cms_content['highlights'] ?? [];
$hl_banner = $highlights_cms['banner'] ?? [];
$hl_intro = $highlights_cms['intro'] ?? [];

include __DIR__ . '/includes/header.php';

// Comprehensive Highlights, Official Circulars, Research Labs and Concluded Events Dataset
$highlights_data = !empty($highlights_cms['items']) ? $highlights_cms['items'] : [
  // 1. PCI Statutory Approval
  [
    'id' => 'pci-approval',
    'slug' => 'pci-approval',
    'category' => 'pci',
    'category_name' => 'Statutory Accreditation',
    'badge' => 'PCI Approved • 2024–2028',
    'circular_no' => 'Ref: PCI/VPC/APP-2024/091',
    'date' => 'July 15, 2024',
    'title' => 'PCI Statutory Approval & Degree Sanction',
    'notice_image' => 'assets/images/campus-front.jpg',
    'summary' => 'Official grant of approval under Section 12 of the Pharmacy Act, 1948 by the Pharmacy Council of India for conducting the 4-Year B.Pharm degree program under VISTAS Deemed University at VMCH Campus.',
    'primary_btn_text' => 'About Heritage',
    'primary_btn_link' => 'about-us'
  ],

  // 2. NEP 2020 Curriculum
  [
    'id' => 'nep-curriculum',
    'slug' => 'nep-curriculum',
    'category' => 'curriculum',
    'category_name' => 'Curriculum Innovation',
    'badge' => '193 Credits • NEP 2020 Framework',
    'circular_no' => 'Gazette Ref: PCI-NEP/BPHARM/2026',
    'date' => 'August 22, 2024',
    'title' => 'NEP 2020 Curriculum with Integrated Python & AI',
    'notice_image' => 'assets/images/pharmacy-lab-main.jpg',
    'summary' => 'Official rollout of the NEP 2020 CBCS curriculum integrating Python Programming, Machine Learning, Clinical AI drug design, and 240 hours of practical hospital/industrial internships.',
    'primary_btn_text' => 'View Syllabus',
    'primary_btn_link' => 'courses'
  ],

  // 3. VMCH Hospital Bedside Training
  [
    'id' => 'hospital-rounds',
    'slug' => 'hospital-rounds',
    'category' => 'infrastructure',
    'category_name' => 'Clinical Training & Hospital',
    'badge' => '300+ Bed Teaching Hospital',
    'circular_no' => 'Circular: VMCH/CLIN-PHARM/2024-25',
    'date' => 'September 10, 2024',
    'title' => 'VMCH Teaching Hospital Clinical Rotations Agreement',
    'notice_image' => 'assets/images/hospital-facility.jpg',
    'summary' => 'Direct bedside clinical training at the on-campus 300+ bed VMCH Medical College Hospital covering inpatient pharmacy dispensation, therapeutic drug monitoring, and surgical ICU ward rounds.',
    'primary_btn_text' => 'Hospital Training',
    'primary_btn_link' => 'facilities#hospital'
  ],

  // 4. Central Research & Instrumentation Facility (HPLC)
  [
    'id' => 'research-labs',
    'slug' => 'research-labs',
    'category' => 'infrastructure',
    'category_name' => 'Research Laboratories',
    'badge' => 'Central Analytical Facility',
    'circular_no' => 'Notice: VPC/R&D-FACILITY/2024',
    'date' => 'October 05, 2024',
    'title' => 'Central Analytical & HPLC Instrumentation Suites',
    'notice_image' => 'assets/images/research-lab-modern.jpg',
    'summary' => 'High-precision analytical laboratories equipped with Shimadzu HPLC, double-beam UV-Vis spectrophotometers, dissolution apparatus, and digital molecular modeling suites.',
    'primary_btn_text' => 'Lab Facilities',
    'primary_btn_link' => 'facilities'
  ],

  // 5. Pharmaceutical Chemistry & Modern Analysis Laboratory
  [
    'id' => 'analysis-lab',
    'slug' => 'analysis-lab',
    'category' => 'infrastructure',
    'category_name' => 'Research Laboratories',
    'badge' => 'Titration & Purity Testing',
    'circular_no' => 'Circular: VPC/LAB-ANALYSIS/2024',
    'date' => 'November 12, 2024',
    'title' => 'Pharmaceutical Analysis & Quality Control Lab',
    'notice_image' => 'assets/images/IMG_0127-scaled.jpg',
    'summary' => 'Dedicated pharmaceutical analysis facility certified for API assay, volumetric titration, limit testing, pharmacopoeial purity profiling, and digital spectrophotometric analysis.',
    'primary_btn_text' => 'Analysis Lab',
    'primary_btn_link' => 'facilities'
  ],

  // 6. Industrial Pilot Plant & Machine Room
  [
    'id' => 'pilot-plant',
    'slug' => 'pilot-plant',
    'category' => 'infrastructure',
    'category_name' => 'Research Laboratories',
    'badge' => 'Pilot Formulation Plant',
    'circular_no' => 'Circular: VPC/PILOT-PLANT/2024',
    'date' => 'December 02, 2024',
    'title' => 'Industrial Pilot Plant & Formulation Machine Room',
    'notice_image' => 'assets/images/IMG_0113-1-scaled.jpg',
    'summary' => 'Commercial formulation plant with rotary tablet punching machines, fluid bed dryers, multi-stage dissolution testers, disintegration units, and GMP blister packaging mockups.',
    'primary_btn_text' => 'Machine Room',
    'primary_btn_link' => 'facilities'
  ],

  // 7. Pharmacology & HAP Simulation Suite
  [
    'id' => 'pharmacology-lab',
    'slug' => 'pharmacology-lab',
    'category' => 'infrastructure',
    'category_name' => 'Research Laboratories',
    'badge' => 'Simulation & Bio-Screening',
    'circular_no' => 'Circular: VPC/PHARM-HAP/2024',
    'date' => 'January 18, 2025',
    'title' => 'Pharmacology & In-Silico Simulation Suites',
    'notice_image' => 'assets/images/IMG_0147-1-scaled.jpg',
    'summary' => 'Interactive pharmacology laboratory combining human skeletal/physiological anatomical systems with computerized animal-free simulation software and digital kymograph recordings.',
    'primary_btn_text' => 'Pharmacology',
    'primary_btn_link' => 'facilities'
  ],

  // 8. Medicinal Museum & Crude Pharmacognosy Bioassay Lab
  [
    'id' => 'pharmacognosy-museum',
    'slug' => 'pharmacognosy-museum',
    'category' => 'infrastructure',
    'category_name' => 'Research Laboratories',
    'badge' => 'Herbal Drug Repository',
    'circular_no' => 'Circular: VPC/HERBAL-MED/2024',
    'date' => 'February 14, 2025',
    'title' => 'Pharmacognosy Herbarium & Botanical Museum',
    'notice_image' => 'assets/images/IMG_0117-scaled.jpg',
    'summary' => 'Natural product research repository hosting over 250 authenticated medicinal plant specimens, Soxhlet extraction units, rotary evaporators, and an on-campus botanical garden.',
    'primary_btn_text' => 'Botanical Lab',
    'primary_btn_link' => 'facilities'
  ],

  // 9. Concluded Event 1: World Pharmacists Day 2026 & White Coat Ceremony
  [
    'id' => 'pharmacists-day-2026',
    'slug' => 'pharmacists-day-2026',
    'category' => 'concluded',
    'category_name' => 'Concluded Event Highlight',
    'badge' => 'Concluded • Sep 25, 2026',
    'circular_no' => 'Event Report: VPC/WPD-2026/01',
    'date' => 'September 25, 2026',
    'title' => 'World Pharmacists Day 2026 & White Coat Ceremony',
    'notice_image' => 'assets/images/seminar-hall.jpg',
    'summary' => 'Commemoration of World Pharmacists Day 2026 featuring the B.Pharm White Coat investiture ceremony, recitation of the Pharmacist Oath, and academic excellence merit awards.',
    'primary_btn_text' => 'Leadership',
    'primary_btn_link' => 'leadership'
  ],

  // 10. Concluded Event 2: Industry CADD Masterclass
  [
    'id' => 'cadd-masterclass-2026',
    'slug' => 'cadd-masterclass-2026',
    'category' => 'concluded',
    'category_name' => 'Concluded Event Highlight',
    'badge' => 'Concluded • Oct 15, 2026',
    'circular_no' => 'Event Report: VPC/CADD-WRK/2026',
    'date' => 'October 15, 2026',
    'title' => 'Industry Masterclass on CADD & Molecular Docking',
    'notice_image' => 'assets/images/computer-lab.jpg',
    'summary' => 'Hands-on computational drug design workshop conducted in the digital laboratory covering PyMOL macromolecule modeling, AutoDock Vina simulations, and SwissADME screenings.',
    'primary_btn_text' => 'Computer Lab',
    'primary_btn_link' => 'facilities'
  ]
];

// Active Filter resolution from query parameters (supports instant server-side pre-filtering)
$active_filter = isset($_GET['filter']) ? trim(strtolower($_GET['filter'])) : 'all';

// Compute dynamic category counts
$counts = [
  'all' => count($highlights_data),
  'concluded' => 0,
  'pci' => 0,
  'curriculum' => 0,
  'infrastructure' => 0,
];
foreach ($highlights_data as $h) {
  $c = $h['category'] ?? '';
  if (isset($counts[$c])) {
    $counts[$c]++;
  }
}
?>

<style>
/* Highlights, Notices & Circulars Page Styles - Compact & Short Card Architecture */
.hl-page-wrap {
  padding: 3rem 0 5rem;
  background: #FFFFFF;
}

.hl-intro-banner {
  background: #FFFFFF;
  border: 1.5px solid #D6B56D;
  border-radius: var(--radius-lg);
  padding: 1.25rem 1.75rem;
  margin-bottom: 2rem;
  box-shadow: var(--shadow-sm);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1.25rem;
  flex-wrap: wrap;
}

.hl-intro-text h2 {
  font-size: 1.25rem;
  font-weight: 800;
  color: var(--color-primary-dark);
  margin: 0 0 0.25rem;
}

.hl-intro-text p {
  font-size: 0.9rem;
  color: var(--color-text-muted);
  margin: 0;
  line-height: 1.45;
}

.hl-intro-stats {
  display: flex;
  gap: 0.75rem;
  flex-wrap: wrap;
}

.hl-stat-box {
  background: #F5F7F4;
  border: 1px solid #D6B56D;
  border-radius: var(--radius-md);
  padding: 0.5rem 0.85rem;
  text-align: center;
  min-width: 80px;
}

.hl-stat-num {
  display: block;
  font-size: 1.15rem;
  font-weight: 800;
  color: var(--color-primary);
  line-height: 1.15;
}

.hl-stat-lbl {
  font-size: 0.68rem;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--color-text-muted);
  letter-spacing: 0.5px;
}

/* Category Filter Chips Bar */
.hl-filter-bar {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
  flex-wrap: wrap;
  margin-bottom: 2.25rem;
}

.hl-filter-chip {
  padding: 0.5rem 1.1rem;
  border-radius: var(--radius-full);
  font-size: 0.86rem;
  font-weight: 700;
  border: 1px solid var(--color-border);
  background: #F5F7F4;
  color: var(--color-text-muted);
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: var(--shadow-sm);
  display: inline-flex;
  align-items: center;
  gap: 0.45rem;
}

.hl-filter-chip:hover {
  background: #F5F7F4;
  color: var(--color-primary-dark);
  border-color: #D6B56D;
  transform: translateY(-2px);
}

.hl-filter-chip.active {
  background: var(--color-primary);
  color: #F5F7F4;
  border-color: var(--color-primary);
  box-shadow: 0 4px 12px rgba(30, 106, 77, 0.22);
}

.hl-filter-count {
  font-size: 0.72rem;
  background: rgba(0, 0, 0, 0.08);
  padding: 0.12rem 0.45rem;
  border-radius: var(--radius-full);
}

.hl-filter-chip.active .hl-filter-count {
  background: rgba(255, 255, 255, 0.25);
  color: #F5F7F4;
}

/* Compact Highlights Grid */
.hl-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
  gap: 1.5rem;
}

.hl-card {
  background: #F5F7F4;
  border: 1px solid #D6B56D;
  border-radius: var(--radius-lg);
  box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
}

.hl-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(30, 106, 77, 0.12);
  border-color: #D6B56D;
}

.hl-card.hl-card-focused {
  border-color: var(--color-gold);
  box-shadow: 0 0 0 3px rgba(214, 181, 109, 0.35), 0 12px 28px rgba(30, 106, 77, 0.15);
  animation: hlPulseFocus 1.5s ease-in-out;
}

@keyframes hlPulseFocus {
  0% { transform: scale(0.98); }
  50% { transform: scale(1.02); }
  100% { transform: scale(1); }
}

/* Card Media Header - Compact Short Height */
.hl-card-media {
  position: relative;
  height: 180px;
  overflow: hidden;
  background: #1E6A4D;
  cursor: pointer;
}

.hl-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.45s ease;
}

.hl-card-media:hover .hl-card-img {
  transform: scale(1.06);
}

.hl-media-overlay {
  position: absolute;
  inset: 0;
  background: rgba(30, 106, 77, 0.82);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0.95rem;
  transition: background 0.3s ease;
}

.hl-card-media:hover .hl-media-overlay {
  background: rgba(30, 106, 77, 0.90);
}

.hl-badge-top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 0.4rem;
}

.hl-status-pill {
  font-size: 0.68rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  padding: 0.25rem 0.65rem;
  border-radius: var(--radius-full);
  background: #F5F7F4;
  color: var(--color-primary-dark);
  box-shadow: var(--shadow-sm);
  white-space: nowrap;
}

.hl-status-pill.concluded {
  background: #1E6A4D;
  color: #F5F7F4;
}

.hl-zoom-btn {
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.4);
  color: #F5F7F4;
  font-size: 0.72rem;
  font-weight: 700;
  padding: 0.25rem 0.65rem;
  border-radius: var(--radius-full);
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.hl-zoom-btn:hover {
  background: #F5F7F4;
  color: var(--color-primary-dark);
}

.hl-meta-bottom-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  color: #F5F7F4;
  font-size: 0.78rem;
  gap: 0.5rem;
}

.hl-circular-ref {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
  font-size: 0.72rem;
  background: rgba(0, 0, 0, 0.55);
  padding: 0.2rem 0.5rem;
  border-radius: 4px;
  color: #D6B56D;
  font-weight: 600;
  letter-spacing: 0.2px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 65%;
}

/* Card Body - Short & Tight */
.hl-card-body {
  padding: 1.25rem 1.35rem;
  display: flex;
  flex-direction: column;
  flex: 1;
}

.hl-category-tag {
  font-size: 0.72rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: var(--color-gold);
  margin-bottom: 0.35rem;
}

.hl-title {
  font-size: 1.08rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  line-height: 1.35;
  margin: 0 0 0.55rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.85rem;
}

.hl-summary {
  font-size: 0.875rem;
  color: var(--color-text-muted);
  line-height: 1.55;
  margin: 0 0 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  flex: 1;
}

.hl-actions-row {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  padding-top: 0.85rem;
  border-top: 1px solid #F5F7F4;
  margin-top: auto;
}

.hl-actions-row .btn {
  flex: 1;
  justify-content: center;
  padding: 0.45rem 0.65rem;
  font-size: 0.82rem;
  white-space: nowrap;
}

/* Lightbox Modal */
.notice-lightbox-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.88);
  backdrop-filter: blur(6px);
  z-index: 9999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 1.25rem;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.notice-lightbox-overlay.open {
  display: flex;
  opacity: 1;
}

.notice-lightbox-dialog {
  background: #F5F7F4;
  border-radius: var(--radius-xl);
  max-width: 820px;
  width: 100%;
  max-height: 92vh;
  overflow: hidden;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  display: flex;
  flex-direction: column;
  animation: modalPopIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes modalPopIn {
  from { transform: scale(0.92); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.notice-lightbox-header {
  padding: 1rem 1.35rem;
  background: #1E6A4D;
  color: #F5F7F4;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
}

.notice-lightbox-title {
  font-size: 1.05rem;
  font-weight: 700;
  margin: 0;
  color: #F5F7F4;
  line-height: 1.35;
}

.notice-lightbox-close {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: #F5F7F4;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.notice-lightbox-close:hover {
  background: rgba(255, 255, 255, 0.35);
  transform: rotate(90deg);
}

.notice-lightbox-body {
  padding: 1.25rem;
  overflow-y: auto;
  text-align: center;
  background: #1E6A4D;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 320px;
}

.notice-lightbox-body img {
  max-width: 100%;
  max-height: 65vh;
  object-fit: contain;
  margin: 0 auto;
  border-radius: var(--radius-md);
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
}

.notice-lightbox-footer {
  padding: 0.85rem 1.35rem;
  background: #F5F7F4;
  border-top: 1px solid #D6B56D;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

@media (max-width: 768px) {
  .hl-grid {
    grid-template-columns: 1fr;
  }
  .hl-intro-banner {
    flex-direction: column;
    align-items: flex-start;
  }
  .hl-actions-row {
    flex-direction: column;
  }
  .hl-actions-row .btn {
    width: 100%;
  }
}
</style>

<!-- PAGE BANNER WITH BREADCRUMB -->
<section class="page-banner" aria-label="Page Title Banner">
  <div class="container-wide">
    <div class="page-banner-box">
      <div class="page-banner-content motion-from-left">
        <nav class="breadcrumb" aria-label="Breadcrumbs">
          <a href="/">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">Highlights &amp; Circulars</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($hl_banner['title'] ?? 'Institutional Highlights & Official Circulars') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($hl_banner['subtitle'] ?? 'Statutory PCI approvals, official academic circulars, advanced research laboratory suites, and proceedings of concluded healthcare symposiums at VEL Pharmacy College.') ?>
        </p>
      </div>
      <div class="page-banner-media motion-from-right">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($hl_banner['image'] ?? 'assets/images/campus-front.jpg') ?>" alt="VEL Pharmacy College Highlights &amp; Circulars" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN HIGHLIGHTS & CIRCULARS REPOSITORY -->
<section class="section hl-page-wrap" style="padding-bottom: 5.5rem; background: #FFFFFF;">
  <div class="container">

    <!-- Overview Statistics Banner -->
    <div class="hl-intro-banner">
      <div class="hl-intro-text">
        <h2><?= htmlspecialchars($hl_intro['title'] ?? 'Institutional Documents & Milestone Archive') ?></h2>
        <p><?= htmlspecialchars($hl_intro['subtitle'] ?? 'Explore official gazette notifications, laboratory facility commissioning records, and past academic proceedings with preview notice images.') ?></p>
      </div>
      <div class="hl-intro-stats">
        <div class="hl-stat-box">
          <span class="hl-stat-num"><?= $counts['all'] ?></span>
          <span class="hl-stat-lbl">Documents</span>
        </div>
        <div class="hl-stat-box">
          <span class="hl-stat-num"><?= $counts['infrastructure'] ?></span>
          <span class="hl-stat-lbl">Research Labs</span>
        </div>
        <div class="hl-stat-box">
          <span class="hl-stat-num"><?= $counts['concluded'] ?></span>
          <span class="hl-stat-lbl">Concluded</span>
        </div>
      </div>
    </div>

    <!-- Interactive Category Filter Chips -->
    <div class="hl-filter-bar" role="tablist" aria-label="Filter Highlights">
      <button type="button" class="hl-filter-chip <?= ($active_filter === 'all') ? 'active' : '' ?>" data-filter="all">
        <span>All Highlights &amp; Circulars</span>
        <span class="hl-filter-count"><?= $counts['all'] ?></span>
      </button>
      <button type="button" class="hl-filter-chip <?= ($active_filter === 'concluded') ? 'active' : '' ?>" data-filter="concluded">
        <span>Concluded Events</span>
        <span class="hl-filter-count"><?= $counts['concluded'] ?></span>
      </button>
      <button type="button" class="hl-filter-chip <?= ($active_filter === 'pci') ? 'active' : '' ?>" data-filter="pci">
        <span>PCI &amp; Statutory Approvals</span>
        <span class="hl-filter-count"><?= $counts['pci'] ?></span>
      </button>
      <button type="button" class="hl-filter-chip <?= ($active_filter === 'curriculum') ? 'active' : '' ?>" data-filter="curriculum">
        <span>Curriculum &amp; AI</span>
        <span class="hl-filter-count"><?= $counts['curriculum'] ?></span>
      </button>
      <button type="button" class="hl-filter-chip <?= ($active_filter === 'infrastructure') ? 'active' : '' ?>" data-filter="infrastructure">
        <span>Research Labs &amp; Hospital</span>
        <span class="hl-filter-count"><?= $counts['infrastructure'] ?></span>
      </button>
    </div>

    <!-- Compact Highlights Cards Grid (Short Cards Architecture) -->
    <div class="hl-grid" id="highlightsGrid">
      <?php foreach ($highlights_data as $hlIdx => $hl): 
        $is_hidden = ($active_filter !== 'all' && ($hl['category'] ?? '') !== $active_filter);
      ?>
        <article class="hl-card" data-category="<?= htmlspecialchars($hl['category'] ?? 'all') ?>" id="<?= htmlspecialchars($hl['slug'] ?? ($hl['id'] ?? 'hl-' . $hlIdx)) ?>" style="<?= $is_hidden ? 'display: none;' : '' ?>">
          
          <!-- Notice Document Media Header (Click to preview notice image) -->
          <div class="hl-card-media btn-open-notice" data-title="<?= htmlspecialchars($hl['title'] ?? '') ?>" data-img="<?= htmlspecialchars($hl['notice_image'] ?? '') ?>" data-ref="<?= htmlspecialchars($hl['circular_no'] ?? '') ?>" title="Click to preview official notice document">
            <img src="<?= htmlspecialchars($hl['notice_image'] ?? 'assets/images/campus-front.jpg') ?>" alt="<?= htmlspecialchars($hl['title'] ?? '') ?>" class="hl-card-img" loading="lazy">
            <div class="hl-media-overlay">
              <div class="hl-badge-top-row">
                <span class="hl-status-pill <?= (($hl['category'] ?? '') === 'concluded') ? 'concluded' : '' ?>">
                  <?= htmlspecialchars($hl['badge'] ?? '') ?>
                </span>
                <span class="hl-zoom-btn" title="View official notice image">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                  <span>Notice</span>
                </span>
              </div>
              <div class="hl-meta-bottom-row">
                <span class="hl-circular-ref" title="<?= htmlspecialchars($hl['circular_no'] ?? '') ?>"><?= htmlspecialchars($hl['circular_no'] ?? '') ?></span>
                <span style="font-size: 0.74rem; opacity: 0.95; font-weight: 600; white-space: nowrap;"><?= htmlspecialchars($hl['date'] ?? '') ?></span>
              </div>
            </div>
          </div>

          <!-- Compact Short Card Body -->
          <div class="hl-card-body">
            <div class="hl-category-tag"><?= htmlspecialchars($hl['category_name'] ?? ucfirst($hl['category'] ?? 'Notice')) ?></div>
            <h2 class="hl-title" title="<?= htmlspecialchars($hl['title'] ?? '') ?>"><?= htmlspecialchars($hl['title'] ?? '') ?></h2>
            <p class="hl-summary"><?= htmlspecialchars($hl['summary'] ?? '') ?></p>

            <div class="hl-actions-row">
              <button type="button" class="btn btn-outline-primary btn-open-notice" data-title="<?= htmlspecialchars($hl['title'] ?? '') ?>" data-img="<?= htmlspecialchars($hl['notice_image'] ?? '') ?>" data-ref="<?= htmlspecialchars($hl['circular_no'] ?? '') ?>" title="Preview official notice document">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                <span>Notice Image</span>
              </button>
              <a href="<?= htmlspecialchars($hl['primary_btn_link'] ?? 'enquiry') ?>" class="btn btn-primary" title="<?= htmlspecialchars($hl['primary_btn_text'] ?? 'View Details') ?>">
                <span><?= htmlspecialchars($hl['primary_btn_text'] ?? 'View Details') ?> &rarr;</span>
              </a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- NOTICE & CIRCULAR IMAGE LIGHTBOX MODAL -->
<div class="notice-lightbox-overlay" id="noticeModal" role="dialog" aria-modal="true" aria-labelledby="noticeModalTitle">
  <div class="notice-lightbox-dialog">
    <div class="notice-lightbox-header">
      <h3 class="notice-lightbox-title" id="noticeModalTitle">Official Notice / Circular Preview</h3>
      <button type="button" class="notice-lightbox-close" id="noticeModalCloseBtn" aria-label="Close modal">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>
    <div class="notice-lightbox-body">
      <img src="" alt="Notice Document" id="noticeModalImg">
    </div>
    <div class="notice-lightbox-footer">
      <span id="noticeModalRef" style="font-family: ui-monospace, SFMono-Regular, monospace; font-size: 0.85rem; color: var(--color-primary-dark); font-weight: 700;"></span>
      <div style="display: flex; gap: 0.5rem;">
        <a href="" id="noticeModalDownload" download class="btn btn-primary" style="padding: 0.45rem 1rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
          <span>Download Notice</span>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.hl-filter-chip');
  const cards = document.querySelectorAll('.hl-card');
  const modal = document.getElementById('noticeModal');
  const modalTitle = document.getElementById('noticeModalTitle');
  const modalImg = document.getElementById('noticeModalImg');
  const modalRef = document.getElementById('noticeModalRef');
  const modalDownload = document.getElementById('noticeModalDownload');
  const modalCloseBtn = document.getElementById('noticeModalCloseBtn');

  // URL query parameter support: e.g. ?filter=concluded
  const urlParams = new URLSearchParams(window.location.search);
  const initialFilter = urlParams.get('filter');

  if (initialFilter) {
    const targetChip = document.querySelector(`.hl-filter-chip[data-filter="${initialFilter}"]`);
    if (targetChip) {
      applyFilter(initialFilter, targetChip);
    }
  }

  // Handle URL hash anchor navigation (e.g. #research-labs)
  if (window.location.hash) {
    const hashTarget = document.querySelector(window.location.hash);
    if (hashTarget) {
      setTimeout(function() {
        hashTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
        hashTarget.classList.add('hl-card-focused');
      }, 250);
    }
  }

  // Filter Buttons
  filterButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      const filter = this.getAttribute('data-filter');
      applyFilter(filter, this);
    });
  });

  function applyFilter(filter, activeChip) {
    filterButtons.forEach(function(b) { b.classList.remove('active'); });
    activeChip.classList.add('active');

    cards.forEach(function(card) {
      const cat = card.getAttribute('data-category');
      if (filter === 'all' || cat === filter) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }

  // Lightbox Modal for Notice and Lab Images
  document.querySelectorAll('.btn-open-notice').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const title = this.getAttribute('data-title');
      const img = this.getAttribute('data-img');
      const ref = this.getAttribute('data-ref');

      modalTitle.textContent = title;
      modalImg.src = img;
      modalImg.alt = title;
      modalRef.textContent = ref;
      modalDownload.href = img;
      modal.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  });

  function closeModal() {
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('open')) {
      closeModal();
    }
  });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
