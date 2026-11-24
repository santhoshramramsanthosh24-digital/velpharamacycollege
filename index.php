<?php
$current_page = 'home';
$page_title = "VEL Pharmacy College | B.Pharm Admissions 2027-2028 | Research Laboratories & Hospital Immersion";
$page_description = "VEL Pharmacy College (VISTAS Deemed University), VMCH Campus, Tiruvallur. PCI Approved 4-Year B.Pharm with hands-on HPLC, UV-Vis, molecular docking, formulation pilot plant, and on-campus 300-bed hospital clinical training.";
$canonical_url = "https://velpharmacycollege.com/";

// Custom Schema for FAQPage and Course
$custom_schema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "Course",
      "name" => "Bachelor of Pharmacy (B.Pharm)",
      "description" => "A comprehensive 4-year undergraduate degree in pharmaceutical sciences approved by the Pharmacy Council of India (PCI) and affiliated to VISTAS Deemed to be University. Features HPLC, UV-Vis instrumentation, computational drug discovery, and 300-bed hospital clinical immersion.",
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
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => [
        [
          "@type" => "Question",
          "name" => "Why is VEL Pharmacy College better than other pharmacy colleges in Chennai and Tiruvallur?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "VEL Pharmacy College offers direct clinical training in an on-campus 300-bed teaching hospital (VMCH), advanced analytical instrumentation including HPLC and UV-Visible spectroscopy accessible to undergraduates, in-silico computational drug discovery with molecular docking, and 45+ Scopus-indexed faculty research publications under VISTAS Deemed University."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "What research laboratories and analytical instruments are available at VEL Pharmacy College?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "The college houses high-precision High-Performance Liquid Chromatography (HPLC), double-beam UV-Visible spectrophotometers, a cGMP pilot machine room with rotary tablet compression and USP dissolution apparatus, pharmacology computer simulation suites, Soxhlet botanical extraction units, and an in-silico CADD laboratory with AutoDock and PyMOL."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "What courses are offered at VEL Pharmacy College?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "VEL Pharmacy College offers the 4-year Bachelor of Pharmacy (B.Pharm) undergraduate degree program across 8 semesters. The program is recognized and approved by the Pharmacy Council of India (PCI), New Delhi, and is affiliated to Vels Institute of Science, Technology & Advanced Studies (VISTAS)."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "What is the admission eligibility for B.Pharm at VEL Pharmacy College?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "As per Pharmacy Council of India (PCI) norms, candidates must have passed higher secondary (+2) examination with Physics, Chemistry, and Mathematics or Biology/Botany and Zoology. Admission is strictly merit-based on the percentage of marks secured in the qualifying examination."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "Where is VEL Pharmacy College located?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "VEL Pharmacy College is located in the VMCH Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Uthukottai Taluk, Tiruvallur District – 601102, Tamil Nadu, India. The institution features a tranquil, pollution-free, green educational environment."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "Is VEL Pharmacy College approved by the Pharmacy Council of India (PCI)?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "Yes, VEL Pharmacy College is recognized and approved by the Pharmacy Council of India (PCI), New Delhi. It is an off-campus center of VISTAS (Vels Institute of Science, Technology & Advanced Studies, Deemed to be University estd. u/s 3 of UGC Act, 1956)."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "What facilities are available for students at VEL Pharmacy College?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "The campus features spacious lecture halls with LCD projectors, advanced pharmaceutical laboratories, an air-conditioned 50-seater computer lab, a library with 1,500+ books and e-journals, on-campus Vels Medical College Hospital (VMCH) training, separate hostels for boys and girls, and transport services across the city."
          ]
        ]
      ]
    ]
  ]
];

// Dynamic CMS Hook: Load website content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = [];
if (file_exists($cms_content_file)) {
  $cms_content = json_decode(file_get_contents($cms_content_file), true) ?: [];
}
$home_cms = $cms_content['home'] ?? ($cms_content['home_hero'] ?? []);
$hero_cfg = $home_cms;
$gen_settings = $cms_content['general_settings'] ?? [];
$contact_cfg = $cms_content['general_contact'] ?? [];

include __DIR__ . '/includes/header.php';

// Variables with comprehensive fallbacks
$announcement = $home_cms['announcement_text'] ?? ($contact_cfg['admission_status'] ?? 'Admission Open for 2027–2028 Batch: 4-Year B.Pharm Degree Program (PCI Approved)');
$phone_primary = $contact_cfg['phone_primary'] ?? '+91 812 261 3300';
$email_primary = $contact_cfg['email_primary'] ?? 'principalvpc@vistas.ac.in';
$phone_clean = preg_replace('/[^0-9+]/', '', $phone_primary);

$floating_enq_txt = $gen_settings['floating_enquiry_text'] ?? 'Admission Enquiry';
$floating_enq_lnk = $gen_settings['floating_enquiry_link'] ?? 'enquiry';
$floating_not_txt = $gen_settings['floating_notice_text'] ?? 'Announcements';
$floating_not_lnk = $gen_settings['floating_notice_link'] ?? '#announcements';

$hero_badge = $home_cms['pill_badge'] ?? 'ADMISSIONS OPEN 2027–2028 | PCI Approved | VISTAS University';
$hero_t1 = $home_cms['title_main'] ?? 'Excellence in';
$hero_t2 = $home_cms['title_highlight'] ?? 'Pharmaceutical Sciences';
$hero_desc = $home_cms['description'] ?? '4-Year Bachelor of Pharmacy (B.Pharm) Degree Program at VMCH Medical Campus, Tiruvallur. World-class research laboratories with hands-on hospital clinical training.';
$hero_cta1_txt = $home_cms['cta_primary_text'] ?? 'Apply for Admissions 2027–2028';
$hero_cta1_lnk = $home_cms['cta_primary_link'] ?? 'enquiry';
$hero_cta2_txt = $home_cms['cta_secondary_text'] ?? 'Explore Curriculum';
$hero_cta2_lnk = $home_cms['cta_secondary_link'] ?? 'courses';
$hero_helpline_lbl = $home_cms['helpline_label'] ?? 'Admissions Helpline';
$hero_helpline_num = $home_cms['helpline_number'] ?? $phone_primary;
$hero_img = $home_cms['hero_image'] ?? ($home_cms['hero_video_poster'] ?? 'assets/images/campus-front.jpg');
$hero_video = !empty($home_cms['video_mp4']) ? $home_cms['video_mp4'] : (!empty($home_cms['hero_video']) ? $home_cms['hero_video'] : 'assets/videos/vmch-campus-hero.mp4');

$pillars_header = $home_cms['pillars_header'] ?? [
  'eyebrow' => 'Institutional Excellence & Trust',
  'title' => 'Pillars of Pharmaceutical Eminence',
  'subtitle' => 'Four defining cornerstones establishing VEL Pharmacy College as Tamil Nadu\'s benchmark destination for modern pharmacy education, clinical hospital mastery, and world-class scientific research.'
];
$pillars = $home_cms['pillars'] ?? [];

