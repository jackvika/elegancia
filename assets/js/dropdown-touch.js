// ============================================================
// DROPDOWN-TOUCH.JS – Touch device support for dropdown
// ============================================================

(function() {
  'use strict';

  // Check if touch device
  const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

  if (!isTouchDevice) {
    return;
  }

  const dropdownParent = document.getElementById('productsDropdown');

  if (!dropdownParent) {
    return;
  }

  // For touch devices, toggle dropdown on click
  dropdownParent.addEventListener('click', function(e) {
    const link = this.querySelector('.nav-link');
    const dropdown = this.querySelector('.mega-dropdown');
    
    if (!dropdown) return;
    
    // Toggle active class
    this.classList.toggle('active');
    
    if (this.classList.contains('active')) {
      dropdown.style.display = 'block';
      dropdown.style.opacity = '1';
      dropdown.style.visibility = 'visible';
      dropdown.style.pointerEvents = 'auto';
      dropdown.style.transform = 'translateX(-50%) translateY(8px)';
    } else {
      dropdown.style.display = 'none';
      dropdown.style.opacity = '0';
      dropdown.style.visibility = 'hidden';
      dropdown.style.pointerEvents = 'none';
      dropdown.style.transform = 'translateX(-50%) translateY(12px)';
    }
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdownParent.contains(e.target)) {
      dropdownParent.classList.remove('active');
      const dropdown = dropdownParent.querySelector('.mega-dropdown');
      if (dropdown) {
        dropdown.style.display = 'none';
        dropdown.style.opacity = '0';
        dropdown.style.visibility = 'hidden';
        dropdown.style.pointerEvents = 'none';
        dropdown.style.transform = 'translateX(-50%) translateY(12px)';
      }
    }
  });

  console.log('Elegancia · Dropdown Touch Support loaded');
})();