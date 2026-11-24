<?php
$current_page = 'home';
$page_title = "VEL Pharmacy College | B.Pharm Admissions 2024-2025 | Research Laboratories & Hospital Immersion";
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
$announcement = $home_cms['announcement_text'] ?? ($contact_cfg['admission_status'] ?? 'Admission Open for 2024–2025 Batch: 4-Year B.Pharm Degree Program (PCI Approved)');
$phone_primary = $contact_cfg['phone_primary'] ?? '+91 812 261 3300';
$email_primary = $contact_cfg['email_primary'] ?? 'vels@vistas.ac.in';
$phone_clean = preg_replace('/[^0-9+]/', '', $phone_primary);

$floating_enq_txt = $gen_settings['floating_enquiry_text'] ?? 'Admission Enquiry';
$floating_enq_lnk = $gen_settings['floating_enquiry_link'] ?? 'enquiry';
$floating_not_txt = $gen_settings['floating_notice_text'] ?? 'Announcements';
$floating_not_lnk = $gen_settings['floating_notice_link'] ?? '#announcements';

$hero_badge = $home_cms['pill_badge'] ?? 'ADMISSIONS OPEN 2024–2025 | PCI Approved | VISTAS University';
$hero_t1 = $home_cms['title_main'] ?? 'Excellence in';
$hero_t2 = $home_cms['title_highlight'] ?? 'Pharmaceutical Sciences';
$hero_desc = $home_cms['description'] ?? '4-Year Bachelor of Pharmacy (B.Pharm) Degree Program at VMCH Medical Campus, Tiruvallur. World-class research laboratories with hands-on hospital clinical training.';
$hero_cta1_txt = $home_cms['cta_primary_text'] ?? 'Apply for Admissions 2024–2025';
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
<section class="cinema-hero" id="heroSection" aria-label="VEL Pharmacy College Admissions 2024–2025">
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
     WHY VEL PHARMACY COLLEGE IS BETTER THAN OTHER COLLEGES IN & AROUND
     ========================================================================== -->
<section class="section why-vels-better-section" id="whyVelBetter" aria-labelledby="whyVelBetterTitle" style="background: #FFFFFF;">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle">COMPETITIVE EXCELLENCE &amp; TRUST</span>
      <h2 class="section-title" id="whyVelBetterTitle">
        Why VEL Pharmacy College is Better than Other Colleges In &amp; Around
      </h2>
      <p class="section-description">
        Strategically located in the green VMCH Campus under VISTAS Deemed University, VEL Pharmacy College delivers a distinct clinical, technological, and research edge over standalone regional pharmacy colleges in Chennai, Tiruvallur, and Tamil Nadu.
      </p>
    </div>

    <div class="why-better-grid">
      <!-- Advantage 1 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 9v4"/><path d="M10 11h4"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 01</span>
            <h3 class="why-better-title">On-Campus 300-Bed Teaching Hospital (VMCH)</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Students train inside our own 300-bed multispecialty teaching hospital on campus. Daily clinical bedside ward rounds, prescription auditing, and inpatient case monitoring from Year 2 onwards.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          Other regional colleges lack a medical hospital and send students on distant, occasional observation visits without hands-on clinical rounds.
        </div>
      </div>

      <!-- Advantage 2 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 02</span>
            <h3 class="why-better-title">Advanced Analytical Instrumentation Hub (HPLC &amp; UV)</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Undergraduate students operate real High-Performance Liquid Chromatography (HPLC) isocratic/gradient systems and double-beam UV-Vis spectrophotometers for active API assays and dissolution profiling.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          Most regional pharmacy colleges restrict analytical instrumentation to faculty or PG students, leaving B.Pharm students with basic glassware only.
        </div>
      </div>

      <!-- Advantage 3 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 03</span>
            <h3 class="why-better-title">Computational Drug Discovery &amp; Molecular Docking</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Dedicated high-performance computer-aided drug design (CADD) facility equipped with AutoDock, PyMOL, and QSAR modeling software to simulate protein-ligand binding and virtual screening.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          We integrate Python and Machine Learning into the pharmacy curriculum under NEP 2020, positioning graduates for high-growth computational biology MNC roles.
        </div>
      </div>

      <!-- Advantage 4 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 04</span>
            <h3 class="why-better-title">Funded Research Projects &amp; Scopus Publications</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Over 45+ research publications in Scopus and Web of Science indexed journals, funded student capstone research grants, and active faculty patent filings in drug formulation.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          While other colleges focus solely on exam memorization, our doctorate faculty actively mentor undergraduate students to publish original research papers.
        </div>
      </div>

      <!-- Advantage 5 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 05</span>
            <h3 class="why-better-title">Vels University Network &amp; 90% Placements</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Constituent off-campus center of VISTAS Deemed University with a 30+ year academic track record, 3,000+ annual campus recruiters across Vels Group, and guaranteed placement drives.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          Graduates receive an esteemed Deemed University degree recognized globally by WES, US-FDA, and foreign licensure bodies rather than affiliated regional state colleges.
        </div>
      </div>

      <!-- Advantage 6 -->
      <div class="why-better-card fade-up">
        <div class="why-better-header">
          <div class="why-better-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
          </div>
          <div>
            <span class="why-better-num">Advantage 06</span>
            <h3 class="why-better-title">Vibrant Student Life, Clubs &amp; Multi-Acre Sports</h3>
          </div>
        </div>
        <p class="why-better-desc">
          Sprawling green campus featuring full-size cricket and football grounds, floodlit courts, student innovation clubs, academic discussion forums, and health outreach camps.
        </p>
        <div class="why-better-comparison">
          <strong>The VEL Difference:</strong>
          True university campus experience with holistic athletic facilities, active student government, and collaborative peer learning.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     VISIBLY SHOWCASED: ADVANCED RESEARCH LABORATORIES & INSTRUMENTATION HUB
     ========================================================================== -->
