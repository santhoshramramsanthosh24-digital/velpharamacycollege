<?php
require_once __DIR__ . '/includes/syllabus_data.php';

$current_page = 'courses';
$page_title = "B.Pharm Curriculum & Syllabus (PCI NEP 2020) | VEL Pharmacy College";
$page_description = "Explore the updated Pharmacy Council of India (PCI) NEP 2020 B.Pharm Syllabus at VEL Pharmacy College. 193 Credits across 8 Semesters featuring Python, AI, Data Analytics, 240 hrs Internship & Capstone Research.";
$canonical_url = "https://velpharmacycollege.com/courses";

// Course & Breadcrumb Schema
$custom_schema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
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
                    "name" => "Courses",
                    "item" => "https://velpharmacycollege.com/courses"
                ]
            ]
        ],
        [
            "@type" => "Course",
            "name" => "Bachelor of Pharmacy (B.Pharm) - NEP 2020",
            "description" => "A comprehensive 4-year undergraduate degree in pharmaceutical sciences approved by the Pharmacy Council of India (PCI) and affiliated to VISTAS Deemed University, updated as per National Education Policy (NEP 2020) with 193 credits.",
            "provider" => [
                "@type" => "CollegeOrUniversity",
                "name" => "VEL Pharmacy College",
                "sameAs" => "https://velpharmacycollege.com"
            ],
            "timeRequired" => "P4Y",
            "educationalCredentialAwarded" => "Bachelor of Pharmacy (B.Pharm)",
            "hasCourseInstance" => [
                "@type" => "CourseInstance",
                "courseMode" => "Full-time",
                "courseWorkload" => "8 Semesters (193 Credits)"
            ]
        ]
    ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$courses_cms = $cms_content['courses'] ?? [];

include __DIR__ . '/includes/header.php';
?>

<!-- Include Modern Curriculum Stylesheet -->
<link rel="stylesheet" href="assets/css/curriculum-modern.css?v=<?= time() ?>">

<!-- PAGE BANNER WITH BREADCRUMB & RELATED IMAGE BOX -->
<section class="page-banner" aria-label="Page Title Banner">
  <div class="container-wide">
    <div class="page-banner-box">
      <div class="page-banner-content">
        <nav class="breadcrumb" aria-label="Breadcrumbs">
          <a href="/">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">Courses</span>
        </nav>
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.18); padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700; color: #F5F7F4; text-transform: uppercase; letter-spacing: 0.75px; margin-bottom: 0.75rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          <?= htmlspecialchars($courses_cms['banner']['badge'] ?? 'PCI NEP 2020 Regulation (2026 Curriculum)') ?>
        </div>
        <h1 class="page-title"><?= htmlspecialchars($courses_cms['banner']['title'] ?? 'Bachelor of Pharmacy (B.Pharm)') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($courses_cms['banner']['subtitle'] ?? 'A premier 4-Year (8 Semesters) undergraduate professional degree recognized by the Pharmacy Council of India (PCI), New Delhi and affiliated to Vels Institute of Science, Technology & Advanced Studies (VISTAS).') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($courses_cms['banner']['image'] ?? 'assets/images/pharmacy-lab-main.jpg') ?>" alt="B.Pharm Pharmacy Laboratory Training" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- QUICK PROGRAM HIGHLIGHTS BAR -->
<?php
$c_hl = $courses_cms['highlights'] ?? [];
$c_ov = $courses_cms['overview'] ?? [];
$c_el = $courses_cms['eligibility'] ?? [];
?>
<div style="background: #FFFFFF; border-bottom: 1px solid #D6B56D; padding: 1.25rem 0;">
  <div class="container-wide">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; text-align: center;">
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Program Level</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-primary-dark);"><?= htmlspecialchars($c_hl['level'] ?? 'Undergraduate (UG)') ?></div>
      </div>
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Duration</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-secondary);"><?= htmlspecialchars($c_hl['duration'] ?? '4 Years (8 Semesters)') ?></div>
      </div>
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Total Credits</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-gold);"><?= htmlspecialchars($c_hl['credits'] ?? '193 Credits (CBCS)') ?></div>
      </div>
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Statutory Approval</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-primary-dark);"><?= htmlspecialchars($c_hl['approval'] ?? 'PCI, New Delhi') ?></div>
      </div>
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Curriculum Model</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-primary);"><?= htmlspecialchars($c_hl['curriculum'] ?? 'NEP 2020 Aligned') ?></div>
      </div>
      <div>
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--color-text-light); font-weight: 600;">Medium</span>
        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-secondary);"><?= htmlspecialchars($c_hl['medium'] ?? 'English') ?></div>
      </div>
    </div>
  </div>
</div>

