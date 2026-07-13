<?php
// index.php - Homepage
require_once 'config.php';

$page_title = 'Premium Interior Solutions';
$use_tailwind = true;
$current_page = 'index.php';

// Include header from includes folder
include INCLUDES_PATH . '/header.php';
?>

<!-- ===== HERO ===== -->
<section id="hero" class="hero-section" aria-label="Hero">
  <div class="hero-bg" style="background: radial-gradient(ellipse at 20% 50%, rgba(213,168,81,0.10) 0%, transparent 60%), radial-gradient(ellipse at 80% 30%, rgba(213,168,81,0.06) 0%, transparent 45%), url('assets/images/hero-banner.webp') center/cover no-repeat;"></div>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content">
      <span class="hero-badge fade-in-up">Elegancia · Premium Decor</span>
      <h1 class="hero-title fade-in-up" style="animation-delay:0.2s;">Premium Decorative <span class="text-gradient-gold">Interior Solutions</span></h1>
      <p class="hero-sub fade-in-up" style="animation-delay:0.4s;">Manufacturers of Premium Wall Panels, Wall Mouldings, Photo Frame Mouldings, Ceiling Cornices &amp; Decorative Interior Products.</p>
      <div class="hero-buttons fade-in-up" style="animation-delay:0.6s;">
        <a href="#products" class="btn-primary">Explore Collection <i class="fas fa-arrow-right"></i></a>
        <a href="#" class="btn-outline-light">Download Catalogue <i class="fas fa-download"></i></a>
      </div>
      <div class="scroll-indicator fade-in-up" style="animation-delay:0.8s;">
        <span>Scroll</span>
        <i class="fas fa-chevron-down"></i>
      </div>
    </div>
  </div>
  <!-- Decorative elements -->
  <div class="floating-elem" aria-hidden="true"><i class="fas fa-circle"></i></div>
  <div class="floating-elem" aria-hidden="true" style="animation-delay:1.2s"><i class="fas fa-square"></i></div>
  <div class="floating-elem" aria-hidden="true" style="animation-delay:0.6s"><i class="fas fa-plus"></i></div>
</section>

<!-- ===== ABOUT ===== -->
<section id="about" class="section-padding" aria-label="About Elegancia">
  <div class="container">
    <div class="row align-center">
      <div class="col-lg-6 reveal-left">
        <span class="section-tag">brand</span>
        <h2 class="section-title">Elegancia · <span class="text-gradient-gold">Premium Interior</span> Decorative Brand</h2>
        <p class="text-muted">Elegancia redefines interior elegance with a curated collection of wall panels, mouldings, cornices, and skirting. Each product is a blend of contemporary design and timeless craftsmanship, manufactured under the esteemed Swastik Moulds &amp; Plastic Pvt. Ltd.</p>
        <a href="#" class="btn-outline-gold">Read More <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="col-lg-6 reveal-right">
        <div class="img-zoom">
          <img src="https://placehold.co/800x600/1a1a1a/848461?text=Elegancia+Interior" alt="Elegancia premium interior display" loading="lazy" />
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== PRODUCTS ===== -->
<section id="products" class="section-padding bg-dark-light" aria-label="Product categories">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">categories</span>
      <h2 class="section-title">Explore our <span class="text-gradient-gold">range</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Discover our premium collection of decorative interior products</p>
    </div>
    <div class="category-grid">
      <!-- Category cards -->
      <a href="#" class="category-card group reveal" style="animation-delay:0.1s;">
        <img src="https://placehold.co/600x400/2a2a2a/848461?text=Photo+Frame+Mouldings" alt="Photo Frame Mouldings" loading="lazy" />
        <div class="category-overlay">
          <h4>Photo Frame Mouldings</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.2s;">
        <img src="https://placehold.co/600x400/1a1a1a/7e7c64?text=Charcoal+Wall+Panels" alt="Charcoal Wall Panels" loading="lazy" />
        <div class="category-overlay">
          <h4>Charcoal Wall Panels</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.3s;">
        <img src="https://placehold.co/600x400/2a2a2a/848461?text=Wall+Mouldings" alt="Wall Mouldings" loading="lazy" />
        <div class="category-overlay">
          <h4>Wall Mouldings</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.4s;">
        <img src="https://placehold.co/600x400/1a1a1a/7e7c64?text=Ceiling+Cornices" alt="Ceiling Cornices" loading="lazy" />
        <div class="category-overlay">
          <h4>Ceiling Cornices</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.5s;">
        <img src="https://placehold.co/600x400/2a2a2a/848461?text=Skirting" alt="Skirting" loading="lazy" />
        <div class="category-overlay">
          <h4>Skirting</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.6s;">
        <img src="https://placehold.co/600x400/1a1a1a/7e7c64?text=PU+Corners" alt="PU Corners" loading="lazy" />
        <div class="category-overlay">
          <h4>Decorative PU Corners</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.7s;">
        <img src="https://placehold.co/600x400/2a2a2a/848461?text=Adhesives" alt="Construction Adhesives" loading="lazy" />
        <div class="category-overlay">
          <h4>Construction Adhesives</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.8s;">
        <img src="https://placehold.co/600x400/1a1a1a/7e7c64?text=Sealants" alt="Silicone Sealants" loading="lazy" />
        <div class="category-overlay">
          <h4>Silicone Sealants</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      <a href="#" class="category-card group reveal" style="animation-delay:0.9s;">
        <img src="https://placehold.co/600x400/2a2a2a/848461?text=Wall+Panels" alt="Wall Panels" loading="lazy" />
        <div class="category-overlay">
          <h4>Wall Panels</h4>
          <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- ===== COMPANY ===== -->