<section class="section section-alt research-showcase-section" id="researchHub" aria-labelledby="researchHubTitle">
  <div class="container-wide">
    <div class="section-header fade-up">
      <span class="section-subtitle" style="color: #D6B56D;">SCIENTIFIC INFRASTRUCTURE &amp; CAPABILITIES</span>
      <h2 class="section-title" id="researchHubTitle">
        Advanced Research Laboratories &amp; Analytical Instrumentation Hub
      </h2>
      <p class="section-description" style="color: rgba(255,255,255,0.88);">
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
<section class="section" aria-labelledby="courseTitle">
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

<!-- ==========================================================================
     STUDENT CORNER, CAMPUS LIFE, CLUBS & SPORTS SHOWCASE
     ========================================================================== -->
<section class="section section-alt" id="studentLifeHub" aria-labelledby="studentLifeTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle" style="color: #D6B56D;">CAMPUS CULTURE &amp; ATHLETICS</span>
      <h2 class="section-title" id="studentLifeTitle">
        Student Corner, Discussions, Live Events &amp; Sports
      </h2>
      <p class="section-description" style="color: rgba(255,255,255,0.88);">
        A rich collegiate experience combining student-driven academic discussion forums, live clinical webinars, collegiate innovation clubs, and expansive athletic sports on our multi-acre campus:
      </p>
    </div>

    <div class="student-life-grid">
      <!-- Feature 1: Student Corner & Discussions -->
      <div class="student-feature-card fade-up">
        <div class="student-feature-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <h3 class="student-feature-title">Student Corner &amp; Discussions</h3>
        <p class="student-feature-desc">
          Active peer discussion boards, GPAT/NIPER study circles, journal clubs, and question-and-answer exchanges mentored by senior students and faculty.
        </p>
        <a href="student-corner#discussions" style="color: #1E6A4D; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
          <span>Join Discussions &rarr;</span>
        </a>
      </div>

      <!-- Feature 2: Live Events & Expert Webinars -->
      <div class="student-feature-card fade-up">
        <div class="student-feature-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
        </div>
        <h3 class="student-feature-title">Live Events &amp; Webinars</h3>
        <p class="student-feature-desc">
          Weekly webinars on computational chemistry, hospital grand rounds, clinical pharmacotherapy workshops, and national pharmacy guest lectures.
        </p>
        <a href="student-corner#live-events" style="color: #1E6A4D; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
          <span>View Upcoming Events &rarr;</span>
        </a>
      </div>

      <!-- Feature 3: Student Clubs & Societies -->
      <div class="student-feature-card fade-up">
        <div class="student-feature-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="12 8 8 12 12 16 16 12 12 8"/></svg>
        </div>
        <h3 class="student-feature-title">Pharma Clubs &amp; Societies</h3>
        <p class="student-feature-desc">
          Pharma Innovators Club, Pharmacovigilance Society, Cultural Arts Club, and Red Ribbon Community Health Outreach providing holistic growth.
        </p>
        <a href="student-corner#clubs" style="color: #1E6A4D; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
          <span>Explore Clubs &rarr;</span>
        </a>
      </div>

      <!-- Feature 4: Sports Corner & Athletics -->
      <div class="student-feature-card fade-up">
        <div class="student-feature-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
        </div>
        <h3 class="student-feature-title">Sports Corner &amp; Athletics</h3>
        <p class="student-feature-desc">
          Multi-acre sports ground featuring a full turf cricket pitch, football field, volleyball, badminton, indoor games, and modern fitness center.
        </p>
        <a href="student-corner#sports" style="color: #1E6A4D; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
          <span>View Sports Facilities &rarr;</span>
        </a>
      </div>
    </div>

    <div style="text-align: center; margin-top: 2.5rem;">
      <a href="student-corner" class="btn btn-download-gold" style="padding: 0.85rem 2rem;">
        <span>Visit Student Corner &amp; Campus Life Hub</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </a>
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
<section class="section section-alt" aria-labelledby="faqTitle">
  <div class="container">
    <div class="section-header fade-up">
      <span class="section-subtitle"><?= htmlspecialchars($faqs['subtitle'] ?? 'Got Questions?') ?></span>
      <h2 class="section-title" id="faqTitle"><?= htmlspecialchars($faqs['title'] ?? 'Frequently Asked Questions') ?>
      </h2>
      <p class="section-description">
        <?= htmlspecialchars($faqs['description'] ?? 'Direct answers to common questions about admissions, approvals, courses, and facilities at VEL Pharmacy College.') ?>
      </p>
    </div>

    <div class="faq-wrap fade-up">
      <?php if (!empty($faqs['items'])): ?>
        <?php foreach ($faqs['items'] as $qIdx => $faqItem): ?>
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
    </div>

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
        <?= htmlspecialchars($cta_banner['subtitle'] ?? 'Admissions are open for the 2024–2025 academic batch. Connect with our admissions counselors today.') ?>
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