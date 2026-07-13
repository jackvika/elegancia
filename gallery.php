<?php
// gallery.php - Gallery page
require_once 'config.php';
$page_title = 'Gallery';
$current_page = 'gallery.php';

$additional_css = '
<style>
  .gallery-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 50px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .gallery-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .gallery-hero .breadcrumb a { color: var(--gold); }
  .gallery-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .gallery-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    justify-content: center;
    margin: 20px 0 28px;
  }
  .gallery-filter-bar .filter-btn {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-muted);
    padding: 6px 20px;
    border-radius: 50px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
  }
  .gallery-filter-bar .filter-btn:hover,
  .gallery-filter-bar .filter-btn.active {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }

  .gallery-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 10px;
  }
  .gallery-masonry .gallery-item {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    background: var(--dark-light);
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.4s var(--ease);
    cursor: pointer;
    aspect-ratio: 4/3;
  }
  .gallery-masonry .gallery-item:hover {
    border-color: rgba(213,168,81,0.15);
    transform: translateY(-6px);
    box-shadow: var(--shadow-gold);
  }
  .gallery-masonry .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s var(--ease);
  }
  .gallery-masonry .gallery-item:hover img {
    transform: scale(1.06);
  }
  .gallery-masonry .gallery-item .gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(12,12,12,0.85) 0%, transparent 50%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 18px 20px 20px;
    opacity: 0;
    transition: opacity 0.4s var(--ease);
  }
  .gallery-masonry .gallery-item:hover .gallery-overlay {
    opacity: 1;
  }
  .gallery-masonry .gallery-item .gallery-overlay h4 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 0.95rem;
  }
  .gallery-masonry .gallery-item .gallery-overlay p {
    color: var(--text-muted);
    font-size: 0.75rem;
  }
  .gallery-masonry .gallery-item .gallery-overlay .gallery-tag {
    display: inline-block;
    font-size: 0.6rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
    margin-bottom: 2px;
  }

  .lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.92);
    z-index: 20000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s var(--ease);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 40px;
  }
  .lightbox-overlay.active {
    opacity: 1;
    pointer-events: all;
  }
  .lightbox-overlay .lightbox-content {
    max-width: 90vw;
    max-height: 85vh;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .lightbox-overlay .lightbox-content img {
    max-width: 100%;
    max-height: 75vh;
    border-radius: var(--radius);
    object-fit: contain;
    border: 1px solid rgba(213,168,81,0.06);
    box-shadow: var(--shadow-lg);
  }
  .lightbox-overlay .lightbox-content .lightbox-info {
    margin-top: 16px;
    text-align: center;
    color: var(--text-strong);
  }
  .lightbox-overlay .lightbox-content .lightbox-info h3 {
    font-weight: 600;
    font-size: 1.1rem;
  }
  .lightbox-overlay .lightbox-content .lightbox-info p {
    color: var(--text-muted);
    font-size: 0.85rem;
  }
  .lightbox-overlay .lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    background: transparent;
    border: none;
    color: rgba(255,255,255,0.5);
    font-size: 2rem;
    cursor: pointer;
    transition: color 0.3s var(--ease);
    z-index: 10;
  }
  .lightbox-overlay .lightbox-close:hover {
    color: var(--gold);
  }
  .lightbox-overlay .lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(26,26,26,0.7);
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-strong);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    z-index: 10;
  }
  .lightbox-overlay .lightbox-nav:hover {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }
  .lightbox-overlay .lightbox-nav.prev { left: 20px; }
  .lightbox-overlay .lightbox-nav.next { right: 20px; }

  @media (max-width: 768px) {
    .gallery-hero { padding: 100px 0 30px; }
    .gallery-masonry { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; }
    .lightbox-overlay .lightbox-nav { width: 36px; height: 36px; }
    .lightbox-overlay .lightbox-nav.prev { left: 10px; }
    .lightbox-overlay .lightbox-nav.next { right: 10px; }
  }
  @media (max-width: 480px) {
    .gallery-masonry { grid-template-columns: 1fr 1fr; gap: 10px; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== GALLERY HERO ===== -->
<section class="gallery-hero" aria-label="Gallery">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Gallery</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Interior <span class="text-gradient-gold">Inspiration</span></h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Explore our curated collection of stunning interiors featuring Elegancia\'s premium decorative products.</p>
  </div>
</section>

<!-- ===== GALLERY GRID ===== -->
<section class="section-padding" style="padding-top: 10px;" aria-label="Gallery images">
  <div class="container">
    <!-- Filter Bar -->
    <div class="gallery-filter-bar reveal">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="living">Living Room</button>
      <button class="filter-btn" data-filter="bedroom">Bedroom</button>
      <button class="filter-btn" data-filter="office">Office</button>
      <button class="filter-btn" data-filter="hospitality">Hospitality</button>
      <button class="filter-btn" data-filter="retail">Retail</button>
    </div>

    <div class="gallery-masonry" id="galleryGrid">
      <?php foreach ($gallery_items as $item): ?>
      <div class="gallery-item" data-category="<?php echo $item['category']; ?>">
        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" loading="lazy" />
        <div class="gallery-overlay">
          <span class="gallery-tag"><?php echo ucfirst($item['category']); ?></span>
          <h4><?php echo $item['title']; ?></h4>
          <p><?php echo $item['description']; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-12 reveal">
      <a href="#" class="btn-outline-gold">Load More <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section" aria-label="Contact us">
  <div class="container">
    <span class="cta-badge">Need Help?</span>
    <h2 class="cta-title">Looking for <span class="text-gradient-gold">custom solutions?</span></h2>
    <p class="cta-sub">Contact our team for bulk orders, custom designs, or any assistance.</p>
    <div class="cta-buttons">
      <a href="#" class="btn-primary btn-lg">Request a Quote <i class="fas fa-arrow-right"></i></a>
      <a href="#" class="btn-outline-light btn-lg">Call Now <i class="fas fa-phone"></i></a>
    </div>
  </div>
</section>

<!-- ===== LIGHTBOX ===== -->
<div class="lightbox-overlay" id="lightboxOverlay">
  <button class="lightbox-close" id="lightboxClose" aria-label="Close lightbox"><i class="fas fa-times"></i></button>
  <button class="lightbox-nav prev" id="lightboxPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
  <button class="lightbox-nav next" id="lightboxNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
  <div class="lightbox-content">
    <img id="lightboxImg" src="" alt="Gallery image" />
    <div class="lightbox-info">
      <h3 id="lightboxTitle">Title</h3>
      <p id="lightboxDesc">Description</p>
    </div>
  </div>
</div>

<?php
$additional_js = '
<script>
  (function() {
    "use strict";

    // ===== LIGHTBOX =====
    const lightboxOverlay = document.getElementById("lightboxOverlay");
    const lightboxImg = document.getElementById("lightboxImg");
    const lightboxTitle = document.getElementById("lightboxTitle");
    const lightboxDesc = document.getElementById("lightboxDesc");
    const lightboxClose = document.getElementById("lightboxClose");
    const lightboxPrev = document.getElementById("lightboxPrev");
    const lightboxNext = document.getElementById("lightboxNext");
    let currentGalleryItems = [];
    let currentIndex = 0;

    function openLightbox(index) {
      const items = document.querySelectorAll(".gallery-item");
      currentGalleryItems = Array.from(items).filter(item => item.style.display !== "none");
      if (currentGalleryItems.length === 0) return;
      currentIndex = index;
      updateLightbox();
      lightboxOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    }

    function updateLightbox() {
      const item = currentGalleryItems[currentIndex];
      if (!item) return;
      const img = item.querySelector("img");
      const overlay = item.querySelector(".gallery-overlay");
      const tag = overlay?.querySelector(".gallery-tag")?.textContent || "";
      const title = overlay?.querySelector("h4")?.textContent || "Interior Design";
      const desc = overlay?.querySelector("p")?.textContent || "Elegancia premium products";
      lightboxImg.src = img?.src || "";
      lightboxImg.alt = img?.alt || "";
      lightboxTitle.textContent = title;
      lightboxDesc.textContent = tag + " · " + desc;
    }

    function closeLightbox() {
      lightboxOverlay.classList.remove("active");
      document.body.style.overflow = "";
    }

    function prevImage() {
      if (currentGalleryItems.length === 0) return;
      currentIndex = (currentIndex - 1 + currentGalleryItems.length) % currentGalleryItems.length;
      updateLightbox();
    }

    function nextImage() {
      if (currentGalleryItems.length === 0) return;
      currentIndex = (currentIndex + 1) % currentGalleryItems.length;
      updateLightbox();
    }

    document.querySelectorAll(".gallery-item").forEach((item, index) => {
      item.addEventListener("click", function() {
        openLightbox(index);
      });
    });

    lightboxClose.addEventListener("click", closeLightbox);
    lightboxOverlay.addEventListener("click", function(e) {
      if (e.target === this) closeLightbox();
    });
    lightboxPrev.addEventListener("click", prevImage);
    lightboxNext.addEventListener("click", nextImage);
    document.addEventListener("keydown", function(e) {
      if (!lightboxOverlay.classList.contains("active")) return;
      if (e.key === "Escape") closeLightbox();
      if (e.key === "ArrowLeft") prevImage();
      if (e.key === "ArrowRight") nextImage();
    });

    // ===== FILTERING =====
    const filterBtns = document.querySelectorAll(".gallery-filter-bar .filter-btn");
    const galleryItems = document.querySelectorAll(".gallery-item");

    filterBtns.forEach(btn => {
      btn.addEventListener("click", function() {
        filterBtns.forEach(b => b.classList.remove("active"));
        this.classList.add("active");
        const filter = this.getAttribute("data-filter");
        galleryItems.forEach(item => {
          const category = item.getAttribute("data-category");
          item.style.display = (filter === "all" || category === filter) ? "block" : "none";
        });
      });
    });

    console.log("Elegancia · Gallery page loaded");
  })();
</script>
';

include INCLUDES_PATH . '/footer.php';
?>