<section id="applications" class="section-padding" aria-label="Company information">
  <div class="container">
    <div class="row align-center">
      <div class="col-lg-6 reveal-left">
        <div class="img-zoom">
          <img src="https://placehold.co/800x600/2a2a2a/848461?text=Swastik+Moulds" alt="Swastik Moulds &amp; Plastic Pvt. Ltd. manufacturing facility" loading="lazy" />
        </div>
      </div>
      <div class="col-lg-6 reveal-right">
        <span class="section-tag">company</span>
        <h2 class="section-title">Swastik Moulds &amp; <span class="text-gradient-gold">Plastic Pvt. Ltd.</span></h2>
        <p class="text-muted">With decades of manufacturing excellence, Swastik Moulds &amp; Plastic Pvt. Ltd. is the trusted powerhouse behind Elegancia. Our state-of-the-art facility, rigorous quality control, and passion for innovation make us the preferred partner for architects, designers, and builders.</p>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-count="100">0</span><span class="stat-suffix">+</span></div>
            <p>Designs</p>
          </div>
          <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-count="500">0</span><span class="stat-suffix">+</span></div>
            <p>Dealers</p>
          </div>
          <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-count="1000">0</span><span class="stat-suffix">+</span></div>
            <p>Projects</p>
          </div>
          <div class="stat-card">
            <div class="stat-value"><span class="stat-label">PAN India</span></div>
            <p>Supply Network</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== WHY ELEGANCIA ===== -->
<section class="section-padding bg-dark-light" aria-label="Why Elegancia">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">why elegancia</span>
      <h2 class="section-title">Designed for <span class="text-gradient-gold">excellence</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Discover what makes Elegancia the preferred choice for premium interiors</p>
    </div>
    <div class="features-grid">
      <div class="icon-card reveal" style="animation-delay:0.1s;">
        <i class="fas fa-gem"></i>
        <h5>Premium Quality</h5>
        <p>Finest materials, impeccable finish.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.2s;">
        <i class="fas fa-palette"></i>
        <h5>Innovative Designs</h5>
        <p>Contemporary aesthetics, timeless.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.3s;">
        <i class="fas fa-industry"></i>
        <h5>Modern Manufacturing</h5>
        <p>Advanced machinery, precision.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.4s;">
        <i class="fas fa-hand-holding-heart"></i>
        <h5>Easy Installation</h5>
        <p>User-friendly, time-saving.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.5s;">
        <i class="fas fa-leaf"></i>
        <h5>Eco Friendly</h5>
        <p>Sustainable, responsible.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.6s;">
        <i class="fas fa-truck"></i>
        <h5>Pan India Network</h5>
        <p>Reliable supply, everywhere.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.7s;">
        <i class="fas fa-headset"></i>
        <h5>Dealer Support</h5>
        <p>Dedicated assistance.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.8s;">
        <i class="fas fa-clock"></i>
        <h5>Fast Delivery</h5>
        <p>On-time, every time.</p>
      </div>
      <div class="icon-card reveal" style="animation-delay:0.9s;">
        <i class="fas fa-shield-alt"></i>
        <h5>Trusted Brand</h5>
        <p>Reliable, proven excellence.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== COLLECTIONS ===== -->
