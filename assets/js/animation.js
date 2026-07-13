// ============================================================
// ANIMATION.JS – Additional animations & micro-interactions
// ============================================================

(function() {
  'use strict';

  // ----- ENHANCED SCROLL REVEAL FOR STAGGER ELEMENTS -----
  var staggerElements = document.querySelectorAll('.reveal-stagger');

  var staggerObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        // Add visible class with staggered delay
        setTimeout(function() {
          entry.target.classList.add('visible');
        }, 50);
      }
    });
  }, {
    threshold: 0.15,
    rootMargin: '0px 0px -40px 0px'
  });

  staggerElements.forEach(function(el) {
    staggerObserver.observe(el);
  });

  // ----- IMAGE REVEAL ON SCROLL -----
  var imgReveals = document.querySelectorAll('.img-reveal');

  var imgObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        var img = entry.target.querySelector('img');
        if (img) {
          img.style.transform = 'scale(1)';
        }
      }
    });
  }, { threshold: 0.2, rootMargin: '0px 0px -40px 0px' });

  imgReveals.forEach(function(el) {
    var img = el.querySelector('img');
    if (img) {
      img.style.transform = 'scale(1.06)';
      img.style.transition = 'transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    }
    imgObserver.observe(el);
  });

  // ----- GLASS CARD GLOW -----
  document.querySelectorAll('.glass-card, .hero-badge').forEach(function(el) {
    el.addEventListener('mousemove', function(e) {
      var rect = this.getBoundingClientRect();
      var x = (e.clientX - rect.left) / rect.width;
      var y = (e.clientY - rect.top) / rect.height;
      var glowX = (x - 0.5) * 20;
      var glowY = (y - 0.5) * 20;
      this.style.setProperty('--glow-x', glowX + 'px');
      this.style.setProperty('--glow-y', glowY + 'px');
    });
  });

  // ----- PARALLAX SECTIONS -----
  var parallaxSections = document.querySelectorAll('.parallax-section');

  window.addEventListener('scroll', function() {
    var scrolled = window.pageYOffset;
    parallaxSections.forEach(function(section, index) {
      var speed = 0.03 + (index * 0.01);
      var rect = section.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        var offset = (rect.top + rect.height / 2) - window.innerHeight / 2;
        section.style.transform = 'translateY(' + (offset * speed * -1) + 'px)';
      }
    });
  }, { passive: true });

  // ----- TILT EFFECT ON CATEGORY CARDS -----
  document.querySelectorAll('.category-card').forEach(function(card) {
    card.addEventListener('mousemove', function(e) {
      var rect = this.getBoundingClientRect();
      var x = (e.clientX - rect.left) / rect.width;
      var y = (e.clientY - rect.top) / rect.height;
      var tiltX = (y - 0.5) * 6;
      var tiltY = (x - 0.5) * -6;
      this.style.transform = 'perspective(800px) rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg)';
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg)';
      this.style.transition = 'transform 0.5s ease';
    });
  });

  // ----- FLOATING ELEMENTS -----
  document.querySelectorAll('.float-box').forEach(function(box, index) {
    var delay = index * 0.3;
    box.style.animationDelay = delay + 's';
  });

  // ----- GALLERY ITEMS ZOOM -----
  document.querySelectorAll('.gallery-item').forEach(function(item) {
    var img = item.querySelector('img');
    if (img) {
      item.addEventListener('mouseenter', function() {
        img.style.transform = 'scale(1.1)';
      });
      item.addEventListener('mouseleave', function() {
        img.style.transform = 'scale(1)';
      });
    }
  });

  // ----- COLLECTION CARDS HOVER -----
  document.querySelectorAll('.collection-card').forEach(function(card) {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-12px) scale(1.01)';
    });
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  });

  // ----- ENHANCED STAT COUNTER WITH DELAY -----
  document.querySelectorAll('.stat-number:not([data-counted])').forEach(function(counter) {
    var card = counter.closest('.stat-card');
    if (card) {
      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting && !counter.dataset.counted) {
            animateCounter(counter);
            counter.dataset.counted = 'true';
          }
        });
      }, { threshold: 0.3 });
      observer.observe(card);
    }
  });

  function animateCounter(element) {
    var target = parseInt(element.getAttribute('data-count')) || 0;
    var duration = 1400;
    var startTime = performance.now();

    function updateCounter(currentTime) {
      var elapsed = currentTime - startTime;
      var progress = Math.min(elapsed / duration, 1);
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

  // ----- SMOOTH CARD ENTRY ANIMATION -----
  document.querySelectorAll('.category-card, .collection-card, .blog-card, .testimonial-card').forEach(function(card, index) {
    card.style.setProperty('--card-index', index);
  });

  console.log('Elegancia · Animation JS loaded with enhancements');
})();