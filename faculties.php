<?php
$current_page = 'faculties';
$page_title = "Faculty Directory & Academic Mentors | Vel Pharmacy College";
$page_description = "Meet the esteemed pharmacy educators and research mentors at Vel Pharmacy College, led by Principal Dr. G. Saravanan. Doctorate professors, dedicated researchers, and PCI-approved cadre.";
$canonical_url = "https://velpharmacycollege.com/faculties";

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
      "name" => "Faculty Directory",
      "item" => "https://velpharmacycollege.com/faculties"
    ]
  ]
];

// Dynamic CMS Hook: Load live faculty data if available from CMS
$cms_fac_file = __DIR__ . '/data/faculties.json';
if (file_exists($cms_fac_file)) {
  $cms_fac_data = json_decode(file_get_contents($cms_fac_file), true);
  if (is_array($cms_fac_data) && !empty($cms_fac_data)) {
    $faculties = $cms_fac_data;
  }
}

// Fallback Default Faculty Data if CMS data not present
if (!isset($faculties)) {
  $faculties = [
    [
      'sno' => 1,
      'id' => 'saravanan-g',
      'name' => 'Dr. G. Saravanan',
      'qualification' => 'M. Pharm., Ph.D., FAPP',
      'designation' => 'Professor & Principal',
      'department' => 'Pharmaceutical Chemistry',
      'dept_slug' => 'chemistry',
      'dept_color' => '#1E6A4D',
      'experience' => '18.5+ Years',
      'image' => 'assets/images/Faculty/Dr. G. Saravanan.png',
      'featured' => true,
      'is_doctorate' => true,
      'badge' => 'Principal & Head',
      'cadre' => 'Professor & Collegiate Head',
      'email' => 'principal@velpharmacycollege.com',
      'office' => 'Administrative Wing, Principal Office (Room 101)',
      'description' => 'Dr. G. Saravanan is an accomplished pharmaceutical scientist and academic administrator with over 18.5 years of rich experience in pharmacy education, PCI statutory administration, and rational drug design. As Principal of Vel Pharmacy College, he spearheads modern pharmaceutical pedagogy, PCI compliance, and student research mentorship. His doctoral research is rooted in novel heterocyclic synthesis, molecular docking, and QSAR studies for antimycobacterial and anticancer therapeutics.',
      'specializations' => [
        'Synthetic Medicinal Chemistry',
        'Computer-Aided Drug Design (CADD)',
        'Molecular Docking & QSAR Studies',
        'Novel Heterocyclic Scaffolds',
        'Academic Governance & PCI Norms'
      ],
      'subjects' => [
        'Medicinal Chemistry I, II & III',
        'Advanced Organic Chemistry',
        'Drug Design & Molecular Modeling',
        'Pharmaceutical Inorganic Chemistry'
      ],
      'achievements' => [
        'Published 45+ research articles in Scopus & Web of Science indexed journals',
        'Elected Fellow of Association of Pharmacy Professionals (FAPP)',
        'Guided over 25 postgraduate & undergraduate pharmacy research dissertations'
      ]
    ],
    [
      'sno' => 2,
      'id' => 'kumanan-r',
      'name' => 'Dr. R. Kumanan',
      'qualification' => 'M. Pharm., Ph.D.',
      'designation' => 'Professor',
      'department' => 'Pharmaceutical Chemistry',
      'dept_slug' => 'chemistry',
      'dept_color' => '#1E6A4D',
      'experience' => '15+ Years',
      'image' => 'assets/images/Faculty/Dr. R.Kumanan.jpeg',
      'featured' => false,
      'is_doctorate' => true,
      'badge' => 'Doctorate / Ph.D.',
      'cadre' => 'Professor & Research Mentor',
      'email' => 'r.kumanan@velpharmacycollege.com',
      'office' => 'Department of Pharmaceutical Chemistry (Block A, Room 104)',
      'description' => 'Dr. R. Kumanan is an esteemed Professor with over 15 years of academic and investigative expertise in pharmaceutical chemistry, chromatographic method development, and drug discovery. He guides scholars in advanced analytical techniques, reverse-phase HPLC characterization, and molecular analysis of active pharmaceutical ingredients.',
      'specializations' => [
        'Analytical Method Development & Validation',
        'RP-HPLC & Spectroscopic Characterization',
        'Phytopharmaceutical Chemistry',
        'Synthetic Drug Analysis & Quality Auditing'
      ],
      'subjects' => [
        'Pharmaceutical Analysis',
        'Medicinal Chemistry',
        'Instrumental Methods of Analysis',
        'Pharmaceutical Quality Assurance'
      ],
      'achievements' => [
        'Extensive publications in peer-reviewed Scopus indexed pharmaceutical journals',
        'Pioneered validated RP-HPLC analytical methods per international ICH protocols',
        'Supervised numerous graduate and undergraduate dissertation research projects'
      ]
    ],
    [
      'sno' => 3,
      'id' => 'avinash-kumar-g',
      'name' => 'Dr. G. Avinash Kumar',
      'qualification' => 'M. Pharm., Ph.D.',
      'designation' => 'Associate Professor',
      'department' => 'Pharmacognosy',
      'dept_slug' => 'pharmacognosy',
      'dept_color' => '#1E6A4D',
      'experience' => '14+ Years',
      'image' => 'assets/images/Faculty/Dr. G. Avinash Kumar.png',
      'featured' => false,
      'is_doctorate' => true,
      'badge' => 'Doctorate / Ph.D.',
      'cadre' => 'Associate Professor & Research Guide',
      'email' => 'g.avinash@velpharmacycollege.com',
      'office' => 'Phytomedicine Research Center (Block B, Room 206)',
      'description' => 'Dr. G. Avinash Kumar holds a Ph.D. with close to 14 years of teaching and investigative research in natural product chemistry, botanical standardizations, and ethnopharmacology. He guides scholars in chromatographic separation of plant active principles, antioxidant bioassays, and standardization of traditional herbal formulations.',
      'specializations' => [
        'Natural Product Chemistry',
        'Ethnopharmacological Screening',
        'Thin Layer & Column Chromatography',
        'Bioactive Secondary Metabolites'
      ],
      'subjects' => [
        'Industrial Pharmacognosy',
        'Advanced Phytochemistry',
        'Medicinal Plant Biotechnology',
        'Herbal Formulation & Standardization'
      ],
      'achievements' => [
        'Extensive research publications in peer-reviewed phytomedicine and herbal journals',
        'Invited keynote speaker at botanical drug research conferences',
        'Principal investigator on plant bioassay efficacy and isolation projects'
      ]
    ],
    [
      'sno' => 4,
      'id' => 'kasireddy-paul',
      'name' => 'Dr. Kasireddy Paul',
      'qualification' => 'M. Pharm., Ph.D.',
      'designation' => 'Associate Professor',
      'department' => 'Pharmacology',
      'dept_slug' => 'pharmacology',
      'dept_color' => '#D6B56D',
      'experience' => '10+ Years',
      'image' => 'assets/images/Faculty/Dr. Kasireddy Paul.jpeg',
      'featured' => false,
      'is_doctorate' => true,
      'badge' => 'Doctorate / Ph.D.',
      'cadre' => 'Associate Professor & Research Guide',
      'email' => 'kasireddy.paul@velpharmacycollege.com',
      'office' => 'Preclinical Pharmacology Research Lab (Block A, Room 208)',
      'description' => 'Dr. Kasireddy Paul is a seasoned doctoral researcher and educator specializing in preclinical in-vivo/in-vitro screening, artificial intelligence in precision therapeutics, and neuropharmacological evaluations. He leads advanced investigational pharmacology protocols and guides scholars in translational drug mechanisms.',
      'specializations' => [
        'In-Vivo & In-Vitro Pharmacological Screening',
        'AI & Machine Learning in Drug Delivery',
        'Hepatoprotective & Anticancer Bioassays',
        'Toxicological Protocols & Regulatory Bioethics'
      ],
      'subjects' => [
        'Pharmacology I, II & III',
        'Clinical Pharmacokinetics & Pharmacodynamics',
        'Experimental Pharmacology Practicals',
        'Pathophysiology & Disease Therapeutics'
      ],
      'achievements' => [
        'Authored high-impact publications on pharmacological strategies and targeted medicine',
        'Principal researcher in preclinical bioassays and metabolic syndrome animal models',
        'Mentor for GPAT and postgraduate medical entrance aspirants'
      ]
    ],
    [
      'sno' => 5,
      'id' => 'sudha-s',
      'name' => 'Dr. Sudha S.',
      'qualification' => 'M. Pharm., Ph.D.',
      'designation' => 'Associate Professor',
      'department' => 'Pharmacognosy',
      'dept_slug' => 'pharmacognosy',
      'dept_color' => '#1E6A4D',
      'experience' => '11+ Years',
      'image' => 'assets/images/Faculty/Dr. Sudha S.jpeg',
      'featured' => false,
      'is_doctorate' => true,
      'badge' => 'Doctorate / Ph.D.',
      'cadre' => 'Associate Professor & Phytomedicine Researcher',
      'email' => 'sudha.s@velpharmacycollege.com',
      'office' => 'Pharmacognosy Research Lab (Block B, Room 204)',
      'description' => 'Dr. Sudha S. brings over 11 years of academic excellence and doctoral expertise in natural pharmacognosy, herbal monograph standardization, and botanical secondary metabolites. She trains students in phytochemical extraction, tissue microscopy, and quality verification of indigenous herbal drugs.',
      'specializations' => [
        'Herbal Drug Standardization & Fingerprinting',
        'Extraction & Isolation of Bioactive Principles',
        'Phytochemical Bioassays & Antioxidant Profiling',
        'Herbal Quality Control & Regulatory Protocols'
      ],
      'subjects' => [
        'Pharmacognosy & Phytochemistry I & II',
        'Herbal Drug Technology',
        'Plant Biotechnology & Secondary Metabolites',
        'Remedial Biology'
      ],
      'achievements' => [
        'Doctoral research in isolation and biological evaluation of herbal medicinal active components',
        'Published research in reputed peer-reviewed journals of pharmaceutical sciences',
        'Organizer of academic workshops on botanical standardization and AYUSH paradigms'
      ]
    ],
    [
      'sno' => 6,
      'id' => 'pravallika-p',
      'name' => 'Mrs. Paladugu Pravallika',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmacology',
      'dept_slug' => 'pharmacology',
      'dept_color' => '#D6B56D',
      'experience' => '4+ Years',
      'image' => 'assets/images/Faculty/Mrs. Paladugu Pravallika.png',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Faculty Mentor',
      'cadre' => 'Assistant Professor',
      'email' => 'p.pravallika@velpharmacycollege.com',
      'office' => 'Preclinical Pharmacology Lab (Block A, Room 210)',
      'description' => 'Mrs. Paladugu Pravallika brings dynamic teaching pedagogy and research enthusiasm in preclinical screening, neuropharmacology, and toxicological bioassays. She engages students through computer-simulated software models, reinforcing receptor theory, autonomic drug interactions, and physiological principles.',
      'specializations' => [
        'Preclinical In-Vivo & In-Vitro Screening',
        'Neuropharmacology & Analgesic Screening',
        'Computer-Assisted Experimental Pharmacology',
        'Toxicological Protocols & Regulatory Bioethics'
      ],
      'subjects' => [
        'Pharmacology I & II',
        'Human Anatomy & Physiology',
        'Pathophysiology of Diseases'
      ],
      'achievements' => [
        'Coordinated digital pharmacology laboratory simulations for B.Pharm students',
        'Published research papers on anti-inflammatory and analgesic screening models',
        'Dedicated faculty mentor for GPAT competitive examination preparation'
      ]
    ],
    [
      'sno' => 7,
      'id' => 'jancyrani-s',
      'name' => 'Mrs. S. Jancyrani',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmaceutics',
      'dept_slug' => 'pharmaceutics',
      'dept_color' => '#1E6A4D',
      'experience' => '3+ Years',
      'image' => 'assets/images/Faculty/Mrs. S. Jancyrani.jpeg',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Formulation Specialist',
      'cadre' => 'Assistant Professor',
      'email' => 's.jancyrani@velpharmacycollege.com',
      'office' => 'Pharmaceutics Formulation Lab (Block A, Room 105)',
      'description' => 'Mrs. S. Jancyrani specializes in pharmaceutics, novel drug delivery systems, and solid oral dosage form technology. She is committed to fostering practical formulation competence among students, with hands-on practice in granulation, tablet compression, and dissolution evaluation.',
      'specializations' => [
        'Novel Drug Delivery Systems (NDDS)',
        'Tablet Compression & Quality Control',
        'Microencapsulation & Polymer Matrices',
        'Biopharmaceutics & Dissolution Testing'
      ],
      'subjects' => [
        'Pharmaceutics I',
        'Industrial Pharmacy I',
        'Physical Pharmaceutics I'
      ],
      'achievements' => [
        'Conducted student industrial formulation demonstrations and scale-up studies',
        'Presented research on sustained-release drug carriers at pharmacy symposiums',
        'Active mentor for laboratory practical skills development'
      ]
    ],
    [
      'sno' => 8,
      'id' => 'divya-c',
      'name' => 'Mrs. C. Divya',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmaceutics',
      'dept_slug' => 'pharmaceutics',
      'dept_color' => '#1E6A4D',
      'experience' => '4+ Years',
      'image' => 'assets/images/Faculty/C.DIVYA.png',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Cosmetic & NDDS',
      'cadre' => 'Assistant Professor',
      'email' => 'c.divya@velpharmacycollege.com',
      'office' => 'Pharmaceutics Pilot Plant & Lab (Block A, Room 108)',
      'description' => 'Mrs. C. Divya brings 4+ years of experience in dosage formulation design, cosmetic science, and physical pharmacy. She combines theoretical lectures with practical lab drills covering emulsification, suspension stability, cosmetic compounding, and dosage form packaging.',
      'specializations' => [
        'Cosmetic Formulations & Technology',
        'Colloidal & Rheological Formulations',
        'Semisolid Compounding & Ointments',
        'Pharmaceutical Packaging Technology'
      ],
      'subjects' => [
        'Pharmaceutics II',
        'Cosmetic Science',
        'Physical Pharmaceutics II',
        'Pharmaceutical Technology'
      ],
      'achievements' => [
        'Formulated innovative topical skincare herbal emulsions and dermatological bases',
        'Guided undergraduate formulation projects for state-level competitions',
        'Active member of the Indian Pharmaceutical Association (IPA)'
      ]
    ],
    [
      'sno' => 9,
      'id' => 'divya-m',
      'name' => 'Ms. M. Divya',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmaceutical Analysis',
      'dept_slug' => 'analysis',
      'dept_color' => '#D6B56D',
      'experience' => '3+ Years',
      'image' => 'assets/images/Faculty/Ms. M. Divya.jpeg',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Analytical Specialist',
      'cadre' => 'Assistant Professor',
      'email' => 'm.divya@velpharmacycollege.com',
      'office' => 'Central Instrumental Analysis Lab (Ground Floor, Room 102)',
      'description' => 'Ms. M. Divya is a dedicated faculty member in pharmaceutical analysis with expertise in spectrophotometric method development, instrumental chromatography, and validation per ICH protocols. She coordinates hands-on analytical instrumentation training for undergraduate pharmacy scholars.',
      'specializations' => [
        'Spectrophotometric Method Development',
        'RP-HPLC Analytical Validation',
        'ICH Quality Assurance & Stability Testing',
        'Quantitative Pharmaceutical Analysis'
      ],
      'subjects' => [
        'Pharmaceutical Analysis',
        'Instrumental Methods of Analysis',
        'Modern Pharmaceutical Analytical Techniques',
        'Quality Assurance Practicals'
      ],
      'achievements' => [
        'Co-authored research articles on analytical method validation in pharmaceutical journals',
        'Conducted instrumental analysis masterclasses for students on HPLC and UV-Vis spectrophotometers',
        'Faculty coordinator for departmental academic documentation and lab safety'
      ]
    ],
    [
      'sno' => 10,
      'id' => 'devibala',
      'name' => 'Mrs. Devibala',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmaceutics',
      'dept_slug' => 'pharmaceutics',
      'dept_color' => '#1E6A4D',
      'experience' => '4+ Years',
      'image' => 'assets/images/Faculty/Mrs. Devibala.jpeg',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Faculty Mentor',
      'cadre' => 'Assistant Professor',
      'email' => 'devibala@velpharmacycollege.com',
      'office' => 'Pharmaceutics & Traditional Medicine Lab (Block A, Room 112)',
      'description' => 'Mrs. Devibala is a dedicated pharmaceutics educator and researcher with expertise in green nanotechnology, traditional medicine formulation, and novel delivery systems. She trains students in particulate science, herbal excipient optimization, and formulation stability.',
      'specializations' => [
        'Green Synthesis of Nanoparticles',
        'Advances in Herbal & Traditional Medicines',
        'Novel Drug Delivery Systems (NDDS)',
        'Polymeric Nanocarriers & Controlled Release'
      ],
      'subjects' => [
        'Pharmaceutics I & II',
        'Industrial Pharmacy',
        'Physical Pharmaceutics',
        'Traditional & Herbal Medicine Formulations'
      ],
      'achievements' => [
        'Co-authored published studies on traditional medicines and green synthesized nanoparticles',
        'Presented research papers at national pharmaceutical science symposiums',
        'Mentored student research projects in novel herbal formulation development'
      ]
    ],
    [
      'sno' => 11,
      'id' => 'pooja',
      'name' => 'Mrs. Pooja',
      'qualification' => 'M. Pharm.',
      'designation' => 'Assistant Professor',
      'department' => 'Pharmacology',
      'dept_slug' => 'pharmacology',
      'dept_color' => '#D6B56D',
      'experience' => '3+ Years',
      'image' => 'assets/images/Faculty/Mrs. Pooja.jpeg',
      'featured' => false,
      'is_doctorate' => false,
      'badge' => 'Faculty Mentor',
      'cadre' => 'Assistant Professor',
      'email' => 'pooja@velpharmacycollege.com',
      'office' => 'Department of Pharmacology (Block A, Room 212)',
      'description' => 'Mrs. Pooja specializes in pharmacology screening protocols, clinical pharmacy practice, and pharmacovigilance. She focuses on interactive teaching methods, clinical case problem-solving, and receptor mechanism demonstrations for pharmacy students.',
      'specializations' => [
        'Pharmacological Screening Strategies',
        'Clinical Pharmacy Practice & Pharmacovigilance',
        'Receptor Pharmacology & Cellular Signaling',
        'Drug-Drug Interaction Analysis'
      ],
      'subjects' => [
        'Pharmacology I & II',
        'Clinical Research & Pharmacovigilance',
        'Pathophysiology',
        'Human Anatomy & Physiology'
      ],
      'achievements' => [
        'Authored research publications on pharmacological strategies and therapeutic management',
        'Conducted clinical interactive workshops on drug safety and patient counseling',
        'Active mentor for student academic development and seminar presentations'
      ]
    ]
  ];
}

