<?php
// application.php - Applications page
require_once 'config.php';
$page_title = 'Applications';
$current_page = 'application.php';

$additional_css = '
<style>
  .apps-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 50px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .apps-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .apps-hero .breadcrumb a { color: var(--gold); }
  .apps-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .app-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    margin-top: 24px;
  }
  .app-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.4s var(--ease);
    display: flex;
    flex-direction: column;
  }
  .app-card:hover {
    border-color: rgba(213,168,81,0.15);
    transform: translateY(-8px);
    box-shadow: var(--shadow-gold);
  }
  .app-card .app-image {
    aspect-ratio: 4/3;
    overflow: hidden;
    background: var(--dark);
  }
  .app-card .app-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s var(--ease);
  }
  .app-card:hover .app-image img {
    transform: scale(1.06);
  }
  .app-card .app-body {
    padding: 18px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .app-card .app-body .app-tag {
    font-size: 0.6rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
  }
  .app-card .app-body h4 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.05rem;
    margin: 4px 0 8px;
  }
  .app-card .app-body p {
    font-size: 0.85rem;
    color: var(--text-muted);
    line-height: 1.6;
    flex: 1;
  }
  .app-card .app-body .app-link {
    color: var(--gold);
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    transition: gap 0.3s var(--ease);
  }
  .app-card .app-body .app-link:hover {
    gap: 12px;
  }

  @media (max-width: 768px) {
    .apps-hero { padding: 100px 0 30px; }
    .app-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
  }
  @media (max-width: 480px) {
    .app-grid { grid-template-columns: 1fr; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== APPLICATIONS HERO ===== -->
<section class="apps-hero" aria-label="Applications">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Applications</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Where <span class="text-gradient-gold">Elegance</span> Meets Every Space</h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Discover how Elegancia products transform residential, commercial, and hospitality interiors with premium decorative solutions.</p>
  </div>
</section>

<!-- ===== APPLICATIONS GRID ===== -->
<section class="section-padding" style="padding-top: 20px;" aria-label="Application areas">
  <div class="container">
    <div class="app-grid">
      <?php foreach ($applications as $app): ?>
      <div class="app-card reveal">
        <div class="app-image"><img src="<?php echo $app['image']; ?>" alt="<?php echo $app['title']; ?>" loading="lazy" /></div>
        <div class="app-body">
          <span class="app-tag"><?php echo $app['category']; ?></span>
          <h4><?php echo $app['title']; ?></h4>
          <p><?php echo $app['description']; ?></p>
          <a href="#" class="app-link">Explore Solutions <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
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

<?php include INCLUDES_PATH . '/footer.php'; ?>