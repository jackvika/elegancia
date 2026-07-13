// ============================================================
// DROPDOWN.JS – Fixes dropdown blinking and hover issues
// ============================================================

(function() {
  'use strict';

  const dropdownParent = document.getElementById('productsDropdown');
  const megaDropdown = document.getElementById('megaDropdown');

  if (!dropdownParent || !megaDropdown) {
    return;
  }

  let hoverTimeout = null;
  let isHovering = false;

  // Handle mouse enter on parent
  dropdownParent.addEventListener('mouseenter', function() {
    clearTimeout(hoverTimeout);
    isHovering = true;
    // Force show
    megaDropdown.style.opacity = '1';
    megaDropdown.style.visibility = 'visible';
    megaDropdown.style.pointerEvents = 'auto';
    megaDropdown.style.transform = 'translateX(-50%) translateY(0)';
  });

  // Handle mouse leave from parent
  dropdownParent.addEventListener('mouseleave', function(e) {
    // Check if we're moving to the dropdown itself
    const relatedTarget = e.relatedTarget;
    if (relatedTarget && megaDropdown.contains(relatedTarget)) {
      // We're moving to the dropdown, keep it open
      return;
    }
    
    // We're leaving the area entirely
    hoverTimeout = setTimeout(function() {
      if (!isHovering) {
        megaDropdown.style.opacity = '0';
        megaDropdown.style.visibility = 'hidden';
        megaDropdown.style.pointerEvents = 'none';
        megaDropdown.style.transform = 'translateX(-50%) translateY(8px)';
      }
    }, 150);
  });

  // Handle mouse enter on dropdown
  megaDropdown.addEventListener('mouseenter', function() {
    clearTimeout(hoverTimeout);
    isHovering = true;
    // Ensure it stays visible
    megaDropdown.style.opacity = '1';
    megaDropdown.style.visibility = 'visible';
    megaDropdown.style.pointerEvents = 'auto';
    megaDropdown.style.transform = 'translateX(-50%) translateY(0)';
  });

  // Handle mouse leave from dropdown
  megaDropdown.addEventListener('mouseleave', function(e) {
    const relatedTarget = e.relatedTarget;
    if (relatedTarget && dropdownParent.contains(relatedTarget)) {
      // Moving back to parent, keep open
      return;
    }
    
    isHovering = false;
    hoverTimeout = setTimeout(function() {
      if (!isHovering) {
        megaDropdown.style.opacity = '0';
        megaDropdown.style.visibility = 'hidden';
        megaDropdown.style.pointerEvents = 'none';
        megaDropdown.style.transform = 'translateX(-50%) translateY(8px)';
      }
    }, 200);
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdownParent.contains(e.target) && !megaDropdown.contains(e.target)) {
      megaDropdown.style.opacity = '0';
      megaDropdown.style.visibility = 'hidden';
      megaDropdown.style.pointerEvents = 'none';
      megaDropdown.style.transform = 'translateX(-50%) translateY(8px)';
      isHovering = false;
    }
  });

  console.log('Elegancia · Dropdown JS loaded');
})();