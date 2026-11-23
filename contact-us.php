<?php
$current_page = 'contact';
$page_title = "Contact Us & Campus Location | Vel Pharmacy College, Manjankaranai";
$page_description = "Get in touch with Vel Pharmacy College, VMCH Campus, Periyapalayam Road, Manjankaranai, Tiruvallur. Call +91 812 261 3300, email vels@vistas.ac.in, or visit our green campus.";
$canonical_url = "https://velpharmacycollege.com/contact-us";

// Contact & Breadcrumb Schema
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
                    "name" => "Contact Us",
                    "item" => "https://velpharmacycollege.com/contact-us"
                ]
            ]
        ],
        [
            "@type" => "ContactPage",
            "name" => "Contact Vel Pharmacy College",
            "url" => "https://velpharmacycollege.com/contact-us",
            "mainEntity" => [
                "@type" => "CollegeOrUniversity",
                "name" => "Vel Pharmacy College",
                "telephone" => "+918122613300",
                "email" => "vels@vistas.ac.in",
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "VMCH Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Uthukottai Taluk",
                    "addressLocality" => "Tiruvallur District",
                    "addressRegion" => "Tamil Nadu",
                    "postalCode" => "601102",
                    "addressCountry" => "IN"
                ]
            ]
        ]
    ]
];

// Dynamic CMS Hook: Load page content from CMS
$cms_content_file = __DIR__ . '/data/pages_content.json';
$cms_content = file_exists($cms_content_file) ? (json_decode(file_get_contents($cms_content_file), true) ?: []) : [];
$contact_cms = $cms_content['contact_us'] ?? [];

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
          <span class="breadcrumb-current" aria-current="page">Contact Us</span>
        </nav>
        <h1 class="page-title"><?= htmlspecialchars($contact_cms['banner']['title'] ?? 'Contact & Campus Location') ?></h1>
        <p class="page-subtitle">
          <?= htmlspecialchars($contact_cms['banner']['subtitle'] ?? 'We welcome prospective pharmacy students, parents, academic collaborators, and healthcare partners. Reach out to our admissions helpdesk or visit our sprawling medical campus.') ?>
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="<?= htmlspecialchars($contact_cms['banner']['image'] ?? 'assets/images/campus-front.jpg') ?>" alt="Vel Pharmacy College Campus Location & Admissions Office" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$c_hdr = $contact_cms['section_header'] ?? [];
$c_addr = $contact_cms['address_card'] ?? [];
$c_phone = $contact_cms['phone_card'] ?? [];
$c_email = $contact_cms['email_card'] ?? [];
$c_hours = $contact_cms['hours_card'] ?? [];
$c_map = $contact_cms['map'] ?? [];
$c_commute = $contact_cms['commute'] ?? [];
?>

