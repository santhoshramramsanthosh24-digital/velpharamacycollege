# LOCKED SECTIONS GOVERNANCE & PROTOCOL

> **STATUS: LOCKED 🔒**  
> **Effective Immediately**  
> **Strict Two-Factor Permission Required for Any Future Modification**

---

## 1. Locked Components

The following three core website components are permanently locked against any accidental, automated, or unsolicited alterations:

### 1. Header Component
- **Files**: `includes/header.php`, `includes/nav.php`
- **Styles & Scripts**: `assets/css/style.css` (Header rules), `assets/js/main.js` (Sticky Header & Scroll Controller)
- **Included Elements**:
  - Tier 1 Brand Row: Official enlarged college logo (`.brand-logo-large`), follow us social media links, admission contact numbers & email.
  - Tier 2 Navigation Row: Main menu items (Home, About Us, Leadership, Courses, Faculty, Facilities, Contact), "Apply Now" button.
  - Mobile Navigation: Hamburger menu button (`.mobile-nav-toggle`), responsive drawer drawer.
  - Smart Sticky Scroll Behavior: Logo stays permanently in view at `top: 0`; menus hide smoothly on scroll down and immediately slide back down on scroll up.

### 2. Notice / Announcement Bar
- **File**: `includes/nav.php` (`<div class="announcement-bar" id="announcements">`)
- **Styles**: `assets/css/style.css` (`.announcement-bar`, `.announcement-marquee-track`, `.announcement-content`)
- **Included Elements**:
  - "Notice" badge
  - Infinite smooth continuous marquee text track
  - Smart scroll behavior (slides up with menu on scroll down, reappears immediately on scroll up)

### 3. Hero Section
- **File**: `index.php` (`<section class="cinema-hero" id="heroSection">`, lines ~131–235)
- **Styles & Scripts**: `assets/css/style.css` (Hero cinema rules), `assets/js/main.js` (Video playback & focus lens handlers)
- **Included Elements**:
  - Full-bleed cinematic campus background video (`assets/videos/VMCH VIDEO - SUBBHIKRISHNAN.mp4`)
  - Circular interactive video focus zone (`#cinemaRightZone`) with college emblem and lens hover effect
  - Accreditation pill badge (`ADMISSIONS OPEN | PCI Approved | VISTAS University`)
  - Main headline and lead description
  - Primary CTA ("Apply for Admissions"), Secondary CTA ("Explore Curriculum"), and Admissions Helpline pulse pill
  - Video play/pause toggle controls

---

## 2. Strict Modification Rule: 2-Step Permission Protocol

Under no circumstances should Antigravity, subagents, or automated scripts modify any code, markup, or styling belonging to the **Header**, **Notice Bar**, or **Hero Section** unless:

1. **Step 1**: The user makes an explicit request to modify one of these locked components.
2. **Step 2**: The assistant MUST halt, show what would change, and request a second explicit confirmation from the user.
3. **Execution**: ONLY after the user confirms for the **second time** ("Permission 2 / Confirmed") may changes be applied.

Without two consecutive explicit user permissions, all modification attempts will be declined and protected.