// Clean sort helper function: strips title prefixes (Dr., Mr., Mrs., Ms.)
if (!function_exists('getCleanFacultyName')) {
  function getCleanFacultyName($name)
  {
    return trim(preg_replace('/^(Dr\.|Mr\.|Mrs\.|Ms\.)\s+/i', '', trim($name)));
  }
}

// Sort all faculty members in alphabetical order (A to Z)
usort($faculties, function ($a, $b) {
  $nameA = getCleanFacultyName($a['name'] ?? '');
  $nameB = getCleanFacultyName($b['name'] ?? '');
  return strcasecmp($nameA, $nameB);
});

// Precompute available starting letters for the A-Z filter bar
$available_letters = [];
foreach ($faculties as $f) {
  $clean = getCleanFacultyName($f['name'] ?? '');
  if (!empty($clean)) {
    $first = strtoupper($clean[0]);
    $available_letters[$first] = ($available_letters[$first] ?? 0) + 1;
  }
}

// Dynamically compute live department counters & doctorate totals
$dept_counts = [
  'chemistry' => 0,
  'pharmaceutics' => 0,
  'pharmacology' => 0,
  'pharmacognosy' => 0,
  'analysis' => 0,
  'practice' => 0
];
$doc_count = 0;
foreach ($faculties as $f) {
  if (isset($dept_counts[$f['dept_slug']])) {
    $dept_counts[$f['dept_slug']]++;
  }
  if (!empty($f['is_doctorate'])) {
    $doc_count++;
  }
}
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$fac_page_cms = $cms_content['faculties_page'] ?? [];