$welcome = $home_cms['welcome'] ?? [];
$events_highlights = $home_cms['events_highlights'] ?? [];
$course_spotlight = $home_cms['course_spotlight'] ?? [];
$facilities_sec = $home_cms['facilities_section'] ?? [];
$why_choose = $home_cms['why_choose'] ?? [];
$placements = $home_cms['placements'] ?? [];
$faqs = $home_cms['faqs'] ?? [];
$cta_banner = $home_cms['cta_banner'] ?? [];
?>


<!-- ==========================================================================
     CINEMATIC COLLEGE VIDEO HERO (SIMPLE, HIGH-IMPACT, VIDEO-FIRST)
     ========================================================================== -->
<section class="cinema-hero" id="heroSection" aria-label="VEL Pharmacy College Admissions 2027–2028">
  <!-- Cinematic Full-Bleed College Video Background -->
  <div class="cinema-hero-media">
    <video class="cinema-video" id="collegeVideoPlayer" autoplay muted loop playsinline preload="metadata"
      poster="<?= htmlspecialchars($hero_img) ?>">
      <source src="<?= htmlspecialchars($hero_video) ?>" type="video/mp4">
      <source src="assets/videos/pharmacy-lab-loop.webm" type="video/webm">
    </video>
    <div class="cinema-overlay"></div>
    <div class="cinema-ambient-glow" aria-hidden="true"></div>
  </div>

  <!-- Interactive Circular Video Focus Zone on Right Side (Action directly within circle space) -->
  <div class="cinema-round-focus-zone" id="cinemaRightZone" role="button" tabindex="0"
    aria-label="Enter video full view mode" title="Hover within circle for full view">
    <div class="focus-circle-content">
      <div class="focus-ring-pulse" aria-hidden="true"></div>
      <div class="focus-lens-circle" aria-label="VEL Pharmacy College Emblem">
        <img src="assets/images/VPC NEW LOGO.jpeg" alt="VEL Pharmacy College Logo" class="focus-college-logo"
          width="44" height="44">
      </div>
      <!--<div class="focus-label-wrap">
        <span class="focus-state-pill">
          <span class="focus-state-dot" aria-hidden="true"></span>
          <span class="focus-text-default">Move Cursor Here</span>
          <span class="focus-text-active">Full View Mode</span>
        </span>
        <span class="focus-subtext-default">Focus Campus Video</span>
        <span class="focus-subtext-active">Move Out to Restore</span>
      </div>-->
    </div>
  </div>

  <div class="cinema-hero-container">
    <div class="cinema-hero-wrap">

      <!-- Left Corner Content -->
      <div class="cinema-hero-content fade-up" id="cinemaHeroContent">
        <!-- Minimal Accreditation Pill -->
        <div class="cinema-pill">
          <span class="cinema-pill-dot" aria-hidden="true"></span>
          <span class="cinema-pill-bold"><?= htmlspecialchars($hero_badge) ?></span>
        </div>

        <!-- Clean, Powerful Headline in Left Corner -->
        <h1 class="cinema-title">
          <?= htmlspecialchars($hero_t1) ?> <br>
          <span class="cinema-title-accent"><?= htmlspecialchars($hero_t2) ?></span>
        </h1>

        <!-- One Simple Impactful Sentence -->
        <p class="cinema-lead">
          <?= htmlspecialchars($hero_desc) ?>
        </p>

        <!-- Clean Actions -->
        <div class="cinema-actions">
          <a href="<?= htmlspecialchars($hero_cta1_lnk) ?>" class="btn cinema-btn-primary">
            <span><?= htmlspecialchars($hero_cta1_txt) ?></span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </a>
          <a href="<?= htmlspecialchars($hero_cta2_lnk) ?>" class="btn cinema-btn-outline">
            <span><?= htmlspecialchars($hero_cta2_txt) ?></span>
          </a>
          <a href="tel:<?= preg_replace('/[^0-9+]/', '', $hero_helpline_num) ?>" class="cinema-helpline-pill"
            aria-label="<?= htmlspecialchars($hero_helpline_lbl) ?>: <?= htmlspecialchars($hero_helpline_num) ?>">
            <div class="helpline-icon-pulse">
              <svg viewBox="0 0 24 24">
                <path
                  d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
              </svg>
            </div>
            <div>
              <span class="helpline-sub"><?= htmlspecialchars($hero_helpline_lbl) ?></span>
              <span class="helpline-num"><?= htmlspecialchars($hero_helpline_num) ?></span>
            </div>
          </a>
        </div>

      </div>

      <!-- Video Controls Button (Bottom Right) -->
      <div class="cinema-video-controls">
        <button type="button" class="cinema-video-toggle" id="cinemaVideoToggle" aria-label="Pause background video">
          <svg class="icon-pause" viewBox="0 0 24 24">
            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
          </svg>
          <svg class="icon-play" viewBox="0 0 24 24" style="display:none;">
            <path d="M8 5v14l11-7z" />
          </svg>
          <span class="video-label">Campus Video</span>
        </button>
      </div>

    </div>
  </div>
</section>

<!-- ==========================================================================
     INSTITUTIONAL PILLARS OF EXCELLENCE - ANIMATED IMAGE CARDS SHOWCASE
     ========================================================================== -->
<section class="pillars-showcase-section" id="institutionalPillars" aria-labelledby="pillarsSectionTitle">
  <div class="container">
    <div class="pillars-header fade-up">
      <div class="pillars-eyebrow">
        <span class="pillars-pulse-glow" aria-hidden="true"></span>
        <span><?= htmlspecialchars($pillars_header['eyebrow'] ?? 'Institutional Excellence & Trust') ?></span>
      </div>
      <h2 class="pillars-main-title" id="pillarsSectionTitle">
        <?= htmlspecialchars($pillars_header['title'] ?? 'Pillars of Pharmaceutical Eminence') ?>
      </h2>
      <p class="pillars-subtitle">
        <?= htmlspecialchars($pillars_header['subtitle'] ?? 'Four defining cornerstones establishing VEL Pharmacy College as Tamil Nadu\'s benchmark destination for modern pharmacy education, clinical hospital mastery, and world-class scientific research.') ?>
      </p>
    </div>

    <div class="pillars-cards-grid">
      <?php if (!empty($pillars)): ?>
        <?php foreach ($pillars as $idx => $p): ?>
          <article class="pillar-card fade-up">
            <div class="pillar-card-media">
              <img src="<?= htmlspecialchars($p['image'] ?? 'assets/images/0001-768x403.jpg') ?>"
                alt="<?= htmlspecialchars($p['title'] ?? '') ?>" class="pillar-card-img" loading="lazy">
              <div class="pillar-media-gradient" aria-hidden="true"></div>
              <span class="pillar-category-tag"><?= htmlspecialchars($p['tag'] ?? 'Excellence') ?></span>
              <div class="pillar-stat-chip">
                <span class="chip-num"><?= htmlspecialchars($p['stat_num'] ?? '') ?></span>
                <span class="chip-txt"><?= htmlspecialchars($p['stat_txt'] ?? '') ?></span>
              </div>
            </div>
            <div class="pillar-card-body">
              <h3 class="pillar-card-title"><?= htmlspecialchars($p['title'] ?? '') ?></h3>
              <p class="pillar-card-desc">
                <?= htmlspecialchars($p['desc'] ?? '') ?>
              </p>
              <div class="pillar-highlights-list">
                <?php if (!empty($p['bullet_1'])): ?>
                  <div class="pillar-highlight-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span><?= htmlspecialchars($p['bullet_1']) ?></span>
                  </div>
                <?php endif; ?>
                <?php if (!empty($p['bullet_2'])): ?>
                  <div class="pillar-highlight-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span><?= htmlspecialchars($p['bullet_2']) ?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 3: UPCOMING EVENTS & INSTITUTIONAL HIGHLIGHTS (DUAL-COLUMN)
     ========================================================================== -->
