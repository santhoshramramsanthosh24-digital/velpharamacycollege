# Vel Pharmacy College (VPC)

> **Official Institutional Portal & Academic Content Management System (CMS)**  
> Affiliated to Vels Institute of Science, Technology & Advanced Studies (VISTAS Deemed to be University)  
> Approved by Pharmacy Council of India (PCI), New Delhi.

---

## 🏛️ Overview

Vel Pharmacy College is a premier pharmaceutical education institution offering state-of-the-art PCI-compliant B.Pharm degree programs under the modern NEP 2020 curriculum framework.

This repository contains the complete web application, including the public-facing institutional website, real-time interactive portals, and a unified enterprise CMS for non-technical administrative content publishing, SEO/GEO/AEO search intelligence, faculty management, and media asset library.

---

## ✨ Features & Architecture

### 1. Public Institutional Portal
- **Home (`index.php`)**: Hero showcase with video loop, Welcome address, 4 Core Academic Pillars, Upcoming Events & Institutional Highlights with automatic past-event date transition, Course Spotlight, 15+ Advanced Laboratories, Placements overview, and FAQs.
- **About Us (`about-us.php`)**: Institutional legacy, VISTAS university heritage, Principal's message, vision/mission, and career versatility.
- **Leadership & Governance (`leadership.php`)**: Visionary profiles including Founder Chancellor Dr. Ishari K. Ganesh, university executive leadership, and collegiate administration.
- **Courses & Curriculum (`courses.php`)**: 4-Year B.Pharm degree architecture (193 Credits, NEP 2020), 10 PCI Graduate Attributes (GA-01 to GA-10), Pharmacist's Oath, and all 8-semester course modules.
- **Research Laboratories & Facilities (`facilities.php`)**: 15+ specialized formulation and analytical suites (HPLC, UV-Vis, Pilot Plant), campus amenities, and VMCH Medical College & Hospital bedside clinical exposure.
- **Faculty Directory (`faculties.php`)**: Interactive faculty directory searchable by department, designation, and research credentials.
- **Highlights & Circulars (`highlights.php`)**: Official gazette notifications, laboratory facility commissioning records, and proceedings of concluded symposiums with modal lightbox notice previews.
- **Statutory Compliance & Anti-Ragging (`anti-ragging.php`)**: PCI and UGC mandatory disclosures, National Anti-Ragging toll-free helplines, Internal Complaints Committee (ICC), and Grievance Redressal.
- **Admissions & Contact (`contact-us.php`, `enquiry.php`)**: Interactive admission enquiry desk, route commute guidance, Google Maps campus integration, and direct admissions contact desk.

### 2. Enterprise Unified Academic CMS (`/cms/`)
- **Secure Authentication**: 256-bit SSL encrypted login with brute-force lockout, rate limiting, and CSRF protection.
- **Multi-Page Content Editor**: Real-time content editing across all 9 pages with dynamic array builders (+ Add / Remove events, highlights, notices, and facilities).
- **Interactive Media Asset Library**: Grid view with uniform aspect ratios, instant keyword search, file size and format badges, and one-click URL copy.
- **Search Intelligence Hub**: Unified command center optimizing traditional Google Search (SEO), Generative Engine AI Search (GEO for ChatGPT & Perplexity), and Answer Engine Voice Search (AEO for Siri & Google Assistant).
- **Security Audit Trail**: Timestamped logs tracking administrative updates, login sessions, and publishing activities.

---

## 🚀 Getting Started

### Prerequisites
- **PHP**: Version 8.0 or higher
- **Web Server**: Apache (with `mod_rewrite` enabled) or PHP Built-in Server

### Local Development Setup
1. Clone this repository:
   ```bash
   git clone https://github.com/santhoshramsanthosh24-tech/Velpharamacycollege.git
   cd Velpharamacycollege
   ```

2. Start the local PHP development server:
   ```bash
   php -S 127.0.0.1:8000 router.php
   ```

3. Open your browser and navigate to:
   - **Public Website**: `http://127.0.0.1:8000/`
   - **CMS Management Portal**: `http://127.0.0.1:8000/cms/`

---

## 🔒 Security & Data Integrity
- Sensitive administrator sessions are protected with CSRF tokens.
- Content data is safely persisted in the `data/` directory with `.htaccess` access restrictions preventing direct public file browsing.

---

## 📜 License
&copy; 2026 Vel Pharmacy College / Vels Institute of Science, Technology & Advanced Studies (VISTAS). All rights reserved.

