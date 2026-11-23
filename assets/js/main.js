/**
 * Vel Pharmacy College - Main JavaScript
 * Vanilla JS only - No external dependencies
 */

document.addEventListener('DOMContentLoaded', () => {
  // 0. Initial Page Loading Screen (Vel Pharmacy Logo Animation Video)
  // Only runs on first visit to the website or when browser refresh is clicked
  const isPreloaderActive = document.documentElement.classList.contains('show-preloader');
  const preloader = document.getElementById('sitePreloader');
  const preloaderVideo = document.getElementById('preloaderVideo');
  const preloaderProgress = document.getElementById('preloaderProgress');
  const preloaderSkip = document.getElementById('preloaderSkip');

  if (isPreloaderActive && preloader && preloaderVideo) {
    let dismissed = false;

    const dismissPreloader = () => {
      if (dismissed) return;
      dismissed = true;

      // Fill progress bar completely
      if (preloaderProgress) {
        preloaderProgress.style.width = '100%';
      }

      // Smooth fade-out transition revealing the website page
      preloader.classList.add('fade-out');
      document.documentElement.classList.remove('show-preloader');
      document.body.classList.remove('preloader-active');

      setTimeout(() => {
        preloader.style.display = 'none';
        try {
          preloaderVideo.pause();
        } catch (e) {}
      }, 600);
    };

    // When the logo video finishes playing, dismiss preloader and reveal the website
    preloaderVideo.addEventListener('ended', dismissPreloader);

    // Track video playback progress bar smoothly
    preloaderVideo.addEventListener('timeupdate', () => {
      if (preloaderVideo.duration && preloaderProgress) {
        const percent = Math.min(100, Math.round((preloaderVideo.currentTime / preloaderVideo.duration) * 100));
        preloaderProgress.style.width = `${percent}%`;
      }
    });

    // Skip button allows instant entrance if clicked
    if (preloaderSkip) {
      preloaderSkip.addEventListener('click', dismissPreloader);
    }

    // Attempt video playback immediately (muted autoplay)
    const playPromise = preloaderVideo.play();
    if (playPromise !== undefined) {
      playPromise.catch(() => {
        preloaderVideo.muted = true;
        preloaderVideo.play().catch(() => {});
      });
    }

    // Safety fallback: if video doesn't end or fails to load, never leave user waiting longer than 4.6s
    const fallbackTimer = setTimeout(dismissPreloader, 4600);
    preloaderVideo.addEventListener('ended', () => clearTimeout(fallbackTimer));
    if (preloaderSkip) {
      preloaderSkip.addEventListener('click', () => clearTimeout(fallbackTimer));
    }
  } else if (preloader) {
    preloader.style.display = 'none';
    document.body.classList.remove('preloader-active');
    if (preloaderVideo) {
      try {
        preloaderVideo.pause();
      } catch (e) {}
    }
  }

  // 1. Smart Sticky Header:
  // - Official College Logo stays stationary in view at top: 0
  // - Scrolling DOWN: Menus & Notice smoothly hide (logo stays visible)
  // - Scrolling UP: Menus & Notice immediately slide back down and show
  const header = document.querySelector('.site-header');
  const siteNav = document.querySelector('.site-nav');
  if (header) {
    let lastScrollY = Math.max(0, window.pageYOffset || document.documentElement.scrollTop || 0);
    let accumulatedDelta = 0;
    let isTicking = false;
    let isTransitioning = false;
    let transitionTimer = null;

    const TOP_ZONE = 40;           // Near top: always keep logo, menus & notice fully visible
    const MIN_SCROLL_TO_HIDE = 260;// Only hide after scrolling past the header itself
    const DELTA_HIDE = 45;         // Accumulated downward scroll needed to hide
    const DELTA_SHOW = -30;        // Accumulated upward scroll needed to reveal

    const setHeaderHidden = (hidden) => {
      const isCurrentlyHidden = header.classList.contains('menu-notice-hidden');
      if (isCurrentlyHidden === hidden) return;

      if (hidden) {
        header.classList.add('menu-notice-hidden');
      } else {
        header.classList.remove('menu-notice-hidden');
      }

      accumulatedDelta = 0;
      isTransitioning = true;
      if (transitionTimer) clearTimeout(transitionTimer);
      transitionTimer = setTimeout(() => {
        isTransitioning = false;
        lastScrollY = Math.max(0, window.pageYOffset || document.documentElement.scrollTop || 0);
      }, 320);
    };

    const updateHeader = () => {
      const currentScrollY = Math.max(0, window.pageYOffset || document.documentElement.scrollTop || 0);

      // Don't auto-hide if mobile drawer is currently open
      if (siteNav && siteNav.classList.contains('active')) {
        setHeaderHidden(false);
        lastScrollY = currentScrollY;
        isTicking = false;
        return;
      }

      // Add elevated shadow when scrolled
      if (currentScrollY > 15) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      // 1. Near the top of the page: always show logo, menus & notice
      if (currentScrollY <= TOP_ZONE) {
        setHeaderHidden(false);
        lastScrollY = currentScrollY;
        isTicking = false;
        return;
      }

      // If we are currently transitioning, ignore intermediate scroll events
      if (isTransitioning) {
        lastScrollY = currentScrollY;
        isTicking = false;
        return;
      }

      const delta = currentScrollY - lastScrollY;

      // Ignore sub-pixel / micro-scroll jitter (< 2px)
      if (Math.abs(delta) < 2) {
        isTicking = false;
        return;
      }

      // 2. Only consider hiding once past the header
      if (currentScrollY > MIN_SCROLL_TO_HIDE) {
        // Reset accumulated delta if direction reverses
        if ((delta > 0 && accumulatedDelta < 0) || (delta < 0 && accumulatedDelta > 0)) {
          accumulatedDelta = 0;
        }
        accumulatedDelta += delta;

        // Scrolling DOWN: Menus & Notice smoothly hide
        if (accumulatedDelta >= DELTA_HIDE) {
          setHeaderHidden(true);
        }
        // Scrolling UP: Menus & Notice smoothly slide back down into view
        else if (accumulatedDelta <= DELTA_SHOW) {
          setHeaderHidden(false);
        }
      } else {
        // Buffer zone: if scrolling up, reveal
        if (delta < -10) {
          setHeaderHidden(false);
        }
      }

      lastScrollY = currentScrollY;
      isTicking = false;
    };

    window.addEventListener('scroll', () => {
      if (!isTicking) {
        window.requestAnimationFrame(updateHeader);
        isTicking = true;
      }
    }, { passive: true });

    window.addEventListener('resize', () => {
      if (!isTicking) {
        window.requestAnimationFrame(updateHeader);
        isTicking = true;
      }
    }, { passive: true });

    updateHeader(); // Initial check
  }

  // 2. Mobile Navigation Toggle
  const navToggle = document.querySelector('.mobile-nav-toggle');
  if (navToggle && siteNav) {
    navToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const isExpanded = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', !isExpanded);
      navToggle.classList.toggle('active', !isExpanded);
      siteNav.classList.toggle('active');
      if (siteNav.classList.contains('active') && header) {
        header.classList.remove('menu-notice-hidden');
      }
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!siteNav.contains(e.target) && !navToggle.contains(e.target) && siteNav.classList.contains('active')) {
        siteNav.classList.remove('active');
        navToggle.classList.remove('active');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });

    // Close menu when clicking any nav link
    siteNav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        siteNav.classList.remove('active');
        navToggle.classList.remove('active');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });

    // Auto-close on resize to desktop
    window.addEventListener('resize', () => {
      if (window.innerWidth > 1120 && siteNav.classList.contains('active')) {
        siteNav.classList.remove('active');
        navToggle.classList.remove('active');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // 3. Dynamic Bidirectional Scroll Reveal Animations (Up & Down Animated Scrolling across ALL pages)
  const sectionSelectors = [
    'section.section',
    'section.section-alt',
    'section.page-banner',
    '.curriculum-section',
    '.faculty-hero-section',
    '.faculty-grid-section',
    '.pillars-showcase-section',
    '.highlights-section'
  ];

  const componentSelectors = [
    '.fade-up',
    '.scroll-animate',
    '.section-header',
    '.pillars-header',
    '.pillar-card',
    '.founder-card',
    '.vm-card',
    '.course-featured-card',
    '.facility-card',
    '.why-card',
    '.placements-banner',
    '.faq-wrap',
    '.quick-facts-box',
    '.cta-banner',
    '.modern-faculty-card',
    '.faculty-stat-card',
    '.contact-info-card',
    '.contact-hub-card',
    '.contact-form-card',
    '.principal-spotlight-card',
    '.page-banner-box',
    '.group-card',
    '.highlight-item-card',
    '.curriculum-card',
    '.curriculum-overview-dual',
    '.feature-card',
    '.stat-box',
    '.anti-ragging-card',
    '.facilities-hero-grid',
    '.about-welcome-grid'
  ];

  // For any section that does not contain animated children, animate its inner container
  // Strictly skip the locked Hero section and Site Header!
  document.querySelectorAll(sectionSelectors.join(', ')).forEach(sec => {
    if (sec.closest('#heroSection') || sec.closest('.cinema-hero') || sec.closest('#siteHeader') || sec.closest('.site-header')) return;
    if (!sec.querySelector('.fade-up, .scroll-animate, .motion-from-left, .motion-from-right')) {
      const container = sec.querySelector('.container, .container-wide') || sec;
      container.classList.add('fade-up');
    }
  });

  // Ensure candidate components have an animation class if not already assigned
  document.querySelectorAll(componentSelectors.join(', ')).forEach(el => {
    if (el.closest('#heroSection') || el.closest('.cinema-hero') || el.closest('#siteHeader') || el.closest('.site-header')) return;
    if (!el.classList.contains('fade-up') && 
        !el.classList.contains('scroll-animate') && 
        !el.classList.contains('motion-from-left') && 
        !el.classList.contains('motion-from-right')) {
      el.classList.add('fade-up');
    }
  });

  // Automatic Two-Column Motion Graphic Detection (Left & Right Entrance Animations)
  const twoColSelectors = [
    '.page-banner-box',
    '.events-highlights-grid',
    '.founder-card',
    '.vm-grid',
    '.course-featured-card',
    '.placements-banner',
    '.principal-spotlight-card',
    '.facilities-hero-grid',
    '.about-welcome-grid',
    '.course-overview-dual',
    '.contact-hub-grid',
    '.contact-grid',
    '.two-col-grid',
    '.two-column-layout',
    '.dual-col-layout'
  ];

  document.querySelectorAll(twoColSelectors.join(', ')).forEach(container => {
    if (container.closest('#heroSection') || container.closest('.cinema-hero') || container.closest('#siteHeader') || container.closest('.site-header')) return;

    const directChildren = Array.from(container.children).filter(child => {
      return child.nodeType === 1 && !child.classList.contains('anchor-target') && child.tagName !== 'SPAN' && child.tagName !== 'SCRIPT';
    });

    if (directChildren.length === 2) {
      const leftEl = directChildren[0];
      const rightEl = directChildren[1];

      if (!leftEl.classList.contains('motion-from-left') && !leftEl.classList.contains('motion-from-right')) {
        leftEl.classList.remove('fade-up');
        leftEl.classList.add('motion-from-left');
      }

      if (!rightEl.classList.contains('motion-from-left') && !rightEl.classList.contains('motion-from-right')) {
        rightEl.classList.remove('fade-up');
        rightEl.classList.add('motion-from-right');
        if (!rightEl.classList.contains('delay-1')) {
          rightEl.classList.add('delay-1');
        }
      }
    }
  });

  // Dynamic Scanner for ANY 2-column horizontal container in #mainContent across all pages
  document.querySelectorAll('#mainContent section, #mainContent .container, #mainContent .container-wide').forEach(container => {
    if (container.closest('#heroSection') || container.closest('.cinema-hero')) return;

    const gridCandidates = container.querySelectorAll('div[style*="grid-template-columns: 1."], div[style*="grid-template-columns: 1fr 1fr"], div[style*="repeat(2,"]');
    gridCandidates.forEach(grid => {
      if (grid.closest('#heroSection') || grid.closest('.cinema-hero')) return;
      const children = Array.from(grid.children).filter(c => c.nodeType === 1 && !c.classList.contains('anchor-target') && c.tagName !== 'SPAN' && c.tagName !== 'SCRIPT');
      if (children.length === 2) {
        const left = children[0];
        const right = children[1];
        if (!left.classList.contains('motion-from-left') && !left.classList.contains('motion-from-right')) {
          left.classList.remove('fade-up');
          left.classList.add('motion-from-left');
        }
        if (!right.classList.contains('motion-from-left') && !right.classList.contains('motion-from-right')) {
          right.classList.remove('fade-up');
          right.classList.add('motion-from-right');
          if (!right.classList.contains('delay-1')) right.classList.add('delay-1');
        }
      }
    });
  });

  // Special enhancement for 4 Institutional Pillar cards on Home Page:
  // Cards 1 & 2 enter from left, Cards 3 & 4 enter from right!
  const pillarCards = document.querySelectorAll('.pillars-showcase-section .pillar-card');
  if (pillarCards.length === 4) {
    pillarCards[0].classList.remove('fade-up');
    pillarCards[0].classList.add('motion-from-left');
    pillarCards[1].classList.remove('fade-up');
    pillarCards[1].classList.add('motion-from-left', 'delay-1');
    pillarCards[2].classList.remove('fade-up');
    pillarCards[2].classList.add('motion-from-right', 'delay-2');
    pillarCards[3].classList.remove('fade-up');
    pillarCards[3].classList.add('motion-from-right', 'delay-3');
  }

  // Automatic staggered delays for multi-card grids (Sister Institutions, Facilities, Faculty, Highlights)
  const multiCardGrids = [
    '.groups-grid .group-card',
    '.faculty-cards-grid .modern-faculty-card',
    '.contact-info-grid .contact-info-card',
    '.amenities-grid > div',
    '.highlight-cards-grid .highlight-item-card'
  ];
  multiCardGrids.forEach(selector => {
    const cards = document.querySelectorAll(selector);
    cards.forEach((card, index) => {
      const mod = index % 3;
      if (mod === 1 && !card.classList.contains('delay-1')) card.classList.add('delay-1');
      if (mod === 2 && !card.classList.contains('delay-2')) card.classList.add('delay-2');
    });
  });

  const motionSelectors = [
    '.fade-up',
    '.scroll-animate',
    '.motion-from-left',
    '.motion-from-right',
    '.fade-in-left',
    '.fade-in-right',
    '.scroll-from-left',
    '.scroll-from-right'
  ];

  // Strictly filter out any elements inside the locked Hero section or Site Header!
  const revealElements = Array.from(document.querySelectorAll(motionSelectors.join(', '))).filter(el => {
    return !el.closest('#heroSection') && !el.closest('.cinema-hero') && !el.closest('#siteHeader') && !el.closest('.site-header');
  });

  if ('IntersectionObserver' in window && revealElements.length > 0) {
    let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
    let isScrollingDown = true;

    // Track scroll direction accurately and update states immediately
    window.addEventListener('scroll', () => {
      const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
      if (currentScrollY !== lastScrollY) {
        isScrollingDown = currentScrollY > lastScrollY;
        lastScrollY = Math.max(0, currentScrollY);
      }
      // When near the top of page, ensure visible elements are solid and in-view
      if (currentScrollY <= 240) {
        revealElements.forEach(el => {
          const r = el.getBoundingClientRect();
          if (r.top < window.innerHeight && r.bottom > 0) {
            el.classList.add('in-view');
          }
        });
      }
    }, { passive: true });

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        const el = entry.target;
        const rect = entry.boundingClientRect;

        if (entry.isIntersecting) {
          if (!el.classList.contains('in-view')) {
            if (isScrollingDown) {
              el.classList.remove('scroll-from-top');
              el.classList.add('scroll-from-bottom');
            } else {
              el.classList.remove('scroll-from-bottom');
              el.classList.add('scroll-from-top');
            }
            el.classList.add('in-view');
          }
        } else {
          // Out of viewport: ONLY reset when completely off-screen (never while visible)
          if (rect.top >= window.innerHeight) {
            // Exited off the BOTTOM of the viewport (user scrolled up past it)
            el.classList.remove('in-view');
            el.classList.remove('scroll-from-top');
            el.classList.add('scroll-from-bottom');
          } else if (rect.bottom <= 0) {
            // Fully exited off the TOP of the viewport (user scrolled down past it)
            el.classList.remove('in-view');
            el.classList.remove('scroll-from-bottom');
            el.classList.add('scroll-from-top');
          }
        }
      });
    }, {
      threshold: 0.05,
      rootMargin: '0px 0px -30px 0px'
    });

    // Initial pass: elements already in viewport are displayed immediately
    const initialVh = window.innerHeight || document.documentElement.clientHeight;
    revealElements.forEach(el => {
      const r = el.getBoundingClientRect();
      if (r.top < initialVh && r.bottom > 80) {
        el.classList.add('in-view');
      } else if (r.top >= initialVh) {
        el.classList.add('scroll-from-bottom');
      } else {
        el.classList.add('scroll-from-top');
      }
      observer.observe(el);
    });
  } else {
    // Fallback for older browsers
    revealElements.forEach(el => el.classList.add('in-view'));
  }

  // 4. FAQ Accordion
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');

    if (question && answer) {
      question.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close other open accordions in the same group
        faqItems.forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove('active');
            const otherAnswer = otherItem.querySelector('.faq-answer');
            if (otherAnswer) otherAnswer.style.maxHeight = null;
          }
        });

        if (!isActive) {
          item.classList.add('active');
          answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
          item.classList.remove('active');
          answer.style.maxHeight = null;
        }
      });
    }
  });

  // 5. Stat Counter Animation
  const counters = document.querySelectorAll('.count-up');
  if ('IntersectionObserver' in window && counters.length > 0) {
    const counterObserver = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const target = entry.target;
          const endValue = parseInt(target.getAttribute('data-target') || '0', 10);
          const duration = 1800; // ms
          const stepTime = 20;
          const totalSteps = duration / stepTime;
          const increment = endValue / totalSteps;
          let current = 0;

          const timer = setInterval(() => {
            current += increment;
            if (current >= endValue) {
              target.textContent = endValue.toLocaleString();
              clearInterval(timer);
            } else {
              target.textContent = Math.floor(current).toLocaleString();
            }
          }, stepTime);

          obs.unobserve(target);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(c => counterObserver.observe(c));
  }

  // 6. Dedicated Round Focus Section Interaction
  const heroSection = document.getElementById('heroSection');
  const cinemaRoundFocusZone = document.getElementById('cinemaRightZone');
  const cinemaVideoToggle = document.getElementById('cinemaVideoToggle');
  const collegeVideoPlayer = document.getElementById('collegeVideoPlayer');

  if (heroSection && cinemaRoundFocusZone) {
    const heroContent = heroSection.querySelector('.cinema-hero-content');
    if (heroContent) {
      heroContent.classList.add('in-view');
    }

    const setFocus = (focused) => {
      if (focused) {
        heroSection.classList.add('video-focused');
      } else {
        heroSection.classList.remove('video-focused');
      }
    };

    // WHEN MOUSE ENTERS THE FOCUS SECTION -> Video becomes bright in Video Focus Mode
    cinemaRoundFocusZone.addEventListener('mouseenter', () => {
      setFocus(true);
    });

    // WHEN MOUSE LEAVES THE FOCUS SECTION -> Video returns to dimmed default state
    cinemaRoundFocusZone.addEventListener('mouseleave', () => {
      setFocus(false);
    });

    // Interactive click / touch toggle support on the round focus target
    cinemaRoundFocusZone.addEventListener('click', (e) => {
      e.stopPropagation();
      heroSection.classList.toggle('video-focused');
    });

    cinemaRoundFocusZone.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        heroSection.classList.toggle('video-focused');
      }
    });
  }

  // 7. Cinematic College Video Hero Controller (Play / Pause Background Video)
  if (cinemaVideoToggle && collegeVideoPlayer) {
    const iconPause = cinemaVideoToggle.querySelector('.icon-pause');
    const iconPlay = cinemaVideoToggle.querySelector('.icon-play');

    const toggleVideoPlayback = (e) => {
      if (e) e.stopPropagation();
      if (collegeVideoPlayer.paused) {
        collegeVideoPlayer.play();
        if (iconPause) iconPause.style.display = 'block';
        if (iconPlay) iconPlay.style.display = 'none';
        cinemaVideoToggle.setAttribute('aria-label', 'Pause background video');
      } else {
        collegeVideoPlayer.pause();
        if (iconPause) iconPause.style.display = 'none';
        if (iconPlay) iconPlay.style.display = 'block';
        cinemaVideoToggle.setAttribute('aria-label', 'Play background video');
      }
    };

    cinemaVideoToggle.addEventListener('click', toggleVideoPlayback);

    // On phone view, allow tapping the landscape video container directly to play/pause
    const heroMedia = heroSection ? heroSection.querySelector('.cinema-hero-media') : null;
    if (heroMedia) {
      heroMedia.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
          toggleVideoPlayback(e);
        }
      });
    }
  }
});