<?php
// Base Events Dataset
$raw_events = $events_highlights['events'] ?? [
  [
    'date' => '2026-11-18',
    'month' => 'NOV',
    'day' => '18',
    'year' => '2026',
    'category' => 'National Symposium',
    'category_color' => 'blue',
    'title' => 'National Seminar on AI & Machine Learning in Modern Drug Discovery',
    'time' => '09:30 AM – 03:30 PM',
    'venue' => 'Dr. Ishari K. Ganesh Seminar Hall',
    'description' => 'Expert talks by pharmaceutical data scientists on generative AI, molecular docking simulations, and QSAR algorithms.',
    'link' => 'enquiry'
  ],
  [
    'date' => '2026-11-28',
    'month' => 'NOV',
    'day' => '28',
    'year' => '2026',
    'category' => 'PCI Workshop',
    'category_color' => 'amber',
    'title' => 'PCI Sponsored Quality Improvement Program on Good Laboratory Practices (GLP)',
    'time' => '10:00 AM – 04:30 PM',
    'venue' => 'Advanced Formulation Pilot Plant',
    'description' => 'Comprehensive regulatory documentation, cleanroom protocol compliance, and analytical instrument validation.',
    'link' => 'facilities'
  ],
  [
    'date' => '2026-12-05',
    'month' => 'DEC',
    'day' => '05',
    'year' => '2026',
    'category' => 'Hands-On Workshop',
    'category_color' => 'maroon',
    'title' => 'Advanced Instrumentation Workshop: High-Performance Liquid Chromatography (HPLC)',
    'time' => '10:00 AM – 04:00 PM',
    'venue' => 'Central Instrumentation & Analysis Lab',
    'description' => 'Practical training for students on method validation, peak integration, and quantitative chromatographic assays.',
    'link' => 'enquiry'
  ],
  [
    'date' => '2026-12-18',
    'month' => 'DEC',
    'day' => '18',
    'year' => '2026',
    'category' => 'Clinical Rounds',
    'category_color' => 'green',
    'title' => 'Hospital Pharmacy Practice & Inpatient Bedside Rounds at VMCH',
    'time' => '09:00 AM – 01:00 PM',
    'venue' => 'VMCH Teaching Hospital, Manjankaranai',
    'description' => 'Ward rounds, patient history interviews, and therapeutic drug monitoring protocols guided by senior clinical preceptors.',
    'link' => 'facilities'
  ],
  [
    'date' => '2027-01-12',
    'month' => 'JAN',
    'day' => '12',
    'year' => '2027',
    'category' => 'Clinical Rounds',
    'category_color' => 'green',
    'title' => 'Clinical Pharmacovigilance & Adverse Drug Reaction Reporting Symposium',
    'time' => '09:00 AM – 01:00 PM',
    'venue' => 'VMCH Seminar Room & Wards',
    'description' => 'Clinical pharmacy faculty-led patient chart reviews, therapeutic drug monitoring, and inpatient ward protocols.',
    'link' => 'facilities'
  ],
  [
    'date' => '2027-02-20',
    'month' => 'FEB',
    'day' => '20',
    'year' => '2027',
    'category' => 'Community Outreach',
    'category_color' => 'amber',
    'title' => 'National Pharmacy Week: Rural Health Screening & Pharmacovigilance Camp',
    'time' => '08:30 AM – 02:00 PM',
    'venue' => 'Velan Nagar Community Health Center',
    'description' => 'Public health awareness on rational antibiotic usage, geriatric dosage regimens, and vital health screenings.',
    'link' => 'contact-us'
  ],
  [
    'date' => '2026-09-25',
    'month' => 'SEP',
    'day' => '25',
    'year' => '2026',
    'category' => 'Celebration & Induction',
    'category_color' => 'green',
    'title' => 'World Pharmacists Day 2026 & White Coat Ceremony for Freshers Batch',
    'time' => '10:00 AM – 02:00 PM',
    'venue' => 'Dr. Ishari K. Ganesh Auditorium',
    'description' => 'Induction of new B.Pharm students with the Pharmacist Oath, guest lectures by eminent healthcare leaders, and academic awards.',
    'link' => 'about-us'
  ],
  [
    'date' => '2026-10-15',
    'month' => 'OCT',
    'day' => '15',
    'year' => '2026',
    'category' => 'Guest Masterclass',
    'category_color' => 'blue',
    'title' => 'Industry Masterclass: Modern Computer-Aided Drug Design (CADD) & Molecular Docking',
    'time' => '11:00 AM – 03:00 PM',
    'venue' => 'Advanced Digital Chemistry Lab',
    'description' => 'Hands-on computational chemistry workshop on PyMOL, AutoDock Vina, and pharmacophore modeling for novel drug synthesis.',
    'link' => 'courses'
  ]
];

// Today's date comparison (YYYY-MM-DD)
$today_ymd = date('Y-m-d');
$active_upcoming_events = [];
$past_events_to_highlights = [];

foreach ($raw_events as &$ev) {
  $ev_date = $ev['date'] ?? '';
  if (!empty($ev_date)) {
    $ts = strtotime($ev_date);
    if ($ts) {
      if (empty($ev['month']))
        $ev['month'] = strtoupper(date('M', $ts));
      if (empty($ev['day']))
        $ev['day'] = date('d', $ts);
      if (empty($ev['year']))
        $ev['year'] = date('Y', $ts);
    }
  } elseif (!empty($ev['year']) && !empty($ev['month']) && !empty($ev['day'])) {
    $parsed_ts = strtotime($ev['day'] . ' ' . $ev['month'] . ' ' . $ev['year']);
    if ($parsed_ts) {
      $ev_date = date('Y-m-d', $parsed_ts);
    }
  }

  // Automatic date check: if event date is over -> move to Highlights!
  if (!empty($ev_date) && $ev_date < $today_ymd) {
    $past_events_to_highlights[] = [
      'icon' => 'calendar-check',
      'tag' => 'Concluded Event Highlight',
      'badge' => 'Concluded • ' . date('M j, Y', strtotime($ev_date)),
      'title' => $ev['title'] ?? '',
      'desc' => !empty($ev['description'])
        ? $ev['description']
        : ('Successfully conducted at ' . ($ev['venue'] ?? 'VEL Pharmacy College') . ' with high student engagement and research discussions.'),
      'link' => $ev['link'] ?? 'about-us',
      'is_transferred_event' => true
    ];
  } else {
    $active_upcoming_events[] = $ev;
  }
}
unset($ev);