include __DIR__ . '/includes/header.php';
?>

<!-- LINK TO DEDICATED MODERN FACULTY STYLESHEET WITH INSTANT REFRESH -->
<link rel="stylesheet" href="assets/css/faculty-modern.css?v=<?= time() ?>">

<!-- ==========================================================================
     MODERN ACADEMIC HERO & STATS COUNTER BANNER
     ========================================================================== -->
<section class="faculty-hero-section" aria-label="Faculty Directory Hero Banner">
  <div class="faculty-hero-bg-pattern"></div>
  <div class="faculty-hero-container">

    <!-- Breadcrumb -->
    <nav class="breadcrumb" aria-label="Breadcrumbs" style="margin-bottom: 1.25rem;">
      <a href="/" style="color: #F5F7F4;">Home</a>
      <span class="breadcrumb-separator" style="color: #D6B56D;">/</span>
      <span class="breadcrumb-current" aria-current="page" style="color: #D6B56D; font-weight: 600;">Faculty
        Directory</span>
    </nav>

    <!-- Top Badge -->
    <div class="faculty-badge-pill">
      <span class="pulse-dot"></span>
      <span><?= htmlspecialchars($fac_page_cms['banner']['badge'] ?? 'Esteemed Academic Cadre • 2024–2025') ?></span>
    </div>

    <h1 class="faculty-hero-title">
      <?= htmlspecialchars($fac_page_cms['banner']['title'] ?? 'Distinguished Faculty & Research Mentors') ?>
    </h1>

    <p class="faculty-hero-desc">
      <?= htmlspecialchars($fac_page_cms['banner']['subtitle'] ?? "Vel Pharmacy College is guided by seasoned pharmaceutical academicians, doctoral researchers, and industrial clinicians. Led by Principal Dr. G. Saravanan, our PCI-approved faculty blends theoretical mastery with individualized laboratory mentorship to shape tomorrow's healthcare innovators.") ?>
    </p>

    <!-- Live Academic Stats Strip -->
    <div class="faculty-stats-strip">
      <div class="faculty-stat-card">
        <div class="faculty-stat-num"><?= count($faculties) ?></div>
        <div class="faculty-stat-label">Full-Time Faculty</div>
      </div>
      <div class="faculty-stat-card">
        <div class="faculty-stat-num">100%</div>
        <div class="faculty-stat-label">PCI Approved Cadre</div>
      </div>
      <div class="faculty-stat-card">
        <div class="faculty-stat-num"><?= $doc_count ?></div>
        <div class="faculty-stat-label">Doctorate Scholars</div>
      </div>
      <div class="faculty-stat-card">
        <div class="faculty-stat-num">15:1</div>
        <div class="faculty-stat-label">Student-Faculty Ratio</div>
      </div>
      <div class="faculty-stat-card">
        <div class="faculty-stat-num"><?= count($dept_counts) ?></div>
        <div class="faculty-stat-label">Core Departments</div>
      </div>
    </div>

  </div>