<section class="section-padding" aria-label="Featured collections">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">collections</span>
      <h2 class="section-title">Featured <span class="text-gradient-gold">collections</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Discover our most popular interior decorative collections</p>
    </div>
    <div class="collection-grid">
      <?php
      $collections = [
        ['name' => '5300 Series', 'desc' => 'Premium wall panel collection', 'image' => 'https://placehold.co/400x500/2a2a2a/848461?text=5300+Series'],
        ['name' => '5100 Series', 'desc' => 'Classic moulding designs', 'image' => 'https://placehold.co/400x500/1a1a1a/7e7c64?text=5100+Series'],
        ['name' => '4200 Series', 'desc' => 'Contemporary cornices', 'image' => 'https://placehold.co/400x500/2a2a2a/848461?text=4200+Series'],
        ['name' => 'Wall Mouldings', 'desc' => 'Elegant wall accents', 'image' => 'https://placehold.co/400x500/1a1a1a/7e7c64?text=Wall+Mouldings'],
        ['name' => 'Skirting', 'desc' => 'Perfect finishing touch', 'image' => 'https://placehold.co/400x500/2a2a2a/848461?text=Skirting'],
        ['name' => 'Ceiling Cornices', 'desc' => 'Elegant ceiling details', 'image' => 'https://placehold.co/400x500/1a1a1a/7e7c64?text=Cornices'],
        ['name' => 'Wall Panels', 'desc' => 'Modern wall solutions', 'image' => 'https://placehold.co/400x500/2a2a2a/848461?text=Panels'],
        ['name' => 'Decorative Mouldings', 'desc' => 'Timeless decorative pieces', 'image' => 'https://placehold.co/400x500/1a1a1a/7e7c64?text=Mouldings'],
        ['name' => 'Premium Cornices', 'desc' => 'Luxury ceiling details', 'image' => 'https://placehold.co/400x500/2a2a2a/848461?text=Premium+Cornices']
      ];
      $i = 0;
      foreach ($collections as $collection):
        $i++;
      ?>
      <div class="collection-card reveal" style="animation-delay:<?php echo $i * 0.1; ?>s;">
        <div class="collection-image">
          <img src="<?php echo $collection['image']; ?>" alt="<?php echo $collection['name']; ?>" loading="lazy" />
          <div class="collection-overlay">
            <a href="#" class="btn-outline-gold btn-sm">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="collection-info">
          <h4><?php echo $collection['name']; ?></h4>
          <p><?php echo $collection['desc']; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-12 reveal">
      <a href="#" class="btn-outline-gold">View All Collections <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery" class="section-padding bg-dark-light" aria-label="Interior inspiration gallery">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">inspiration</span>
      <h2 class="section-title">Interior <span class="text-gradient-gold">inspiration</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Explore stunning interiors featuring Elegancia's premium products</p>
    </div>
    <div class="gallery-grid">
      <?php
      $home_gallery = [
        ['image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Living+Room', 'label' => 'Living Room'],
        ['image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Bedroom', 'label' => 'Bedroom'],
        ['image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Office', 'label' => 'Office'],
        ['image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Reception', 'label' => 'Reception'],
        ['image' => 'https://placehold.co/600x400/2a2a2a/848461?text=TV+Unit', 'label' => 'TV Unit'],
        ['image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Hotel', 'label' => 'Hotel'],
        ['image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Restaurant', 'label' => 'Restaurant'],
        ['image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Showroom', 'label' => 'Showroom'],
        ['image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Lobby', 'label' => 'Lobby']
      ];
      $i = 0;
      foreach ($home_gallery as $item):
        $i++;
      ?>
      <div class="gallery-item reveal" style="animation-delay:<?php echo $i * 0.1; ?>s;">
        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['label']; ?> interior with Elegancia products" loading="lazy" />
        <div class="gallery-overlay"><span><?php echo $item['label']; ?></span></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== PROCESS ===== -->