// Base Highlights
$base_highlights = $events_highlights['highlights'] ?? [
  [
    'image' => 'assets/images/campus-main-entrance.jpg',
    'tag' => 'Accreditation',
    'badge' => 'PCI Approved',
    'title' => 'Pharmacy Council of India (PCI) Statutory Approval',
    'desc' => 'Fully recognized and approved by PCI, New Delhi under VISTAS Deemed to be University, upholding premier educational benchmarks.',
    'link' => 'about-us'
  ],
  [
    'image' => 'assets/images/computer-lab.jpg',
    'tag' => 'Curriculum',
    'badge' => '193 Credits • NEP 2020',
    'title' => 'Pioneering NEP 2020 Syllabus with Python & AI',
    'desc' => 'Tamil Nadu\'s first 4-year B.Pharm integrating Python Programming, Machine Learning, Clinical AI, and 240 hours internships.',
    'link' => 'courses'
  ],
  [
    'image' => 'assets/images/hospital-facility.jpg',
    'tag' => 'Clinical Immersion',
    'badge' => '300+ Bed Hospital',
    'title' => 'On-Campus VMCH Medical College & Hospital',
    'desc' => 'Unrivaled real-world hospital exposure with bedside patient rotations, ADR reporting, and drug interaction analysis.',
    'link' => 'facilities'
  ],
  [
    'image' => 'assets/images/research-lab-modern.jpg',
    'tag' => 'Research Labs',
    'badge' => '15+ High-Tech Labs',
    'title' => 'State-of-the-Art Analytical & Formulation Suites',
    'desc' => 'Equipped with HPLC, UV-Vis Spectrophotometers, Pilot Formulation Plant, Machine Room, and Digital Molecular Modeling Lab.',
    'link' => 'facilities'
  ]
];

// Concluded events automatically added to Highlights list
$all_highlights = array_merge($base_highlights, $past_events_to_highlights);
?>