</section>

<!-- ==========================================================================
     INTERACTIVE FACULTY CONTROL COMMAND BAR (Sticky Search & Department Filters)
     ========================================================================== -->
<section class="faculty-controls-section" aria-label="Search and Filter Faculty">
  <div class="faculty-controls-wrapper">

    <!-- Top Search & Quick Toggle Row -->
    <div class="faculty-search-row">
      <!-- Search Input -->
      <div class="faculty-search-box">
        <svg class="faculty-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="search" id="facultySearchInput" class="faculty-search-input"
          placeholder="Search by faculty name..." autocomplete="off" aria-label="Search faculty members by name">
        <button type="button" id="facultySearchClear" class="faculty-search-clear" aria-label="Clear search">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <!-- Quick Toggles & Result Count -->
      <!--<div class="faculty-result-meta">
        <button type="button" id="toggleDoctorates" class="faculty-cadre-toggle" aria-pressed="false">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
          </svg>
          <span>Doctorates &amp; Ph.D. Only</span>
        </button>
        <span id="facultyCounterBadge" style="font-weight: 700; color: var(--color-primary-dark);">Showing
          <?= count($faculties) ?> Faculty</span>
      </div>-->
    </div>

    <!-- Alphabetical Filter Bar (A-Z) -->
    <div class="faculty-alphabet-bar" role="tablist" aria-label="Filter Faculty Alphabetically">
      <button type="button" class="faculty-alpha-btn active" data-letter="all" role="tab" aria-selected="true">
        All
      </button>
      <?php foreach (range('A', 'Z') as $char): ?>
        <?php $has_fac = isset($available_letters[$char]); ?>
        <button type="button" class="faculty-alpha-btn <?= !$has_fac ? 'is-empty' : '' ?>" data-letter="<?= $char ?>"
          <?= !$has_fac ? 'disabled title="No faculty starting with ' . $char . '"' : '' ?>>
          <?= $char ?>
        </button>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ==========================================================================
     FACULTY DIRECTORY SHOWCASE - MODERN CARD GRID
     Features: Hover Pop-Card Preview & Click Full Dossier Pop-Card Modal
     ========================================================================== -->
