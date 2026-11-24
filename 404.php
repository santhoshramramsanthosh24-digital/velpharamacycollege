<?php
$current_page = '404';
$page_title = "404 - Page Not Found | Vel Pharmacy College";
$page_description = "The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Browse Vel Pharmacy College programs and facilities.";
$canonical_url = "https://velpharmacycollege.com/404";

include __DIR__ . '/includes/header.php';
?>

<section class="section" style="min-height: 65vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 5rem 1rem 5.5rem; background: #FFFFFF;">
  <div class="container" style="max-width: 680px;">
    
    <div style="font-size: 7rem; font-weight: 900; font-family: var(--font-heading); color: var(--color-primary); line-height: 1; margin-bottom: 1rem; text-shadow: 2px 4px 10px rgba(30, 58, 138, 0.15);">
      404
    </div>

    <span class="badge-pill badge-maroon" style="margin-bottom: 1.25rem; display: inline-block;">Page Not Found</span>

    <h1 style="font-family: var(--font-heading); font-size: 2.25rem; color: var(--color-primary-dark); margin-bottom: 1rem;">
      Oops! We Couldn't Find That Page
    </h1>

    <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 2.5rem;">
      The page you requested may have moved, been renamed, or is temporarily unavailable. Explore our key sections below:
    </p>

    <!-- Quick Links Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; margin-bottom: 2.5rem;">
      <a href="/" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        🏠 Home
      </a>
      <a href="about-us" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        ℹ️ About Us
      </a>
      <a href="courses" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        🎓 B.Pharm
      </a>
      <a href="faculties" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        👨‍🏫 Faculty
      </a>
      <a href="facilities" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        🔬 Facilities
      </a>
      <a href="contact-us" style="background: var(--color-bg-alt); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-tertiary-light); font-weight: 600; color: var(--color-primary-dark); display: block; transition: all 0.2s ease;">
        📞 Contact
      </a>
    </div>

    <div>
      <a href="/" class="btn btn-primary" style="padding: 0.85rem 2rem;">
        <span>Return to Homepage</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
      </a>
    </div>

  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