<!-- SECTION 1: PROGRAM OVERVIEW -->
<section class="section" aria-labelledby="programOverviewTitle">
  <div class="container">
    <div class="course-overview-grid">
      <div class="course-overview-content fade-up">
        <span class="section-subtitle"><?= htmlspecialchars($c_ov['subtitle'] ?? 'Excellence in Pharmaceutical Education') ?></span>
        <h2 class="section-title" id="programOverviewTitle" style="text-align: left; margin-bottom: 1.25rem;">
          <?= htmlspecialchars($c_ov['title'] ?? 'Courses Offered - B.Pharm') ?>
        </h2>
        <p style="font-size: 1.05rem; line-height: 1.8; color: var(--color-text-main); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($c_ov['desc_p1'] ?? 'The Bachelor of Pharmacy (B.Pharm) program at VEL Pharmacy College is a four-year professional degree meticulously aligned with the Pharmacy Council of India (PCI) NEP 2020 framework.') ?>
        </p>
        <p style="line-height: 1.75; color: var(--color-text-muted); margin-bottom: 1.5rem;">
          <?= htmlspecialchars($c_ov['desc_p2'] ?? 'Our students undergo direct clinical rotations and bedside patient exposure at the on-campus 300+ bed Vels Medical College Hospital (VMCH), mastering therapeutic drug monitoring, patient counseling, pharmacovigilance, and modern hospital pharmacy logistics.') ?>
        </p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="#curriculum" class="btn btn-primary">
            <span>Explore NEP 2020 Syllabus</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
          </a>
          <a href="enquiry" class="btn btn-outline">
            <span>Apply Online 2027-28</span>
          </a>
        </div>
      </div>

      <div class="course-overview-card fade-up delay-2">
        <div class="course-overview-img-wrap">
          <img src="<?= htmlspecialchars($c_ov['image'] ?? 'assets/images/IMG_0098-1-scaled.jpg') ?>" alt="VEL Pharmacy College Advanced Laboratory" class="course-overview-img">
          <div class="course-overview-badge-tag">
            <div style="font-size: 0.85rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase; margin-bottom: 0.25rem;"><?= htmlspecialchars($c_ov['badge'] ?? 'Off-Campus Center & Hospital') ?></div>
            <div style="font-size: 0.95rem; font-weight: 600; color: var(--color-text-main);"><?= htmlspecialchars($c_ov['pill'] ?? 'VMCH Campus, Manjankaranai, Tiruvallur') ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: ADMISSION ELIGIBILITY & CRITERIA -->
<section class="section section-alt" id="eligibility" aria-labelledby="eligibilityHeading">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3rem;">
      <span class="section-subtitle"><?= htmlspecialchars($c_el['subtitle'] ?? 'Admissions Guidelines') ?></span>
      <h2 class="section-title" id="eligibilityHeading"><?= htmlspecialchars($c_el['title'] ?? 'Eligibility for Admission') ?></h2>
      <p class="section-description">
        Admissions to the Bachelor of Pharmacy program are conducted strictly in accordance with the regulatory standards established by the Pharmacy Council of India (PCI).
      </p>
    </div>

    <!-- Eligibility Table -->
    <div style="background: #FFFFFF; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); overflow-x: auto; border: 1.5px solid #D6B56D; margin-bottom: 2.5rem;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
        <thead>
          <tr style="background-color: var(--color-primary); color: #F5F7F4;">
            <th style="padding: 1.25rem 1.5rem; font-weight: 700; letter-spacing: 0.5px;">Program Stream</th>
            <th style="padding: 1.25rem 1.5rem; font-weight: 700; letter-spacing: 0.5px;">Program Duration</th>
            <th style="padding: 1.25rem 1.5rem; font-weight: 700; letter-spacing: 0.5px;">Prescribed Eligibility (PCI Regulations)</th>
            <th style="padding: 1.25rem 1.5rem; font-weight: 700; letter-spacing: 0.5px;">Credit Scheme</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom: 1px solid var(--color-tertiary-light);">
            <td style="padding: 1.5rem; font-weight: 700; color: var(--color-primary-dark); font-size: 1.05rem;">
              First Year B.Pharm<br>
              <span style="color: var(--color-secondary); font-size: 0.9rem;">(Regular 4-Year Entry)</span>
            </td>
            <td style="padding: 1.5rem; font-weight: 600; color: var(--color-text-main);">
              4 Academic Years<br>
              <span style="font-size: 0.85rem; color: var(--color-text-light);">(8 Semesters)</span>
            </td>
            <td style="padding: 1.5rem; color: var(--color-text-muted); line-height: 1.6;">
              <?= htmlspecialchars($c_el['hsc_requirement'] ?? 'Passed 10+2 examination conducted by State/Central Government or equivalent examination recognized by AIU/COBSE, with English, Physics, and Chemistry as compulsory subjects, along with either Mathematics OR Biology (Botany & Zoology).') ?>
            </td>
            <td style="padding: 1.5rem; color: var(--color-text-main); font-weight: 700; line-height: 1.6;">
              <span style="color: var(--color-primary);">193 Total Credits</span><br>
              <span style="font-size: 0.85rem; font-weight: 500; color: var(--color-text-light);">Theory + Practical + 240h Internship + Research</span>
            </td>
          </tr>
          <tr style="border-bottom: 1px solid var(--color-tertiary-light); background: #F5F7F4;">
            <td style="padding: 1.5rem; font-weight: 700; color: var(--color-primary-dark); font-size: 1.05rem;">
              Lateral Entry B.Pharm<br>
              <span style="color: var(--color-secondary); font-size: 0.9rem;">(Direct 3rd Semester)</span>
            </td>
            <td style="padding: 1.5rem; font-weight: 600; color: var(--color-text-main);">
              3 Academic Years<br>
              <span style="font-size: 0.85rem; color: var(--color-text-light);">(6 Semesters: Sem III to VIII)</span>
            </td>
            <td style="padding: 1.5rem; color: var(--color-text-muted); line-height: 1.6;">
              <?= htmlspecialchars($c_el['lateral_entry'] ?? 'Passed in Diploma in Pharmacy (D. Pharm) from an institution approved by the Pharmacy Council of India under Section 12 of the Pharmacy Act.') ?>
            </td>
            <td style="padding: 1.5rem; color: var(--color-text-main); font-weight: 700; line-height: 1.6;">
              <span style="color: var(--color-secondary);">47 Bridge Credits Awarded</span><br>
              <span style="font-size: 0.85rem; font-weight: 500; color: var(--color-text-light);">(41 D.Pharm credits + 6 bridge credits in Sem III &amp; IV)</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Medium of Instruction Notice -->
    <div style="background: #FFFFFF; border: 1.5px solid #D6B56D; border-left: 6px solid #D6B56D; padding: 1.25rem 1.75rem; border-radius: var(--radius-sm); display: flex; align-items: center; gap: 1rem;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-primary); flex-shrink: 0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      <div>
        <strong style="color: var(--color-primary-dark);">Medium of Instruction &amp; Examinations:</strong>
        <span style="color: var(--color-text-muted); margin-left: 0.5rem;">English is the mandatory medium of classroom teaching, laboratory work, dissertation submissions, and semester examinations for all courses. Minimum 75% attendance required separately in theory and practicals.</span>
      </div>
    </div>
  </div>