<section class="section section-alt events-highlights-section" id="events-highlights"
  aria-labelledby="eventsHighlightsTitle">
  <span id="announcements" class="anchor-target" aria-hidden="true" style="position: absolute; top: -80px;"></span>
  <span id="highlights-anchor" class="anchor-target" aria-hidden="true" style="position: absolute; top: -80px;"></span>
  <div class="container-wide">
    <div class="section-header fade-up">
      <span
        class="section-subtitle"><?= htmlspecialchars($events_highlights['subtitle'] ?? 'Campus Life & Key Milestones') ?></span>
      <h2 class="section-title" id="eventsHighlightsTitle">
        <?= htmlspecialchars($events_highlights['title'] ?? 'Upcoming Events & Institutional Highlights') ?>
      </h2>
      <p class="section-description">
        <?= htmlspecialchars($events_highlights['description'] ?? 'Stay connected with upcoming academic conferences, hands-on clinical workshops, and premier institutional achievements shaping pharmaceutical education at VEL Pharmacy College.') ?>
      </p>
    </div>

    <div class="events-highlights-grid">

      <!-- LEFT COLUMN: UPCOMING EVENTS (AUTO-SCROLLING) -->
      <div class="eh-col-box events-col motion-from-left">
        <div class="eh-col-header">
          <div class="eh-col-title-group">
            <div class="eh-col-icon events-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
            <div>
              <h3 class="eh-col-title"><?= htmlspecialchars($events_highlights['events_title'] ?? 'Upcoming Events') ?>
              </h3>
            </div>
          </div>

          <div class="eh-scroll-controls">
            <span class="eh-live-badge" title="Auto-scrolling list. Hover cursor to pause.">
              <span class="eh-live-dot" aria-hidden="true"></span>
              <span class="eh-live-text">Live Scroll</span>
            </span>
            <button type="button" class="eh-ctrl-btn" id="ehScrollPrevBtn" aria-label="Scroll to previous event"
              title="Previous event">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="18 15 12 9 6 15"></polyline>
              </svg>
            </button>
            <button type="button" class="eh-ctrl-btn" id="ehScrollNextBtn" aria-label="Scroll to next event"
              title="Next event">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <button type="button" class="eh-ctrl-btn" id="ehScrollPlayPauseBtn" aria-label="Pause or resume auto-scroll"
              title="Pause / Play auto-scroll">
              <svg class="icon-pause" width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                <rect x="6" y="4" width="4" height="16"></rect>
                <rect x="14" y="4" width="4" height="16"></rect>
              </svg>
              <svg class="icon-play" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"
                style="display: none;">
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
              </svg>
            </button>
          </div>
        </div>

        <!-- Auto-Scrolling Viewport -->
        <div class="eh-events-scroll-viewport" id="ehEventsScrollViewport">
          <div class="eh-events-list" id="ehEventsList">
            <?php foreach ($active_upcoming_events as $ev): ?>
              <a href="<?= htmlspecialchars($ev['link'] ?? 'enquiry') ?>" class="eh-event-card"
                data-event-date="<?= htmlspecialchars($ev['date'] ?? '') ?>"
                title="<?= htmlspecialchars($ev['title']) ?>">
                <div class="eh-date-badge">
                  <span class="eh-date-month"><?= htmlspecialchars($ev['month']) ?></span>
                  <span class="eh-date-day"><?= htmlspecialchars($ev['day']) ?></span>
                  <span class="eh-date-year"><?= htmlspecialchars($ev['year']) ?></span>
                </div>
                <div class="eh-event-body">
                  <span
                    class="eh-tag-pill <?= htmlspecialchars($ev['category_color'] ?? 'blue') ?>"><?= htmlspecialchars($ev['category']) ?></span>
                  <h4 class="eh-event-title"><?= htmlspecialchars($ev['title']) ?></h4>
                  <div class="eh-event-meta">
                    <span class="eh-meta-item">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                      </svg>
                      <?= htmlspecialchars($ev['time']) ?>
                    </span>
                    <span class="eh-meta-item">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                      </svg>
                      <?= htmlspecialchars($ev['venue']) ?>
                    </span>
                  </div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: HIGHLIGHTS (WITH AUTO-TRANSFERRED PAST EVENTS) -->
      <div class="eh-col-box highlights-col motion-from-right delay-1" id="highlights">
        <div class="eh-col-header">
          <div class="eh-col-title-group">
            <div class="eh-col-icon highlights-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon
                  points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                </polygon>
              </svg>
            </div>
            <div>
              <h3 class="eh-col-title">
                <?= htmlspecialchars($events_highlights['highlights_title'] ?? 'College Highlights') ?>
              </h3>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap;">
            <span
              class="eh-col-badge badge-gold"><?= htmlspecialchars($events_highlights['highlights_badge'] ?? 'Institutional Prestige') ?></span>
          </div>
        </div>

        <!-- Scrollable Highlights Viewport -->
        <div class="eh-highlights-scroll-viewport eh-scroll-styled" id="ehHighlightsScrollViewport">
          <div class="eh-highlights-list" id="ehHighlightsList">
            <?php foreach ($all_highlights as $hl): ?>
              <?php
              // Resolve topic-related image according to title
              $hl_img = !empty($hl['image']) ? $hl['image'] : (!empty($hl['notice_image']) ? $hl['notice_image'] : '');
              if (empty($hl_img)) {
                $t = strtolower($hl['title'] ?? '');
                if (strpos($t, 'pci') !== false || strpos($t, 'approval') !== false) {
                  $hl_img = 'assets/images/campus-main-entrance.jpg';
                } elseif (strpos($t, 'python') !== false || strpos($t, 'ai') !== false || strpos($t, 'nep') !== false || strpos($t, 'cadd') !== false) {
                  $hl_img = 'assets/images/computer-lab.jpg';
                } elseif (strpos($t, 'hospital') !== false || strpos($t, 'clinical') !== false || strpos($t, 'vmch') !== false) {
                  $hl_img = 'assets/images/hospital-facility.jpg';
                } elseif (strpos($t, 'lab') !== false || strpos($t, 'analytical') !== false || strpos($t, 'suite') !== false) {
                  $hl_img = 'assets/images/research-lab-modern.jpg';
                } elseif (strpos($t, 'pharmacist') !== false || strpos($t, 'ceremony') !== false) {
                  $hl_img = 'assets/images/seminar-hall.jpg';
                } else {
                  $hl_img = 'assets/images/campus-main-entrance.jpg';
                }
              }
              ?>
              <a href="highlights#<?= !empty($hl['slug']) ? htmlspecialchars($hl['slug']) : '' ?>" target="_blank"
                rel="noopener noreferrer"
                class="eh-highlight-card <?= !empty($hl['is_transferred_event']) ? 'transferred-event-card' : '' ?>"
                title="<?= htmlspecialchars($hl['title']) ?>">
                <div class="eh-hl-image-wrap <?= !empty($hl['is_transferred_event']) ? 'img-transferred' : '' ?>">
                  <img src="<?= htmlspecialchars($hl_img) ?>" alt="<?= htmlspecialchars($hl['title']) ?>"
                    class="eh-hl-thumb-img" loading="lazy" width="76" height="76">
                </div>
                <div class="eh-hl-body">
                  <div class="eh-hl-badge-row">
                    <span
                      class="eh-hl-badge <?= !empty($hl['is_transferred_event']) ? 'badge-concluded' : '' ?>"><?= htmlspecialchars($hl['badge']) ?></span>
                    <span class="eh-hl-category"><?= htmlspecialchars($hl['tag']) ?></span>
                  </div>
                  <h4 class="eh-hl-title"><?= htmlspecialchars($hl['title']) ?></h4>
                  <p class="eh-hl-desc"><?= htmlspecialchars($hl['desc']) ?></p>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="eh-action-box">
          <a href="highlights" target="_blank" rel="noopener noreferrer" class="btn btn-primary"
            style="width: 100%; justify-content: center; display: inline-flex; align-items: center; gap: 0.5rem;"
            title="View Highlights">
            <span>View Highlights &rarr;</span>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Auto-Scroll Engine & Live Date Checker for Upcoming Events -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.getElementById('ehEventsScrollViewport');
    const list = document.getElementById('ehEventsList');
    if (!viewport || !list) return;

    const playPauseBtn = document.getElementById('ehScrollPlayPauseBtn');
    const prevBtn = document.getElementById('ehScrollPrevBtn');
    const nextBtn = document.getElementById('ehScrollNextBtn');
    const iconPause = playPauseBtn ? playPauseBtn.querySelector('.icon-pause') : null;
    const iconPlay = playPauseBtn ? playPauseBtn.querySelector('.icon-play') : null;
    const liveBadge = document.querySelector('.eh-live-badge');

    let isPaused = false;
    let scrollSpeed = 0.65; // pixels per animation frame
    let animationFrameId = null;

    // Duplicate items for continuous seamless loop if list has at least 2 cards
    const cards = list.querySelectorAll('.eh-event-card');
    if (cards.length >= 2) {
      const originalCardsHtml = list.innerHTML;
      list.insertAdjacentHTML('beforeend', originalCardsHtml);
    }

    function getHalfHeight() {
      return list.scrollHeight / 2;
    }

    function autoScrollLoop() {
      if (!isPaused) {
        viewport.scrollTop += scrollSpeed;
        const halfHeight = getHalfHeight();
        if (halfHeight > 0 && viewport.scrollTop >= halfHeight) {
          viewport.scrollTop = 0;
        }
      }
      animationFrameId = requestAnimationFrame(autoScrollLoop);
    }

    // Start smooth auto-scroll loop
    animationFrameId = requestAnimationFrame(autoScrollLoop);

    // Pause on hover
    const eventsCol = document.querySelector('.eh-col-box.events-col');
    if (eventsCol) {
      eventsCol.addEventListener('mouseenter', function () {
        isPaused = true;
        if (liveBadge) liveBadge.style.opacity = '0.6';
      });
      eventsCol.addEventListener('mouseleave', function () {
        if (!playPauseBtn || !playPauseBtn.classList.contains('manual-paused')) {
          isPaused = false;
          if (liveBadge) liveBadge.style.opacity = '1';
        }
      });
      eventsCol.addEventListener('touchstart', function () {
        isPaused = true;
      }, { passive: true });
      eventsCol.addEventListener('touchend', function () {
        setTimeout(function () {
          if (!playPauseBtn || !playPauseBtn.classList.contains('manual-paused')) {
            isPaused = false;
          }
        }, 3000);
      }, { passive: true });
    }

    // Play / Pause Toggle Button
    if (playPauseBtn) {
      playPauseBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (isPaused) {
          isPaused = false;
          playPauseBtn.classList.remove('manual-paused');
          if (iconPause) iconPause.style.display = 'block';
          if (iconPlay) iconPlay.style.display = 'none';
          if (liveBadge) liveBadge.style.opacity = '1';
        } else {
          isPaused = true;
          playPauseBtn.classList.add('manual-paused');
          if (iconPause) iconPause.style.display = 'none';
          if (iconPlay) iconPlay.style.display = 'block';
          if (liveBadge) liveBadge.style.opacity = '0.5';
        }
      });
    }

    // Manual Prev / Next Buttons
    if (prevBtn) {
      prevBtn.addEventListener('click', function (e) {
        e.preventDefault();
        viewport.scrollBy({ top: -110, behavior: 'smooth' });
        if (viewport.scrollTop <= 0) {
          viewport.scrollTop = getHalfHeight();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function (e) {
        e.preventDefault();
        viewport.scrollBy({ top: 110, behavior: 'smooth' });
        if (viewport.scrollTop >= getHalfHeight()) {
          viewport.scrollTop = 0;
        }
      });
    }
  });
