<?php
// product.php - Products page with series catalogues
require_once 'config.php';
$page_title = 'Products';
$current_page = 'product.php';

$selected_series = isset($_GET['series']) ? $_GET['series'] : '';
$selected_product = isset($_GET['product']) ? $_GET['product'] : '';

$filtered_products = $all_products;
if ($selected_series && isset($series_data[$selected_series])) {
    $filtered_products = $series_data[$selected_series]['products'];
}

$single_product = null;
if ($selected_product) {
    foreach ($all_products as $p) {
        if ($p['id'] === $selected_product) {
            $single_product = $p;
            break;
        }
    }
}

$additional_css = '
<style>
  .product-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 40px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .product-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .product-hero .breadcrumb a { color: var(--gold); }
  .product-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .series-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin: 20px 0 30px;
  }
  .series-nav .series-btn {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-muted);
    padding: 10px 24px;
    border-radius: 50px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
  }
  .series-nav .series-btn:hover,
  .series-nav .series-btn.active {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }
  .series-nav .series-btn .badge-count {
    background: rgba(213,168,81,0.1);
    border-radius: 50%;
    padding: 0 8px;
    font-size: 0.7rem;
    color: var(--text-muted);
  }
  .series-nav .series-btn.active .badge-count {
    background: rgba(0,0,0,0.1);
    color: var(--dark);
  }

  .series-header {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 30px 32px;
    margin-bottom: 30px;
    border: 1px solid rgba(213,168,81,0.06);
    display: flex;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
  }
  .series-header .series-info {
    flex: 1;
    min-width: 200px;
  }
  .series-header .series-info h2 {
    color: var(--text-strong);
    font-weight: 700;
    font-size: 1.6rem;
    margin-bottom: 4px;
  }
  .series-header .series-info p {
    color: var(--text-muted);
    font-size: 0.95rem;
  }
  .series-header .series-stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }
  .series-header .series-stats .stat {
    text-align: center;
    padding: 8px 16px;
    background: var(--dark);
    border-radius: var(--radius-sm);
    border: 1px solid rgba(213,168,81,0.04);
  }
  .series-header .series-stats .stat .num {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--gold);
  }
  .series-header .series-stats .stat .label {
    font-size: 0.7rem;
    color: var(--text-muted);
    display: block;
  }

  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    margin-top: 10px;
  }
  .product-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.4s ease;
    display: flex;
    flex-direction: column;
  }
  .product-card:hover {
    border-color: rgba(213,168,81,0.15);
    transform: translateY(-8px);
    box-shadow: var(--shadow-gold);
  }
  .product-card .product-image {
    aspect-ratio: 1/1;
    overflow: hidden;
    background: var(--dark);
    position: relative;
  }
  .product-card .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
  }
  .product-card:hover .product-image img {
    transform: scale(1.06);
  }
  .product-card .product-image .product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--gold);
    color: var(--dark);
    font-size: 0.6rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 50px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }
  .product-card .product-body {
    padding: 16px 18px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .product-card .product-body h4 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1rem;
    margin: 4px 0 2px;
  }
  .product-card .product-body .product-code {
    font-size: 0.7rem;
    color: var(--text-muted);
    margin-bottom: 8px;
  }
  .product-card .product-body .product-desc {
    font-size: 0.8rem;
    color: var(--text-muted);
    line-height: 1.5;
    margin-bottom: 10px;
    flex: 1;
  }
  .product-card .product-body .product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--gold);
    margin-bottom: 12px;
  }
  .product-card .product-body .product-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
  }
  .product-card .product-body .product-actions .btn-quote {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    background: var(--gold);
    color: var(--dark);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
  }
  .product-card .product-body .product-actions .btn-quote:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }
  .product-card .product-body .product-actions .btn-view {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid rgba(213,168,81,0.08);
    background: transparent;
    color: var(--text-muted);
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .product-card .product-body .product-actions .btn-view:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  .product-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 20000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s ease;
    backdrop-filter: blur(8px);
    padding: 40px;
  }
  .product-modal-overlay.active {
    opacity: 1;
    pointer-events: all;
  }
  .product-modal {
    background: var(--dark-light);
    border-radius: var(--radius-lg);
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    border: 1px solid rgba(213,168,81,0.06);
    padding: 40px;
    transform: scale(0.95) translateY(20px);
    transition: transform 0.4s ease;
  }
  .product-modal-overlay.active .product-modal {
    transform: scale(1) translateY(0);
  }
  .product-modal .modal-close {
    float: right;
    background: transparent;
    border: none;
    color: var(--text-muted);
    font-size: 1.4rem;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  .product-modal .modal-close:hover {
    color: var(--gold);
  }
  .product-modal .modal-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 10px;
  }
  .product-modal .modal-content .modal-image img {
    width: 100%;
    border-radius: var(--radius);
    border: 1px solid rgba(213,168,81,0.04);
  }
  .product-modal .modal-content .modal-info h2 {
    color: var(--text-strong);
    font-weight: 700;
    font-size: 1.6rem;
    margin-bottom: 4px;
  }
  .product-modal .modal-content .modal-info .code {
    color: var(--text-muted);
    font-size: 0.85rem;
    margin-bottom: 8px;
  }
  .product-modal .modal-content .modal-info .series-tag {
    display: inline-block;
    background: rgba(213,168,81,0.08);
    color: var(--gold);
    padding: 2px 14px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-bottom: 12px;
  }
  .product-modal .modal-content .modal-info .price {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--gold);
    margin-bottom: 12px;
  }
  .product-modal .modal-content .modal-info .desc {
    color: var(--text-body);
    line-height: 1.7;
    margin-bottom: 16px;
  }
  .product-modal .modal-content .modal-info .btn-quote-modal {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 32px;
    background: var(--gold);
    color: var(--dark);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
  }
  .product-modal .modal-content .modal-info .btn-quote-modal:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }

  .toast-message {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--dark-light);
    color: var(--text-strong);
    border: 1px solid rgba(213,168,81,0.15);
    padding: 14px 28px;
    border-radius: 50px;
    box-shadow: var(--shadow-lg);
    z-index: 99999;
    font-size: 0.95rem;
    font-weight: 500;
    opacity: 0;
    pointer-events: none;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .toast-message.show {
    opacity: 1;
    pointer-events: all;
    transform: translateX(-50%) translateY(0);
  }
  .toast-message .toast-icon {
    font-size: 1.2rem;
  }
  .toast-message.success .toast-icon { color: #2d8a4e; }
  .toast-message.error .toast-icon { color: #e74c3c; }

  @media (max-width: 768px) {
    .product-hero { padding: 100px 0 30px; }
    .product-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
    .series-header { padding: 20px; flex-direction: column; text-align: center; }
    .series-header .series-stats { justify-content: center; }
    .product-modal .modal-content { grid-template-columns: 1fr; }
    .product-modal { padding: 24px; margin: 20px; }
  }
  @media (max-width: 480px) {
    .product-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
    .product-card .product-body .product-actions .btn-view { display: none; }
    .series-nav .series-btn { padding: 6px 14px; font-size: 0.7rem; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<section class="product-hero" aria-label="Products">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Products</span>
      <?php if ($selected_series): ?>
        <span>/</span> <span><?php echo htmlspecialchars($series_data[$selected_series]['name'] ?? $selected_series); ?></span>
      <?php endif; ?>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">
      <?php if ($selected_series && isset($series_data[$selected_series])): ?>
        <?php echo htmlspecialchars($series_data[$selected_series]['name']); ?>
      <?php else: ?>
        Our <span class="text-gradient-gold">Collection</span>
      <?php endif; ?>
    </h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">
      <?php if ($selected_series && isset($series_data[$selected_series])): ?>
        <?php echo htmlspecialchars($series_data[$selected_series]['description']); ?>
      <?php else: ?>
        Premium wall panels, mouldings, cornices, and decorative interior products crafted for excellence.
      <?php endif; ?>
    </p>
  </div>
</section>

<section class="section-padding" style="padding-top: 20px;" aria-label="Product listings">
  <div class="container">
    
    <nav class="series-nav" aria-label="Product series">
      <a href="product.php" class="series-btn <?php echo !$selected_series ? 'active' : ''; ?>">
        All Products <span class="badge-count"><?php echo count($all_products); ?></span>
      </a>
      <?php foreach ($series_data as $code => $series): ?>
        <a href="product.php?series=<?php echo $code; ?>" class="series-btn <?php echo $selected_series === $code ? 'active' : ''; ?>">
          <?php echo htmlspecialchars($series['name']); ?>
          <span class="badge-count"><?php echo $series['items']; ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <?php if ($selected_series && isset($series_data[$selected_series])): ?>
      <div class="series-header reveal">
        <div class="series-info">
          <h2><?php echo htmlspecialchars($series_data[$selected_series]['name']); ?></h2>
          <p><?php echo htmlspecialchars($series_data[$selected_series]['description']); ?></p>
        </div>
        <div class="series-stats">
          <div class="stat">
            <span class="num"><?php echo $series_data[$selected_series]['items']; ?></span>
            <span class="label">Products</span>
          </div>
          <div class="stat">
            <span class="num">₹<?php echo number_format($base_prices[$selected_series] ?? 500); ?></span>
            <span class="label">Starting Price</span>
          </div>
          <div class="stat">
            <span class="num"><?php echo ucfirst($unit_map[$selected_series] ?? 'unit'); ?></span>
            <span class="label">Unit</span>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="product-grid" id="productGrid">
      <?php foreach ($filtered_products as $product): ?>
        <div class="product-card reveal" data-product-id="<?php echo $product['id']; ?>">
          <div class="product-image">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy" />
            <span class="product-badge"><?php echo htmlspecialchars($product['series']); ?></span>
          </div>
          <div class="product-body">
            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
            <span class="product-code">Code: <?php echo htmlspecialchars($product['code']); ?></span>
            <p class="product-desc"><?php echo htmlspecialchars($product['description']); ?></p>
            <div class="product-price">₹<?php echo number_format($product['price']); ?> <span style="font-size:0.7rem; color:var(--text-muted); font-weight:400;">/<?php echo $product['unit']; ?></span></div>
            <div class="product-actions">
              <a href="contact.php?product=<?php echo $product['id']; ?>" class="btn-quote">
                <i class="fas fa-paper-plane"></i> Request Quote
              </a>
              <button class="btn-view" data-product-id="<?php echo $product['id']; ?>" aria-label="View product details">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (empty($filtered_products)): ?>
      <div class="text-center mt-20" style="padding: 60px 0; color: var(--text-muted);">
        <i class="fas fa-box-open" style="font-size: 3rem; opacity: 0.2; display: block; margin-bottom: 16px;"></i>
        <p>No products found in this series.</p>
      </div>
    <?php endif; ?>

  </div>
</section>

<section class="cta-section" aria-label="Contact us">
  <div class="container">
    <span class="cta-badge">Need Help?</span>
    <h2 class="cta-title">Looking for <span class="text-gradient-gold">custom solutions?</span></h2>
    <p class="cta-sub">Contact our team for bulk orders, custom designs, or any assistance.</p>
    <div class="cta-buttons">
      <a href="contact.php" class="btn-primary btn-lg">Request a Quote <i class="fas fa-arrow-right"></i></a>
      <a href="tel:<?php echo COMPANY_PHONE; ?>" class="btn-outline-light btn-lg">Call Now <i class="fas fa-phone"></i></a>
    </div>
  </div>
</section>

<div class="product-modal-overlay" id="productModal">
  <div class="product-modal">
    <button class="modal-close" id="modalClose" aria-label="Close modal"><i class="fas fa-times"></i></button>
    <div class="modal-content" id="modalContent">
      <div class="modal-image">
        <img id="modalImg" src="" alt="Product" />
      </div>
      <div class="modal-info">
        <span class="series-tag" id="modalSeries">Series</span>
        <h2 id="modalName">Product Name</h2>
        <p class="code" id="modalCode">Code: EWP-0000</p>
        <div class="price" id="modalPrice">₹0</div>
        <p class="desc" id="modalDesc">Product description goes here.</p>
        <a href="contact.php" class="btn-quote-modal" id="modalQuote">
          <i class="fas fa-paper-plane"></i> Request Quote
        </a>
      </div>
    </div>
  </div>
</div>

<div class="toast-message" id="toastMessage">
  <span class="toast-icon"><i class="fas fa-check-circle"></i></span>
  <span id="toastText">Success</span>
</div>

<?php
$additional_js = '
<script>
(function() {
  "use strict";

  const toast = document.getElementById("toastMessage");
  const toastText = document.getElementById("toastText");
  const toastIcon = toast.querySelector(".toast-icon i");

  function showToast(msg, success = true) {
    toastText.textContent = msg;
    toastIcon.className = success ? "fas fa-check-circle" : "fas fa-exclamation-circle";
    toast.className = "toast-message show " + (success ? "success" : "error");
    clearTimeout(toast._timer);
    toast._timer = setTimeout(function() {
      toast.classList.remove("show");
    }, 4000);
  }

  // ===== PRODUCT DETAIL MODAL =====
  const modal = document.getElementById("productModal");
  const modalClose = document.getElementById("modalClose");
  const modalImg = document.getElementById("modalImg");
  const modalName = document.getElementById("modalName");
  const modalCode = document.getElementById("modalCode");
  const modalPrice = document.getElementById("modalPrice");
  const modalDesc = document.getElementById("modalDesc");
  const modalSeries = document.getElementById("modalSeries");
  const modalQuote = document.getElementById("modalQuote");

  const products = <?php echo json_encode($all_products); ?>;

  function openModal(productId) {
    const product = products.find(function(p) { return p.id === productId; });
    if (!product) return;
    
    modalImg.src = product.image;
    modalImg.alt = product.name;
    modalName.textContent = product.name;
    modalCode.textContent = "Code: " + product.code;
    modalPrice.textContent = "₹" + Number(product.price).toLocaleString() + " /" + product.unit;
    modalDesc.textContent = product.description;
    modalSeries.textContent = product.series + " Series";
    modalQuote.href = "contact.php?product=" + product.id;
    
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
  }

  function closeModal() {
    modal.classList.remove("active");
    document.body.style.overflow = "";
  }

  document.querySelectorAll(".btn-view").forEach(function(btn) {
    btn.addEventListener("click", function(e) {
      e.stopPropagation();
      const id = this.getAttribute("data-product-id");
      openModal(id);
    });
  });

  modalClose.addEventListener("click", closeModal);
  modal.addEventListener("click", function(e) {
    if (e.target === this) closeModal();
  });
  document.addEventListener("keydown", function(e) {
    if (e.key === "Escape" && modal.classList.contains("active")) closeModal();
  });

  console.log("Elegancia · Products page loaded");
})();
</script>
';

include INCLUDES_PATH . '/footer.php';
?>