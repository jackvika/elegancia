<?php
// includes/header.php - Global header
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

// Ensure BASE_PATH is defined
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
    define('INCLUDES_PATH', BASE_PATH . '/includes');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($page_title) ? $page_title . ' · ' . SITE_NAME : SITE_NAME; ?></title>
  
  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/root.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/component.css" />
  <link rel="stylesheet" href="assets/css/animation.css" />
  <link rel="stylesheet" href="assets/css/responsive.css" />
  
  <?php if (isset($additional_css)): echo $additional_css; endif; ?>
  <?php if (isset($use_tailwind) && $use_tailwind === true): ?>
  <script src="https://cdn.tailwindcss.com"></script>
  <?php endif; ?>
</head>
<body>

<!-- ===== LOADING OVERLAY ===== -->
<div id="loadingOverlay" role="status" aria-label="Loading">
  <div class="loader-text">ELEGANCIA</div>
  <div class="loader-spinner"></div>
</div>

<!-- ===== SKIP LINK ===== -->
<a href="#main" class="skip-link">Skip to main content</a>

<!-- ===== HEADER ===== -->
<header class="site-header" id="siteHeader" role="banner">
  <div class="container">
    <div class="header-inner">
      <a href="index.php" class="brand-logo" aria-label="Elegancia Home">
        <span class="logo-elegancia">ELEGANCIA</span>
        <span class="logo-tag">premium interior solutions</span>
      </a>
      <nav class="main-nav" role="navigation" aria-label="Main navigation">
        <ul>
          <li><a href="index.php" class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">Home</a></li>
          <li><a href="aboutus.php" class="nav-link <?php echo $current_page === 'aboutus.php' ? 'active' : ''; ?>">About</a></li>
          <li class="has-dropdown">
            <a href="product.php" class="nav-link <?php echo $current_page === 'product.php' ? 'active' : ''; ?>">Products <i class="fas fa-chevron-down dropdown-arrow"></i></a>
            <div class="mega-dropdown">
              <div class="mega-dropdown-grid">
                <a href="product.php?cat=5300-series" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=5300+Series" alt="5300 Series" width="200" height="200" loading="lazy" /></span>
                  <span>5300 Series</span>
                </a>
                <a href="product.php?cat=5100-series" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=5100+Series" alt="5100 Series" width="200" height="200" loading="lazy" /></span>
                  <span>5100 Series</span>
                </a>
                <a href="product.php?cat=4200-series" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=4200+Series" alt="4200 Series" width="200" height="200" loading="lazy" /></span>
                  <span>4200 Series</span>
                </a>
                <a href="product.php?cat=wall-mouldings" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Mouldings" alt="Wall Mouldings" width="200" height="200" loading="lazy" /></span>
                  <span>Wall Mouldings</span>
                </a>
                <a href="product.php?cat=skirting" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Skirting" alt="Skirting" width="200" height="200" loading="lazy" /></span>
                  <span>Skirting</span>
                </a>
                <a href="product.php?cat=ceiling-cornices" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Ceiling+Cornices" alt="Ceiling Cornices" width="200" height="200" loading="lazy" /></span>
                  <span>Ceiling Cornices</span>
                </a>
                <a href="product.php?cat=wall-panels" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Panels" alt="Wall Panels" width="200" height="200" loading="lazy" /></span>
                  <span>Wall Panels</span>
                </a>
                <a href="product.php?cat=decorative-mouldings" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Decorative+Mouldings" alt="Decorative Mouldings" width="200" height="200" loading="lazy" /></span>
                  <span>Decorative Mouldings</span>
                </a>
                <a href="product.php?cat=premium-cornices" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Premium+Cornices" alt="Premium Cornices" width="200" height="200" loading="lazy" /></span>
                  <span>Premium Cornices</span>
                </a>
                <a href="product.php?cat=wall-coverings" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Coverings" alt="Wall Coverings" width="200" height="200" loading="lazy" /></span>
                  <span>Wall Coverings</span>
                </a>
                <a href="product.php?cat=floor-trims" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Floor+Trims" alt="Floor Trims" width="200" height="200" loading="lazy" /></span>
                  <span>Floor Trims</span>
                </a>
                <a href="product.php?cat=architraves" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Architraves" alt="Architraves" width="200" height="200" loading="lazy" /></span>
                  <span>Architraves</span>
                </a>
                <a href="product.php?cat=door-surrounds" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Door+Surrounds" alt="Door Surrounds" width="200" height="200" loading="lazy" /></span>
                  <span>Door Surrounds</span>
                </a>
                <a href="product.php?cat=window-sills" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Window+Sills" alt="Window Sills" width="200" height="200" loading="lazy" /></span>
                  <span>Window Sills</span>
                </a>
                <a href="product.php?cat=column-covers" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Column+Covers" alt="Column Covers" width="200" height="200" loading="lazy" /></span>
                  <span>Column Covers</span>
                </a>
                <a href="product.php?cat=rosettes" class="mega-dropdown-item">
                  <span class="dropdown-img-wrap"><img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Rosettes" alt="Rosettes" width="200" height="200" loading="lazy" /></span>
                  <span>Rosettes</span>
                </a>
              </div>
            </div>
          </li>
          <li><a href="application.php" class="nav-link <?php echo $current_page === 'application.php' ? 'active' : ''; ?>">Applications</a></li>
          <li><a href="gallery.php" class="nav-link <?php echo $current_page === 'gallery.php' ? 'active' : ''; ?>">Gallery</a></li>
          <li><a href="blog.php" class="nav-link <?php echo $current_page === 'blog.php' ? 'active' : ''; ?>">Blogs</a></li>
          <li><a href="contact.php" class="nav-link <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
        </ul>
      </nav>
      <div class="header-actions">
        <button class="btn-icon" aria-label="Search"><i class="fas fa-search"></i></button>
        <button class="btn-icon" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></button>
        <a href="#contact" class="btn-primary btn-sm d-none d-lg-inline-flex">Get Quote</a>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- ===== MOBILE MENU ===== -->