</script>


<!-- ==========================================================================
     VISIBLY SHOWCASED: ADVANCED RESEARCH LABORATORIES & INSTRUMENTATION HUB
     ========================================================================== -->
<section class="section research-showcase-section" id="researchHub" aria-labelledby="researchHubTitle">
  <div class="container-wide">
    <div class="section-header fade-up">
      <span class="section-subtitle">SCIENTIFIC INFRASTRUCTURE &amp; CAPABILITIES</span>
      <h2 class="section-title" id="researchHubTitle">
        Advanced Research Laboratories &amp; Analytical Instrumentation Hub
      </h2>
      <p class="section-description">
        VEL Pharmacy College visibly showcases an advanced pharmaceutical research ecosystem. Explore our specialized laboratories, analytical instrumentation, pilot manufacturing equipment, and computational drug discovery suites:
      </p>
    </div>

    <div class="research-grid">
      <!-- Showcase 1: Analytical Instrumentation (HPLC & UV-Vis) -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/analysis-lab.jpg" alt="HPLC and UV-Visible Spectroscopy Laboratory" loading="lazy">
          <span class="research-badge">Analytical Instrumentation</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">HPLC &amp; UV-Visible Spectroscopy Suite</h3>
          <p class="research-card-desc">
            Equipped with state-of-the-art analytical instrumentation for quantitative drug estimation, stability testing, and purity profiling conforming to ICH and Indian Pharmacopoeia standards.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>HPLC:</strong> Isocratic &amp; binary gradient pumps, Photodiode Array (PDA) detector, automated sample injector.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>UV-Vis Spectroscopy:</strong> Double-beam spectrophotometer (190–1100 nm) for dissolution absorbance kinetics.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>PCI &amp; ICH Compliant</span>
            <span style="color: #D6B56D;">Direct Student Hands-on</span>
          </div>
        </div>
      </div>

      <!-- Showcase 2: Pharmaceutical Formulation Laboratories & Machine Room -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/machine-room.jpg" alt="Pharmaceutical Formulation Laboratories & Machine Room" loading="lazy">
          <span class="research-badge">Formulation &amp; Pilot Plant</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">Pharmaceutical Formulation Laboratories</h3>
          <p class="research-card-desc">
            Industrial pilot-scale machine room simulating modern cGMP manufacturing of solid, semi-solid, and liquid dosage forms from powder blending to finished tablets.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Machine Room:</strong> 10-station rotary tablet compression press, fluid bed processor, granulators, and coating pans.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Formulation Testing:</strong> USP Type I &amp; II multi-basket dissolution stations, friability, and hardness testers.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>cGMP Simulation Facility</span>
            <span style="color: #D6B56D;">Pilot Manufacturing</span>
          </div>
        </div>
      </div>

      <!-- Showcase 3: Pharmacology & Pre-Clinical Research Laboratories -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/research-lab-modern.jpg" alt="Pharmacology & Pre-Clinical Testing Laboratories" loading="lazy">
          <span class="research-badge">Pharmacology &amp; Pre-Clinical</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">Pharmacology &amp; Pre-Clinical Laboratories</h3>
          <p class="research-card-desc">
            Advanced facilities for evaluating experimental therapeutics, biological screening, receptor binding mechanisms, and behavioral pharmacology using ethical simulated models.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Apparatus:</strong> Computer-assisted simulation pharmacology suites, isolated organ bath setups, and student kymographs.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Screening:</strong> Hemodynamic monitoring, analgesiometers, behavioral rotarod and maze test apparatus.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>Ethical Computer-Assisted Models</span>
            <span style="color: #D6B56D;">Pre-Clinical Testing</span>
          </div>
        </div>
      </div>

      <!-- Showcase 4: Pharmacognosy & Phytochemical Research -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/pharmacognosy-lab.jpg" alt="Pharmacognosy & Phytochemical Research Laboratory" loading="lazy">
          <span class="research-badge">Phytochemistry &amp; Botanicals</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">Pharmacognosy &amp; Phytochemical Research</h3>
          <p class="research-card-desc">
            Dedicated laboratory for botanical drug standardization, Soxhlet extraction of medicinal plants, isolation of bioactive metabolites, and herbal formulation quality assurance.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Extraction:</strong> Continuous Soxhlet extraction batteries, rotary vacuum evaporators, and Clevenger essential oil stills.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Histology:</strong> High-resolution compound research microscopes, camera lucida, and botanical section microtomes.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>Medicinal Plant Standardization</span>
            <span style="color: #D6B56D;">Natural Products R&amp;D</span>
          </div>
        </div>
      </div>

      <!-- Showcase 5: Computational Drug Discovery & Molecular Docking -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/computer-lab.jpg" alt="Computational Drug Discovery and Molecular Docking Laboratory" loading="lazy">
          <span class="research-badge">CADD &amp; Molecular Docking</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">Computational Drug Discovery &amp; Docking</h3>
          <p class="research-card-desc">
            High-speed workstation cluster dedicated to in-silico computer-aided drug design (CADD), target protein-ligand docking, pharmacophore mapping, and ADMET profiling.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Software:</strong> AutoDock Vina, PyMOL 3D visualization, MarvinSketch, and quantitative QSAR toolkits.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Capabilities:</strong> High-throughput virtual screening, binding free energy calculation, and AI drug repurposing.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>In-Silico Bio-Computing</span>
            <span style="color: #D6B56D;">NEP 2020 AI Skills</span>
          </div>
        </div>
      </div>

      <!-- Showcase 6: Research Projects & Faculty Publications -->
      <div class="research-card fade-up">
        <div class="research-media">
          <img src="assets/images/lecture-hall.jpg" alt="Research Projects and Faculty Publications Record" loading="lazy">
          <span class="research-badge">Projects &amp; Publications</span>
        </div>
        <div class="research-body">
          <h3 class="research-card-title">Research Projects &amp; Faculty Publications</h3>
          <p class="research-card-desc">
            A rich culture of scientific inquiry evidenced by published research papers in prestigious peer-reviewed international journals and funded student innovation grants.
          </p>
          <ul class="research-specs-list">
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Publications:</strong> 45+ research articles published in Scopus and Web of Science indexed journals by doctorate professors.</span>
            </li>
            <li>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Student Projects:</strong> Mandatory 12-credit capstone dissertation with faculty mentorship, patent filings, and national symposiums.</span>
            </li>
          </ul>
          <div class="research-footer-tag">
            <span>Scopus / Web of Science</span>
            <span style="color: #D6B56D;">Patent Filings &amp; Grants</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     FEATURED ACADEMIC PROGRAM: BACHELOR OF PHARMACY (B.PHARM)
     ========================================================================== -->
