<?php
// aboutus.php - About Us page
require_once 'config.php';
$page_title = 'About Us';
$current_page = 'aboutus.php';

// Additional CSS for this page
$additional_css = '
<style>
  /* professional centering & refined alignments */
  .about-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 60px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .about-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 16px;
  }
  .about-hero .breadcrumb a { color: var(--gold); }
  .about-hero .breadcrumb span { color: rgba(224,221,208,0.2); }
  .about-hero .hero-content-center {
    max-width: 820px;
    margin: 0 auto;
  }
  .about-hero .hero-badges {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: 16px;
  }
  .about-hero .img-zoom {
    max-width: 700px;
    margin: 24px auto 0;
  }
  .company-factsheet {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 32px 28px;
    border: 1px solid rgba(213,168,81,0.06);
    margin-top: 24px;
    text-align: left;
  }
  .fact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px 24px;
    margin-top: 8px;
  }
  .fact-item {
    border-bottom: 1px solid rgba(213,168,81,0.04);
    padding-bottom: 8px;
  }
  .fact-item .label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    font-weight: 500;
  }
  .fact-item .value {
    font-weight: 500;
    color: var(--text-strong);
    margin-top: 2px;
    font-size: 0.95rem;
  }
  .badge-gold {
    background: rgba(213,168,81,0.08);
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--gold);
    padding: 4px 14px;
    border-radius: 50px;
    font-size: 0.7rem;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .section-header-center .section-divider {
    margin-left: auto;
    margin-right: auto;
  }
  .warehouse-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin: 20px 0;
  }
  .warehouse-gallery .img-box {
    border-radius: var(--radius-sm);
    overflow: hidden;
    background: var(--dark);
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.3s ease;
  }
  .warehouse-gallery .img-box:hover {
    transform: translateY(-4px);
    border-color: rgba(213,168,81,0.15);
    box-shadow: var(--shadow-sm);
  }
  .warehouse-gallery .img-box img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
  }
  .warehouse-gallery .img-box .caption {
    padding: 10px 12px 14px;
    font-size: 0.85rem;
    color: var(--text-muted);
    text-align: center;
    font-weight: 500;
  }
  .review-summary {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 24px 40px;
    background: var(--dark);
    padding: 24px 32px;
    border-radius: var(--radius);
    border: 1px solid rgba(213,168,81,0.04);
    text-align: left;
  }
  .review-summary .stars-big {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--text-strong);
  }
  .review-summary .stars-big small {
    font-size: 1.2rem;
    color: var(--gold);
    margin-left: 6px;
  }
  .rating-bar {
    flex: 1;
    min-width: 160px;
  }
  .rating-bar .bar {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    margin-bottom: 2px;
  }
  .rating-bar .bar .fill {
    height: 4px;
    background: var(--gold);
    border-radius: 10px;
  }
  .rating-bar .bar .bg {
    flex: 1;
    height: 4px;
    background: rgba(255,255,255,0.04);
    border-radius: 10px;
  }
  .btn-gold-outline {
    border: 1px solid var(--gold);
    color: var(--gold);
    background: transparent;
    padding: 6px 18px;
    border-radius: 50px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .btn-gold-outline:hover {
    background: var(--gold);
    color: var(--dark);
  }
  .contact-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 24px 28px;
    border: 1px solid rgba(213,168,81,0.06);
    text-align: left;
  }
  .contact-card i {
    color: var(--gold);
    width: 28px;
    text-align: center;
  }
  .contact-card p { margin-bottom: 10px; }
  .form-dark input, .form-dark textarea {
    background: var(--dark);
    border: 1px solid rgba(213,168,81,0.06);
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    color: var(--text-strong);
    width: 100%;
    font-family: inherit;
    transition: border 0.3s ease;
  }
  .form-dark input:focus, .form-dark textarea:focus {
    border-color: var(--gold);
    outline: none;
  }
  .form-dark input::placeholder, .form-dark textarea::placeholder {
    color: rgba(224,221,208,0.2);
  }
  .features-grid-centered {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    justify-items: center;
  }
  .features-grid-centered .icon-card {
    width: 100%;
    max-width: 220px;
    text-align: center;
  }
  .testimonial-grid-centered {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 20px;
    justify-items: center;
    margin-top: 28px;
  }
  .testimonial-grid-centered .testimonial-card {
    width: 100%;
    max-width: 320px;
    background: var(--dark);
    text-align: left;
  }
  .contact-row-centered {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
  }
  .contact-row-centered > div {
    flex: 1 1 360px;
    max-width: 500px;
  }
  @media (max-width: 768px) {
    .about-hero { padding: 100px 0 40px; }
    .fact-grid { grid-template-columns: 1fr 1fr; }
    .review-summary { flex-direction: column; align-items: center; text-align: center; }
    .rating-bar { width: 100%; }
    .contact-row-centered > div { flex: 1 1 100%; }
  }
  @media (max-width: 480px) {
    .fact-grid { grid-template-columns: 1fr; }
    .warehouse-gallery { grid-template-columns: 1fr 1fr; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== ABOUT HERO ===== -->
<section class="about-hero" aria-label="About Elegancia">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>About Us</span>
    </div>
    <div class="hero-content-center">
      <span class="section-tag" style="display: inline-block;">about us</span>
      <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Crafting <span class="text-gradient-gold">Interior Excellence</span> Since 2017</h1>
      <p class="hero-sub" style="max-width: 680px; margin-left: auto; margin-right: auto;">Swastik Moulding &amp; Plastics holds expertise in manufacturing a gamut of Frame Moulding, Wooden Frame Moulding, Wall Panels, Cornices, and more. We source raw material from trustworthy vendors and ensure superior quality.</p>
      <div class="hero-badges">
        <span class="badge-gold"><i class="fas fa-check-circle"></i> 250+ designs</span>
        <span class="badge-gold"><i class="fas fa-check-circle"></i> PAN India supply</span>
        <span class="badge-gold"><i class="fas fa-check-circle"></i> 84% response rate</span>
      </div>
      <div class="img-zoom">
        <img src="https://placehold.co/800x500/2a2a2a/848461?text=Swastik+Moulding+%26+Plastics" alt="Swastik Moulding & Plastics facility" loading="lazy" />
      </div>
    </div>
  </div>
</section>

<!-- ===== COMPANY FACTSHEET ===== -->
<section class="section-padding" style="padding-top: 20px;" aria-label="Company factsheet">
  <div class="container">
    <div class="company-factsheet reveal" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
      <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center; margin-bottom: 16px;">
        <h3 style="color: var(--text-strong); font-weight: 600; font-size: 1.2rem;"><i class="fas fa-building" style="color: var(--gold); margin-right: 10px;"></i> Company Factsheet</h3>
        <span class="badge-gold"><i class="fas fa-shield-alt"></i> TrustSEAL Verified</span>
      </div>
      <div class="fact-grid">
        <?php foreach ($company_factsheet as $label => $value): ?>
        <div class="fact-item">
          <span class="label"><?php echo $label; ?></span>
          <div class="value"><?php echo $value; ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ===== WHY US ===== -->
<section class="section-padding bg-dark-light" aria-label="Why Us">
  <div class="container">
    <div class="section-header section-header-center reveal">
      <span class="section-tag">why us</span>
      <h2 class="section-title">Built on <span class="text-gradient-gold">trust &amp; quality</span></h2>
      <div class="section-divider"></div>
    </div>
    <div class="features-grid-centered">
      <div class="icon-card"><i class="fas fa-industry"></i><h5>Well-equipped infra</h5><p>Modern machinery, precision</p></div>
      <div class="icon-card"><i class="fas fa-truck"></i><h5>Prompt delivery</h5><p>Reliable logistics</p></div>
      <div class="icon-card"><i class="fas fa-award"></i><h5>Strong market recognition</h5><p>Trusted by dealers &amp; architects</p></div>
      <div class="icon-card"><i class="fas fa-tag"></i><h5>Economical prices</h5><p>Best value, no compromise</p></div>
      <div class="icon-card"><i class="fas fa-handshake"></i><h5>Reliable vendor base</h5><p>Premium raw materials</p></div>
      <div class="icon-card"><i class="fas fa-gem"></i><h5>Ethical practices</h5><p>Transparency, integrity</p></div>
    </div>
  </div>
</section>

<!-- ===== WAREHOUSE / INFRA ===== -->
<section class="section-padding" aria-label="Infrastructure">
  <div class="container">
    <div class="section-header section-header-center reveal">
      <span class="section-tag">infrastructure</span>
      <h2 class="section-title">Our <span class="text-gradient-gold">facilities</span></h2>
      <div class="section-divider"></div>
    </div>
    <div class="warehouse-gallery" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
      <?php
      $warehouse_images = [
        ['src' => 'https://placehold.co/600x400/1a1a1a/848461?text=Infrastructural+Set-Up', 'caption' => 'Infrastructural Set-Up'],
        ['src' => 'https://placehold.co/600x400/2a2a2a/7e7c64?text=Our+Warehouse', 'caption' => 'Our Warehouse'],
        ['src' => 'https://placehold.co/600x400/1a1a1a/848461?text=Warehouse+Unit', 'caption' => 'Warehouse Unit'],
        ['src' => 'https://placehold.co/600x400/2a2a2a/7e7c64?text=Office+Facility', 'caption' => 'Our Office']
      ];
      foreach ($warehouse_images as $img):
      ?>
      <div class="img-box">
        <img src="<?php echo $img['src']; ?>" alt="<?php echo $img['caption']; ?>" loading="lazy" />
        <div class="caption"><?php echo $img['caption']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-8">
      <a href="#" class="btn-outline-gold btn-sm">View More <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ===== RATINGS & REVIEWS ===== -->
<section class="section-padding bg-dark-light" aria-label="Ratings and Reviews">
  <div class="container">
    <div class="section-header section-header-center reveal">
      <span class="section-tag">reviews</span>
      <h2 class="section-title">What our <span class="text-gradient-gold">customers say</span></h2>
      <div class="section-divider"></div>
    </div>
    <div class="review-summary reveal" style="max-width: 960px; margin-left: auto; margin-right: auto;">
      <div>
        <div class="stars-big">4.5 <small><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></small></div>
        <div style="color: var(--text-muted); font-size: 0.9rem;">Reviewed by 43 Users</div>
      </div>
      <div class="rating-bar">
        <div class="bar"><span>5★</span> <div class="bg"><div class="fill" style="width:70%"></div></div> <span>70%</span></div>
        <div class="bar"><span>4★</span> <div class="bg"><div class="fill" style="width:7%"></div></div> <span>7%</span></div>
        <div class="bar"><span>3★</span> <div class="bg"><div class="fill" style="width:5%"></div></div> <span>5%</span></div>
        <div class="bar"><span>2★</span> <div class="bg"><div class="fill" style="width:2%"></div></div> <span>2%</span></div>
        <div class="bar"><span>1★</span> <div class="bg"><div class="fill" style="width:16%"></div></div> <span>16%</span></div>
      </div>
      <div style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
        <span class="badge-gold"><i class="fas fa-check-circle"></i> Response 75%</span>
        <span class="badge-gold"><i class="fas fa-check-circle"></i> Quality 87%</span>
        <span class="badge-gold"><i class="fas fa-check-circle"></i> Delivery 85%</span>
      </div>
    </div>

    <div class="testimonial-grid-centered">
      <?php foreach ($testimonials as $testimonial): ?>
      <div class="testimonial-card">
        <i class="fas fa-quote-left"></i>
        <p><?php echo $testimonial['text']; ?></p>
        <h6><?php echo $testimonial['name']; ?></h6>
        <span><?php echo $testimonial['location']; ?></span>
        <div style="margin-top: 8px; color: var(--gold); font-size:0.8rem;">
          <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
          <i class="fas fa-star"></i>
          <?php endfor; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CONTACT / REACH US ===== -->
<section id="contact" class="section-padding" aria-label="Contact information">
  <div class="container">
    <div class="section-header section-header-center reveal">
      <span class="section-tag">reach us</span>
      <h2 class="section-title">Get in <span class="text-gradient-gold">touch</span></h2>
      <div class="section-divider"></div>
    </div>
    <div class="contact-row-centered">
      <div class="contact-card">
        <p><i class="fas fa-user"></i> <strong><?php echo COMPANY_CEO; ?></strong> (Owner)</p>
        <p><i class="fas fa-map-marker-alt"></i> <?php echo COMPANY_ADDRESS; ?></p>
        <p><i class="fas fa-phone-alt"></i> <a href="tel:<?php echo COMPANY_PHONE; ?>" style="color: var(--gold);"><?php echo COMPANY_PHONE; ?></a></p>
        <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo COMPANY_EMAIL; ?>" style="color: var(--gold);"><?php echo COMPANY_EMAIL; ?></a></p>
        <div style="display: flex; gap: 10px; margin-top: 16px; flex-wrap: wrap;">
          <a href="<?php echo SOCIAL_FACEBOOK; ?>" class="btn-gold-outline"><i class="fab fa-facebook-f"></i> Facebook</a>
          <a href="<?php echo SOCIAL_TWITTER; ?>" class="btn-gold-outline"><i class="fab fa-twitter"></i> Twitter</a>
          <a href="<?php echo SOCIAL_LINKEDIN; ?>" class="btn-gold-outline"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
        </div>
      </div>
      <div style="background: var(--dark-light); border-radius: var(--radius); padding: 28px; border:1px solid rgba(213,168,81,0.06);">
        <h4 style="color:var(--text-strong); margin-bottom: 16px; font-weight: 600; text-align: center;">Send us a message</h4>
        <form class="form-dark" method="POST" action="#">
          <div style="display: grid; gap: 14px;">
            <input type="text" placeholder="Your Name" required />
            <input type="email" placeholder="Email Address" required />
            <input type="text" placeholder="Phone Number" />
            <textarea rows="3" placeholder="Describe your requirement..."></textarea>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Send <i class="fas fa-arrow-right"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include INCLUDES_PATH . '/footer.php'; ?>