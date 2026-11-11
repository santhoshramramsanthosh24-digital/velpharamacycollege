<?php
$current_page = 'enquiry';
$page_title = "Online Admission Enquiry Form 2024–2025 | Vel Pharmacy College";
$page_description = "Apply online for the 4-year B.Pharm degree program at Vel Pharmacy College. Submit your admission enquiry for the 2024–2025 academic batch. PCI approved & VISTAS affiliated.";
$canonical_url = "https://velpharmacycollege.com/enquiry";

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
            "name" => "Admission Enquiry",
            "item" => "https://velpharmacycollege.com/enquiry"
        ]
    ]
];

$form_submitted = false;
$form_error = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['enquiry_action'])) {
    $applicant_name = trim($_POST['applicant_name'] ?? '');
    $applicant_email = trim($_POST['applicant_email'] ?? '');
    $applicant_phone = trim($_POST['applicant_phone'] ?? '');

    if (empty($applicant_name) || empty($applicant_email) || empty($applicant_phone)) {
        $form_error = "Please fill in all mandatory fields (Name, Email, and Phone).";
    } else {
        $form_submitted = true;
    }
}

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$enquiry_cms = $cms_content['enquiry'] ?? [];

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
          <span class="breadcrumb-current" aria-current="page">Enquiry Form</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($enquiry_cms['banner']['title'] ?? 'Admission Enquiry Form 2024–2025') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($enquiry_cms['banner']['subtitle'] ?? 'Take the first step toward a rewarding career in pharmaceutical science and healthcare. Submit your details below and our admissions counseling team will contact you.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($enquiry_cms['banner']['image'] ?? 'assets/images/hero-pharmacy-showcase.jpg') ?>" alt="Vel Pharmacy College Admissions Enquiry" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 1: ADMISSION FORM & BENEFITS -->
<section class="section" aria-labelledby="formHeading">
  <div class="container">
    <div class="enquiry-grid">
      
      <!-- Left Column: The Interactive Form -->
      <div class="enquiry-form-col fade-up">
        <div class="enquiry-form-card">
          
          <div style="margin-bottom: 2rem;">
            <span class="badge-pill badge-gold" style="margin-bottom: 0.75rem; display: inline-block;"><?= htmlspecialchars($enquiry_cms['intro']['badge_pill'] ?? 'Batch 2024–2025') ?></span>
            <h2 id="formHeading" style="font-family: var(--font-heading); font-size: 1.85rem; color: var(--color-primary-dark); margin-bottom: 0.5rem;">
              <?= htmlspecialchars($enquiry_cms['intro']['title'] ?? 'B.Pharm Candidate Application & Enquiry') ?>
            </h2>
            <p style="font-size: 0.95rem; color: var(--color-text-muted);">
              <?= htmlspecialchars($enquiry_cms['intro']['description'] ?? 'Please complete all required fields (*). Merit-based seats are allocated on a rolling basis.') ?>
            </p>
          </div>

          <?php if ($form_submitted): ?>
            <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 1.75rem 1.5rem; border-radius: var(--radius-lg); margin-bottom: 2rem; text-align: center;">
              <div style="width: 56px; height: 56px; border-radius: 50%; background: #22C55E; color: #FFFFFF; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              </div>
              <h3 style="font-size: 1.35rem; font-weight: 800; margin-bottom: 0.5rem; color: #14532D;">
                Application Received Successfully!
              </h3>
              <p style="font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                Thank you, <strong><?= htmlspecialchars($applicant_name) ?></strong>. Your admission enquiry has been registered with Vel Pharmacy College.
              </p>
              <div style="background: #FFFFFF; padding: 1rem; border-radius: var(--radius-md); font-size: 0.9rem; color: #166534; display: inline-block; text-align: left;">
                <div><strong>Enquiry Ref:</strong> VPC-<?= rand(10000, 99999) ?></div>
                <div><strong>Registered Phone:</strong> <?= htmlspecialchars($applicant_phone) ?></div>
                <div><strong>Registered Email:</strong> <?= htmlspecialchars($applicant_email) ?></div>
              </div>
              <p style="font-size: 0.85rem; color: #15803D; margin-top: 1rem;">
                Our admissions counselor will call you within 24 business hours to guide you through verification and seat reservation.
              </p>
            </div>
          <?php endif; ?>

          <?php if (!empty($form_error)): ?>
            <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 1rem 1.25rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-size: 0.95rem;">
              <strong>Error:</strong> <?= htmlspecialchars($form_error) ?>
            </div>
          <?php endif; ?>

          <form action="enquiry" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <input type="hidden" name="enquiry_action" value="submit">

            <!-- Name -->
            <div>
              <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
                Full Name of Applicant <span style="color: #DC2626;">*</span>
              </label>
              <input type="text" name="applicant_name" required placeholder="e.g. Ramesh Kumar" value="<?= htmlspecialchars($_POST['applicant_name'] ?? '') ?>" style="width: 100%; padding: 0.85rem 1.1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
            </div>

            <!-- Email & Phone Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
              <div>
                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
                  Email Address <span style="color: #DC2626;">*</span>
                </label>
                <input type="email" name="applicant_email" required placeholder="e.g. candidate@gmail.com" value="<?= htmlspecialchars($_POST['applicant_email'] ?? '') ?>" style="width: 100%; padding: 0.85rem 1.1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
              </div>

              <div>
                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
                  Mobile Phone Number <span style="color: #DC2626;">*</span>
                </label>
                <input type="tel" name="applicant_phone" required placeholder="e.g. +91 98765 43210" value="<?= htmlspecialchars($_POST['applicant_phone'] ?? '') ?>" style="width: 100%; padding: 0.85rem 1.1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem;">
              </div>
            </div>

            <!-- Source Dropdown -->
            <div>
              <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
                How did you know about our website?
              </label>
              <select name="referral_source" style="width: 100%; padding: 0.85rem 1.1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem; background: #FFFFFF;">
                <option value="">-- Please Select --</option>
                <option value="FRIENDS">Friends / Family Referral</option>
                <option value="SOCIAL MEDIA">Social Media (Instagram, Facebook, LinkedIn)</option>
                <option value="ADS">Google / Online Advertisements</option>
                <option value="NEWSPAPER">Newspaper / Print Media</option>
                <option value="EDUCATION_FAIR">Education Fair / School Visit</option>
                <option value="OTHER">Other Sources</option>
              </select>
            </div>

            <!-- Address Fields Group -->
            <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: var(--radius-lg); border: 1px solid var(--color-tertiary-light); display: flex; flex-direction: column; gap: 1rem;">
              <span style="font-size: 0.85rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase; letter-spacing: 0.5px;">
                Postal Address for Correspondence
              </span>

              <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                  Street Address
                </label>
                <input type="text" name="address_street" placeholder="House / Flat No., Street Name" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
              </div>

              <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                  Apartment, suite, unit, etc. (optional)
                </label>
                <input type="text" name="address_suite" placeholder="Apartment / Landmark" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
              </div>

              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                <div>
                  <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                    City
                  </label>
                  <input type="text" name="address_city" placeholder="City / Town" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
                </div>

                <div>
                  <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                    State / Province
                  </label>
                  <input type="text" name="address_state" placeholder="e.g. Tamil Nadu" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
                </div>

                <div>
                  <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                    ZIP / Postal Code
                  </label>
                  <input type="text" name="address_zip" placeholder="e.g. 600001" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
                </div>
              </div>

              <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--color-text-main); margin-bottom: 0.35rem;">
                  Country
                </label>
                <select name="address_country" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.9rem; background: #FFFFFF;">
                  <option value="India" selected>India</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Singapore">Singapore</option>
                  <option value="UAE">United Arab Emirates (UAE)</option>
                  <option value="Other">Other International</option>
                </select>
              </div>
            </div>

            <!-- Requirement / Message -->
            <div>
              <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-primary-dark); margin-bottom: 0.4rem;">
                Requirement / Specific Questions
              </label>
              <textarea name="applicant_message" rows="4" placeholder="Mention your +2 marks percentage, PCB/PCM subjects, hostel requirement, or any specific questions..." style="width: 100%; padding: 0.85rem 1.1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.95rem; font-family: inherit; resize: vertical;"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.05rem; justify-content: center;">
              <span>Submit Admission Enquiry</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
          </form>
        </div>
      </div>

      <!-- Right Column: Why Choose VPC & Fast Help -->
      <div class="enquiry-help-col fade-up delay-2">
        
        <?php 
        $eq_help = $enquiry_cms['helpdesk'] ?? [];
        $eq_why = $enquiry_cms['why_apply'] ?? [];
        ?>
        <!-- Quick Admission Helpline Card -->
        <div style="background-color: var(--color-primary); border-radius: var(--radius-xl); padding: 2rem; color: #FFFFFF; box-shadow: var(--shadow-lg);">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
              <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #93C5FD; font-weight: 700;">Direct Admissions Line</div>
              <div style="font-size: 1.35rem; font-weight: 800;">
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $eq_help['phone'] ?? '+918122613300') ?>" style="color: #FFFFFF;"><?= htmlspecialchars($eq_help['phone'] ?? '+91 812 261 3300') ?></a>
              </div>
            </div>
          </div>
          <p style="font-size: 0.9rem; color: #CBD5E1; line-height: 1.6; margin-bottom: 1.25rem;">
            <?= htmlspecialchars($eq_help['hours'] ?? 'Monday - Saturday: 8:30 AM - 5:00 PM') ?>. Speak directly with our senior admission counselors for immediate seat confirmation.
          </p>
          <div style="font-size: 0.85rem; color: #FEF3C7; padding-top: 0.75rem; border-top: 1px solid rgba(255,255,255,0.2);">
            ✉️ Email: <strong><?= htmlspecialchars($eq_help['email'] ?? 'vels@vistas.ac.in') ?></strong>
          </div>
        </div>

        <!-- Why Choose VPC Card -->
        <div style="background: #FFFFFF; border-radius: var(--radius-xl); border: 1px solid var(--color-tertiary-light); padding: 2rem; box-shadow: var(--shadow-md);">
          <h3 style="font-family: var(--font-heading); font-size: 1.35rem; color: var(--color-primary-dark); margin-bottom: 1.25rem;">
            <?= htmlspecialchars($eq_why['title'] ?? 'Why Choose Vel Pharmacy College?') ?>
          </h3>

          <ul style="display: flex; flex-direction: column; gap: 1rem;">
            <?php 
            $why_items = $eq_why['items'] ?? [
              ['title' => 'PCI Approved Curriculum', 'desc' => 'Complete 4-year B.Pharm syllabus recognized by the Pharmacy Council of India.'],
              ['title' => 'VISTAS Deemed University', 'desc' => 'Off-campus center of a NAAC accredited university with 30+ years legacy.'],
              ['title' => 'VMCH Hospital On-Campus', 'desc' => 'Direct clinical bedside rounds, drug interaction study, and patient counseling.'],
              ['title' => '90% Assured Placement Support', 'desc' => 'Top pharma recruiters with packages reaching up to ₹8.0 LPA.']
            ];
            foreach ($why_items as $item):
            ?>
            <li style="display: flex; gap: 0.75rem; align-items: flex-start;">
              <div style="width: 24px; height: 24px; border-radius: 50%; background: #DCFCE7; color: #166534; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 0.8rem; font-weight: 700;">✓</div>
              <div style="font-size: 0.9rem; color: var(--color-text-main); line-height: 1.5;">
                <strong><?= htmlspecialchars($item['title'] ?? '') ?>:</strong> <?= htmlspecialchars($item['desc'] ?? '') ?>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Campus Image Card -->
        <div style="border-radius: var(--radius-xl); overflow: hidden; box-shadow: var(--shadow-md);">
          <img src="<?= htmlspecialchars($enquiry_cms['banner']['image'] ?? 'assets/images/campus-building.jpg') ?>" alt="Vel Pharmacy College Campus" style="width: 100%; height: 220px; object-fit: cover;">
        </div>

      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