<section class="faculty-grid-section" aria-label="Faculty Directory Grid">
  <div class="container-wide">

    <div class="faculty-cards-grid" id="facultyGridContainer">
      <?php foreach ($faculties as $index => $fac): ?>
        <?php
        $clean_name = getCleanFacultyName($fac['name']);
        $first_char = !empty($clean_name) ? strtoupper($clean_name[0]) : '';

        // Extract initials for fallback avatar
        $words = explode(' ', $clean_name);
        $initials = '';
        foreach ($words as $w) {
          if (!empty($w))
            $initials .= strtoupper($w[0]);
        }
        $initials = substr($initials, 0, 2);

        // Department CSS color map
        $dept_border = match ($fac['dept_slug']) {
          'chemistry' => '#1E6A4D',
          'pharmaceutics' => '#D6B56D',
          'pharmacology' => '#1E6A4D',
          'pharmacognosy' => '#D6B56D',
          'analysis' => '#1E6A4D',
          'practice' => '#D6B56D',
          default => '#1E6A4D'
        };
        ?>

        <div class="modern-faculty-card fade-up" data-index="<?= $index ?>" data-id="<?= htmlspecialchars($fac['id']) ?>"
          data-dept="<?= htmlspecialchars($fac['dept_slug']) ?>"
          data-doctorate="<?= $fac['is_doctorate'] ? 'true' : 'false' ?>" data-initial="<?= $first_char ?>"
          data-name="<?= htmlspecialchars(strtolower($fac['name'] . ' ' . $clean_name)) ?>"
          style="--dept-accent: <?= $dept_border ?>;">

          <!-- FACULTY PHOTO CONTAINER (Click to open full pop-up dossier, Hover to zoom close in / close out) -->
          <div class="faculty-card-media" tabindex="0" role="button" aria-haspopup="dialog"
            aria-label="Click photo to view complete academic profile for <?= htmlspecialchars($fac['name']) ?>"
            title="Click photo to view complete profile">
            <?php if (!empty($fac['image'])): ?>
              <img src="<?= htmlspecialchars($fac['image']) ?>"
                alt="<?= htmlspecialchars($fac['name']) ?> - <?= htmlspecialchars($fac['designation']) ?>"
                class="faculty-card-img" loading="lazy" width="360" height="450">
            <?php else: ?>
              <!-- High-end Monogram Crest Avatar -->
              <div class="faculty-monogram-avatar" style="background: <?= $dept_border ?>;">
                <span class="faculty-monogram-initials"><?= $initials ?></span>
                <svg class="faculty-monogram-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2">
                  <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                  <path d="M2 17l10 5 10-5"></path>
                  <path d="M2 12l10 5 10-5"></path>
                </svg>
              </div>
            <?php endif; ?>

          </div>

          <!-- CARD CONTENT BODY -->
          <div class="faculty-card-body">

            <!-- Department Tag with icon -->
            <div class="faculty-dept-badge dept-badge-<?= htmlspecialchars($fac['dept_slug']) ?>">
              <?php if ($fac['dept_slug'] === 'chemistry'): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="3"></circle>
                  <path
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                  </path>
                </svg>
              <?php elseif ($fac['dept_slug'] === 'pharmacology'): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path
                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                  </path>
                </svg>
              <?php elseif ($fac['dept_slug'] === 'pharmacognosy'): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 20A7 7 0 0 1 4 13C4 8.5 8 3 12 2c4 1 8 6.5 8 11a7 7 0 0 1-7 7Zm0 0v-8"></path>
                </svg>
              <?php elseif ($fac['dept_slug'] === 'pharmaceutics'): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M10 2v7.31M14 9.3V1.99M8.5 2h7M14 9.3a6.5 6.5 0 1 1-4 0"></path>
                </svg>
              <?php elseif ($fac['dept_slug'] === 'practice'): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
              <?php else: ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="18" y1="20" x2="18" y2="10"></line>
                  <line x1="12" y1="20" x2="12" y2="4"></line>
                  <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
              <?php endif; ?>
              <span><?= htmlspecialchars($fac['department']) ?></span>
            </div>

            <!-- Name & Title -->
            <h2 class="faculty-card-name"><?= htmlspecialchars($fac['name']) ?></h2>
            <div class="faculty-card-designation"><?= htmlspecialchars($fac['designation']) ?></div>

            <div class="faculty-card-qual">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                style="color: #1E6A4D; flex-shrink: 0; margin-top: 2px;">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <div><strong>Qual:</strong> <?= htmlspecialchars($fac['qualification']) ?></div>
            </div>

            <!-- Tags -->
            <div class="faculty-specialty-tags">
              <?php foreach (array_slice($fac['specializations'], 0, 2) as $spec): ?>
                <span class="faculty-tag-pill"><?= htmlspecialchars($spec) ?></span>
              <?php endforeach; ?>
            </div>

            <!-- Card Bottom Button -->
            <div class="faculty-card-footer">
              <button type="button" class="btn-open-dossier"
                aria-label="Open detailed card for <?= htmlspecialchars($fac['name']) ?>">
                <span>View Full Details &amp; Dossier</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>
            </div>

          </div>
        </div>
      <?php endforeach; ?>

      <!-- No Results Container -->
      <div id="facultyNoResults" class="faculty-no-results" style="display: none;">
        <svg class="no-results-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          <line x1="8" y1="11" x2="14" y2="11"></line>
        </svg>
        <h3 class="no-results-title">No Faculty Members Found</h3>
        <p class="no-results-text">We couldn't find any faculty members matching your search criteria. Please adjust
          your name search or letter filter.</p>
        <button type="button" id="resetFiltersBtn" class="btn btn-primary"
          style="padding: 0.6rem 1.5rem; font-size: 0.875rem;">
          Reset All Filters
        </button>
      </div>

    </div>

  </div>
