<?php
// blog.php - Blog page
require_once 'config.php';
$page_title = 'Blog';
$current_page = 'blog.php';

$additional_css = '
<style>
  .blog-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 50px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .blog-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .blog-hero .breadcrumb a { color: var(--gold); }
  .blog-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .blog-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    justify-content: center;
    margin: 20px 0 28px;
  }
  .blog-filter-bar .filter-btn {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-muted);
    padding: 6px 20px;
    border-radius: 50px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
  }
  .blog-filter-bar .filter-btn:hover,
  .blog-filter-bar .filter-btn.active {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }

  .blog-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 10px;
  }
  .blog-grid-3 .blog-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.4s var(--ease);
    display: flex;
    flex-direction: column;
  }
  .blog-grid-3 .blog-card:hover {
    border-color: rgba(213,168,81,0.15);
    transform: translateY(-8px);
    box-shadow: var(--shadow-gold);
  }
  .blog-grid-3 .blog-card .blog-image {
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--dark);
  }
  .blog-grid-3 .blog-card .blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s var(--ease);
  }
  .blog-grid-3 .blog-card:hover .blog-image img {
    transform: scale(1.06);
  }
  .blog-grid-3 .blog-card .blog-body {
    padding: 18px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .blog-grid-3 .blog-card .blog-body .blog-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.7rem;
    color: var(--text-muted);
    margin-bottom: 6px;
  }
  .blog-grid-3 .blog-card .blog-body .blog-meta .blog-tag {
    display: inline-block;
    font-size: 0.6rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
  }
  .blog-grid-3 .blog-card .blog-body h4 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.05rem;
    margin: 4px 0 8px;
    line-height: 1.3;
  }
  .blog-grid-3 .blog-card .blog-body p {
    font-size: 0.85rem;
    color: var(--text-muted);
    line-height: 1.6;
    flex: 1;
  }
  .blog-grid-3 .blog-card .blog-body .blog-link {
    color: var(--gold);
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    transition: gap 0.3s var(--ease);
  }
  .blog-grid-3 .blog-card .blog-body .blog-link:hover {
    gap: 12px;
  }

  .pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 32px;
    flex-wrap: wrap;
  }
  .pagination .page-btn {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-muted);
    padding: 8px 16px;
    border-radius: var(--radius-sm);
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
  }
  .pagination .page-btn:hover,
  .pagination .page-btn.active {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }
  .pagination .page-btn.disabled {
    opacity: 0.3;
    cursor: not-allowed;
  }

  @media (max-width: 992px) {
    .blog-grid-3 { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 768px) {
    .blog-hero { padding: 100px 0 30px; }
    .blog-grid-3 { grid-template-columns: 1fr 1fr; gap: 16px; }
  }
  @media (max-width: 480px) {
    .blog-grid-3 { grid-template-columns: 1fr; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== BLOG HERO ===== -->
<section class="blog-hero" aria-label="Blog">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Blog</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Latest <span class="text-gradient-gold">Insights</span></h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Explore expert tips, design trends, and industry news from the world of premium interior solutions.</p>
  </div>
</section>

<!-- ===== BLOG GRID ===== -->
<section class="section-padding" style="padding-top: 10px;" aria-label="Blog posts">
  <div class="container">
    <!-- Filter Bar -->
    <div class="blog-filter-bar reveal">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="trends">Trends</button>
      <button class="filter-btn" data-filter="tips">Tips</button>
      <button class="filter-btn" data-filter="innovation">Innovation</button>
      <button class="filter-btn" data-filter="projects">Projects</button>
    </div>

    <div class="blog-grid-3" id="blogGrid">
      <?php foreach ($blogs as $blog): ?>
      <article class="blog-card" data-category="<?php echo $blog['category']; ?>">
        <div class="blog-image"><img src="<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" loading="lazy" /></div>
        <div class="blog-body">
          <div class="blog-meta">
            <span class="blog-tag"><?php echo ucfirst($blog['category']); ?></span>
            <span>·</span>
            <span><?php echo $blog['date']; ?></span>
          </div>
          <h4><?php echo $blog['title']; ?></h4>
          <p><?php echo $blog['excerpt']; ?></p>
          <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination reveal">
      <button class="page-btn disabled">Previous</button>
      <button class="page-btn active">1</button>
      <button class="page-btn">2</button>
      <button class="page-btn">3</button>
      <button class="page-btn">Next</button>
    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section" aria-label="Contact us">
  <div class="container">
    <span class="cta-badge">Stay Updated</span>
    <h2 class="cta-title">Subscribe to Our <span class="text-gradient-gold">Newsletter</span></h2>
    <p class="cta-sub">Get the latest design insights, product updates, and exclusive offers delivered to your inbox.</p>
    <div class="cta-buttons">
      <a href="#" class="btn-primary btn-lg">Subscribe Now <i class="fas fa-arrow-right"></i></a>
      <a href="#" class="btn-outline-light btn-lg">Browse All Posts <i class="fas fa-book"></i></a>
    </div>
  </div>
</section>

<?php
$additional_js = '
<script>
  (function() {
    "use strict";

    // ===== FILTERING =====
    const filterBtns = document.querySelectorAll(".blog-filter-bar .filter-btn");
    const blogCards = document.querySelectorAll(".blog-card");

    filterBtns.forEach(btn => {
      btn.addEventListener("click", function() {
        filterBtns.forEach(b => b.classList.remove("active"));
        this.classList.add("active");
        const filter = this.getAttribute("data-filter");
        blogCards.forEach(card => {
          const category = card.getAttribute("data-category");
          card.style.display = (filter === "all" || category === filter) ? "flex" : "none";
        });
      });
    });

    // ===== PAGINATION =====
    const pageBtns = document.querySelectorAll(".pagination .page-btn:not(.disabled)");
    pageBtns.forEach(btn => {
      btn.addEventListener("click", function() {
        pageBtns.forEach(b => b.classList.remove("active"));
        this.classList.add("active");
        document.querySelector(".blog-grid-3").scrollIntoView({ behavior: "smooth", block: "start" });
      });
    });

    console.log("Elegancia · Blog page loaded");
  })();
</script>
';

include INCLUDES_PATH . '/footer.php';
?>