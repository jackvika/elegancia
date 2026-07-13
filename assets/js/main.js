// ============================================================
// MAIN.JS – Core functionality, counters, scroll effects
// ============================================================

(function() {
  'use strict';

  // ----- STICKY HEADER -----
  var header = document.getElementById('siteHeader');
  var lastScroll = 0;

  if (header) {
    window.addEventListener('scroll', function() {
      var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
      if (currentScroll > 80) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
      lastScroll = currentScroll;
    }, { passive: true });
  }

  // ----- SCROLL REVEAL (Intersection Observer) -----
  var revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .slide-up');

  var revealObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');

        // Check for counter inside
        var counter = entry.target.querySelector('.stat-number');
        if (counter && !counter.dataset.counted) {
          animateCounter(counter);
          counter.dataset.counted = 'true';
        }
      }
    });
  }, {
    threshold: 0.15,
    rootMargin: '0px 0px -40px 0px'
  });

  revealElements.forEach(function(el) {
    revealObserver.observe(el);
  });

  // Also observe stat cards directly
  document.querySelectorAll('.stat-card').forEach(function(card) {
    revealObserver.observe(card);
  });

  // ----- COUNTER ANIMATION -----
  function animateCounter(element) {
    var target = parseInt(element.getAttribute('data-count')) || 0;
    var duration = 1400;
    var startTime = performance.now();

    function updateCounter(currentTime) {
      var elapsed = currentTime - startTime;
      var progress = Math.min(elapsed / duration, 1);
      // Ease out cubic
      var eased = 1 - Math.pow(1 - progress, 3);
      var current = Math.floor(eased * target);

      element.textContent = current;

      if (progress < 1) {
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = target;
      }
    }

    requestAnimationFrame(updateCounter);
  }

  // Check counters that are already visible on load
  document.querySelectorAll('.stat-number:not([data-counted])').forEach(function(counter) {
    var rect = counter.closest('.stat-card')?.getBoundingClientRect();
    if (rect && rect.top < window.innerHeight) {
      animateCounter(counter);
      counter.dataset.counted = 'true';
    }
  });

  // ----- SMOOTH SCROLL FOR ANCHOR LINKS -----
  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;

      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        var headerHeight = header ? header.offsetHeight : 80;
        var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
      }
    });
  });

  // ----- PARALLAX HERO -----
  var heroBg = document.querySelector('#hero .hero-bg') || document.querySelector('.hero-bg');
  if (heroBg) {
    window.addEventListener('scroll', function() {
      var scrolled = window.pageYOffset;
      heroBg.style.transform = 'scale(1.05) translateY(' + (scrolled * 0.04) + 'px)';
    }, { passive: true });
  }

  // ----- BUTTON RIPPLE EFFECT -----
  document.querySelectorAll('.btn-primary, .btn-outline-gold, .btn-outline-light').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      var rect = this.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;

      var ripple = document.createElement('span');
      ripple.className = 'ripple-effect';
      ripple.style.cssText =
        'position:absolute;' +
        'width:60px;height:60px;' +
        'border-radius:50%;' +
        'background:rgba(213,168,81,0.15);' +
        'top:' + (y - 30) + 'px;' +
        'left:' + (x - 30) + 'px;' +
        'pointer-events:none;' +
        'transform:scale(0);' +
        'animation:rippleAnim 0.6s cubic-bezier(0.25,0.46,0.45,0.94) forwards;';

      this.style.position = 'relative';
      this.style.overflow = 'hidden';
      this.appendChild(ripple);

      setTimeout(function() {
        ripple.remove();
      }, 700);
    });
  });

  // Add ripple keyframes if not present
  if (!document.getElementById('rippleStyle')) {
    var style = document.createElement('style');
    style.id = 'rippleStyle';
    style.textContent =
      '@keyframes rippleAnim {' +
      '  to { transform: scale(2.8); opacity: 0; }' +
      '}';
    document.head.appendChild(style);
  }

  // ----- ACTIVE NAV LINK ON SCROLL -----
  var sections = document.querySelectorAll('section[id]');
  var navLinks = document.querySelectorAll('.main-nav .nav-link');

  if (sections.length && navLinks.length) {
    window.addEventListener('scroll', function() {
      var current = '';
      var scrollPos = window.pageYOffset + 120;

      sections.forEach(function(section) {
        var sectionTop = section.offsetTop;
        if (scrollPos >= sectionTop) {
          current = section.getAttribute('id');
        }
      });

      navLinks.forEach(function(link) {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
          link.classList.add('active');
        }
      });
    }, { passive: true });
  }

  console.log('Elegancia · Main JS loaded');
})();