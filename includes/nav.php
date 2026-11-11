<?php
/**
 * ============================================================================
 * 🔒 LOCKED COMPONENT: HEADER & NOTICE BAR (DO NOT MODIFY)
 * Any modifications to this file require TWO (2) explicit user permissions.
 * See LOCKED_SECTIONS.md for full governance protocol.
 * ============================================================================
 */
// Reusable Navigation Bar Component - Centered Big Logo Architecture
if (!isset($current_page)) {
    $current_page = 'home';
}
$nav_logo = $gen_settings['logo_img'] ?? ($gen_settings['logo_image'] ?? 'assets/images/logo.jpg');
$nav_phone = $gen_settings['contact_phone'] ?? ($gen_settings['phone_primary'] ?? ($gen_contact['phone_primary'] ?? '+91 812 261 3300'));
$nav_phone_clean = preg_replace('/[^0-9+]/', '', $nav_phone);
$nav_email = $gen_settings['contact_email'] ?? ($gen_settings['email_primary'] ?? ($gen_contact['email_primary'] ?? 'vels@vistas.ac.in'));
$nav_fb = $gen_contact['social_links']['facebook'] ?? ($gen_settings['social_facebook'] ?? 'https://www.facebook.com/velspharmacy');
$nav_ig = $gen_contact['social_links']['instagram'] ?? ($gen_settings['social_instagram'] ?? 'https://www.instagram.com/velspharmacy');
$nav_yt = $gen_contact['social_links']['youtube'] ?? ($gen_settings['social_youtube'] ?? 'https://www.youtube.com/@VelsUniversity');
$nav_li = $gen_contact['social_links']['linkedin'] ?? ($gen_settings['social_linkedin'] ?? 'https://www.linkedin.com/school/vistas');
$nav_tw = $gen_contact['social_links']['twitter'] ?? ($gen_settings['social_twitter'] ?? 'https://twitter.com/vistas');
$nav_apply_txt = $gen_settings['admissions_cta_text'] ?? ($gen_settings['nav_apply_text'] ?? 'Apply Now');
$nav_apply_lnk = $gen_settings['admissions_cta_url'] ?? ($gen_settings['nav_apply_link'] ?? 'enquiry');
$home_cms_data = $cms_content['home_page'] ?? [];
$nav_announcement = $home_cms_data['announcement_text'] ?? ($gen_contact['admission_status'] ?? 'Admission Open for 2024–2025 Batch: 4-Year B.Pharm Degree Program (PCI Approved) • Merit-based entry for +2 PCM/PCB students');
?>
<header class="site-header" id="siteHeader">
  <!-- Tier 1: Centered Big Official Logo with Contact Underneath & Social Icons in Top Right -->
  <div class="header-brand-row">
    <div class="header-brand-container">
      
      <!-- Center: Official Logo (Enlarged in that place itself) -->
      <div class="header-center-block">
        <a href="/" class="brand-link-centered" aria-label="Vel Pharmacy College Home">
          <img src="<?= htmlspecialchars($nav_logo) ?>" alt="Vel Pharmacy College - VISTAS" class="brand-logo-large" width="620" height="148">
        </a>
      </div>

      <!-- Top Right Corner: Follow Us + Phone & Email Directly Underneath -->
      <div class="header-top-right">
        <div class="header-top-social" aria-label="Social Media Links">
        <span class="top-social-label">Follow Us:</span>
        <div class="top-social-icons">
          <a href="<?= htmlspecialchars($nav_fb) ?>" target="_blank" rel="noopener noreferrer" class="top-social-link" aria-label="Vel Pharmacy College on Facebook" title="Facebook">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
          </a>
          <a href="<?= htmlspecialchars($nav_ig) ?>" target="_blank" rel="noopener noreferrer" class="top-social-link" aria-label="Vel Pharmacy College on Instagram" title="Instagram">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="<?= htmlspecialchars($nav_yt) ?>" target="_blank" rel="noopener noreferrer" class="top-social-link" aria-label="Vel Pharmacy College on YouTube" title="YouTube">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <a href="<?= htmlspecialchars($nav_li) ?>" target="_blank" rel="noopener noreferrer" class="top-social-link" aria-label="Vel Pharmacy College on LinkedIn" title="LinkedIn">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c-.97 0-1.75-.79-1.75-1.76s.78-1.75 1.75-1.75 1.76.78 1.76 1.75-.79 1.76-1.76 1.76m1.4 9.74v-8.37H5.06v8.37h2.8z"/></svg>
          </a>
          <a href="<?= htmlspecialchars($nav_tw) ?>" target="_blank" rel="noopener noreferrer" class="top-social-link" aria-label="Vel Pharmacy College on X" title="X (Twitter)">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
        </div>
      </div>

      <!-- Phone Number & Email ID Under Social Media Icons -->
      <div class="header-top-contact">
        <a href="tel:<?= htmlspecialchars($nav_phone_clean) ?>" class="top-contact-link" title="Call Vel Pharmacy College Admissions">
          <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
          <span><?= htmlspecialchars($nav_phone) ?></span>
        </a>
        <span class="top-contact-dot" aria-hidden="true">•</span>
        <a href="mailto:<?= htmlspecialchars($nav_email) ?>" class="top-contact-link" title="Email Vel Pharmacy College">
          <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          <span><?= htmlspecialchars($nav_email) ?></span>
        </a>
      </div>
    </div>

      <!-- Mobile Hamburger Button (visible on mobile / tablet) -->
      <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false" id="mobileNavToggle">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Tier 2: Clean Centered Navigation Bar -->
  <div class="header-nav-row">
    <div class="header-nav-container">
      <nav class="site-nav" id="siteNav" aria-label="Main Navigation">
        <ul class="nav-list">
          <li>
            <a href="/" class="nav-link <?= ($current_page === 'home') ? 'active' : '' ?>">Home</a>
          </li>
          <li>
            <a href="about-us" class="nav-link <?= ($current_page === 'about') ? 'active' : '' ?>">About Us</a>
          </li>
          <li>
            <a href="leadership" class="nav-link <?= ($current_page === 'leadership') ? 'active' : '' ?>">Leadership</a>
          </li>
          <li>
            <a href="courses" class="nav-link <?= ($current_page === 'courses') ? 'active' : '' ?>">Courses</a>
          </li>
          <li>
            <a href="faculties" class="nav-link <?= ($current_page === 'faculties') ? 'active' : '' ?>">Faculty</a>
          </li>
          <li>
            <a href="facilities" class="nav-link <?= ($current_page === 'facilities') ? 'active' : '' ?>">Facilities</a>
          </li>
          <li>
            <a href="contact-us" class="nav-link <?= ($current_page === 'contact') ? 'active' : '' ?>">Contact</a>
          </li>
        </ul>

        <a href="<?= htmlspecialchars($nav_apply_lnk) ?>" class="btn-nav-apply">
          <span><?= htmlspecialchars($nav_apply_txt) ?></span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>

        <!-- Mobile/Tablet Drawer Footer: Social Links + Phone & Email (Visible ONLY on phone/tab view) -->
        <div class="mobile-nav-contact-block" aria-label="Admissions Contact & Social">
          <div class="mobile-nav-social">
            <span class="mobile-nav-social-label">Follow Us:</span>
            <div class="mobile-nav-social-icons">
              <a href="<?= htmlspecialchars($nav_fb) ?>" target="_blank" rel="noopener noreferrer" class="mobile-social-link" aria-label="Vel Pharmacy College on Facebook" title="Facebook">
                <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
              </a>
              <a href="<?= htmlspecialchars($nav_ig) ?>" target="_blank" rel="noopener noreferrer" class="mobile-social-link" aria-label="Vel Pharmacy College on Instagram" title="Instagram">
                <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              </a>
              <a href="<?= htmlspecialchars($nav_yt) ?>" target="_blank" rel="noopener noreferrer" class="mobile-social-link" aria-label="Vel Pharmacy College on YouTube" title="YouTube">
                <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              </a>
              <a href="<?= htmlspecialchars($nav_li) ?>" target="_blank" rel="noopener noreferrer" class="mobile-social-link" aria-label="Vel Pharmacy College on LinkedIn" title="LinkedIn">
                <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c-.97 0-1.75-.79-1.75-1.76s.78-1.75 1.75-1.75 1.76.78 1.76 1.75-.79 1.76-1.76 1.76m1.4 9.74v-8.37H5.06v8.37h2.8z"/></svg>
              </a>
              <a href="<?= htmlspecialchars($nav_tw) ?>" target="_blank" rel="noopener noreferrer" class="mobile-social-link" aria-label="Vel Pharmacy College on X" title="X (Twitter)">
                <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              </a>
            </div>
          </div>
          <div class="mobile-nav-contact">
            <a href="tel:<?= htmlspecialchars($nav_phone_clean) ?>" class="mobile-contact-link" title="Call Vel Pharmacy College Admissions">
              <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
              <span><?= htmlspecialchars($nav_phone) ?></span>
            </a>
            <span class="mobile-contact-dot" aria-hidden="true">•</span>
            <a href="mailto:<?= htmlspecialchars($nav_email) ?>" class="mobile-contact-link" title="Email Vel Pharmacy College">
              <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
              <span><?= htmlspecialchars($nav_email) ?></span>
            </a>
          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- Tier 3: Announcement Marquee Bar (Integrated into Smart Header) -->
  <div class="announcement-bar" id="announcements" role="region" aria-label="College Announcements">
    <div class="announcement-container-fluid">
      <div class="announcement-inner">
        <span class="announcement-badge">Notice</span>
        <div class="announcement-marquee-track">
          <div class="announcement-content">
            <span>★ <?= htmlspecialchars($nav_announcement) ?> &bull; Merit-based entry for +2 PCM/PCB students &bull; Call Admissions: <?= htmlspecialchars($nav_phone) ?> &bull; Email: <?= htmlspecialchars($nav_email) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>★ <?= htmlspecialchars($nav_announcement) ?> &bull; Merit-based entry for +2 PCM/PCB students &bull; Call Admissions: <?= htmlspecialchars($nav_phone) ?> &bull; Email: <?= htmlspecialchars($nav_email) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>