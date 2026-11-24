</main> <!-- End of mainContent -->

<?php
$foot_settings = $gen_settings ?? ($cms_content['general_settings'] ?? []);
$foot_contact = $gen_contact ?? ($cms_content['general_contact'] ?? []);
$f_about = $foot_settings['footer_about'] ?? ($foot_settings['footer_about_text'] ?? 'Established in 2024–25 as an off-campus center of Vels Institute of Science, Technology & Advanced Studies (VISTAS Deemed University) in the VMCH Campus, Manjankaranai. Approved by the Pharmacy Council of India (PCI), New Delhi.');
$f_badge1 = $foot_settings['naac_badge'] ?? ($foot_settings['footer_badge_1'] ?? '30+ Yrs Legacy');
$f_badge2 = $foot_settings['pci_badge'] ?? ($foot_settings['footer_badge_2'] ?? '11 Campuses');
$f_phone = $foot_settings['contact_phone'] ?? ($foot_settings['phone_primary'] ?? ($foot_contact['phone_primary'] ?? '+91 812 261 3300'));
$f_phone_clean = preg_replace('/[^0-9+]/', '', $f_phone);
$f_email = $foot_settings['contact_email'] ?? ($foot_settings['email_primary'] ?? ($foot_contact['email_primary'] ?? 'vels@vistas.ac.in'));
$f_address = $foot_contact['address_full'] ?? ($foot_settings['campus_address'] ?? ($foot_contact['campus_address'] ?? 'VMCH Campus, No.12/123, Periyapalayam Road, Velan Nagar, Manjankaranai Village, Uthukottai Taluk, Tiruvallur District – 601102, Tamil Nadu, India'));
$f_tollfree = $foot_settings['toll_free'] ?? ($foot_settings['anti_ragging_tollfree'] ?? ($foot_contact['anti_ragging_tollfree'] ?? '1800-180-5522'));
$f_tollfree_clean = preg_replace('/[^0-9+]/', '', $f_tollfree);
$f_copy = $foot_settings['copyright'] ?? ($foot_settings['footer_copyright'] ?? 'VEL Pharmacy College. All Rights Reserved. Member institution of VISTAS.');
$f_fb = $foot_settings['social_facebook'] ?? 'https://www.facebook.com/velspharmacy';
$f_ig = $foot_settings['social_instagram'] ?? 'https://www.instagram.com/velspharmacy';
$f_yt = $foot_settings['social_youtube'] ?? 'https://www.youtube.com/@VelsUniversity';
$f_li = $foot_settings['social_linkedin'] ?? 'https://www.linkedin.com/school/vistas';
$f_tw = $foot_settings['social_twitter'] ?? 'https://twitter.com/vistas';
?>
<footer class="site-footer" role="contentinfo">
  <!-- Pre-Footer Institutional Trust Strip -->
  <!--<div class="footer-trust-strip">
    <div class="container-wide">
      <div class="footer-trust-grid">
        <div class="footer-trust-item">
          <div class="footer-trust-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
          </div>
          <div>
            <strong>PCI Statutory Approval</strong>
            <span>Pharmacy Council of India, New Delhi</span>
          </div>
        </div>
        <div class="footer-trust-item">
          <div class="footer-trust-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <div>
            <strong>VISTAS Deemed University</strong>
            <span>Off-Campus Centre • 30+ Yrs Legacy</span>
          </div>
        </div>
        <div class="footer-trust-item">
          <div class="footer-trust-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 9v4"/><path d="M10 11h4"/></svg>
          </div>
          <div>
            <strong>VMCH Teaching Hospital</strong>
            <span>300+ Bed Multi-Speciality Exposure</span>
          </div>
        </div>
        <div class="footer-trust-item">
          <div class="footer-trust-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div>
            <strong>NEP 2020 B.Pharm Syllabus</strong>
            <span>193 Credits with Python, ML &amp; AI</span>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <div class="footer-main-area">
    <div class="container-wide">
      <div class="footer-grid">
        <!-- Col 1: Brand & Institution -->
        <div class="footer-widget footer-about">
          <a href="/" class="footer-brand-badge" title="VEL Pharmacy College Home">
            <img src="assets/images/VPC NEW LOGO.jpeg" alt="VEL Pharmacy College" height="52" loading="lazy">
          </a>
          <h4 class="footer-brand-title">VEL Pharmacy College</h4>
          <div class="footer-brand-sub">Under Vels Institute of Science, Technology &amp; Advanced Studies (VISTAS)
          </div>
          <p>
            <?= htmlspecialchars($f_about) ?>
          </p>
          <div class="footer-badges-row">
            <span class="f-badge f-badge-pci">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              PCI Approved
            </span>
            <span class="f-badge f-badge-legacy">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
              <?= htmlspecialchars($f_badge1) ?>
            </span>
          </div>
          <div class="footer-social-row">
            <?php if (!empty($f_fb)): ?>
              <a href="<?= htmlspecialchars($f_fb) ?>" target="_blank" rel="noopener noreferrer" class="f-social-btn"
                aria-label="Facebook">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                </svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($f_ig)): ?>
              <a href="<?= htmlspecialchars($f_ig) ?>" target="_blank" rel="noopener noreferrer" class="f-social-btn"
                aria-label="Instagram">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                </svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($f_yt)): ?>
              <a href="<?= htmlspecialchars($f_yt) ?>" target="_blank" rel="noopener noreferrer" class="f-social-btn"
                aria-label="YouTube">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />
                  <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#1E6A4D" />
                </svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($f_li)): ?>
              <a href="<?= htmlspecialchars($f_li) ?>" target="_blank" rel="noopener noreferrer" class="f-social-btn"
                aria-label="LinkedIn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                  <rect x="2" y="9" width="4" height="12" />
                  <circle cx="4" cy="4" r="2" />
                </svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($f_tw)): ?>
              <a href="<?= htmlspecialchars($f_tw) ?>" target="_blank" rel="noopener noreferrer" class="f-social-btn"
                aria-label="X / Twitter">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                </svg>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Col 2: Quick Links (7 items) -->
        <div class="footer-widget">
          <h4>Quick Links</h4>
          <ul class="footer-links">
            <li><a href="/"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Home</span></a></li>
            <li><a href="about-us"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>About Us &amp; Vision</span></a></li>
            <li><a href="leadership"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Leadership &amp; Founder</span></a></li>
            <li><a href="courses"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>B.Pharm Degree Program</span></a></li>
            <li><a href="faculties"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Faculty Directory</span></a></li>
            <li><a href="facilities"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Campus &amp; Laboratories</span></a></li>
            <li><a href="contact-us"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Contact &amp; Location</span></a></li>
          </ul>
        </div>

        <!-- Col 3: Academics & Statutory (7 items) -->
        <div class="footer-widget">
          <h4>Academics &amp; Statutory</h4>
          <ul class="footer-links">
            <li><a href="courses#eligibility"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Eligibility (+2 PCM/PCB)</span></a></li>
            <li><a href="courses#curriculum"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>PCI NEP 2020 Syllabus</span></a></li>
            <li><a href="facilities#hospital"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>VMCH Hospital Immersion</span></a></li>
            <li><a href="facilities#placements"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Placement Cell @ VISTAS</span></a></li>
            <li><a href="anti-ragging"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Anti-Ragging Committee</span></a></li>
            <li><a href="highlights"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Institutional Circulars</span></a></li>
            <li><a href="enquiry"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6" />
                </svg><span>Online Admission Enquiry</span></a></li>
          </ul>
        </div>

        <!-- Col 4: Campus & Helpdesk -->
        <div class="footer-widget">
          <h4>Campus &amp; Helpdesk</h4>
          <div class="footer-contact-list">
            <div class="footer-contact-card">
              <div class="footer-contact-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
              </div>
              <div class="footer-contact-info">
                <strong>Campus Address</strong>
                <?= nl2br(htmlspecialchars($f_address)) ?>
                <a href="https://maps.google.com/?q=13.2921,80.0894" target="_blank" rel="noopener noreferrer"
                  class="footer-map-btn">
                  <span>Open in Google Maps</span>
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                    <polyline points="15 3 21 3 21 9" />
                    <line x1="10" y1="14" x2="21" y2="3" />
                  </svg>
                </a>
              </div>
            </div>

            <div class="footer-contact-card">
              <div class="footer-contact-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
              </div>
              <div class="footer-contact-info">
                <strong>Admissions Helpline</strong>
                <a href="tel:<?= htmlspecialchars($f_phone_clean) ?>"><?= htmlspecialchars($f_phone) ?></a>
              </div>
            </div>

            <div class="footer-contact-card">
              <div class="footer-contact-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg>
              </div>
              <div class="footer-contact-info">
                <strong>Official Email</strong>
                <a href="mailto:<?= htmlspecialchars($f_email) ?>"><?= htmlspecialchars($f_email) ?></a>
              </div>
            </div>

            <div class="footer-anti-ragging-card">
              <div class="footer-ar-icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
              </div>
              <div class="footer-ar-text">
                <strong>24×7 Anti-Ragging Toll-Free</strong>
                <a href="tel:<?= htmlspecialchars($f_tollfree_clean) ?>"><?= htmlspecialchars($f_tollfree) ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Professional Bottom Copyright & Statutory Bar -->
  <div class="footer-bottom">
    <div class="container-wide">
      <div class="footer-bottom-inner">
        <div>
          &copy; <?= date('Y'); ?> <strong>VEL Pharmacy College</strong>. All Rights Reserved. Member institution of
          VISTAS Deemed to be University.
        </div>
        <ul class="footer-bottom-links">
          <li><a href="anti-ragging">Anti-Ragging Policy</a></li>
          <li class="sep" aria-hidden="true">•</li>
          <li><a href="courses">PCI Disclosure</a></li>
          <li class="sep" aria-hidden="true">•</li>
          <li><a href="contact-us">Privacy &amp; Terms</a></li>
        </ul>
        <!--<div class="footer-bottom-right">
          <a href="cms/login.php" class="footer-staff-btn" title="Secure Staff Portal">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
              <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
            <span>Staff Portal</span>
          </a>
          <button type="button" class="footer-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            title="Back to Top" aria-label="Scroll to top of page">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="18 15 12 9 6 15" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Core JavaScript with cache-busting -->
        <script src="assets/js/main.js?v=<?= time() ?>"></script>
        </body>

        </html>