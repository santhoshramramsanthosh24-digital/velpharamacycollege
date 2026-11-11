<?php
$current_page = 'facilities';
$page_title = "Campus & Infrastructure Facilities | Vel Pharmacy College";
$page_description = "Explore the cutting-edge facilities at Vel Pharmacy College, Manjankaranai: advanced pharmaceutical laboratories, 1500+ books library, VMCH Hospital clinical exposure, hostels, and sports.";
$canonical_url = "https://velpharmacycollege.com/facilities";

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
            "name" => "Facilities",
            "item" => "https://velpharmacycollege.com/facilities"
        ]
    ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$facilities_cms = $cms_content['facilities'] ?? [];

include __DIR__ . '/includes/header.php';
?>

<!-- PAGE BANNER WITH BREADCRUMB & RELATED IMAGE BOX -->
<section class="page-banner" aria-label="Page Title Banner">
  <div class="container-wide">
    <div class="page-banner-box">
      <div class="page-banner-content">
        <nav class="breadcrumb" aria-label="Breadcrumbs">
          <a href="/">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">Facilities</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($facilities_cms['banner']['title'] ?? 'Campus & Facilities') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($facilities_cms['banner']['subtitle'] ?? 'An exclusive, tranquil, pollution-free campus housing cutting-edge research laboratories, digital lecture halls, extensive libraries, and direct clinical hospital training at VMCH.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($facilities_cms['banner']['image'] ?? 'assets/images/library-main.jpg') ?>" alt="Vel Pharmacy College Campus Facilities & Laboratories" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$f_ov = $facilities_cms['overview'] ?? [];
$f_am_hdr = $facilities_cms['amenities_header'] ?? [];
$f_amenities = $facilities_cms['amenities'] ?? [];
?>

<!-- SECTION 1: OVERVIEW HERO -->
<section class="section" aria-labelledby="facilitiesOverviewTitle">
  <div class="container">
    <div class="facilities-hero-grid">
      <div class="facilities-hero-content fade-up">
        <span class="section-subtitle"><?= htmlspecialchars($f_ov['subtitle'] ?? 'Infrastructure That Inspires Learning') ?></span>
        <h2 class="section-title" id="facilitiesOverviewTitle" style="text-align: left; margin-bottom: 1.25rem;">
          <?= htmlspecialchars($f_ov['title'] ?? 'Modern Infrastructure In a Serene Green Campus') ?>
        </h2>
        <p style="font-size: 1.05rem; line-height: 1.8; color: var(--color-text-main); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($f_ov['description_1'] ?? 'There is an exclusive building with modern and spacious infrastructure. Located in a tranquil atmosphere, there are spacious lecture halls, well-equipped laboratories, a central library, an air-conditioned computer lab with internet facilities, an auditorium, student hostels with dining, indoor & outdoor sports playgrounds, and comprehensive transportation facilities for students and staff.') ?>
        </p>
        <p style="line-height: 1.75; color: var(--color-text-muted); margin-bottom: 1.5rem;">
          <?= htmlspecialchars($f_ov['description_2'] ?? 'Situated in the VMCH Campus at Manjankaranai Village, Tiruvallur District, our campus balances academic rigor with peaceful natural surroundings, promoting concentration, mental well-being, and scientific innovation.') ?>
        </p>

        <div class="facilities-stats-dual">
          <div style="background: var(--color-bg-alt); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--color-primary);">
            <div style="font-weight: 700; color: var(--color-primary-dark); font-size: 1.1rem;"><?= htmlspecialchars($f_ov['lab_count'] ?? '15+ Laboratories') ?></div>
            <div style="font-size: 0.85rem; color: var(--color-text-light);">Fully PCI Compliant</div>
          </div>
          <div style="background: var(--color-bg-alt); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--color-secondary);">
            <div style="font-weight: 700; color: var(--color-secondary); font-size: 1.1rem;"><?= htmlspecialchars($f_ov['hospital_info'] ?? 'VMCH Hospital') ?></div>
            <div style="font-size: 0.85rem; color: var(--color-text-light);">On-Campus Clinical Training</div>
          </div>
        </div>
      </div>

      <div class="facilities-hero-card fade-up delay-2">
        <div class="facilities-hero-img-wrap">
          <img src="<?= htmlspecialchars($f_ov['campus_front_img'] ?? 'assets/images/campus-front.jpg') ?>" alt="Vel Pharmacy College Campus Front" class="facilities-hero-img">
          <div class="facilities-hero-floating-badge">
            <div>
              <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase;"><?= htmlspecialchars($f_ov['location_tag'] ?? 'Campus Location') ?></div>
              <div style="font-size: 0.95rem; font-weight: 600; color: var(--color-text-main);"><?= htmlspecialchars($f_ov['location_sub'] ?? 'VMCH Campus, Manjankaranai') ?></div>
            </div>
            <span class="badge-pill badge-gold">Tiruvallur Dist</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: CORE AMENITIES GRID -->