</section>

<!-- ==========================================================================
     INTERACTIVE FULL-PROFILE POP-CARD MODAL (CLICK POP-CARD)
     Opens on click of any faculty card, image, or button
     ========================================================================== -->
<div id="facultyPopCardModal" class="faculty-popcard-backdrop" role="dialog" aria-modal="true"
  aria-labelledby="modalFacultyName" aria-hidden="true">
  <div class="faculty-modal-dossier" id="modalDossierCard">

    <!-- Modal Top Bar -->
    <div class="faculty-modal-topbar">
      <div class="modal-brand-badge">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
          <path d="M2 17l10 5 10-5"></path>
          <path d="M2 12l10 5 10-5"></path>
        </svg>
        <span>Vel Pharmacy College &bull; Faculty Dossier</span>
      </div>

      <button type="button" class="modal-close-btn" id="modalCloseBtn" aria-label="Close Profile Card (Esc)">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Scrollable Modal Content -->
    <div class="faculty-modal-scroll">

      <!-- Top Grid: Photo Column + Header Column -->
      <div class="modal-profile-header">

        <!-- Left: Large Portrait Frame -->
        <div class="modal-photo-column">
          <div class="modal-photo-frame" id="modalPhotoContainer">
            <img src="" alt="" id="modalFacultyImg" class="modal-photo-img">
            <div id="modalMonogramAvatar" class="faculty-monogram-avatar"
              style="display: none; width: 130px; height: 130px;">
              <span class="faculty-monogram-initials" style="font-size: 2.5rem;" id="modalMonogramText"></span>
            </div>
          </div>
          <div class="modal-cadre-tag" id="modalCadreTag">
            PCI Recognized Educator
          </div>
        </div>

        <!-- Right: Name, Title & Credentials -->
        <div class="modal-meta-column">
          <div class="modal-dept-label" id="modalDeptLabel">Department of Pharmaceutical Chemistry</div>
          <h2 class="modal-faculty-name" id="modalFacultyName">Dr. G. Saravanan</h2>
          <div class="modal-faculty-designation" id="modalFacultyDesignation">Professor &amp; Principal</div>

          <!-- Metric Badges Row -->
          <div class="modal-metric-chips">
            <div class="modal-chip">
              <svg class="modal-chip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <span id="modalFacultyQual">M. Pharm., Ph.D., FAPP</span>
            </div>
            <div class="modal-chip">
              <svg class="modal-chip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <span id="modalFacultyExp">18.5 Years Teaching Experience</span>
            </div>
            <div class="modal-chip">
              <svg class="modal-chip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
              <span>PCI Approved Cadre</span>
            </div>
          </div>

          <!-- Academic Biography & Description -->
          <div class="modal-section-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              style="color: var(--color-primary);">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span>Academic Biography &amp; Professional Profile</span>
          </div>
          <p class="modal-bio-text" id="modalFacultyBio"></p>

        </div>

      </div>

      <!-- Core Research Specializations -->
      <div>
        <div class="modal-section-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            style="color: var(--color-secondary);">
            <polygon
              points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
            </polygon>
          </svg>
          <span>Areas of Research Specialization</span>
        </div>
        <div class="modal-specializations-grid" id="modalSpecializations"></div>
      </div>

      <!-- Courses & Practical Mentorship -->
      <div>
        <div class="modal-section-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            style="color: #1E6A4D;">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
          </svg>
          <span>Curricular Teaching &amp; Laboratory Mentorship</span>
        </div>
        <div class="modal-courses-list" id="modalCourses"></div>
      </div>

      <!-- Key Academic Achievements -->
      <div>
        <div class="modal-section-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            style="color: #D6B56D;">
            <circle cx="12" cy="8" r="7"></circle>
            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
          </svg>
          <span>Research Accomplishments &amp; Key Honors</span>
        </div>
        <ul style="padding-left: 1.25rem; font-size: 0.95rem; color: #1E6A4D; line-height: 1.7;" id="modalAchievements">
        </ul>
      </div>

      <!-- Office Location & Inquiries -->
      <div class="modal-contact-strip">
        <div class="modal-contact-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <span id="modalFacultyOffice">Administrative Wing, Room 101</span>
        </div>
        <div class="modal-contact-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <a href="#" id="modalFacultyEmailLink"
            style="color: var(--color-primary); font-weight: 600; text-decoration: underline;">
            <span id="modalFacultyEmail">principal@velpharmacycollege.com</span>
          </a>
        </div>
      </div>

    </div>

    <!-- Modal Footer Controls (Next / Prev Navigation + Inquire CTA) -->
    <div class="faculty-modal-footer">
      <div class="modal-nav-group">
        <button type="button" class="modal-nav-btn" id="modalPrevBtn" aria-label="View Previous Faculty">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
          <span>Previous Faculty</span>
        </button>
        <button type="button" class="modal-nav-btn" id="modalNextBtn" aria-label="View Next Faculty">
          <span>Next Faculty</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>

      <div class="modal-cta-group">
        <a href="enquiry" class="btn btn-primary"
          style="padding: 0.55rem 1.25rem; font-size: 0.875rem; border-radius: var(--radius-full);">
          <span>Inquire for Admission &bull; 2024–2025</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>
      </div>
    </div>

  </div>
</div>