<section class="section section-alt" aria-labelledby="courseTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle">PREMIER UNDERGRADUATE DEGREE</span>
      <h2 class="section-title" id="courseTitle">
        Bachelor of Pharmacy (B.Pharm)
      </h2>
      <p class="section-description">
        PCI-Approved 4-Year professional degree program structured under the National Education Policy (NEP 2020). Integrating core pharmaceutical sciences with digital AI and clinical hospital immersion.
      </p>
    </div>

    <div class="course-featured-card">
      <div class="course-featured-media motion-from-left">
        <img src="assets/images/pharmacy-lab-main.jpg" alt="VEL Pharmacy College B.Pharm Laboratory" loading="lazy" width="600" height="420">
        <div class="course-media-badge">PCI Approved • NEP 2020</div>
      </div>
      <div class="course-featured-body motion-from-right">
        <span class="course-pill">4 Years • 8 Semesters • 193 Total Credits</span>
        <h3 class="course-title">Bachelor of Pharmacy (B.Pharm)</h3>
        <p class="course-desc">
          Designed to develop practice-ready healthcare leaders. Students master medicinal chemistry, formulation technology, pharmacology, clinical AI, hospital practice at VMCH, and complete a 12-credit capstone thesis.
        </p>

        <div class="course-meta-grid">
          <div class="meta-item">
            <strong>Duration</strong>
            <span>4 Years (8 Semesters)</span>
          </div>
          <div class="meta-item">
            <strong>Total Credits</strong>
            <span>193 Credits (CBCS)</span>
          </div>
          <div class="meta-item">
            <strong>Eligibility</strong>
            <span>+2 with PCM or PCB (Merit)</span>
          </div>
          <div class="meta-item">
            <strong>Clinical Exposure</strong>
            <span>300-Bed VMCH Hospital</span>
          </div>
        </div>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.25rem;">
          <a href="assets/docs/B.Pharm_Syllabus_2026_NEP2020.pdf" download="B.Pharm_Syllabus_2026_NEP2020.pdf" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            <span>Download Syllabus (PDF)</span>
          </a>
          <a href="courses" class="btn btn-outline-primary">
            <span>Explore Course Details</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PLACEMENTS & CAREER OUTCOMES -->
<section class="section" aria-labelledby="placementTitle">
  <div class="container">
    <div class="placements-banner">
      <div class="motion-from-left">
        <span class="section-subtitle"><?= htmlspecialchars($placements['subtitle'] ?? 'Career Opportunities') ?></span>
        <h2 class="section-title" id="placementTitle" style="text-align: left; margin-bottom: 1rem;">
          <?= htmlspecialchars($placements['title'] ?? 'Placements @ VISTAS Network') ?>
        </h2>
        <p style="color: var(--color-text-muted); line-height: 1.7; margin-bottom: 1.5rem;">
          <?= htmlspecialchars($placements['desc_p1'] ?? '') ?>
        </p>
        <p style="color: var(--color-text-muted); line-height: 1.7;">
          <?= htmlspecialchars($placements['desc_p2'] ?? '') ?>
        </p>
      </div>

      <div class="placement-stats-grid motion-from-right delay-1">
        <div class="stat-box">
          <div class="stat-number"><?= htmlspecialchars($placements['stat_1_num'] ?? '90%') ?></div>
          <div class="stat-label"><?= htmlspecialchars($placements['stat_1_label'] ?? 'Assured Placements') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-number count-up" data-target="<?= (int) ($placements['stat_2_num'] ?? 3000) ?>">
            <?= htmlspecialchars($placements['stat_2_num'] ?? '3000') ?>
          </div>
          <div class="stat-label"><?= htmlspecialchars($placements['stat_2_label'] ?? 'Students in Annual Placement') ?>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-number"><?= htmlspecialchars($placements['stat_3_num'] ?? '8 LPA') ?></div>
          <div class="stat-label"><?= htmlspecialchars($placements['stat_3_label'] ?? 'Highest Package') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-number"><?= htmlspecialchars($placements['stat_4_num'] ?? '5 LPA') ?></div>
          <div class="stat-label"><?= htmlspecialchars($placements['stat_4_label'] ?? 'Standard / Average Package') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FREQUENTLY ASKED QUESTIONS (AEO FAQ SECTION) -->
<?php
$faq_base_items = $faqs['items'] ?? [];