<section class="section section-alt" aria-labelledby="coreAmenitiesTitle">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle"><?= htmlspecialchars($f_am_hdr['subtitle'] ?? 'Academic & Living Amenities') ?></span>
      <h2 class="section-title" id="coreAmenitiesTitle"><?= htmlspecialchars($f_am_hdr['title'] ?? 'Comprehensive Campus Amenities') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($f_am_hdr['description'] ?? 'Every essential facility—from smart classrooms and high-speed digital labs to clinical hospital access and separate hostels—is meticulously maintained for student success.') ?>
      </p>
    </div>

    <div class="facilities-amenities-grid">
      <?php foreach ($f_amenities as $idx => $am): 
        $delay_class = ($idx % 3 === 1) ? 'delay-1' : (($idx % 3 === 2) ? 'delay-2' : '');
      ?>
      <div class="fade-up <?= $delay_class ?>" style="background: #FFFFFF; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--color-tertiary-light);">
        <div style="height: 220px; overflow: hidden;">
          <img src="<?= htmlspecialchars($am['image'] ?? 'assets/images/lecture-hall.jpg') ?>" alt="<?= htmlspecialchars($am['title'] ?? 'Facility') ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
        </div>
        <div style="padding: 1.75rem;">
          <span style="font-size: 0.75rem; font-weight: 700; color: var(--color-primary); background: var(--color-primary-subtle); padding: 0.25rem 0.65rem; border-radius: var(--radius-full); text-transform: uppercase;">
            Facility #<?= $idx + 1 ?>
          </span>
          <h3 style="font-family: var(--font-heading); font-size: 1.35rem; color: var(--color-primary-dark); margin: 0.5rem 0 0.75rem;">
            <?= htmlspecialchars($am['title'] ?? '') ?>
          </h3>
          <p style="font-size: 0.925rem; color: var(--color-text-muted); line-height: 1.7;">
            <?= htmlspecialchars($am['desc'] ?? '') ?>
          </p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
$f_labs = $facilities_cms['specialized_labs'] ?? [];
$f_place = $facilities_cms['placements'] ?? [];
?>
<!-- SECTION 3: ADVANCED PHARMACEUTICAL LABORATORIES GALLERY -->
<section class="section" id="labs" aria-labelledby="labsTitle">
  <div class="container">
    <div class="text-center" style="max-width: 800px; margin: 0 auto 3rem;">
      <span class="section-subtitle">PCI-Mandated Research Infrastructure</span>
      <h2 class="section-title" id="labsTitle">Specialized Pharmaceutical Laboratories</h2>
      <p class="section-description">
        Hands-on laboratory training is the cornerstone of pharmacy practice. Our laboratories are equipped with calibrated instruments, precision glassware, analytical reagents, and safety stations.
      </p>
    </div>

    <!-- Lab Showcase Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
      <?php if (!empty($f_labs)): ?>
        <?php foreach ($f_labs as $lIdx => $lab): ?>
          <div class="fade-up" style="background: #FFFFFF; border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--color-tertiary-light); box-shadow: var(--shadow-sm);">
            <img src="<?= htmlspecialchars($lab['image'] ?? 'assets/images/IMG_0113-1-scaled.jpg') ?>" alt="<?= htmlspecialchars($lab['title'] ?? 'Laboratory') ?>" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 1.25rem;">
              <h4 style="font-size: 1.1rem; color: var(--color-primary-dark); margin-bottom: 0.35rem;"><?= htmlspecialchars($lab['title'] ?? '') ?></h4>
              <p style="font-size: 0.85rem; color: var(--color-text-muted);"><?= htmlspecialchars($lab['description'] ?? '') ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- SECTION 4: PLACEMENTS @ VISTAS -->
