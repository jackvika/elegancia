// ============================================================
// DROPDOWN.JS – Enhanced dropdown with scroll & animations
// ============================================================

(function() {
  'use strict';

  const dropdownParent = document.getElementById('productsDropdown');
  const megaDropdown = document.getElementById('megaDropdown');

  if (!dropdownParent || !megaDropdown) {
    console.warn('Dropdown elements not found');
    return;
  }

  let hoverTimeout = null;
  let isHovering = false;
  let isDropdownVisible = false;

  // Handle mouse enter on parent
  dropdownParent.addEventListener('mouseenter', function() {
    clearTimeout(hoverTimeout);
    isHovering = true;
    showDropdown();
  });

  // Handle mouse leave from parent
  dropdownParent.addEventListener('mouseleave', function(e) {
    const relatedTarget = e.relatedTarget;
    if (relatedTarget && megaDropdown.contains(relatedTarget)) {
      return;
    }
    
    hoverTimeout = setTimeout(function() {
      if (!isHovering) {
        hideDropdown();
      }
    }, 150);
  });

  // Handle mouse enter on dropdown
  megaDropdown.addEventListener('mouseenter', function() {
    clearTimeout(hoverTimeout);
    isHovering = true;
    showDropdown();
  });

  // Handle mouse leave from dropdown
  megaDropdown.addEventListener('mouseleave', function(e) {
    const relatedTarget = e.relatedTarget;
    if (relatedTarget && dropdownParent.contains(relatedTarget)) {
      return;
    }
    
    isHovering = false;
    hoverTimeout = setTimeout(function() {
      if (!isHovering) {
        hideDropdown();
      }
    }, 200);
  });

  // Show dropdown with animation
  function showDropdown() {
    if (isDropdownVisible) return;
    isDropdownVisible = true;
    
    megaDropdown.style.opacity = '1';
    megaDropdown.style.visibility = 'visible';
    megaDropdown.style.pointerEvents = 'auto';
    megaDropdown.style.transform = 'translateX(-50%) translateY(8px)';
    
    // Add entrance animation to items
    const items = megaDropdown.querySelectorAll('.mega-dropdown-item');
    items.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(12px) scale(0.96)';
      setTimeout(() => {
        item.style.transition = 'opacity 0.4s ease, transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0) scale(1)';
      }, 50 + (index * 30));
    });
  }

  // Hide dropdown with animation
  function hideDropdown() {
    if (!isDropdownVisible) return;
    isDropdownVisible = false;
    
    megaDropdown.style.opacity = '0';
    megaDropdown.style.visibility = 'hidden';
    megaDropdown.style.pointerEvents = 'none';
    megaDropdown.style.transform = 'translateX(-50%) translateY(12px)';
    
    // Reset items
    const items = megaDropdown.querySelectorAll('.mega-dropdown-item');
    items.forEach((item) => {
      item.style.transition = 'none';
      item.style.opacity = '';
      item.style.transform = '';
    });
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdownParent.contains(e.target) && !megaDropdown.contains(e.target)) {
      hideDropdown();
      isHovering = false;
    }
  });

  // Close on Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isDropdownVisible) {
      hideDropdown();
      isHovering = false;
    }
  });

  // Handle window resize
  let resizeTimeout = null;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
      if (window.innerWidth > 992 && isDropdownVisible) {
        // Reposition if needed
      }
    }, 200);
  });

  console.log('Elegancia · Enhanced Dropdown JS loaded');
})();