<section class="section-padding" aria-label="Manufacturing process">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">process</span>
      <h2 class="section-title">Manufacturing <span class="text-gradient-gold">excellence</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">From design to delivery, our commitment to quality never wavers</p>
    </div>
    <div class="process-grid">
      <?php
      $steps = [
        ['step' => '01', 'title' => 'Design', 'desc' => 'Concept to 3D modelling'],
        ['step' => '02', 'title' => 'Manufacturing', 'desc' => 'Precision molding & finishing'],
        ['step' => '03', 'title' => 'Quality', 'desc' => 'Rigorous inspection'],
        ['step' => '04', 'title' => 'Packaging', 'desc' => 'Secure, premium packing'],
        ['step' => '05', 'title' => 'Dispatch', 'desc' => 'Timely logistics']
      ];
      $i = 0;
      foreach ($steps as $step):
        $i++;
      ?>
      <div class="process-card reveal" style="animation-delay:<?php echo $i * 0.1; ?>s;">
        <span class="step"><?php echo $step['step']; ?></span>
        <h5><?php echo $step['title']; ?></h5>
        <p><?php echo $step['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="section-padding bg-dark-light" aria-label="Testimonials">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">testimonials</span>
      <h2 class="section-title">What our <span class="text-gradient-gold">partners say</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Real feedback from our valued customers and partners</p>
    </div>
    <div class="testimonial-grid">
      <?php 
      $i = 0;
      foreach ($testimonials as $testimonial):
        $i++;
      ?>
      <div class="testimonial-card reveal" style="animation-delay:<?php echo $i * 0.1; ?>s;">
        <i class="fas fa-quote-left"></i>
        <p><?php echo $testimonial['text']; ?></p>
        <h6><?php echo $testimonial['name']; ?></h6>
        <span><?php echo $testimonial['location']; ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== BLOGS ===== -->
<section id="blogs" class="section-padding" aria-label="Latest insights">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-tag">blogs</span>
      <h2 class="section-title">Latest <span class="text-gradient-gold">insights</span></h2>
      <div class="section-divider"></div>
      <p class="text-muted" style="margin-top:10px;">Stay updated with the latest trends and expert tips</p>
    </div>
    <div class="blog-grid">
      <?php 
      $home_blogs = array_slice($blogs, 0, 3);
      $i = 0;
      foreach ($home_blogs as $blog):
        $i++;
      ?>
      <article class="blog-card reveal" style="animation-delay:<?php echo $i * 0.1; ?>s;">
        <img src="<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" loading="lazy" />
        <div class="blog-body">
          <span class="blog-tag"><?php echo ucfirst($blog['category']); ?></span>
          <h5><?php echo $blog['title']; ?></h5>
          <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CTA / CONTACT ===== -->
<section id="contact" class="cta-section" aria-label="Contact us">
  <div class="container">
    <span class="cta-badge reveal">Get In Touch</span>
    <h2 class="cta-title reveal" style="animation-delay:0.2s;">Transform Your Space With <span class="text-gradient-gold">Premium Decor</span></h2>
    <p class="cta-sub reveal" style="animation-delay:0.3s;">Let's bring your vision to life with Elegancia's exquisite range of interior decorative products.</p>
    <div class="cta-features reveal" style="animation-delay:0.4s;">
      <span class="cta-feature"><i class="fas fa-check-circle"></i> Premium Quality</span>
      <span class="cta-feature"><i class="fas fa-check-circle"></i> Expert Support</span>
      <span class="cta-feature"><i class="fas fa-check-circle"></i> Fast Delivery</span>
      <span class="cta-feature"><i class="fas fa-check-circle"></i> Best Prices</span>
    </div>
    <div class="cta-buttons reveal" style="animation-delay:0.5s;">
      <a href="#" class="btn-primary btn-lg">Request a Quote <i class="fas fa-arrow-right"></i></a>
      <a href="#" class="btn-outline-light btn-lg">Call Now <i class="fas fa-phone"></i></a>
    </div>
    <p class="cta-small reveal" style="animation-delay:0.6s;"><i class="fas fa-clock"></i> Available Monday - Saturday, 9:00 AM to 6:00 PM</p>
  </div>
</section>

<?php include INCLUDES_PATH . '/footer.php'; ?>