// ============================================================
// MENU.JS – Mobile menu toggle & navigation
// ============================================================

(function() {
  'use strict';

  const menuToggle = document.getElementById('menuToggle');
  const closeBtn = document.getElementById('closeMenu');
  const overlay = document.getElementById('menuOverlay');
  const mobileMenu = document.getElementById('mobileMenu');

  if (!menuToggle || !mobileMenu || !overlay) {
    console.warn('Menu elements not found');
    return;
  }

  function openMenu() {
    mobileMenu.classList.add('open');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    menuToggle.setAttribute('aria-expanded', 'true');
    const icon = menuToggle.querySelector('i');
    if (icon) {
      icon.className = 'fas fa-times';
    }
  }

  function closeMenu() {
    mobileMenu.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    menuToggle.setAttribute('aria-expanded', 'false');
    const icon = menuToggle.querySelector('i');
    if (icon) {
      icon.className = 'fas fa-bars';
    }
  }

  function toggleMenu() {
    if (mobileMenu.classList.contains('open')) {
      closeMenu();
    } else {
      openMenu();
    }
  }

  // Event listeners
  menuToggle.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleMenu();
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', closeMenu);
  }

  overlay.addEventListener('click', closeMenu);

  // Close on link click (but not the submenu toggle row's parent link when opening submenu)
  document.querySelectorAll('.mobile-menu a').forEach(function(link) {
    link.addEventListener('click', function(e) {
      // Don't close if it's the submenu toggle link being clicked
      if (this.closest('.mobile-submenu-toggle-row')) {
        return;
      }
      closeMenu();
    });
  });

  // ----- PRODUCTS SUBMENU TOGGLE -----
  document.querySelectorAll('.mobile-submenu-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      const parent = this.closest('.mobile-has-submenu');
      const submenu = parent.querySelector('.mobile-submenu');
      const isOpen = submenu.classList.contains('open');

      if (isOpen) {
        submenu.classList.remove('open');
        this.setAttribute('aria-expanded', 'false');
      } else {
        // Close other open submenus
        document.querySelectorAll('.mobile-submenu.open').forEach(function(menu) {
          if (menu !== submenu) {
            menu.classList.remove('open');
            const btn = menu.closest('.mobile-has-submenu').querySelector('.mobile-submenu-toggle');
            if (btn) {
              btn.setAttribute('aria-expanded', 'false');
            }
          }
        });
        
        submenu.classList.add('open');
        this.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // Close on Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
      closeMenu();
    }
  });

  // Close on resize to desktop
  window.addEventListener('resize', function() {
    if (window.innerWidth > 992 && mobileMenu.classList.contains('open')) {
      closeMenu();
    }
  });

  // Set initial state
  menuToggle.setAttribute('aria-expanded', 'false');

  console.log('Elegancia · Menu JS loaded');
})();