</section>

<?php
$ga_meta_map = [
  '01' => [
    'group' => 'science',
    'category' => 'Core Sciences',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31L4.69 19.3A2 2 0 0 0 6.44 22h11.12a2 2 0 0 0 1.75-2.7L14 9.31V2"/><line x1="8.5" y1="2" x2="15.5" y2="2"/><line x1="7" y1="16" x2="17" y2="16"/></svg>'
  ],
  '02' => [
    'group' => 'science',
    'category' => 'Analytical Lab',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>'
  ],
  '03' => [
    'group' => 'clinical',
    'category' => 'PCI Oath & Ethics',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>'
  ],
  '04' => [
    'group' => 'clinical',
    'category' => 'Patient Care',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 9v4"/><path d="M10 11h4"/></svg>'
  ],
  '05' => [
    'group' => 'science',
    'category' => 'Industry Readiness',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><line x1="6" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="18" y2="12"/></svg>'
  ],
  '06' => [
    'group' => 'tech',
    'category' => 'AI & Pharma 4.0',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>'
  ],
  '07' => [
    'group' => 'clinical',
    'category' => 'Healthcare Dialogue',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="13" y2="13"/></svg>'
  ],
  '08' => [
    'group' => 'tech',
    'category' => 'Leadership & Teams',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
  ],
  '09' => [
    'group' => 'tech',
    'category' => 'Problem Innovation',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>'
  ],
  '10' => [
    'group' => 'tech',
    'category' => 'Lifelong Learning',
    'accent' => '#1E6A4D',
    'subtle' => '#F5F7F4',
    'gradient' => '#D6B56D',
    'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>'
  ]
];
?>
<!-- SECTION 3: PCI GRADUATE ATTRIBUTES & PROGRAM OBJECTIVES -->
<section class="section ga-section" aria-labelledby="peoTitle">
  <div class="container-wide">
    <div class="text-center" style="max-width: 1040px; margin: 0 auto;">
      <div class="ga-header-meta">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <span>Outcome Based Education (OBE) • PCI NEP 2020</span>
      </div>
      <h2 class="section-title" id="peoTitle">PCI Graduate Attributes &amp; Educational Objectives</h2>
      <p class="section-description" style="font-size: 1.12rem; line-height: 1.75; max-width: 920px; margin: 0 auto;">
        In accordance with the Pharmacy Council of India (PCI) NEP 2020 curriculum, our B.Pharm degree instills 10 core Graduate Attributes (GAs) and 11 Programme Outcomes (POs) to produce versatile healthcare leaders.
      </p>
    </div>

    <!-- Interactive Category Filter Chips -->
    <div class="ga-filter-bar">
      <button type="button" class="ga-filter-btn active" data-ga-filter="all">
        <span>All Attributes</span>
        <span class="ga-count">10</span>
      </button>
      <button type="button" class="ga-filter-btn" data-ga-filter="science">
        <span>Core Science &amp; Lab</span>
        <span class="ga-count">3</span>
      </button>
      <button type="button" class="ga-filter-btn" data-ga-filter="clinical">
        <span>Clinical Care &amp; Ethics</span>
        <span class="ga-count">3</span>
      </button>
      <button type="button" class="ga-filter-btn" data-ga-filter="tech">
        <span>AI, Tech &amp; Leadership</span>
        <span class="ga-count">4</span>
      </button>
    </div>

    <!-- 10 Symmetrical Graduate Attributes Grid (5x2 on desktop, 2x5 on tablet, 1x10 on mobile) -->
    <div class="ga-grid" id="gaGrid">
      <?php foreach ($nep_syllabus_data['graduate_attributes'] as $ga): 
        $num = $ga['num'];
        $meta = $ga_meta_map[$num] ?? [
          'group' => 'all',
          'category' => 'Graduate Attribute',
          'accent' => '#1E6A4D',
          'subtle' => '#F5F7F4',
          'gradient' => '#D6B56D',
          'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>'
        ];
      ?>
        <div class="ga-card fade-up" data-ga-group="<?= htmlspecialchars($meta['group']) ?>" style="--ga-accent: <?= $meta['accent'] ?>; --ga-subtle: <?= $meta['subtle'] ?>; --ga-gradient: <?= $meta['gradient'] ?>;">
          <span class="ga-watermark" aria-hidden="true"><?= htmlspecialchars($num) ?></span>
          <div>
            <div class="ga-card-top">
              <span class="ga-serial-badge">GA · <?= htmlspecialchars($num) ?></span>
              <div class="ga-icon-box" aria-hidden="true">
                <?= $meta['icon'] ?>
              </div>
            </div>
            <span class="ga-category-tag"><?= htmlspecialchars($meta['category']) ?></span>
            <h3 class="ga-card-title"><?= htmlspecialchars($ga['title']) ?></h3>
            <p class="ga-card-desc"><?= htmlspecialchars($ga['desc']) ?></p>
          </div>
          <div class="ga-card-bottom">
            <span>PCI NEP 2020 OBE</span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Upgraded Pharmacist's Oath Card -->
    <div class="ga-oath-card fade-up">
      <div class="ga-oath-emblem" aria-hidden="true">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          <circle cx="12" cy="12" r="9"/>
        </svg>
      </div>
      <div class="ga-oath-body">
        <h4>
          <span>The Pharmacist's Oath</span>
          <span class="ga-oath-pill">PCI Code of Ethics</span>
        </h4>
        <p style="color: #F5F7F4; font-size: 1.05rem; line-height: 1.8; margin: 0;">
          &ldquo;<?= htmlspecialchars($nep_syllabus_data['pharmacist_oath']['text'] ?? 'I swear by the code of ethics of Pharmacy Council of India, in relation to the community and shall act as an integral part of health care team... I shall endeavour to discover and manufacture drugs of quality to alleviate sufferings of humanity.') ?>&rdquo; Every student at VEL Pharmacy College commits to upholding professional integrity, patient confidentiality, and lifelong healthcare service.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: INTERACTIVE PCI NEP 2020 CURRICULUM & SYLLABUS -->