<!-- ==========================================================================
     SECTION 2: ACADEMIC MENTORSHIP CALLOUT
     ========================================================================== -->
<section class="section" style="padding-top: 1.5rem; padding-bottom: 5.5rem; background: #FFFFFF;"
  aria-label="Faculty Mentorship">
  <div class="container" style="max-width: 1080px;">
    <div
      style="background: #1E6A4D; color: #F5F7F4; border-radius: 24px; padding: 4.5rem 2.5rem; text-align: center; box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.2); border: 2px solid #D6B56D; position: relative; overflow: hidden;">
      <div
        style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); padding: 0.35rem 1rem; border-radius: 9999px; margin-bottom: 1.25rem; color: #D6B56D; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">
        ★ Individualized Research &amp; Clinical Mentorship
      </div>
      <h2
        style="font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); color: #F5F7F4; margin-bottom: 1.25rem; line-height: 1.2;">
        Learn Under National Scholars &amp; Pharmacy Researchers
      </h2>
      <p
        style="font-size: 1.1rem; color: #F5F7F4; line-height: 1.7; margin-bottom: 2.25rem; max-width: 780px; margin-left: auto; margin-right: auto;">
        At Vel Pharmacy College, academic mentors do not simply lecture—they guide clinical rounds, mentor research
        publications, train students in modern analytical instrumentation, and provide focused coaching for GPAT and
        international licensing examinations.
      </p>
      <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="enquiry" class="btn"
          style="background: #D6B56D; color: #1E6A4D; font-weight: 700; padding: 0.85rem 2rem; border-radius:
          var(--radius-full); box-shadow: 0 4px 15px rgba(217, 119, 6, 0.4);">
          <span>Apply for B.Pharm 2024–2025</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>
        <a href="contact-us" class="btn"
          style="background: rgba(255,255,255,0.15); color: #F5F7F4; font-weight: 600; padding: 0.85rem 1.75rem; border-radius: var(--radius-full); border: 1px solid rgba(255,255,255,0.3);">
          <span>Schedule Campus Visit</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     INTERACTIVE JAVASCRIPT: POP-CARD MODAL ENGINE & DYNAMIC FILTERING
     ========================================================================== -->
