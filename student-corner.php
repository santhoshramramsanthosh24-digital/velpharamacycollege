<?php
$current_page = 'student-corner';
$page_title = "Student Corner, Discussions, Live Events & Sports | VEL Pharmacy College";
$page_description = "Engage in student academic discussions, live webinars, innovative pharma clubs, and multi-acre sports at VEL Pharmacy College, VMCH Campus, Tiruvallur.";
$canonical_url = "https://velpharmacycollege.com/student-corner";

// Schema for Discussions and Live Events (SEO Traffic Driver)
$breadcrumb_schema = [
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
      "name" => "Student Corner & Campus Life",
      "item" => "https://velpharmacycollege.com/student-corner"
    ]
  ]
];

$custom_schema = [
  "@context" => "https://schema.org",
  "@graph" => [
    $breadcrumb_schema,
    [
      "@type" => "Event",
      "name" => "National Live Webinar: Computational Drug Discovery & Molecular Docking in Pharma R&D",
      "description" => "Interactive live academic seminar hosted by doctorate faculty and pharmaceutical data scientists for B.Pharm students.",
      "startDate" => "2026-12-05T10:00:00+05:30",
      "endDate" => "2026-12-05T13:00:00+05:30",
      "eventAttendanceMode" => "https://schema.org/OnlineEventAttendanceMode",
      "eventStatus" => "https://schema.org/EventScheduled",
      "location" => [
        "@type" => "VirtualLocation",
        "url" => "https://velpharmacycollege.com/student-corner#live-events"
      ],
      "organizer" => [
        "@type" => "CollegeOrUniversity",
        "name" => "VEL Pharmacy College",
        "url" => "https://velpharmacycollege.com"
      ]
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => [
        [
          "@type" => "Question",
          "name" => "How does the on-campus 300-bed VMCH Hospital clinical exposure help B.Pharm students?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "Unlike standalone colleges with no hospital access, students at VEL Pharmacy College participate in direct bedside ward rounds, medication therapy reviews, and adverse drug reaction reporting at the on-campus Velammal Medical College Hospital (VMCH)."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "Do undergraduate students get hands-on access to HPLC and UV-Vis spectroscopy?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "Yes. Under doctorate faculty supervision, undergraduate B.Pharm students operate High-Performance Liquid Chromatography (HPLC) and UV-Visible spectrophotometers for practical coursework, drug formulation assays, and capstone research dissertations."
          ]
        ],
        [
          "@type" => "Question",
          "name" => "What sports and athletic facilities are available on the campus?",
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => "The multi-acre VMCH Campus features a full cricket ground, football pitch, outdoor volleyball and badminton courts, athletic tracks, and an indoor games pavilion with modern fitness gym facilities."
          ]
        ]
      ]
    ]
  ]
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main id="mainContent">
  <!-- PAGE HERO BANNER -->
  <section class="page-banner" aria-label="Student Corner Banner">
    <div class="page-banner-container">
      <div class="page-banner-content">
        <nav class="breadcrumb-nav" aria-label="Breadcrumb">
          <a href="/" class="breadcrumb-link">Home</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current" aria-current="page">Student Corner</span>
        </nav>
        <h1 class="page-title">Student Corner, Campus Life &amp; Sports</h1>
        <p class="page-subtitle">
          A dynamic academic sanctuary blending peer scientific discussions, live webinars, student-led innovation clubs, and spirited athletics across our multi-acre VMCH Campus.
        </p>
      </div>
      <div class="page-banner-media">
        <div class="page-banner-img-frame">
          <img src="assets/images/sports-ground.jpg" alt="VEL Pharmacy College Student Life & Sports Ground" class="page-banner-img" loading="eager" width="480" height="250">
        </div>
      </div>
    </div>
  </section>

  <!-- QUICK NAVIGATION STRIP -->
  <div style="background: #1E6A4D; padding: 0.85rem 1rem; border-bottom: 2px solid #D6B56D;">
    <div class="container" style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
      <a href="#discussions" style="color: #F5F7F4; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D6B56D" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span>Student Discussions</span>
      </a>
      <a href="#live-events" style="color: #F5F7F4; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D6B56D" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
        <span>Live Events &amp; Webinars</span>
      </a>
      <a href="#clubs" style="color: #F5F7F4; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D6B56D" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
        <span>Student Clubs</span>
      </a>
      <a href="#sports" style="color: #F5F7F4; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D6B56D" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
        <span>Sports Corner</span>
      </a>
    </div>
  </div>

  <!-- SECTION 1: STUDENT CORNER & ACADEMIC DISCUSSIONS -->
  <section class="section" id="discussions" aria-labelledby="discussionsTitle">
    <div class="container">
      <div class="section-header fade-up">
        <span class="section-subtitle">PEER DISCOURSE &amp; MENTORSHIP</span>
        <h2 class="section-title" id="discussionsTitle">Student Academic Corner &amp; Discussions</h2>
        <p class="section-description">
          Ask questions, discuss pharmaceutical research, learn from senior peers, and connect directly with doctorate mentors in our collaborative student discussion forum.
        </p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
        
        <!-- Left: Discussion Threads Feed -->
        <div>
          <!-- Thread 1 -->
          <div class="discussion-thread-card fade-up">
            <div class="discussion-meta-row">
              <span class="discussion-tag">Clinical Practice</span>
              <span>Updated Today</span>
              <span>&bull; 24 Answers</span>
            </div>
            <h3 class="discussion-title">
              How does on-campus VMCH Hospital clinical exposure help in 3rd &amp; 4th Year B.Pharm?
            </h3>
            <p class="discussion-excerpt">
              "Students at VEL Pharmacy College gain immediate daily ward rounds, prescription analysis, patient counseling, and therapeutic drug monitoring right next door at the 300-bed hospital, giving real-world clinical confidence before graduation."
            </p>
            <div style="margin-top: 0.85rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
              Answered by: Dr. G. Saravanan (Principal) &amp; Final Year Student Council
            </div>
          </div>

          <!-- Thread 2 -->
          <div class="discussion-thread-card fade-up">
            <div class="discussion-meta-row">
              <span class="discussion-tag">Research Labs</span>
              <span>Active Thread</span>
              <span>&bull; 18 Answers</span>
            </div>
            <h3 class="discussion-title">
              Hands-on HPLC &amp; UV-Vis spectroscopy access for undergraduate projects
            </h3>
            <p class="discussion-excerpt">
              "Undergraduate students at VPC are trained to independently operate isocratic and gradient HPLC systems, prepare mobile phases, and record UV spectra for their final-year research thesis."
            </p>
            <div style="margin-top: 0.85rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
              Answered by: Dept. of Pharmaceutical Chemistry &amp; Analysis
            </div>
          </div>

          <!-- Thread 3 -->
          <div class="discussion-thread-card fade-up">
            <div class="discussion-meta-row">
              <span class="discussion-tag">NEP 2020 AI</span>
              <span>Curriculum Insights</span>
              <span>&bull; 31 Answers</span>
            </div>
            <h3 class="discussion-title">
              Molecular docking, Python &amp; Machine Learning in Pharmacy: Career pathways
            </h3>
            <p class="discussion-excerpt">
              "How the integration of computational drug discovery (AutoDock, PyMOL) and Python in NEP 2020 prepares VPC graduates for lucrative roles in clinical data analytics and computational biology MNCs."
            </p>
            <div style="margin-top: 0.85rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
              Answered by: Faculty Coordinator, Bioinformatics &amp; CADD Lab
            </div>
          </div>

          <!-- Thread 4 -->
          <div class="discussion-thread-card fade-up">
            <div class="discussion-meta-row">
              <span class="discussion-tag">Entrance Exam</span>
              <span>GPAT / NIPER</span>
              <span>&bull; 42 Answers</span>
            </div>
            <h3 class="discussion-title">
              Free GPAT &amp; NIPER coaching circles organized by doctorate faculty
            </h3>
            <p class="discussion-excerpt">
              "Weekly mock assessments, previous year question paper discussions, and high-yield pharmacology mnemonic workshops conducted on Saturdays for aspiring post-graduates."
            </p>
            <div style="margin-top: 0.85rem; font-size: 0.85rem; color: #1E6A4D; font-weight: 700;">
              Answered by: Academic Development Cell
            </div>
          </div>
        </div>

        <!-- Right: Submit Query / Join Discussion Box -->
        <div>
          <div style="background: #FFFFFF; border: 2px solid #D6B56D; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.06); position: sticky; top: 100px;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
              <div style="width: 44px; height: 44px; border-radius: 10px; background: #1E6A4D; color: #D6B56D; display: flex; align-items: center; justify-content: center;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              </div>
              <div>
                <h3 style="font-family: var(--font-heading); font-size: 1.2rem; color: #1E6A4D; margin: 0;">Have a Question?</h3>
                <span style="font-size: 0.85rem; color: #718096;">Ask students &amp; professors directly</span>
              </div>
            </div>

            <p style="font-size: 0.92rem; color: #4A5568; line-height: 1.6; margin-bottom: 1.25rem;">
              Whether you are a prospective student asking about B.Pharm eligibility or a current student seeking research guidance, submit your query here:
            </p>

            <form action="enquiry-form.php" method="POST" style="display: flex; flex-direction: column; gap: 0.85rem;">
              <input type="text" name="name" required placeholder="Your Name" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #CBD5E0; border-radius: 8px; font-size: 0.92rem;">
              <input type="email" name="email" required placeholder="Email Address" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #CBD5E0; border-radius: 8px; font-size: 0.92rem;">
              <select name="topic" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #CBD5E0; border-radius: 8px; font-size: 0.92rem;">
                <option value="Admissions">Admissions &amp; Course Eligibility</option>
                <option value="Research">Research Labs &amp; Instrumentation (HPLC/UV)</option>
                <option value="Hospital">Hospital Immersion &amp; Internships</option>
                <option value="Clubs">Student Clubs &amp; Campus Sports</option>
              </select>
              <textarea name="question" rows="3" required placeholder="Type your question or topic here..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #CBD5E0; border-radius: 8px; font-size: 0.92rem;"></textarea>
              <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem;">
                <span>Post Query to Student Academic Cell</span>
              </button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 2: LIVE EVENTS & WEBINARS -->
  <section class="section section-alt" id="live-events" aria-labelledby="liveEventsTitle">
    <div class="container">
      <div class="section-header fade-up">
        <span class="section-subtitle" style="color: #D6B56D;">KNOWLEDGE SHARING &amp; SYMPOSIA</span>
        <h2 class="section-title" id="liveEventsTitle">Live Events, Guest Lectures &amp; Symposia</h2>
        <p class="section-description" style="color: rgba(255,255,255,0.88);">
          Stay up-to-date with international academic webinars, clinical grand rounds, hands-on instrumentation workshops, and national student seminars.
        </p>
      </div>

      <div style="max-width: 900px; margin: 0 auto;">
        
        <!-- Event 1 -->
        <div class="event-live-card fade-up">
          <div class="event-date-box">
            <div class="event-date-day">05</div>
            <div class="event-date-month">DEC 2026</div>
          </div>
          <div class="event-details-col">
            <span class="event-badge-live">Live Webinar</span>
            <h3 class="event-title-h3">
              Computational Drug Discovery: Molecular Docking &amp; AI Screening in Modern R&amp;D
            </h3>
            <div class="event-meta-info">
              <span><strong>Time:</strong> 10:00 AM – 01:00 PM</span>
              <span><strong>Speaker:</strong> Dr. V. Arunkumar (Pharma Informatics Lead)</span>
              <span><strong>Platform:</strong> Zoom Live Stream + Lab Workstation</span>
            </div>
            <p style="font-size: 0.92rem; color: #4A5568; line-height: 1.55; margin: 0 0 0.75rem;">
              Demonstration of AutoDock Vina protein-ligand binding calculations, PyMOL 3D modeling, and real-time virtual screening for antiviral targets.
            </p>
            <a href="enquiry" class="btn btn-primary" style="padding: 0.45rem 1rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem;">
              <span>Register for Webinar</span>
            </a>
          </div>
        </div>

        <!-- Event 2 -->
        <div class="event-live-card fade-up">
          <div class="event-date-box" style="background: #154e38;">
            <div class="event-date-day">12</div>
            <div class="event-date-month">DEC 2026</div>
          </div>
          <div class="event-details-col">
            <span style="background: #1E6A4D; color: #D6B56D; font-size: 0.75rem; font-weight: 700; padding: 0.2rem 0.5rem; border-radius: 10px; text-transform: uppercase;">Hospital Grand Round</span>
            <h3 class="event-title-h3">
              Bedside Clinical Pharmacy &amp; Adverse Drug Reaction (ADR) Monitoring
            </h3>
            <div class="event-meta-info">
              <span><strong>Time:</strong> 09:30 AM – 12:30 PM</span>
              <span><strong>Venue:</strong> VMCH Teaching Hospital IPD Wards</span>
              <span><strong>Participants:</strong> B.Pharm 3rd &amp; 4th Year Cohorts</span>
            </div>
            <p style="font-size: 0.92rem; color: #4A5568; line-height: 1.55; margin: 0 0 0.75rem;">
              Hands-on hospital clinical training evaluating real patient charts, antibiotic stewardship programs, and therapeutic pharmacokinetics under consultant clinicians.
            </p>
            <a href="facilities#hospital" class="btn btn-outline" style="padding: 0.45rem 1rem; font-size: 0.85rem; border-color: #1E6A4D; color: #1E6A4D;">
              <span>View Hospital Details</span>
            </a>
          </div>
        </div>

        <!-- Event 3 -->
        <div class="event-live-card fade-up">
          <div class="event-date-box">
            <div class="event-date-day">20</div>
            <div class="event-date-month">DEC 2026</div>
          </div>
          <div class="event-details-col">
            <span style="background: #D6B56D; color: #1E6A4D; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.5rem; border-radius: 10px; text-transform: uppercase;">Instrumentation Workshop</span>
            <h3 class="event-title-h3">
              Practical Masterclass: HPLC Method Validation &amp; UV-Vis Dissolution Kinetics
            </h3>
            <div class="event-meta-info">
              <span><strong>Time:</strong> 10:00 AM – 03:00 PM</span>
              <span><strong>Venue:</strong> Central Analytical Instrumentation Suite</span>
              <span><strong>Mentor:</strong> Doctorate Analytical Chemistry Faculty</span>
            </div>
            <p style="font-size: 0.92rem; color: #4A5568; line-height: 1.55; margin: 0 0 0.75rem;">
              Step-by-step hands-on instrumentation session covering column conditioning, gradient mobile phase preparation, detector baseline stabilization, and peak integration.
            </p>
            <a href="facilities#labs" class="btn btn-primary" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
              <span>Explore Research Lab</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 3: CAMPUS LIFE & STUDENT CLUBS -->
  <section class="section" id="clubs" aria-labelledby="clubsTitle">
    <div class="container">
      <div class="section-header fade-up">
        <span class="section-subtitle">COMMUNITY &amp; CREATIVITY</span>
        <h2 class="section-title" id="clubsTitle">Campus Life &amp; Student Clubs</h2>
        <p class="section-description">
          Develop holistic leadership, scientific innovation, artistic flair, and public health commitment through our vibrant student-driven collegiate clubs.
        </p>
      </div>

      <div class="student-life-grid">
        
        <!-- Club 1 -->
        <div class="student-feature-card fade-up">
          <div class="student-feature-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.31"/><path d="M14 9.3V1.99"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/></svg>
          </div>
          <h3 class="student-feature-title">Pharma Innovators Club</h3>
          <p class="student-feature-desc">
            A student-led incubator for novel formulation ideas, research poster presentations, herbal extraction experiments, and patent literacy workshops.
          </p>
          <div style="background: #F5F7F4; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; color: #1E6A4D; font-weight: 600;">
            Key Activity: Annual "Pharma Pitch" Innovation Challenge &amp; Student Research Poster Awards.
          </div>
        </div>

        <!-- Club 2 -->
        <div class="student-feature-card fade-up">
          <div class="student-feature-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
          </div>
          <h3 class="student-feature-title">Pharmacovigilance &amp; Clinical Society</h3>
          <p class="student-feature-desc">
            Focuses on patient safety, adverse drug reaction monitoring, mock clinical trial protocols, and community health counseling in coordination with VMCH clinicians.
          </p>
          <div style="background: #F5F7F4; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; color: #1E6A4D; font-weight: 600;">
            Key Activity: Monthly Hospital Patient Counseling Drives &amp; Drug Information Bulletins.
          </div>
        </div>

        <!-- Club 3 -->
        <div class="student-feature-card fade-up">
          <div class="student-feature-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="12 8 8 12 12 16 16 12 12 8"/></svg>
          </div>
          <h3 class="student-feature-title">Cultural &amp; Fine Arts Society</h3>
          <p class="student-feature-desc">
            Enriches campus life with music, dance, theater, photography, literary debates, and the annual grand collegiate festival celebrating Tamil and Indian heritage.
          </p>
          <div style="background: #F5F7F4; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; color: #1E6A4D; font-weight: 600;">
            Key Activity: Annual "VEL PHARMA FEST" Cultural Championship &amp; Talent Showcases.
          </div>
        </div>

        <!-- Club 4 -->
        <div class="student-feature-card fade-up">
          <div class="student-feature-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </div>
          <h3 class="student-feature-title">Red Ribbon &amp; Community Outreach Wing</h3>
          <p class="student-feature-desc">
            Organizes rural health awareness campaigns, free blood pressure/diabetes screenings, blood donation camps, and community hygiene initiatives in Tiruvallur villages.
          </p>
          <div style="background: #F5F7F4; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; color: #1E6A4D; font-weight: 600;">
            Key Activity: Rural Public Health Immersion Camps in partnership with VMCH Hospital.
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 4: SPORTS CORNER & ATHLETICS -->
  <section class="section section-alt" id="sports" aria-labelledby="sportsTitle">
    <div class="container">
      <div class="section-header fade-up">
        <span class="section-subtitle" style="color: #D6B56D;">FITNESS, TEAMWORK &amp; GLORY</span>
        <h2 class="section-title" id="sportsTitle">Sports Corner &amp; Multi-Acre Athletics</h2>
        <p class="section-description" style="color: rgba(255,255,255,0.88);">
          Physical vigor and mental agility thrive together at VEL Pharmacy College. Our multi-acre campus offers expansive outdoor grounds and modern indoor sports facilities.
        </p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div class="why-better-card fade-up">
          <div class="why-better-header">
            <div class="why-better-icon">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
            </div>
            <div>
              <span class="why-better-num">Outdoor Athletics</span>
              <h3 class="why-better-title">Cricket &amp; Football Grounds</h3>
            </div>
          </div>
          <p class="why-better-desc">
            Dedicated full-sized turf cricket pitch with practice nets, FIFA-standard football ground, and running track for track and field athletics events.
          </p>
          <div class="why-better-comparison">
            <strong>Annual Highlights:</strong>
            Annual Vels Chancellor Trophy Cricket Cup and Inter-Institutional Football League.
          </div>
        </div>

        <div class="why-better-card fade-up">
          <div class="why-better-header">
            <div class="why-better-icon">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            </div>
            <div>
              <span class="why-better-num">Court Sports</span>
              <h3 class="why-better-title">Volleyball &amp; Badminton Courts</h3>
            </div>
          </div>
          <p class="why-better-desc">
            Floodlit synthetic and clay volleyball courts, outdoor basketball arena, and professional badminton courts for evening matches and collegiate tournaments.
          </p>
          <div class="why-better-comparison">
            <strong>Regular Practice:</strong>
            Coached training sessions every weekday evening with collegiate sports trainers.
          </div>
        </div>

        <div class="why-better-card fade-up">
          <div class="why-better-header">
            <div class="why-better-icon">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            </div>
            <div>
              <span class="why-better-num">Indoor Complex</span>
              <h3 class="why-better-title">Gymnasium &amp; Indoor Games</h3>
            </div>
          </div>
          <p class="why-better-desc">
            Fully equipped modern strength and cardio gymnasium, table tennis arenas, chess rooms, and carrom boards inside the student activity pavilion.
          </p>
          <div class="why-better-comparison">
            <strong>Wellness &amp; Health:</strong>
            Free access for all residential hostelers and day-scholars with fitness trainers.
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 5: CAMPUS LIFE PHOTO GALLERY -->
  <section class="section" aria-labelledby="galleryTitle">
    <div class="container-wide">
      <div class="section-header fade-up">
        <span class="section-subtitle">VISUAL WALKTHROUGH</span>
        <h2 class="section-title" id="galleryTitle">Moments from Campus Life</h2>
        <p class="section-description">
          A glimpse into the daily rhythm of scientific inquiry, student collaborations, and athletic achievements at VEL Pharmacy College.
        </p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
        <div style="border-radius: 14px; overflow: hidden; height: 240px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
          <img src="assets/images/research-lab-modern.jpg" alt="VEL Pharmacy College Research Laboratory" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
        <div style="border-radius: 14px; overflow: hidden; height: 240px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
          <img src="assets/images/sports-ground.jpg" alt="VEL Pharmacy College Sports Ground" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
        <div style="border-radius: 14px; overflow: hidden; height: 240px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
          <img src="assets/images/seminar-hall.jpg" alt="VEL Pharmacy College Seminar Hall & Conferences" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
        <div style="border-radius: 14px; overflow: hidden; height: 240px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
          <img src="assets/images/library-main.jpg" alt="VEL Pharmacy College Central Library" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 6: ADMISSIONS CTA BANNER -->
  <section class="section" style="padding-top: 0; padding-bottom: 5.5rem; background: #FFFFFF;">
    <div class="container">
      <div class="cta-banner fade-up">
        <h2>Experience Vibrant Campus Life at VEL Pharmacy College</h2>
        <p>
          Admissions are open for the 2024–2025 academic batch. Connect with our admissions counselors and student mentors today.
        </p>
        <div class="cta-actions">
          <a href="enquiry" class="btn btn-gold">
            <span>Apply for B.Pharm 2024–25</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
          <a href="contact-us" class="btn btn-outline-white">
            <span>Schedule Campus Visit</span>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

