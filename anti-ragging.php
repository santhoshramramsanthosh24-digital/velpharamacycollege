<?php
$current_page = 'anti-ragging';
$page_title = "Anti-Ragging, Grievance & Student Safety | Vel Pharmacy College";
$page_description = "Vel Pharmacy College maintains a zero-tolerance policy against ragging in accordance with PCI and UGC guidelines. 24x7 National Helpline: 1800-180-5522. View committee circulars.";
$canonical_url = "https://velpharmacycollege.com/anti-ragging";

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
            "name" => "Anti-Ragging",
            "item" => "https://velpharmacycollege.com/anti-ragging"
        ]
    ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$antiragging_cms = $cms_content['anti_ragging'] ?? [];

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
          <span class="breadcrumb-current" aria-current="page">Anti-Ragging</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($antiragging_cms['banner']['title'] ?? 'Anti-Ragging & Student Safety') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($antiragging_cms['banner']['subtitle'] ?? 'Vel Pharmacy College enforces a strict Zero-Tolerance Policy toward ragging, harassment, and discrimination, ensuring a secure, supportive, and dignified academic sanctuary for all students.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($antiragging_cms['banner']['image'] ?? 'assets/images/seminar-hall.jpg') ?>" alt="Vel Pharmacy College Student Safety & Ethics" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$ar_hl = $antiragging_cms['helpline'] ?? [];
$ar_pol = $antiragging_cms['policy'] ?? [];
$ar_cells = $antiragging_cms['cells'] ?? [];
$ar_rep = $antiragging_cms['report_section'] ?? [];
?>

<!-- EMERGENCY TOLL-FREE HELPLINE BANNER -->
<div style="background-color: var(--color-secondary); color: #1E6A4D; padding: 1.5rem 0; box-shadow: var(--shadow-md);">
  <div class="container-wide">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
      <div style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #1E6A4D; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F5F7F4" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div>
          <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #1E6A4D; font-weight: 800;">National Anti-Ragging 24x7 Toll-Free Helpline</div>
          <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: 0.5px;">
            <a href="tel:<?= preg_replace('/[^0-9]/', '', $ar_hl['national_tollfree'] ?? '18001805522') ?>" style="color: #1E6A4D;"><?= htmlspecialchars($ar_hl['national_tollfree'] ?? '1800-180-5522') ?></a>
          </div>
        </div>
      </div>

      <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <a href="https://<?= htmlspecialchars(ltrim($ar_hl['national_portal'] ?? 'www.antiragging.in', 'https://')) ?>" target="_blank" rel="noopener noreferrer" class="btn" style="background: #1E6A4D; color: #F5F7F4; font-weight: 700; font-size: 0.875rem;">
          <span>Visit <?= htmlspecialchars($ar_hl['national_portal'] ?? 'www.antiragging.in') ?></span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $ar_hl['campus_cell'] ?? '+918122613300') ?>" class="btn" style="background: #1E6A4D; color: #F5F7F4; border: 1px solid #1E6A4D; font-size: 0.875rem;">
          <span>Campus Cell: <?= htmlspecialchars($ar_hl['campus_cell'] ?? '+91 812 261 3300') ?></span>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- SECTION 1: INSTITUTIONAL ZERO-TOLERANCE DECLARATION -->
<section class="section" aria-labelledby="policyHeading">
  <div class="container">
    <div class="anti-ragging-grid">
      <div class="anti-ragging-content fade-up">
        <span class="section-subtitle"><?= htmlspecialchars($ar_pol['subtitle'] ?? 'Zero Tolerance Campus') ?></span>
        <h2 class="section-title" id="policyHeading" style="text-align: left; margin-bottom: 1.25rem;">
          <?= htmlspecialchars($ar_pol['title'] ?? 'Our Unwavering Anti-Ragging Stance') ?>
        </h2>
        <div style="background: var(--color-bg-alt); border-left: 4px solid var(--color-secondary); padding: 1.5rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem;">
          <p style="font-size: 1.05rem; line-height: 1.8; color: var(--color-text-main); font-weight: 500; font-style: italic;">
            "<?= htmlspecialchars($ar_pol['quote'] ?? 'At Vel Pharmacy College, we unequivocally reject all forms of ragging as a violation of our core values and a threat to the well-being of our community.') ?>"
          </p>
        </div>
        <p style="line-height: 1.75; color: var(--color-text-muted); margin-bottom: 1.25rem;">
          <?= htmlspecialchars($ar_pol['p1'] ?? 'We are committed to fostering a campus culture rooted in respect, dignity, and inclusivity, where every individual can pursue their academic journey free from fear or intimidation.') ?>
        </p>
        <p style="line-height: 1.75; color: var(--color-text-muted);">
          <?= htmlspecialchars($ar_pol['p2'] ?? 'In accordance with the Supreme Court of India directives and UGC / PCI regulations, ragging is completely outlawed within the college campus, hostels, college transport, cafeteria, and during off-campus clinical postings.') ?>
        </p>
      </div>

      <div class="anti-ragging-card fade-up delay-2">
        <div class="anti-ragging-legal-card">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: #D6B56D; color: #1E6A4D; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12.01" y2="8"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
              <h3 style="font-size: 1.2rem; color: #1E6A4D; font-weight: 700;">Legal Consequences</h3>
              <p style="font-size: 0.8rem; color: var(--color-text-light);">Under IPC &amp; UGC Regulations</p>
            </div>
          </div>

          <ul style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.9rem; color: var(--color-text-main);">
            <?php 
            $consequences = $ar_pol['consequences'] ?? [
              'Immediate Suspension from attending classes and academic privileges.',
              'Withholding of Results and cancellation of scholarship or financial aid.',
              'Expulsion from Hostels and campus exclusion orders.',
              'Rustication from the university for periods ranging from 1 to 4 semesters.',
              'Filing of Police FIR leading to criminal trial under Indian Penal Code.'
            ];
            foreach ($consequences as $cons):
            ?>
            <li style="display: flex; gap: 0.65rem; align-items: flex-start;">
              <span style="color: #D6B56D; font-weight: 700;">&bull;</span>
              <span><?= htmlspecialchars($cons) ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: THE THREE STATUTORY REGULATORY CELLS WITH PDF DOWNLOADS -->