<!-- SECTION 1: CONTACT CARDS (BALANCED 4-COLUMN GRID) -->
<section class="section" aria-labelledby="contactInfoHeading">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle"><?= htmlspecialchars($c_hdr['subtitle'] ?? 'Get In Touch With Us') ?></span>
      <h2 class="section-title" id="contactInfoHeading"><?= htmlspecialchars($c_hdr['title'] ?? 'Contact Information & Helpdesk') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($c_hdr['description'] ?? 'Our admissions officers and campus administrators are available to assist you with course inquiries, campus visits, hostel bookings, and admission guidance.') ?>
      </p>
    </div>

    <!-- 4-Card Contact Grid: Balanced Across Desktop -->
    <div class="contact-info-grid">
      
      <!-- Card 1: Campus Address -->
      <div class="contact-info-card fade-up">
        <div class="contact-icon-bubble" style="background: var(--color-primary-subtle); color: var(--color-primary);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="contact-info-title"><?= htmlspecialchars($c_addr['title'] ?? 'Campus Location') ?></h3>
        <p class="contact-info-text">
          <strong><?= htmlspecialchars($c_addr['institution'] ?? 'Vel Pharmacy College') ?></strong><br>
          <?= htmlspecialchars($c_addr['address'] ?? 'VMCH Medical Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Uthukottai Taluk, Tiruvallur District – 601102, Tamil Nadu.') ?>
        </p>
        <span class="contact-badge-pill" style="background: #1E6A4D; color: #F5F7F4;">
          <?= htmlspecialchars($c_addr['badge'] ?? '📍 Near VMCH Hospital Gate') ?>
        </span>
      </div>

      <!-- Card 2: Phone Numbers -->
      <div class="contact-info-card fade-up delay-1">
        <div class="contact-icon-bubble" style="background: #D6B56D; color: #1E6A4D;">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        </div>
        <h3 class="contact-info-title"><?= htmlspecialchars($c_phone['title'] ?? 'Phone & Admissions') ?></h3>
        <p class="contact-info-text">
          <?= htmlspecialchars($c_phone['label'] ?? 'Direct Admissions Line:') ?><br>
          <a href="tel:<?= preg_replace('/[^0-9+]/', '', $c_phone['phone'] ?? '+918122613300') ?>" style="font-size: 1.25rem; font-weight: 800; color: #1E6A4D; display: block; margin: 0.5rem 0; text-decoration: none;">
            <?= htmlspecialchars($c_phone['phone'] ?? '+91 812 261 3300') ?>
          </a>
          <?= htmlspecialchars($c_phone['hours'] ?? 'Available Mon–Sat from 8:30 AM to 5:00 PM for all admission queries.') ?>
        </p>
        <span class="contact-badge-pill" style="background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <?= htmlspecialchars($c_phone['badge'] ?? '🛡️ Anti-Ragging: 1800-180-5522') ?>
        </span>
      </div>

      <!-- Card 3: Email Address -->
      <div class="contact-info-card fade-up delay-2">
        <div class="contact-icon-bubble" style="background: #D6B56D; color: #1E6A4D;">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h3 class="contact-info-title"><?= htmlspecialchars($c_email['title'] ?? 'Email Correspondence') ?></h3>
        <p class="contact-info-text">
          <?= htmlspecialchars($c_email['label'] ?? 'Official Admissions & Inquiries:') ?><br>
          <a href="mailto:<?= htmlspecialchars($c_email['email'] ?? 'vels@vistas.ac.in') ?>" style="font-size: 1.05rem; font-weight: 700; color: var(--color-primary); display: block; margin: 0.5rem 0; text-decoration: none;">
            <?= htmlspecialchars($c_email['email'] ?? 'vels@vistas.ac.in') ?>
          </a>
          Official Institution Website:<br>
          <strong><?= htmlspecialchars($c_email['website'] ?? 'velpharmacycollege.com') ?></strong>
        </p>
        <span class="contact-badge-pill" style="background: #D6B56D; color: #1E6A4D; font-weight: 700;">
          <?= htmlspecialchars($c_email['badge'] ?? '⚡ Reply Within 24 Business Hours') ?>
        </span>
      </div>

      <!-- Card 4: Working Hours -->
      <div class="contact-info-card fade-up delay-3">
        <div class="contact-icon-bubble" style="background: #1E6A4D; color: #F5F7F4;">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3 class="contact-info-title"><?= htmlspecialchars($c_hours['title'] ?? 'Visiting & Office Hours') ?></h3>
        <p class="contact-info-text">
          <strong><?= htmlspecialchars($c_hours['weekday'] ?? 'Monday – Friday: 8:30 AM – 4:30 PM') ?></strong><br>
          <strong><?= htmlspecialchars($c_hours['saturday'] ?? 'Saturday: 8:30 AM – 1:30 PM') ?></strong><br>
          <strong><?= htmlspecialchars($c_hours['sunday'] ?? 'Sunday & Holidays: Closed') ?></strong>
        </p>
        <span class="contact-badge-pill" style="background: #1E6A4D; color: #F5F7F4;">
          <?= htmlspecialchars($c_hours['badge'] ?? '🚶 Campus Tours Welcome') ?>
        </span>
      </div>

    </div>

    <!-- SECTION 2: MAP & DIRECT CONTACT FORM DUAL HUB -->
    <div class="contact-hub-grid">
      
      <!-- Interactive Google Map Embed Card -->
      <div class="contact-hub-card fade-up">
        <div class="contact-hub-header">
          <h3>
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
            <?= htmlspecialchars($c_map['title'] ?? 'Interactive Campus Map') ?>
          </h3>
          <p><?= htmlspecialchars($c_map['subtitle'] ?? 'Located within the 150+ Acre Vels Medical College & Hospital (VMCH) Campus, Manjankaranai') ?></p>
        </div>
        
        <div class="contact-map-wrapper">
          <iframe 
            src="<?= htmlspecialchars($c_map['embed_url'] ?? 'https://maps.google.com/maps?q=Vels%20Medical%20College%20and%20Hospital%2C%20Manjankaranai&t=m&z=13&output=embed&iwloc=near') ?>" 
            title="Vel Pharmacy College Location at VMCH Campus Manjankaranai"
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

        <div class="contact-map-footer">
          <div style="font-size: 0.85rem; color: var(--color-text-muted);">
            📍 <strong>GPS:</strong> <?= htmlspecialchars($c_map['gps'] ?? '13.2921° N, 80.0894° E • Periyapalayam High Road') ?>
          </div>
          <a href="<?= htmlspecialchars($c_map['direction_link'] ?? 'https://maps.google.com/?q=Vels+Medical+College+and+Hospital+Manjankaranai') ?>" target="_blank" rel="noopener" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
            <span>Get Directions</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
          </a>
        </div>
      </div>

      <!-- Quick Message Form Card -->
      <div class="contact-hub-card fade-up delay-1">
        <div class="contact-hub-header">
          <h3>
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            Send Us a Direct Message
          </h3>
          <p>Our admissions counselors will review your inquiry and respond within 24 hours.</p>
        </div>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_message_submit'])): ?>
          <div style="margin: 1.5rem 2.25rem 0; background: #F5F7F4; border: 1px solid #D6B56D; color: #1E6A4D; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: 0.95rem;">
            <strong>Thank You!</strong> Your message has been received. Our admissions team will reach out to you shortly.
          </div>
        <?php endif; ?>

        <form action="contact-us" method="POST" class="contact-form-body">
          <input type="hidden" name="contact_message_submit" value="1">

          <div class="form-group">
            <label for="contact_name">
              Your Full Name <span style="color: #D6B56D;">*</span>
            </label>
            <div class="form-input-wrapper">
              <span class="form-input-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </span>
              <input type="text" id="contact_name" name="contact_name" required placeholder="Enter your full name" class="form-control-custom">
            </div>
          </div>

          <div class="form-row-dual">
            <div class="form-group">
              <label for="contact_email">
                Email Address <span style="color: #D6B56D;">*</span>
              </label>
              <div class="form-input-wrapper">
                <span class="form-input-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </span>
                <input type="email" id="contact_email" name="contact_email" required placeholder="you@domain.com" class="form-control-custom">
              </div>
            </div>
            
            <div class="form-group">
              <label for="contact_phone">
                Phone Number <span style="color: #D6B56D;">*</span>
              </label>
              <div class="form-input-wrapper">
                <span class="form-input-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </span>
                <input type="tel" id="contact_phone" name="contact_phone" required placeholder="+91 98765 43210" class="form-control-custom">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="contact_subject">
              Subject / Topic of Inquiry
            </label>
            <select id="contact_subject" name="contact_subject" class="form-control-custom no-icon">
              <option value="admissions">B.Pharm Admission 2024-25</option>
              <option value="eligibility">Eligibility &amp; Merit Criteria</option>
              <option value="fee">Fee Structure &amp; Scholarships</option>
              <option value="hostel">Hostel &amp; Accommodation Inquiries</option>
              <option value="transport">Bus Routes &amp; Transportation</option>
              <option value="other">General Inquiries / Campus Visit</option>
            </select>
          </div>

          <div class="form-group">
            <label for="contact_message">
              Message <span style="color: #D6B56D;">*</span>
            </label>
            <textarea id="contact_message" name="contact_message" rows="3" required placeholder="Write your question or request here..." class="form-control-custom no-icon" style="resize: vertical;"></textarea>
          </div>

          <div style="margin-top: 0.5rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.9rem 1.5rem; font-size: 1rem; font-weight: 700;">
              <span>Submit Inquiry</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            </button>
          </div>

          <div style="text-align: center; font-size: 0.8rem; color: var(--color-text-light);">
            🔒 Your information is secure and confidential.
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- SECTION 3: HOW TO REACH THE CAMPUS -->
<section class="section section-alt" aria-labelledby="howToReachHeading">
  <div class="container">
    <div class="text-center" style="max-width: 760px; margin: 0 auto 3.5rem;">
      <span class="section-subtitle"><?= htmlspecialchars($c_commute['subtitle'] ?? 'Travel & Commute Guide') ?></span>
      <h2 class="section-title" id="howToReachHeading"><?= htmlspecialchars($c_commute['title'] ?? 'How to Reach Our Campus') ?></h2>
      <p class="section-description">
        <?= htmlspecialchars($c_commute['description'] ?? 'Conveniently connected by road, bus routes, and suburban rail networks across the Chennai Metropolitan and Tiruvallur regions.') ?>
      </p>
    </div>

    <div class="commute-grid">
      <?php 
      $commute_cards = $c_commute['cards'] ?? [];
      $commute_icons = [
        '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 17h10M7 7h10M7 12h10"/>',
        '<rect x="4" y="3" width="16" height="16" rx="2"/><path d="M4 11h16M12 3v8M8 19l-2 3M16 19l2 3"/>',
        '<path d="M12 2a10 10 0 0 0-7.07 17.07l1.41-1.41A8 8 0 1 1 12 20v2a10 10 0 0 0 0-20z"/>'
      ];
      $commute_styles = [
        ['bg' => 'var(--color-primary-subtle)', 'col' => 'var(--color-primary)'],
        ['bg' => 'var(--color-secondary-subtle)', 'col' => 'var(--color-secondary-dark)'],
        ['bg' => 'var(--color-tertiary)', 'col' => 'var(--color-primary-dark)']
      ];
      foreach ($commute_cards as $c_idx => $c_card):
        $c_style = $commute_styles[$c_idx % 3];
        $c_delay = ($c_idx === 1) ? 'delay-1' : (($c_idx === 2) ? 'delay-2' : '');
      ?>
      <div class="commute-card fade-up <?= $c_delay ?>">
        <div class="commute-icon" style="background: <?= $c_style['bg'] ?>; color: <?= $c_style['col'] ?>;">
          <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><?= $commute_icons[$c_idx % 3] ?></svg>
        </div>
        <h3 class="commute-title"><?= htmlspecialchars($c_card['title'] ?? '') ?></h3>
        <p class="commute-text">
          <?= htmlspecialchars($c_card['desc'] ?? '') ?>
        </p>
        <span class="commute-chip">
          <?= htmlspecialchars($c_card['chip'] ?? '') ?>
        </span>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