<section class="curriculum-section" id="curriculum" aria-labelledby="curriculumHeading">
  <div class="container-wide">
    
    <!-- Hero Announcement Card -->
    <div class="nep-highlight-card fade-up">
      <div class="nep-badge-row">
        <span class="nep-badge-pill gold">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Official PCI Curriculum 2026
        </span>
        <span class="nep-badge-pill">NEP 2020 Aligned</span>
        <span class="nep-badge-pill">CBCS 193 Total Credits</span>
        <span class="nep-badge-pill">8 Semesters Full Course</span>
      </div>

      <h2 class="nep-highlight-title" id="curriculumHeading">
        Bachelor of Pharmacy (B.Pharm) Curriculum &amp; Syllabus
      </h2>
      <p class="nep-highlight-desc">
        Proposed and structured by the <strong>Pharmacy Council of India (PCI), New Delhi</strong> in accordance with the <strong>National Education Policy (NEP) 2020</strong>. This next-generation syllabus introduces cutting-edge disciplines — including <strong>Python Programming, Machine Learning, Clinical AI, and AR/VR Pharma 4.0</strong> — alongside deep foundational sciences, 240 hours of practical internships, and a 12-credit capstone research thesis.
      </p>

      <div style="margin-top: 1.25rem; display: flex; gap: 0.85rem; flex-wrap: wrap;">
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="background: rgba(255,255,255,0.15); color: #F5F7F4; border-color: rgba(255,255,255,0.4); font-size: 0.88rem; padding: 0.55rem 1.15rem; display: inline-flex; align-items: center; gap: 0.5rem;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          <span>View Official Syllabus PDF</span>
        </a>
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" download="B.Pharm_Syllabus_2026_NEP2020.pdf" class="btn" style="background: #D6B56D; color: #1E6A4D; font-weight: 700; font-size: 0.88rem; padding: 0.55rem 1.15rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Download Syllabus (PDF)</span>
        </a>
      </div>

      <!-- 4 Pillars Grid -->
      <div class="nep-pillars-grid">
        <div class="nep-pillar-item">
          <div class="nep-pillar-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div class="nep-pillar-title">Digital &amp; AI Integration</div>
          <div class="nep-pillar-meta">Python in Sem I, ML in Sem III, AI in Sem VI &amp; VII, plus Translational AI Ethics in Sem VIII.</div>
        </div>

        <div class="nep-pillar-item">
          <div class="nep-pillar-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
          </div>
          <div class="nep-pillar-title">193 Total Credits</div>
          <div class="nep-pillar-meta">Rigorous Choice Based Credit System (CBCS) across 8 semesters with continuous internal and university evaluation.</div>
        </div>

        <div class="nep-pillar-item">
          <div class="nep-pillar-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          </div>
          <div class="nep-pillar-title">240 Hours Internships</div>
          <div class="nep-pillar-meta">Mandatory practical training in Sem IV (120 hrs) and Sem VI (120 hrs) in GMP plants and teaching hospitals.</div>
        </div>

        <div class="nep-pillar-item">
          <div class="nep-pillar-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          </div>
          <div class="nep-pillar-title">12-Credit Capstone Project</div>
          <div class="nep-pillar-meta">Two-semester original research project &amp; dissertation defense (Sem VII &amp; VIII) supervised by doctorate faculty.</div>
        </div>
      </div>
    </div>

    <!-- 4-Year Academic Progression Matrix (Clean High-Level Roadmap) -->
    <div style="margin-top: 3.5rem;">
      <div class="text-center" style="max-width: 760px; margin: 0 auto 2.5rem;">
        <span class="section-subtitle">EXECUTIVE CURRICULUM ARCHITECTURE</span>
        <h3 class="section-title" style="font-size: 1.85rem;">4-Year B.Pharm Academic Progression</h3>
        <p class="section-description">
          A phased, high-impact curriculum moving from foundational sciences to advanced pharmacology, artificial intelligence, clinical hospital immersion, and capstone research dissertations:
        </p>
      </div>

      <div class="years-progression-grid fade-up">
        <div class="year-card">
          <span class="year-card-badge">YEAR 1 • FOUNDATIONS</span>
          <h4 class="year-card-title">Foundational Sciences &amp; Digital Health</h4>
          <p class="year-card-desc">
            Human Anatomy &amp; Physiology, Pharmaceutical Analysis I, Pharmaceutics I, Inorganic Chemistry, Communication Skills, and modern <strong>Python Programming for Health Sciences</strong>.
          </p>
          <div style="margin-top: 1rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
            Semesters I &amp; II • 54 Credits Total
          </div>
        </div>

        <div class="year-card">
          <span class="year-card-badge">YEAR 2 • FORMULATIONS</span>
          <h4 class="year-card-title">Organic Synthesis &amp; Pharmacology</h4>
          <p class="year-card-desc">
            Pharmaceutical Organic Chemistry II &amp; III, Physical Pharmaceutics, Microbiology, Pharmacology I, <strong>Machine Learning Fundamentals</strong>, and mandatory <strong>120-Hour Industrial GMP Internship</strong>.
          </p>
          <div style="margin-top: 1rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
            Semesters III &amp; IV • 52 Credits Total
          </div>
        </div>

        <div class="year-card">
          <span class="year-card-badge">YEAR 3 • CLINICAL AI</span>
          <h4 class="year-card-title">Medicinal Chemistry &amp; Hospital Rounds</h4>
          <p class="year-card-desc">
            Medicinal Chemistry II &amp; III, Pharmacology II &amp; III, Herbal Drug Tech, Biopharmaceutics, <strong>Clinical AI in Diagnostics</strong>, and <strong>120-Hour VMCH Teaching Hospital Internship</strong>.
          </p>
          <div style="margin-top: 1rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
            Semesters V &amp; VI • 54 Credits Total
          </div>
        </div>

        <div class="year-card">
          <span class="year-card-badge">YEAR 4 • RESEARCH</span>
          <h4 class="year-card-title">Instrumental Analysis &amp; Capstone Thesis</h4>
          <p class="year-card-desc">
            Instrumental Methods of Analysis (HPLC, UV-Vis), Novel Drug Delivery Systems, Pharmacy Practice, Biostatistics, and a <strong>12-Credit Original Research Capstone Thesis &amp; Defense</strong>.
          </p>
          <div style="margin-top: 1rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
            Semesters VII &amp; VIII • 43 Credits Total
          </div>
        </div>
      </div>
    </div>

    <!-- Executive Semester Summary Table -->
    <div class="fade-up" style="margin-top: 1rem;">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h4 style="font-family: var(--font-heading); font-size: 1.35rem; color: #1E6A4D; margin: 0 0 0.25rem;">
            Semester-by-Semester Course Outline
          </h4>
          <span style="font-size: 0.9rem; color: #4A5568;">
            Choice Based Credit System (CBCS) • 193 Total Prescribed Credits
          </span>
        </div>
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" download="B.Pharm_Syllabus_2026_NEP2020.pdf" class="btn btn-primary" style="padding: 0.55rem 1.15rem; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 0.5rem;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Download Detailed Syllabus (PDF)</span>
        </a>
      </div>

      <div class="curriculum-summary-table-wrap">
        <table class="curriculum-summary-table">
          <thead>
            <tr>
              <th style="width: 14%;">Semester</th>
              <th style="width: 16%;">Credits</th>
              <th style="width: 42%;">Core Course Modules</th>
              <th style="width: 28%;">Practical &amp; Specialized Focus</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Semester I</strong></td>
              <td><span class="badge-tag badge-tag-primary">27 Credits</span></td>
              <td>Human Anatomy &amp; Physiology I, Pharmaceutical Analysis I, Pharmaceutics I, Pharmaceutical Inorganic Chemistry</td>
              <td>Python for Healthcare, Remedial Biology / Mathematics</td>
            </tr>
            <tr>
              <td><strong>Semester II</strong></td>
              <td><span class="badge-tag badge-tag-primary">27 Credits</span></td>
              <td>Human Anatomy &amp; Physiology II, Pharmaceutical Organic Chemistry I, Biochemistry, Pathophysiology</td>
              <td>Computer Applications in Pharmacy, Environmental Sciences</td>
            </tr>
            <tr>
              <td><strong>Semester III</strong></td>
              <td><span class="badge-tag badge-tag-primary">24 Credits</span></td>
              <td>Pharmaceutical Organic Chemistry II, Physical Pharmaceutics I, Pharmaceutical Microbiology, Pharmaceutical Engineering</td>
              <td>Machine Learning in Pharmacy, AI Health Analytics</td>
            </tr>
            <tr>
              <td><strong>Semester IV</strong></td>
              <td><span class="badge-tag badge-tag-primary">28 Credits</span></td>
              <td>Pharmaceutical Organic Chemistry III, Medicinal Chemistry I, Physical Pharmaceutics II, Pharmacology I, Pharmacognosy I</td>
              <td><strong>Practice Internship I (120 Hours)</strong> in GMP Pharmaceutical Manufacturing</td>
            </tr>
            <tr>
              <td><strong>Semester V</strong></td>
              <td><span class="badge-tag badge-tag-primary">26 Credits</span></td>
              <td>Medicinal Chemistry II, Industrial Pharmacy I, Pharmacology II, Pharmacognosy II, Pharmaceutical Jurisprudence</td>
              <td>Regulatory Affairs &amp; IPR, Drug Formulation Technology</td>
            </tr>
            <tr>
              <td><strong>Semester VI</strong></td>
              <td><span class="badge-tag badge-tag-primary">28 Credits</span></td>
              <td>Medicinal Chemistry III, Pharmacology III, Herbal Drug Technology, Biopharmaceutics &amp; Pharmacokinetics, Pharmaceutical Biotechnology</td>
              <td>Clinical AI Diagnostics, <strong>Hospital Internship II (120 Hours)</strong> at VMCH Hospital</td>
            </tr>
            <tr>
              <td><strong>Semester VII</strong></td>
              <td><span class="badge-tag badge-tag-primary">22 Credits</span></td>
              <td>Instrumental Methods of Analysis (HPLC, UV-Vis), Industrial Pharmacy II, Pharmacy Practice, Novel Drug Delivery Systems</td>
              <td>Instrumental Analysis Practicals &amp; <strong>Capstone Research Project Phase I</strong></td>
            </tr>
            <tr>
              <td><strong>Semester VIII</strong></td>
              <td><span class="badge-tag badge-tag-primary">21 Credits</span></td>
              <td>Biostatistics &amp; Research Methodology, Social &amp; Preventive Pharmacy, Pharmaceutical Marketing / Pharmacovigilance Electives</td>
              <td><strong>12-Credit Capstone Project Dissertation Defense</strong> &amp; Viva Voce</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="margin-top: 1.5rem; background: #F5F7F4; border-left: 4px solid #1E6A4D; padding: 1rem 1.25rem; border-radius: 8px; font-size: 0.92rem; color: #2D3748; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
        <div>
          <strong>Need the complete day-by-day lesson plan and recommended textbooks?</strong>
          <div style="font-size: 0.86rem; color: #718096; margin-top: 0.2rem;">
            The official PCI 193-credit curriculum booklet contains individual subject units, reference bibliography, and internal exam rubrics.
          </div>
        </div>
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" download="B.Pharm_Syllabus_2026_NEP2020.pdf" class="btn btn-download-gold" style="padding: 0.6rem 1.25rem; font-size: 0.88rem;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Download Complete Syllabus PDF</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: PROGRAM OUTCOMES & CAREER OPPORTUNITIES -->
<section class="section" aria-labelledby="outcomesTitle">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle">Professional Versatility</span>
      <h2 class="section-title" id="outcomesTitle">Program Outcomes &amp; Career Opportunities</h2>
      <p class="section-description">
        Graduates of the NEP 2020 B.Pharm program possess multi-disciplinary competencies bridging traditional pharmaceutical sciences with cutting-edge AI, modern clinical therapeutics, and industrial manufacturing:
      </p>
    </div>

    <div class="course-pathways-grid">
      
      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: #F5F7F4; color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Hospital &amp; Clinical Pharmacist</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Serve as vital healthcare team members in bedside clinical pharmacy, therapeutic drug monitoring (TDM), and patient counseling at NABH accredited hospitals.
          </p>
        </div>
      </div>

      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: var(--color-secondary-subtle); color: var(--color-secondary-dark); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Government Drug Inspector &amp; Regulatory Officer</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Eligible for State and UPSC examinations to serve as Drug Inspectors, CDSCO regulatory officers, and government analytical chemists.
          </p>
        </div>
      </div>

      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: var(--color-tertiary); color: var(--color-primary-dark); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.31L6.71 14.1A6 6 0 0 0 11.5 22h1a6 6 0 0 0 4.79-7.9L14 9.31V2"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Pharma R&amp;D Formulation &amp; AI Scientist</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Innovate novel synthetic &amp; herbal formulations, nanomedicines, and apply predictive machine learning models in drug discovery pipelines.
          </p>
        </div>
      </div>

      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: #F5F7F4; color: #1E6A4D; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Quality Control &amp; Analytical Chemist</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Operate HPLC, GC-MS, FTIR, and analytical instrumentation in USFDA/WHO-GMP compliant manufacturing facilities.
          </p>
        </div>
      </div>

      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: #F5F7F4; color: #1E6A4D; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Pharmacovigilance &amp; Clinical Data Specialist</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Manage drug safety data, adverse event reporting (PvPI, WHO Vigiflow), and epidemiological data analytics for pharmaceutical corporations.
          </p>
        </div>
      </div>

      <div style="background: #F5F7F4; border: 1px solid var(--color-tertiary-light); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-sm); display: flex; gap: 1.25rem;">
        <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: #F5F7F4; color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M16 12l-4-4-4 4M12 8v8"/></svg>
        </div>
        <div>
          <h4 style="font-size: 1.15rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">Pharma Startup Founder &amp; Supply Chain Leader</h4>
          <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6;">
            Leverage knowledge from the Startup Ecosystem &amp; Supply Chain Management modules to establish licensed pharmaceutical businesses, e-pharmacy platforms, and export ventures.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SECTION 6: ADMISSIONS PROCESS CTA -->