<section class="section section-alt" id="placements" aria-labelledby="placementsHeading">
  <div class="container">
    <div class="facilities-placements-card">
      <div style="max-width: 900px; margin: 0 auto; text-align: center;">
        <span style="display: inline-block; background: rgba(255,255,255,0.15); color: #FEF3C7; font-size: 0.825rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; padding: 0.35rem 1rem; border-radius: var(--radius-full); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($f_place['badge'] ?? 'Career Growth & Industry Alignment') ?>
        </span>
        <h2 id="placementsHeading" style="font-family: var(--font-heading); font-size: 2.5rem; color: #FFFFFF; margin-bottom: 1.25rem; line-height: 1.2;">
          <?= htmlspecialchars($f_place['title'] ?? 'Placements @ VISTAS') ?>
        </h2>
        <p style="font-size: 1.05rem; line-height: 1.8; color: #E0E7FF; margin-bottom: 2rem;">
          <?= htmlspecialchars($f_place['description_1'] ?? 'Vels Institute of Science, Technology and Advanced Studies (VISTAS) is a representation of knowledge and possibilities. It is one of the prestigious, high-grade multidisciplinary Universities in Chennai, securing the highest number of placement offers in the region.') ?>
        </p>

        <!-- Stats Counter Row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
          <div style="background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.15);">
            <div style="font-size: 2.25rem; font-weight: 800; color: #FEF3C7; margin-bottom: 0.25rem;">
              <span class="count-up" data-target="90"><?= htmlspecialchars($f_place['stat_1_val'] ?? '90%') ?></span>
            </div>
            <div style="font-size: 0.9rem; color: #CBD5E1;"><?= htmlspecialchars($f_place['stat_1_lbl'] ?? 'Assured Placement Support') ?></div>
          </div>

          <div style="background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.15);">
            <div style="font-size: 2.25rem; font-weight: 800; color: #FEF3C7; margin-bottom: 0.25rem;">
              <span class="count-up" data-target="3000"><?= htmlspecialchars($f_place['stat_2_val'] ?? '3000+') ?></span>
            </div>
            <div style="font-size: 0.9rem; color: #CBD5E1;"><?= htmlspecialchars($f_place['stat_2_lbl'] ?? 'Students Placed Annually') ?></div>
          </div>

          <div style="background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.15);">
            <div style="font-size: 2.25rem; font-weight: 800; color: #FEF3C7; margin-bottom: 0.25rem;">
              <?= htmlspecialchars($f_place['stat_3_val'] ?? '₹8.0 LPA') ?>
            </div>
            <div style="font-size: 0.9rem; color: #CBD5E1;"><?= htmlspecialchars($f_place['stat_3_lbl'] ?? 'Highest Salary Package') ?></div>
          </div>

          <div style="background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.15);">
            <div style="font-size: 2.25rem; font-weight: 800; color: #FEF3C7; margin-bottom: 0.25rem;">
              <?= htmlspecialchars($f_place['stat_4_val'] ?? '₹5.0 LPA') ?>
            </div>
            <div style="font-size: 0.9rem; color: #CBD5E1;"><?= htmlspecialchars($f_place['stat_4_lbl'] ?? 'Average Salary Standard') ?></div>
          </div>
        </div>

        <p style="font-size: 0.95rem; line-height: 1.7; color: #CBD5E1; margin-bottom: 2rem;">
          <?= htmlspecialchars($f_place['description_2'] ?? 'Being the top-ranked university in Chennai, VISTAS provides comprehensive placement coaching and essential soft-skills training to students. High-level product-based companies and prominent pharmaceutical leaders are our prime recruiters. Specially designed Employability Skill Development Programs ensure every graduate enters the industry career-ready.') ?>
        </p>

        <a href="<?= htmlspecialchars($f_place['btn_link'] ?? 'enquiry') ?>" class="btn" style="background: #D97706; color: #FFFFFF; font-weight: 700;">
          <span><?= htmlspecialchars($f_place['btn_text'] ?? 'Apply Now for B.Pharm 2024-25') ?></span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
