// ============================================================
// SLIDER.JS – Featured collections slider
// ============================================================

(function() {
  'use strict';

  const track = document.getElementById('sliderTrack');
  const prevBtn = document.getElementById('sliderPrev');
  const nextBtn = document.getElementById('sliderNext');

  if (!track || !prevBtn || !nextBtn) {
    console.warn('Slider elements not found');
    return;
  }

  const slides = track.querySelectorAll('.slider-card');
  let currentIndex = 0;
  let totalSlides = slides.length;
  let autoPlayInterval = null;
  let slideWidth = 0;
  const gap = 20;
  let isAutoPlayRunning = true;
  let resizeTimeout = null;

  function getSlidesPerView() {
    const width = window.innerWidth;
    if (width < 480) return 1.2;
    if (width < 576) return 1.5;
    if (width < 768) return 2.2;
    if (width < 992) return 2.8;
    if (width < 1200) return 3.5;
    return 4.5;
  }

  function getSlideWidth() {
    const containerWidth = track.parentElement.clientWidth - 56;
    const slidesPerView = getSlidesPerView();
    return Math.max(120, (containerWidth - (gap * (slidesPerView - 1))) / slidesPerView);
  }

  function updateSlider(animate) {
    animate = animate !== false;
    slideWidth = getSlideWidth();

    const slidesPerView = getSlidesPerView();
    const maxIndex = Math.max(0, totalSlides - Math.floor(slidesPerView));

    if (currentIndex > maxIndex) {
      currentIndex = maxIndex;
    }

    const offset = currentIndex * (slideWidth + gap);

    track.style.transition = animate ? 'transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)' : 'none';
    track.style.transform = 'translateX(-' + offset + 'px)';

    slides.forEach(function(slide) {
      slide.style.flex = '0 0 ' + slideWidth + 'px';
      slide.style.minWidth = '120px';
    });
  }

  function nextSlide() {
    const slidesPerView = getSlidesPerView();
    const maxIndex = Math.max(0, totalSlides - Math.floor(slidesPerView));
    if (currentIndex < maxIndex) {
      currentIndex++;
    } else {
      currentIndex = 0;
    }
    updateSlider(true);
  }

  function prevSlide() {
    const slidesPerView = getSlidesPerView();
    const maxIndex = Math.max(0, totalSlides - Math.floor(slidesPerView));
    if (currentIndex > 0) {
      currentIndex--;
    } else {
      currentIndex = maxIndex;
    }
    updateSlider(true);
  }

  function startAutoPlay() {
    stopAutoPlay();
    isAutoPlayRunning = true;
    autoPlayInterval = setInterval(nextSlide, 4000);
  }

  function stopAutoPlay() {
    isAutoPlayRunning = false;
    if (autoPlayInterval) {
      clearInterval(autoPlayInterval);
      autoPlayInterval = null;
    }
  }

  function restartAutoPlay() {
    if (!isAutoPlayRunning) {
      setTimeout(startAutoPlay, 3000);
    }
  }

  // Button events
  nextBtn.addEventListener('click', function() {
    stopAutoPlay();
    nextSlide();
    restartAutoPlay();
  });

  prevBtn.addEventListener('click', function() {
    stopAutoPlay();
    prevSlide();
    restartAutoPlay();
  });

  // Resize
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
      updateSlider(false);
    }, 150);
  });

  // Touch support
  let touchStartX = 0;
  let touchEndX = 0;

  track.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
    if (isAutoPlayRunning) {
      stopAutoPlay();
    }
  }, { passive: true });

  track.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 30) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
    if (!autoPlayInterval) {
      setTimeout(startAutoPlay, 3000);
    }
  }, { passive: true });

  // Pause on hover
  var sliderContainer = track.closest('.slider-container');
  if (sliderContainer) {
    sliderContainer.addEventListener('mouseenter', function() {
      if (isAutoPlayRunning) {
        stopAutoPlay();
      }
    });
    sliderContainer.addEventListener('mouseleave', function() {
      if (!autoPlayInterval) {
        setTimeout(startAutoPlay, 1000);
      }
    });
  }

  // Initialize
  updateSlider(false);
  startAutoPlay();

  console.log('Elegancia · Slider JS loaded');
})();