<div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Mobile navigation">
  <button class="close-menu" id="closeMenu" aria-label="Close menu"><i class="fas fa-times"></i></button>
  <nav role="navigation" aria-label="Mobile navigation">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="aboutus.php">About</a></li>
      <li class="mobile-has-submenu">
        <div class="mobile-submenu-toggle-row">
          <a href="product.php">Products</a>
          <button type="button" class="mobile-submenu-toggle" aria-label="Toggle Products submenu" aria-expanded="false">
            <i class="fas fa-chevron-down"></i>
          </button>
        </div>
        <div class="mobile-submenu">
          <div class="mobile-submenu-grid">
            <a href="product.php?cat=5300-series" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=5300+Series" alt="5300 Series" width="200" height="200" loading="lazy" />
              <span>5300 Series</span>
            </a>
            <a href="product.php?cat=5100-series" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=5100+Series" alt="5100 Series" width="200" height="200" loading="lazy" />
              <span>5100 Series</span>
            </a>
            <a href="product.php?cat=4200-series" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=4200+Series" alt="4200 Series" width="200" height="200" loading="lazy" />
              <span>4200 Series</span>
            </a>
            <a href="product.php?cat=wall-mouldings" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Mouldings" alt="Wall Mouldings" width="200" height="200" loading="lazy" />
              <span>Wall Mouldings</span>
            </a>
            <a href="product.php?cat=skirting" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Skirting" alt="Skirting" width="200" height="200" loading="lazy" />
              <span>Skirting</span>
            </a>
            <a href="product.php?cat=ceiling-cornices" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Ceiling+Cornices" alt="Ceiling Cornices" width="200" height="200" loading="lazy" />
              <span>Ceiling Cornices</span>
            </a>
            <a href="product.php?cat=wall-panels" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Panels" alt="Wall Panels" width="200" height="200" loading="lazy" />
              <span>Wall Panels</span>
            </a>
            <a href="product.php?cat=decorative-mouldings" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Decorative+Mouldings" alt="Decorative Mouldings" width="200" height="200" loading="lazy" />
              <span>Decorative Mouldings</span>
            </a>
            <a href="product.php?cat=premium-cornices" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Premium+Cornices" alt="Premium Cornices" width="200" height="200" loading="lazy" />
              <span>Premium Cornices</span>
            </a>
            <a href="product.php?cat=wall-coverings" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Wall+Coverings" alt="Wall Coverings" width="200" height="200" loading="lazy" />
              <span>Wall Coverings</span>
            </a>
            <a href="product.php?cat=floor-trims" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Floor+Trims" alt="Floor Trims" width="200" height="200" loading="lazy" />
              <span>Floor Trims</span>
            </a>
            <a href="product.php?cat=architraves" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Architraves" alt="Architraves" width="200" height="200" loading="lazy" />
              <span>Architraves</span>
            </a>
            <a href="product.php?cat=door-surrounds" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Door+Surrounds" alt="Door Surrounds" width="200" height="200" loading="lazy" />
              <span>Door Surrounds</span>
            </a>
            <a href="product.php?cat=window-sills" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Window+Sills" alt="Window Sills" width="200" height="200" loading="lazy" />
              <span>Window Sills</span>
            </a>
            <a href="product.php?cat=column-covers" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Column+Covers" alt="Column Covers" width="200" height="200" loading="lazy" />
              <span>Column Covers</span>
            </a>
            <a href="product.php?cat=rosettes" class="mobile-submenu-item">
              <img src="https://placehold.co/200x200/1a1a1a/d5a851?text=Rosettes" alt="Rosettes" width="200" height="200" loading="lazy" />
              <span>Rosettes</span>
            </a>
          </div>
        </div>
      </li>
      <li><a href="application.php">Applications</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="blog.php">Blogs</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
</div>
<div class="menu-overlay" id="menuOverlay"></div>

<!-- ===== MAIN CONTENT ===== -->
<main id="main">