$faq_comparative_items = [
  [
    'category' => 'Competitive Edge',
    'question' => 'Why is VEL Pharmacy College better than other pharmacy colleges in Chennai and Tiruvallur?',
    'answer' => 'Strategically located in the green VMCH Campus under VISTAS Deemed University, VEL Pharmacy College delivers a distinct clinical, technological, and research edge over standalone regional pharmacy colleges. Our students benefit from an on-campus 300-bed multispecialty teaching hospital for real bedside clinical rounds, advanced analytical instrumentation (HPLC and double-beam UV-Vis spectroscopy) directly accessible to undergraduates, in-silico computational drug discovery with molecular docking, over 45+ Scopus-indexed faculty research publications, and assured placements across the Vels network of 3,000+ annual recruiters.'
  ],
  [
    'category' => 'Hospital Immersion',
    'question' => 'How does having an on-campus 300-bed teaching hospital (VMCH) benefit pharmacy students compared to other colleges?',
    'answer' => 'Unlike standalone regional colleges that lack medical hospital infrastructure and only send students on distant, occasional observation visits, students at VEL Pharmacy College train inside our own on-campus 300-bed Velammal Medical College Hospital (VMCH). From Year 2 onwards, students participate in daily clinical bedside ward rounds, prescription auditing, inpatient case studies, adverse drug reaction (ADR) monitoring, and therapeutic drug management alongside medical specialists.'
  ],
  [
    'category' => 'Analytical Instrumentation',
    'question' => 'What analytical instrumentation (HPLC & UV-Vis) access do undergraduate students receive?',
    'answer' => 'Undergraduate B.Pharm students at VEL Pharmacy College receive direct, hands-on operating experience with High-Performance Liquid Chromatography (HPLC) isocratic/gradient systems with Photodiode Array (PDA) detectors, as well as double-beam UV-Visible spectrophotometers for active API assays, impurity profiling, and dissolution release kinetics. While most other regional colleges restrict such instrumentation to postgraduate researchers, our B.Pharm students run practical analyses independently.'
  ],
  [
    'category' => 'Computational Discovery',
    'question' => 'How does the computational drug discovery and molecular docking lab give students an advantage?',
    'answer' => 'VEL Pharmacy College houses a dedicated computer-aided drug design (CADD) facility equipped with AutoDock Vina, PyMOL 3D visualization, MarvinSketch, and quantitative QSAR toolkits. Under NEP 2020, we integrate Python programming and Machine Learning into the pharmacy syllabus, preparing graduates for high-growth careers in computational biology, clinical data science, and global pharmaceutical MNCs.'
  ],
  [
    'category' => 'Research & Patents',
    'question' => 'What is the research, publication, and patent record of VEL Pharmacy College?',
    'answer' => 'Our doctorate faculty have published over 45+ research articles in Scopus and Web of Science indexed international journals, with active patents in drug formulation and sponsored research grants. Students complete a mandatory 12-credit capstone dissertation with doctorate faculty mentorship, preparing them for higher studies and R&D careers.'
  ],
  [
    'category' => 'University Advantage',
    'question' => 'How does being an off-campus center of VISTAS Deemed University benefit students over affiliated colleges?',
    'answer' => 'Graduates receive an esteemed Deemed to be University degree from VISTAS (accredited with an \'A\' grade and recognized globally by WES, US-FDA, and foreign licensure bodies) rather than an affiliated regional college certificate. Additionally, students leverage Vels Group\'s centralized placement ecosystem, connecting with over 3,000 corporate campus recruiters annually with verified packages.'
  ],
  [
    'category' => 'Campus Life & Sports',
    'question' => 'What campus life, student clubs, and athletic sports facilities are available?',
    'answer' => 'Our sprawling green campus features multi-acre athletic facilities including a full turf cricket pitch, FIFA-standard football field, floodlit volleyball and badminton courts, and a modern indoor gymnasium. Students actively lead professional and cultural societies including the Pharma Innovators Club, Pharmacovigilance Society, Cultural Arts Club, and Red Ribbon Community Health Outreach wing.'
  ]
];
?>
<section class="section section-alt" aria-labelledby="faqTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle"><?= htmlspecialchars($faqs['subtitle'] ?? 'Got Questions?') ?></span>
      <h2 class="section-title" id="faqTitle"><?= htmlspecialchars($faqs['title'] ?? 'Frequently Asked Questions') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($faqs['description'] ?? 'Direct answers to common questions about admissions, approvals, courses, facilities, and why VEL Pharmacy College leads in education.') ?>
      </p>
    </div>

    <div class="faq-wrap fade-up">
      <?php if (!empty($faq_base_items)): ?>
        <?php foreach ($faq_base_items as $qIdx => $faqItem): ?>
          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              <span><?= htmlspecialchars($faqItem['question'] ?? '') ?></span>
              <span class="faq-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                <?= htmlspecialchars($faqItem['answer'] ?? '') ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <!-- Comparative & Detailed FAQs ("Why VEL is Better") revealed via More Questions button -->
      <?php foreach ($faq_comparative_items as $cIdx => $cFaq): ?>
        <div class="faq-item faq-item-more">
          <button class="faq-question" aria-expanded="false">
            <span>
              <span class="badge-tag badge-tag-secondary" style="font-size: 0.72rem; padding: 0.18rem 0.55rem; margin-right: 0.6rem; vertical-align: middle;"><?= htmlspecialchars($cFaq['category']) ?></span>
              <?= htmlspecialchars($cFaq['question']) ?>
            </span>
            <span class="faq-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
              </svg>
            </span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-inner">
              <?= htmlspecialchars($cFaq['answer']) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- More Questions Toggle Button -->
    <div class="faq-more-wrap text-center fade-up" style="margin-top: 2.25rem; text-align: center;">
      <button type="button" class="btn btn-outline" id="btnToggleFaqMore" aria-expanded="false" style="border: 2px solid #D6B56D; color: #FFFFFF; font-weight: 700; padding: 0.85rem 2.25rem; border-radius: 30px; display: inline-flex; align-items: center; gap: 0.65rem; background: rgba(255,255,255,0.08); cursor: pointer; transition: all 0.3s ease;">
        <span id="faqMoreBtnText">More Questions (Why VEL is Better)</span>
        <svg id="faqMoreBtnIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="transition: transform 0.3s ease;"><polyline points="6 9 12 15 18 9"></polyline></svg>
      </button>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var btnToggle = document.getElementById('btnToggleFaqMore');
        if (btnToggle) {
          btnToggle.addEventListener('click', function () {
            var hiddenItems = document.querySelectorAll('.faq-item-more');
            var isExpanded = btnToggle.getAttribute('aria-expanded') === 'true';
            hiddenItems.forEach(function (item) {
              if (isExpanded) {
                item.classList.remove('is-visible');
                item.classList.remove('active');
                var ans = item.querySelector('.faq-answer');
                if (ans) ans.style.maxHeight = null;
              } else {
                item.classList.add('is-visible');
              }
            });
            btnToggle.setAttribute('aria-expanded', !isExpanded);
            var btnText = document.getElementById('faqMoreBtnText');
            var btnIcon = document.getElementById('faqMoreBtnIcon');
            if (btnText) {
              btnText.textContent = isExpanded ? 'More Questions (Why VEL is Better)' : 'Show Fewer Questions';
            }
            if (btnIcon) {
              btnIcon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(180deg)';
            }
          });
        }
      });
    </script>
  </div>
</section>

<!-- QUICK FACTS BLOCK (AEO/GEO Citable Data) -->
    <!--<div class="quick-facts-box fade-up">
      <h3 class="quick-facts-title">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        <span>Quick Institutional Facts</span>
      </h3>
      <div class="quick-facts-grid">
        <div class="fact-item">
          <strong>Institution Name</strong>
          <span><?= htmlspecialchars($gen_settings['college_name'] ?? 'VEL Pharmacy College') ?></span>
        </div>
        <div class="fact-item">
          <strong>Established Year</strong>
          <span>2024–2025 (Trust Estd. 1992)</span>
        </div>
        <div class="fact-item">
          <strong>Approval Status</strong>
          <span>Pharmacy Council of India (PCI)</span>
        </div>
        <div class="fact-item">
          <strong>Affiliated University</strong>
          <span>VISTAS (Deemed University)</span>
        </div>
        <div class="fact-item">
          <strong>Program Offered</strong>
          <span>B.Pharm (4 Years / 8 Semesters)</span>
        </div>
        <div class="fact-item">
          <strong>Campus Location</strong>
          <span>Manjankaranai, Tiruvallur, TN</span>
        </div>
        <div class="fact-item">
          <strong>Admissions Contact</strong>
          <span><?= htmlspecialchars($phone_primary) ?></span>
        </div>
        <div class="fact-item">
          <strong>Official Email</strong>
          <span><?= htmlspecialchars($email_primary) ?></span>
        </div>
      </div>
    </div> -->
  </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="section" style="padding-top: 0; padding-bottom: 5.5rem; background: #FFFFFF;">
  <div class="container">
    <div class="cta-banner fade-up">
      <h2><?= htmlspecialchars($cta_banner['title'] ?? 'Begin Your Journey in Pharmacy at VEL Pharmacy College') ?></h2>
      <p>
        <?= htmlspecialchars($cta_banner['subtitle'] ?? 'Admissions are open for the 2027–2028 academic batch. Connect with our admissions counselors today.') ?>
      </p>
      <div class="cta-buttons">
        <a href="<?= htmlspecialchars($cta_banner['btn_link'] ?? 'enquiry') ?>" class="btn btn-primary"
          style="background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <span><?= htmlspecialchars($cta_banner['btn_text'] ?? 'Fill Online Enquiry Form') ?></span>
        </a>
        <a href="contact-us" class="btn btn-outline-white">
          <span>Contact Admissions Office</span>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>