<section class="section" style="padding-top: 1.5rem; padding-bottom: 5.5rem; background: #FFFFFF;" aria-label="Admissions Banner">
  <div class="container">
    <div class="cta-collage-banner fade-up" id="admissionsCta" style="border-radius: 24px; border: 2px solid #D6B56D; box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.2); overflow: hidden; position: relative; padding: 4.5rem 1.5rem;">
      <!-- Slowly Auto-Moving College Photo Collage (Light Dim Mode) -->
      <div class="cta-bg-collage" aria-hidden="true">
        <!-- Row 1: Leftward Pan -->
        <div class="cta-collage-track cta-track-1">
          <div class="cta-collage-strip">
            <div class="cta-collage-item"><img src="assets/images/campus-main-entrance.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/pharmacy-lab-main.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/hospital-facility.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/research-lab-modern.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-compact"><img src="assets/images/computer-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/library-main.jpg" alt="" loading="lazy"></div>
          </div>
          <div class="cta-collage-strip" aria-hidden="true">
            <div class="cta-collage-item"><img src="assets/images/campus-main-entrance.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/pharmacy-lab-main.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/hospital-facility.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/research-lab-modern.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-compact"><img src="assets/images/computer-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/library-main.jpg" alt="" loading="lazy"></div>
          </div>
        </div>

        <!-- Row 2: Rightward Pan -->
        <div class="cta-collage-track cta-track-2">
          <div class="cta-collage-strip">
            <div class="cta-collage-item item-wide"><img src="assets/images/lecture-hall.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/analysis-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-compact"><img src="assets/images/machine-room.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/instrumentation-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/pharmacognosy-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/seminar-hall.jpg" alt="" loading="lazy"></div>
          </div>
          <div class="cta-collage-strip" aria-hidden="true">
            <div class="cta-collage-item item-wide"><img src="assets/images/lecture-hall.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/analysis-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-compact"><img src="assets/images/machine-room.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item item-wide"><img src="assets/images/instrumentation-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/pharmacognosy-lab.jpg" alt="" loading="lazy"></div>
            <div class="cta-collage-item"><img src="assets/images/seminar-hall.jpg" alt="" loading="lazy"></div>
          </div>
        </div>
      </div>

      <div class="cta-collage-overlay" aria-hidden="true"></div>

      <?php
      $c_cta = $courses_cms['cta_banner'] ?? [];
      ?>
      <div class="text-center" style="position: relative; z-index: 2; max-width: 800px; margin: 0 auto;">
        <span style="display: inline-block; background: rgba(255,255,255,0.15); color: #F5F7F4; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; padding: 0.35rem 1rem; border-radius: var(--radius-full); margin-bottom: 1.25rem; backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2);">
          <?= htmlspecialchars($c_cta['badge'] ?? 'Admissions Open • B.Pharm 2027–2028') ?>
        </span>
        <h2 style="font-family: var(--font-heading); font-size: 2.25rem; color: #F5F7F4; margin-bottom: 1rem; text-shadow: 0 2px 10px rgba(0,0,0,0.35);">
          <?= htmlspecialchars($c_cta['title'] ?? 'Join VEL Pharmacy College Under the Modern NEP 2020 Framework') ?>
        </h2>
        <p style="font-size: 1.1rem; color: #F5F7F4; line-height: 1.7; margin-bottom: 2rem; text-shadow: 0 1px 4px rgba(0,0,0,0.25);">
          <?= htmlspecialchars($c_cta['subtitle'] ?? 'Merit-based admissions for +2 passed students (PCM/PCB) and lateral entry for D.Pharm holders. Connect with our admissions desk to secure your academic future today.') ?>
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
          <a href="<?= htmlspecialchars($c_cta['btn1_link'] ?? 'enquiry') ?>" class="btn" style="background: #D6B56D; color: #1E6A4D; font-weight: 700; box-shadow: 0 4px 14px rgba(217,119,6,0.35);">
            <span><?= htmlspecialchars($c_cta['btn1_text'] ?? 'Apply Online 2027-28') ?></span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </a>
          <a href="<?= htmlspecialchars($c_cta['btn2_link'] ?? 'tel:+918122613300') ?>" class="btn" style="background: rgba(255,255,255,0.15); color: #F5F7F4; border: 1px solid rgba(255,255,255,0.3); backdrop-filter: blur(8px);">
            <span><?= htmlspecialchars($c_cta['btn2_text'] ?? 'Call: +91 812 261 3300') ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Syllabus Interactive Script & JSON Dataset -->