<section class="section section-alt" id="committees" aria-labelledby="committeesHeading">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle">Official Committee Circulars</span>
      <h2 class="section-title" id="committeesHeading">Statutory Protection Cells</h2>
      <p class="section-description">
        Vel Pharmacy College has instituted dedicated oversight bodies to safeguard every student. View and download official circulars, member rosters, and complaint protocols below:
      </p>
    </div>

    <div class="anti-ragging-cells-grid">
      <?php foreach ($ar_cells as $idx => $cell): 
        $cellColor = !empty($cell['color']) ? $cell['color'] : '#D6B56D';
        $delay_class = ($idx === 1) ? 'delay-1' : (($idx === 2) ? 'delay-2' : '');
      ?>
      <div class="fade-up <?= $delay_class ?>" style="background: #FFFFFF; border-radius: var(--radius-lg); padding: 2.25rem 2rem; box-shadow: var(--shadow-md); border: 1.5px solid #D6B56D; display: flex; flex-direction: column;">
        <div style="width: 56px; height: 56px; border-radius: var(--radius-md); background: <?= htmlspecialchars($cellColor) ?>1A; color: <?= htmlspecialchars($cellColor) ?>; display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <span style="font-size: 0.75rem; font-weight: 700; color: <?= htmlspecialchars($cellColor) ?>; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.35rem;"><?= htmlspecialchars($cell['badge'] ?? ('Cell ' . ($idx + 1))) ?></span>
        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; color: var(--color-primary-dark); margin-bottom: 0.75rem;">
          <?= htmlspecialchars($cell['title'] ?? '') ?>
        </h3>
        <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.65; margin-bottom: 1.5rem; flex-grow: 1;">
          <?= htmlspecialchars($cell['desc'] ?? '') ?>
        </p>
        <a href="<?= htmlspecialchars($cell['doc_link'] ?? '#') ?>" target="_blank" rel="noopener noreferrer" class="btn" style="background: <?= htmlspecialchars($cellColor) ?>; color: #F5F7F4; font-weight: 600; font-size: 0.9rem; width: 100%; justify-content: center;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
          <span>View &amp; Download PDF</span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SECTION 3: CONFIDENTIAL GRIEVANCE SUBMISSION FORM -->
<section class="section" id="report" aria-labelledby="reportHeading">
  <div class="container" style="max-width: 860px;">
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="section-subtitle"><?= htmlspecialchars($ar_rep['subtitle'] ?? 'Confidential & Secure') ?></span>
      <h2 class="section-title" id="reportHeading"><?= htmlspecialchars($ar_rep['title'] ?? 'Report an Incident or Grievance') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($ar_rep['description'] ?? 'Your safety and confidentiality are our highest priority. Reports submitted through this form are sent directly to the Principal and the Anti-Ragging Committee Chairman.') ?>
      </p>
    </div>

    <div class="anti-ragging-form-card fade-up">
      <?php if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['grievance_submit'])): ?>
        <div style="background: #F5F7F4; border: 1px solid #D6B56D; color: #1E6A4D; padding: 1.25rem 1.5rem; border-radius: var(--radius-md); margin-bottom: 2rem;">
          <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem; font-weight: 700;">Grievance Report Received</h4>
          <p style="font-size: 0.9rem;">Thank you for your report. The Anti-Ragging Committee has been notified and prompt, confidential action is underway.</p>
        </div>
      <?php endif; ?>

      <form action="anti-ragging#report" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem;">
        <input type="hidden" name="grievance_submit" value="1">

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
          <div>
            <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
              Your Name (Optional - Can be Anonymous)
            </label>
            <input type="text" name="student_name" placeholder="Leave blank to remain anonymous" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
          </div>

          <div>
            <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
              Contact Phone / Email (Optional for Follow-up)
            </label>
            <input type="text" name="student_contact" placeholder="Phone number or email" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
          <div>
            <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
              Nature of Concern <span style="color: #D6B56D;">*</span>
            </label>
            <select name="incident_type" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem; background: #F5F7F4;">
              <option value="ragging">Ragging / Intimidation Incident</option>
              <option value="discrimination">Discrimination or Caste/Regional Bias</option>
              <option value="gender">Gender Harassment / Disrespect</option>
              <option value="hostel">Hostel Welfare Grievance</option>
              <option value="other">General Student Welfare Concern</option>
            </select>
          </div>

          <div>
            <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
              Location / Area of Incident
            </label>
            <input type="text" name="incident_location" placeholder="e.g. Hostel, Bus, Lab, Canteen" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
          </div>
        </div>

        <div>
          <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
            Detailed Description of Incident / Concern <span style="color: #D6B56D;">*</span>
          </label>
          <textarea name="incident_details" rows="5" required placeholder="Please provide specific details regarding date, time, individuals involved, and what transpired..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem; font-family: inherit; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: 0.5rem;">
          <div style="font-size: 0.85rem; color: var(--color-text-light);">
            🔒 Submissions are protected by strict institutional privacy protocols.
          </div>
          <button type="submit" class="btn" style="background: #1E6A4D; color: #F5F7F4; font-weight: 700;">
            <span>Submit Confidential Report</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
