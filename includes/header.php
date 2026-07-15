<?php
// includes/header.php - Simplified header with series dropdown
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
    define('INCLUDES_PATH', BASE_PATH . '/includes');
}

$pinterestMeta = '';
if (defined('PINTEREST_ENABLED') && PINTEREST_ENABLED) {
    $pinterestMeta = '
    <meta name="pinterest-rich-pin" content="true" />
    <meta property="og:type" content="product" />
    <meta property="og:site_name" content="' . SITE_NAME . '" />
    ';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($page_title) ? $page_title . ' · ' . SITE_NAME : SITE_NAME; ?></title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  
  <link rel="stylesheet" href="assets/css/root.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/component.css" />
  <link rel="stylesheet" href="assets/css/animation.css" />
  <link rel="stylesheet" href="assets/css/responsive.css" />
  
  <?php if (isset($additional_css)): echo $additional_css; endif; ?>
  <?php if (isset($use_tailwind) && $use_tailwind === true): ?>
  <script src="https://cdn.tailwindcss.com"></script>
  <?php endif; ?>

<meta name="p:domain_verify" content="774b60da553bf63fb8144c954787c771"/>

<meta name="facebook-domain-verification" content="itzil26yq13a1vikqq3f7ylyumvq6q" />

</head>
<body>

<div id="loadingOverlay" role="status" aria-label="Loading">
  <div class="loader-text">ELEGANCIA</div>
  <div class="loader-spinner"></div>
</div>

<a href="#main" class="skip-link">Skip to main content</a>

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
          <li class="has-dropdown" id="productsDropdown">
            <a href="product.php" class="nav-link <?php echo $current_page === 'product.php' ? 'active' : ''; ?>">Products <i class="fas fa-chevron-down dropdown-arrow"></i></a>
            <div class="mega-dropdown" id="megaDropdown">
              <div class="mega-dropdown-scroll">
                <div class="mega-dropdown-grid">
                  <?php
                  // Show ONLY unique series (no duplicates)
                  $unique_series = [];
                  foreach ($series_data as $code => $series) {
                      $unique_series[] = [
                          'code' => $code,
                          'name' => $series['name'],
                          'img' => $series['image']
                      ];
                  }
                  
                  // Display only the unique series (5 items)
                  foreach ($unique_series as $item):
                  ?>
                  <a href="product.php?series=<?php echo $item['code']; ?>" class="mega-dropdown-item">
                    <span class="dropdown-img-wrap"><img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" height="200" loading="lazy" /></span>
                    <span class="item-label"><?php echo $item['name']; ?></span>
                  </a>
                  <?php endforeach; ?>
                </div>
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
        <a href="contact.php" class="btn-primary btn-sm d-none d-lg-inline-flex">Get Quote</a>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </div>
</header>

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
            <?php
            // Show unique series for mobile (no duplicates)
            $mobile_series = [];
            foreach ($series_data as $code => $series) {
                $mobile_series[] = [
                    'code' => $code,
                    'name' => $series['name'],
                    'img' => $series['image']
                ];
            }
            // Limit to 6 items (but we only have 5)
            $mobile_series = array_slice($mobile_series, 0, 6);
            foreach ($mobile_series as $item):
            ?>
            <a href="product.php?series=<?php echo $item['code']; ?>" class="mobile-submenu-item">
              <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" height="200" loading="lazy" />
              <span><?php echo $item['name']; ?></span>
            </a>
            <?php endforeach; ?>
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

<main id="main">