<script>
  // Pass full PHP faculty dataset directly to JS for zero-latency instant pop-card rendering
  const facultyData = <?= json_encode($faculties, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

  document.addEventListener('DOMContentLoaded', () => {
    let currentActiveIndex = 0;
    let activeFilterLetter = 'all';
    let onlyDoctorates = false;
    let searchQuery = '';

    // DOM Elements
    const searchInput = document.getElementById('facultySearchInput');
    const searchClear = document.getElementById('facultySearchClear');
    const toggleDocBtn = document.getElementById('toggleDoctorates');
    const alphaBtns = document.querySelectorAll('.faculty-alpha-btn');
    const cards = document.querySelectorAll('.modern-faculty-card');
    const counterBadge = document.getElementById('facultyCounterBadge');
    const noResultsBox = document.getElementById('facultyNoResults');
    const resetFiltersBtn = document.getElementById('resetFiltersBtn');

    // Modal Elements
    const modal = document.getElementById('facultyPopCardModal');
    const modalDossier = document.getElementById('modalDossierCard');
    const modalCloseBtn = document.getElementById('modalCloseBtn');
    const modalPrevBtn = document.getElementById('modalPrevBtn');
    const modalNextBtn = document.getElementById('modalNextBtn');

    const modalFacultyImg = document.getElementById('modalFacultyImg');
    const modalMonogramAvatar = document.getElementById('modalMonogramAvatar');
    const modalMonogramText = document.getElementById('modalMonogramText');
    const modalDeptLabel = document.getElementById('modalDeptLabel');
    const modalFacultyName = document.getElementById('modalFacultyName');
    const modalFacultyDesignation = document.getElementById('modalFacultyDesignation');
    const modalFacultyQual = document.getElementById('modalFacultyQual');
    const modalFacultyExp = document.getElementById('modalFacultyExp');
    const modalCadreTag = document.getElementById('modalCadreTag');
    const modalFacultyBio = document.getElementById('modalFacultyBio');
    const modalSpecializations = document.getElementById('modalSpecializations');
    const modalCourses = document.getElementById('modalCourses');
    const modalAchievements = document.getElementById('modalAchievements');
    const modalFacultyOffice = document.getElementById('modalFacultyOffice');
    const modalFacultyEmail = document.getElementById('modalFacultyEmail');
    const modalFacultyEmailLink = document.getElementById('modalFacultyEmailLink');

    // 1. FILTERING ENGINE
    function applyFilters() {
      let visibleCount = 0;

      cards.forEach(card => {
        const initial = card.getAttribute('data-initial') || '';
        const name = (card.getAttribute('data-name') || '').toLowerCase();
        const isDoc = card.getAttribute('data-doctorate') === 'true';

        const matchesLetter = (activeFilterLetter === 'all' || initial === activeFilterLetter);
        const matchesDoc = (!onlyDoctorates || isDoc);
        const matchesSearch = (!searchQuery || name.includes(searchQuery));

        if (matchesLetter && matchesDoc && matchesSearch) {
          card.style.display = 'flex';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      // Update Counter
      if (counterBadge) {
        counterBadge.textContent = `Showing ${visibleCount} Faculty`;
      }

      // Toggle No Results
      if (noResultsBox) {
        noResultsBox.style.display = visibleCount === 0 ? 'block' : 'none';
      }
    }

    // Search Input Handler (Search by Faculty Name)
    if (searchInput) {
      searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value.trim().toLowerCase();
        if (searchClear) {
          searchClear.style.display = searchQuery ? 'block' : 'none';
        }
        applyFilters();
      });

      if (searchClear) {
        searchClear.addEventListener('click', () => {
          searchInput.value = '';
          searchQuery = '';
          searchClear.style.display = 'none';
          searchInput.focus();
          applyFilters();
        });
      }
    }

    // Doctorates Only Toggle
    if (toggleDocBtn) {
      toggleDocBtn.addEventListener('click', () => {
        onlyDoctorates = !onlyDoctorates;
        toggleDocBtn.classList.toggle('active', onlyDoctorates);
        toggleDocBtn.setAttribute('aria-pressed', onlyDoctorates ? 'true' : 'false');
        applyFilters();
      });
    }

    // Alphabetical Filter Tabs
    alphaBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        if (btn.classList.contains('is-empty')) return;
        alphaBtns.forEach(b => {
          b.classList.remove('active');
          b.setAttribute('aria-selected', 'false');
        });
        btn.classList.add('active');
        btn.setAttribute('aria-selected', 'true');
        activeFilterLetter = btn.getAttribute('data-letter');
        applyFilters();
      });
    });

    // Reset Filters
    if (resetFiltersBtn) {
      resetFiltersBtn.addEventListener('click', () => {
        activeFilterLetter = 'all';
        onlyDoctorates = false;
        searchQuery = '';
        if (searchInput) searchInput.value = '';
        if (searchClear) searchClear.style.display = 'none';
        if (toggleDocBtn) {
          toggleDocBtn.classList.remove('active');
          toggleDocBtn.setAttribute('aria-pressed', 'false');
        }
        alphaBtns.forEach(b => {
          const isAll = b.getAttribute('data-letter') === 'all';
          b.classList.toggle('active', isAll);
          b.setAttribute('aria-selected', isAll ? 'true' : 'false');
        });
        applyFilters();
      });
    }

    // 2. POP-CARD MODAL ENGINE (CLICK TRIGGER)
    function openFacultyPopCard(index) {
      const data = facultyData[index];
      if (!data) return;

      currentActiveIndex = index;

      // Populate Fields
      modalFacultyName.textContent = data.name;
      modalFacultyDesignation.textContent = data.designation;
      modalDeptLabel.textContent = data.department;
      modalFacultyQual.textContent = data.qualification;
      modalFacultyExp.textContent = `${data.experience} Experience`;
      modalCadreTag.textContent = data.cadre || 'PCI Approved Faculty';
      modalFacultyBio.textContent = data.description;
      modalFacultyOffice.textContent = data.office || 'Main Pharmacy Block';
      modalFacultyEmail.textContent = data.email || 'info@velpharmacycollege.com';
      modalFacultyEmailLink.href = `mailto:${data.email || 'info@velpharmacycollege.com'}`;

      // Handle Photo vs Monogram Avatar
      if (data.image && data.image.trim() !== '') {
        modalFacultyImg.src = data.image;
        modalFacultyImg.alt = `${data.name} - ${data.designation}`;
        modalFacultyImg.style.display = 'block';
        modalMonogramAvatar.style.display = 'none';
      } else {
        modalFacultyImg.style.display = 'none';
        modalMonogramAvatar.style.display = 'flex';

        // Calculate monogram
        const cleanName = data.name.replace(/Dr\.|Mrs\.|Mr\.|Ms\./gi, '').trim();
        const parts = cleanName.split(' ').filter(p => p.length > 0);
        let initials = '';
        parts.forEach(p => initials += p[0].toUpperCase());
        modalMonogramText.textContent = initials.slice(0, 2);
      }

      // Populate Specializations
      modalSpecializations.innerHTML = '';
      (data.specializations || []).forEach(spec => {
        const badge = document.createElement('span');
        badge.className = 'modal-spec-badge';
        badge.textContent = spec;
        modalSpecializations.appendChild(badge);
      });

      // Populate Courses
      modalCourses.innerHTML = '';
      (data.subjects || []).forEach(sub => {
        const item = document.createElement('div');
        item.className = 'modal-course-item';
        item.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>${sub}</span>
      `;
        modalCourses.appendChild(item);
      });

      // Populate Achievements
      modalAchievements.innerHTML = '';
      (data.achievements || []).forEach(ach => {
        const li = document.createElement('li');
        li.style.marginBottom = '0.5rem';
        li.textContent = ach;
        modalAchievements.appendChild(li);
      });

      // Open Modal with Animation
      modal.classList.add('open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden'; // lock background scrolling

      // Focus close button for accessibility
      setTimeout(() => {
        if (modalCloseBtn) modalCloseBtn.focus();
      }, 100);
    }

    function closeFacultyPopCard() {
      modal.classList.remove('open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    // Next / Prev Navigation inside Modal
    function navigateFaculty(direction) {
      let nextIndex = currentActiveIndex + direction;
      if (nextIndex < 0) nextIndex = facultyData.length - 1;
      if (nextIndex >= facultyData.length) nextIndex = 0;
      openFacultyPopCard(nextIndex);
    }

    if (modalPrevBtn) {
      modalPrevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        navigateFaculty(-1);
      });
    }

    if (modalNextBtn) {
      modalNextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        navigateFaculty(1);
      });
    }

    if (modalCloseBtn) {
      modalCloseBtn.addEventListener('click', closeFacultyPopCard);
    }

    // Close when clicking modal backdrop outside the card
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeFacultyPopCard();
      }
    });

    // Keyboard Shortcuts: ESC to close, Left/Right Arrows to navigate
    document.addEventListener('keydown', (e) => {
      if (!modal.classList.contains('open')) return;

      if (e.key === 'Escape') {
        closeFacultyPopCard();
      } else if (e.key === 'ArrowLeft') {
        navigateFaculty(-1);
      } else if (e.key === 'ArrowRight') {
        navigateFaculty(1);
      }
    });

    // 3. ONLY IMAGE CLICK LISTENERS
    // ONLY when the faculty image is clicked -> OPEN THE FULL DESCRIPTION POPUP CARD!
    cards.forEach(card => {
      const index = parseInt(card.getAttribute('data-index'), 10);
      const media = card.querySelector('.faculty-card-media');
      const dossierBtn = card.querySelector('.btn-open-dossier');

      // ONLY clicking the image opens the pop up card!
      if (media) {
        media.addEventListener('click', (e) => {
          e.stopPropagation();
          openFacultyPopCard(index);
        });

        // Accessible keyboard trigger directly on the image
        media.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            e.stopPropagation();
            openFacultyPopCard(index);
          }
        });
      }

      // Also allow clicking the dedicated "View Full Details & Dossier" action button
      if (dossierBtn) {
        dossierBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          openFacultyPopCard(index);
        });
      }
    });

  });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>