<script>
// Course details dictionary passed safely from PHP
const courseDetailsData = <?= json_encode($nep_syllabus_data['course_details'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

document.addEventListener('DOMContentLoaded', function() {
  const tabButtons = document.querySelectorAll('.sem-tab-btn');
  const panels = document.querySelectorAll('.sem-panel-block');
  const searchInput = document.getElementById('courseSearchInput');
  const filterChips = document.querySelectorAll('.filter-chip');
  const modalOverlay = document.getElementById('syllabusModal');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const modalCourseCode = document.getElementById('modalCourseCode');
  const modalSubjectTitle = document.getElementById('modalSubjectTitle');
  const modalCredits = document.getElementById('modalCredits');
  const modalHours = document.getElementById('modalHours');
  const modalMarks = document.getElementById('modalMarks');
  const modalBody = document.getElementById('modalBody');

  // Tab Switching
  tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const target = this.getAttribute('data-target');
      
      tabButtons.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      this.classList.add('active');
      this.setAttribute('aria-selected', 'true');

      panels.forEach(p => {
        p.style.display = 'none';
      });

      const activePanel = document.getElementById('panel-' + target);
      if (activePanel) {
        activePanel.style.display = 'block';
      }

      // Re-apply filter and search if active
      applyFilterAndSearch();
    });
  });

  // Filter Chips
  filterChips.forEach(chip => {
    chip.addEventListener('click', function() {
      filterChips.forEach(c => c.classList.remove('active'));
      this.classList.add('active');
      applyFilterAndSearch();
    });
  });

  // Live Search
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      applyFilterAndSearch();
    });
  }

  function applyFilterAndSearch() {
    const term = (searchInput ? searchInput.value.toLowerCase().trim() : '');
    const activeChip = document.querySelector('.filter-chip.active');
    const filterVal = activeChip ? activeChip.getAttribute('data-filter') : 'all';

    const rows = document.querySelectorAll('.course-row');
    rows.forEach(row => {
      const code = (row.getAttribute('data-code') || '').toLowerCase();
      const title = (row.getAttribute('data-title') || '').toLowerCase();
      const type = row.getAttribute('data-type') || '';
      const category = row.getAttribute('data-category') || '';

      const matchesSearch = !term || code.includes(term) || title.includes(term);
      
      let matchesFilter = true;
      if (filterVal === 'Theory') {
        matchesFilter = (type === 'Theory');
      } else if (filterVal === 'Practical') {
        matchesFilter = (type === 'Practical');
      } else if (filterVal === 'AI') {
        matchesFilter = category.includes('AI') || title.includes('python') || title.includes('machine learning');
      } else if (filterVal === 'Elective') {
        matchesFilter = category.includes('Elective');
      }

      if (matchesSearch && matchesFilter) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  // Open Modal on click of detail buttons
  document.querySelectorAll('.btn-view-detail').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const code = this.getAttribute('data-course-code');
      const details = courseDetailsData[code];
      if (details) {
        populateModal(details);
        openModal();
      }
    });
  });

  function populateModal(data) {
    modalCourseCode.textContent = data.code;
    modalSubjectTitle.textContent = data.title;
    modalCredits.textContent = data.credit + ' Credits';
    modalHours.textContent = data.hours || '30-45 Hours';
    modalMarks.textContent = data.marks || 'Total: 50/75/100';

    let html = '';

    // Course Objectives
    if (data.objectives && data.objectives.length > 0) {
      html += `<div class="modal-section-block">
        <h4 class="modal-section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Course Objectives
        </h4>
        <ul class="modal-obj-list">`;
      data.objectives.forEach(obj => {
        html += `<li>${escapeHtml(obj)}</li>`;
      });
      html += `</ul></div>`;
    }

    // Course Outcomes (COs)
    if (data.outcomes && data.outcomes.length > 0) {
      html += `<div class="modal-section-block">
        <h4 class="modal-section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          Course Outcomes (COs)
        </h4>
        <ul class="modal-co-list">`;
      data.outcomes.forEach(co => {
        html += `<li>${escapeHtml(co)}</li>`;
      });
      html += `</ul></div>`;
    }

    // Units
    if (data.units && data.units.length > 0) {
      html += `<div class="modal-section-block">
        <h4 class="modal-section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          Detailed Unit Syllabus
        </h4>`;
      data.units.forEach(unit => {
        html += `<div class="unit-accordion-item">
          <div class="unit-header">
            <span>${escapeHtml(unit.title)}</span>
            <span class="unit-hours">${escapeHtml(unit.hours)}</span>
          </div>
          <div class="unit-content">${escapeHtml(unit.content)}</div>
        </div>`;
      });
      html += `</div>`;
    }

    // References
    if (data.references && data.references.length > 0) {
      html += `<div class="modal-section-block">
        <h4 class="modal-section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          Recommended References &amp; Textbooks
        </h4>
        <ul class="books-list">`;
      data.references.forEach(book => {
        html += `<li>${escapeHtml(book)}</li>`;
      });
      html += `</ul></div>`;
    }

    // Official Gazette Syllabus Document Card
    html += `<div class="modal-section-block" style="background: #F5F7F4; border: 1px solid #D6B56D; border-radius: 10px; padding: 1.15rem 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
      <div style="display: flex; align-items: center; gap: 0.85rem;">
        <div style="width: 42px; height: 42px; border-radius: 8px; background: #F5F7F4; color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        </div>
        <div>
          <div style="font-weight: 700; color: var(--color-primary-dark); font-size: 0.95rem;">Official PCI NEP 2020 Complete Syllabus (PDF)</div>
          <div style="font-size: 0.82rem; color: var(--color-text-muted);">Includes detailed unit breakdowns, teaching hours, exam schemes &amp; practicum.</div>
        </div>
      </div>
      <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="padding: 0.4rem 0.85rem; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 0.35rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          <span>View PDF</span>
        </a>
        <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" download="B.Pharm_Syllabus_2026_NEP2020.pdf" class="btn btn-primary" style="padding: 0.4rem 0.85rem; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 0.35rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Download PDF</span>
        </a>
      </div>
    </div>`;

    modalBody.innerHTML = html;
  }

  function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function openModal() {
    modalOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modalOverlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closeModal);
  }

  if (modalOverlay) {
    modalOverlay.addEventListener('click', function(e) {
      if (e.target === modalOverlay) {
        closeModal();
      }
    });
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalOverlay.classList.contains('open')) {
      closeModal();
    }
  });

  // PCI Graduate Attributes Category Filtering
  const gaFilterBtns = document.querySelectorAll('.ga-filter-btn');
  const gaCards = document.querySelectorAll('.ga-card');
  if (gaFilterBtns.length > 0 && gaCards.length > 0) {
    gaFilterBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const filter = this.getAttribute('data-ga-filter');
        gaFilterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        gaCards.forEach(card => {
          if (filter === 'all' || card.getAttribute('data-ga-group') === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
