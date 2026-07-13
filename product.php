<?php
// product.php - Products page
require_once 'config.php';
$page_title = 'Products';
$current_page = 'product.php';

$additional_css = '
<style>
  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
    margin-top: 24px;
  }
  .product-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(213,168,81,0.04);
    transition: all 0.4s var(--ease);
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
  }
  .product-card .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s var(--ease);
  }
  .product-card:hover .product-image img {
    transform: scale(1.06);
  }
  .product-card .product-body {
    padding: 16px 18px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .product-card .product-body .product-tag {
    font-size: 0.6rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
  }
  .product-card .product-body h4 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1rem;
    margin: 4px 0 6px;
  }
  .product-card .product-body .product-code {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-bottom: 8px;
  }
  .product-card .product-body .product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--gold);
    margin-bottom: 12px;
  }
  .product-card .product-body .btn-add-cart {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--gold);
    color: var(--dark);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    width: 100%;
    margin-top: auto;
  }
  .product-card .product-body .btn-add-cart:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }
  .product-card .product-body .btn-add-cart.added {
    background: #2d8a4e;
    color: #fff;
  }
  .product-card .product-body .btn-add-cart:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
  .filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    justify-content: center;
    margin: 16px 0 8px;
  }
  .filter-bar .filter-btn {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-muted);
    padding: 6px 18px;
    border-radius: 50px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
  }
  .filter-bar .filter-btn:hover,
  .filter-bar .filter-btn.active {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }
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

  .cart-float {
    position: fixed;
    bottom: 30px;
    left: 30px;
    z-index: 9999;
    background: var(--dark-light);
    border: 1px solid rgba(213,168,81,0.15);
    border-radius: 60px;
    padding: 12px 18px 12px 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: var(--shadow-lg);
    cursor: pointer;
    transition: all 0.3s var(--ease);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }
  .cart-float:hover {
    transform: translateY(-4px);
    border-color: var(--gold);
    box-shadow: var(--shadow-gold);
  }
  .cart-float .cart-icon {
    position: relative;
    font-size: 1.6rem;
    color: var(--gold);
  }
  .cart-float .cart-badge {
    position: absolute;
    top: -8px;
    right: -10px;
    background: var(--gold);
    color: var(--dark);
    font-size: 0.65rem;
    font-weight: 700;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s var(--ease);
  }
  .cart-float .cart-badge.pop {
    transform: scale(1.3);
  }
  .cart-float .cart-total {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 0.9rem;
    border-left: 1px solid rgba(213,168,81,0.08);
    padding-left: 12px;
  }
  .cart-float .cart-total span {
    color: var(--gold);
    font-weight: 700;
  }

  .cart-drawer-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.7);
    z-index: 10000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s var(--ease);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
  }
  .cart-drawer-overlay.active {
    opacity: 1;
    pointer-events: all;
  }
  .cart-drawer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    max-width: 560px;
    max-height: 85vh;
    background: var(--dark-light);
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    border: 1px solid rgba(213,168,81,0.06);
    border-bottom: none;
    padding: 24px 28px 28px;
    z-index: 10001;
    transform: translateY(100%);
    transition: transform 0.5s var(--ease);
    overflow-y: auto;
    box-shadow: 0 -12px 48px rgba(0,0,0,0.6);
  }
  .cart-drawer.open {
    transform: translateY(0);
  }
  .cart-drawer .drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
  }
  .cart-drawer .drawer-header h3 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.2rem;
  }
  .cart-drawer .drawer-header h3 i {
    color: var(--gold);
    margin-right: 8px;
  }
  .cart-drawer .drawer-close {
    background: transparent;
    border: none;
    color: var(--text-muted);
    font-size: 1.2rem;
    cursor: pointer;
    transition: color 0.3s var(--ease);
  }
  .cart-drawer .drawer-close:hover {
    color: var(--gold);
  }
  .cart-drawer .cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(213,168,81,0.04);
  }
  .cart-drawer .cart-item .item-info {
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .cart-drawer .cart-item .item-name {
    color: var(--text-strong);
    font-weight: 500;
    font-size: 0.9rem;
  }
  .cart-drawer .cart-item .item-price {
    color: var(--gold);
    font-weight: 600;
    font-size: 0.85rem;
  }
  .cart-drawer .cart-item .item-qty {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .cart-drawer .cart-item .item-qty button {
    background: transparent;
    border: 1px solid rgba(213,168,81,0.08);
    color: var(--text-strong);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .cart-drawer .cart-item .item-qty button:hover {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
  }
  .cart-drawer .cart-item .item-qty .qty-num {
    color: var(--text-strong);
    font-weight: 600;
    min-width: 20px;
    text-align: center;
  }
  .cart-drawer .cart-item .item-remove {
    background: transparent;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    transition: color 0.3s var(--ease);
    margin-left: 8px;
  }
  .cart-drawer .cart-item .item-remove:hover {
    color: #e74c3c;
  }
  .cart-drawer .drawer-footer {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid rgba(213,168,81,0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }
  .cart-drawer .drawer-footer .total-label {
    color: var(--text-muted);
    font-size: 0.9rem;
  }
  .cart-drawer .drawer-footer .total-amount {
    color: var(--gold);
    font-size: 1.4rem;
    font-weight: 700;
  }
  .cart-drawer .drawer-footer .checkout-btn {
    background: var(--gold);
    color: var(--dark);
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    width: 100%;
  }
  .cart-drawer .drawer-footer .checkout-btn:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }
  .cart-drawer .drawer-footer .checkout-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
  .cart-drawer .empty-cart {
    color: var(--text-muted);
    text-align: center;
    padding: 30px 0;
  }
  .cart-drawer .empty-cart i {
    font-size: 2.4rem;
    color: rgba(213,168,81,0.1);
    display: block;
    margin-bottom: 12px;
  }

  .cart-toast {
    position: fixed;
    bottom: 100px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--dark-light);
    color: var(--text-strong);
    border: 1px solid rgba(213,168,81,0.15);
    padding: 12px 24px;
    border-radius: 50px;
    box-shadow: var(--shadow-lg);
    z-index: 99999;
    font-size: 0.9rem;
    font-weight: 500;
    opacity: 0;
    pointer-events: none;
    transition: all 0.4s var(--ease);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .cart-toast.show {
    opacity: 1;
    pointer-events: all;
    transform: translateX(-50%) translateY(0);
  }
  .cart-toast i {
    color: #2d8a4e;
  }

  .checkout-form {
    display: none;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(213,168,81,0.06);
  }
  .checkout-form.active {
    display: block;
  }
  .checkout-form .form-group {
    margin-bottom: 14px;
  }
  .checkout-form .form-group label {
    display: block;
    color: var(--text-muted);
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 4px;
  }
  .checkout-form .form-group input,
  .checkout-form .form-group textarea {
    width: 100%;
    background: var(--dark);
    border: 1px solid rgba(213,168,81,0.06);
    padding: 10px 14px;
    border-radius: var(--radius-sm);
    color: var(--text-strong);
    font-family: inherit;
    font-size: 0.9rem;
    transition: border 0.3s var(--ease);
  }
  .checkout-form .form-group input:focus,
  .checkout-form .form-group textarea:focus {
    border-color: var(--gold);
    outline: none;
  }
  .checkout-form .form-group textarea {
    resize: vertical;
    min-height: 80px;
  }
  .checkout-form .form-group input::placeholder,
  .checkout-form .form-group textarea::placeholder {
    color: rgba(224,221,208,0.2);
  }
  .checkout-form .submit-order-btn {
    background: var(--gold);
    color: var(--dark);
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    width: 100%;
    font-size: 1rem;
  }
  .checkout-form .submit-order-btn:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }
  .checkout-form .submit-order-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  @media (max-width: 768px) {
    .product-hero { padding: 100px 0 30px; }
    .product-grid { grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; }
    .cart-float { bottom: 20px; left: 20px; padding: 10px 14px; }
    .cart-float .cart-icon { font-size: 1.3rem; }
    .cart-float .cart-total { font-size: 0.75rem; padding-left: 8px; }
    .cart-drawer { max-width: 100%; padding: 20px; max-height: 70vh; }
  }
  @media (max-width: 480px) {
    .product-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== PRODUCT HERO ===== -->
<section class="product-hero" aria-label="Products">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Products</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Our <span class="text-gradient-gold">Collection</span></h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Premium wall panels, mouldings, cornices, and decorative interior products crafted for excellence.</p>
  </div>
</section>

<!-- ===== PRODUCTS GRID ===== -->
<section class="section-padding" style="padding-top: 20px;" aria-label="Product listings">
  <div class="container">
    <div class="filter-bar reveal">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="panels">Wall Panels</button>
      <button class="filter-btn" data-filter="mouldings">Mouldings</button>
      <button class="filter-btn" data-filter="cornices">Cornices</button>
      <button class="filter-btn" data-filter="skirting">Skirting</button>
      <button class="filter-btn" data-filter="adhesives">Adhesives</button>
    </div>

    <div class="product-grid" id="productGrid">
      <?php foreach ($products as $product): ?>
      <div class="product-card" data-category="<?php echo $product['category']; ?>">
        <div class="product-image">
          <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" loading="lazy" />
        </div>
        <div class="product-body">
          <span class="product-tag"><?php echo ucfirst(str_replace('_', ' ', $product['category'])); ?></span>
          <h4><?php echo $product['name']; ?></h4>
          <span class="product-code">Code: <?php echo $product['code']; ?></span>
          <div class="product-price">₹<?php echo number_format($product['price']); ?> <span style="font-size:0.7rem; color:var(--text-muted); font-weight:400;">/<?php echo $product['unit']; ?></span></div>
          <button class="btn-add-cart" data-product-id="<?php echo $product['id']; ?>" data-product-name="<?php echo htmlspecialchars($product['name']); ?>" data-product-price="<?php echo $product['price']; ?>">
            <i class="fas fa-shopping-cart"></i> Add to Cart
          </button>
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

<!-- ===== FLOATING CART ===== -->
<div class="cart-float" id="cartFloat" aria-label="Open cart">
  <div class="cart-icon">
    <i class="fas fa-shopping-bag"></i>
    <span class="cart-badge" id="cartBadge">0</span>
  </div>
  <div class="cart-total">
    Total: <span id="cartTotal">₹0</span>
  </div>
</div>

<!-- ===== CART DRAWER ===== -->
<div class="cart-drawer-overlay" id="cartOverlay"></div>
<div class="cart-drawer" id="cartDrawer" role="dialog" aria-modal="true" aria-label="Shopping cart">
  <div class="drawer-header">
    <h3><i class="fas fa-shopping-bag"></i> Your Cart</h3>
    <button class="drawer-close" id="cartClose" aria-label="Close cart"><i class="fas fa-times"></i></button>
  </div>
  <div id="cartItems">
    <div class="empty-cart">
      <i class="fas fa-shopping-bag"></i>
      <p>Your cart is empty.</p>
    </div>
  </div>
  
  <div class="checkout-form" id="checkoutForm">
    <h4 style="color:var(--text-strong); margin-bottom:12px;">Complete Your Order</h4>
    <div class="form-group">
      <label for="checkoutName">Full Name *</label>
      <input type="text" id="checkoutName" placeholder="Your full name" required />
    </div>
    <div class="form-group">
      <label for="checkoutEmail">Email Address *</label>
      <input type="email" id="checkoutEmail" placeholder="your@email.com" required />
    </div>
    <div class="form-group">
      <label for="checkoutPhone">Phone Number *</label>
      <input type="tel" id="checkoutPhone" placeholder="9876543210" required />
    </div>
    <div class="form-group">
      <label for="checkoutAddress">Shipping Address *</label>
      <textarea id="checkoutAddress" placeholder="Enter your full address" required></textarea>
    </div>
    <button class="submit-order-btn" id="submitOrder">Place Order <i class="fas fa-arrow-right"></i></button>
  </div>
  
  <div class="drawer-footer" id="cartFooter">
    <div>
      <div class="total-label">Total</div>
      <div class="total-amount" id="drawerTotal">₹0</div>
    </div>
    <button class="checkout-btn" id="checkoutBtn">Proceed to Checkout <i class="fas fa-arrow-right"></i></button>
  </div>
</div>

<!-- Toast notification -->
<div class="cart-toast" id="cartToast">
  <i class="fas fa-check-circle"></i>
  <span id="toastMessage">Added to cart</span>
</div>

<?php
$additional_js = '
<script>
(function() {
  "use strict";

  let cart = [];
  let isCheckoutMode = false;

  const cartFloat = document.getElementById("cartFloat");
  const cartBadge = document.getElementById("cartBadge");
  const cartTotal = document.getElementById("cartTotal");
  const cartDrawer = document.getElementById("cartDrawer");
  const cartOverlay = document.getElementById("cartOverlay");
  const cartClose = document.getElementById("cartClose");
  const cartItemsContainer = document.getElementById("cartItems");
  const drawerTotal = document.getElementById("drawerTotal");
  const checkoutBtn = document.getElementById("checkoutBtn");
  const checkoutForm = document.getElementById("checkoutForm");
  const submitOrderBtn = document.getElementById("submitOrder");
  const toast = document.getElementById("cartToast");
  const toastMsg = document.getElementById("toastMessage");

  async function apiCall(endpoint, method, data) {
    try {
      const response = await fetch(endpoint, {
        method: method,
        headers: { "Content-Type": "application/json" },
        body: data ? JSON.stringify(data) : undefined
      });
      return await response.json();
    } catch (error) {
      console.error("API Error:", error);
      return { success: false, message: "Network error" };
    }
  }

  async function loadCart() {
    const result = await apiCall("api/cart?action=get", "GET");
    if (result.success && result.data) {
      cart = result.data.cart || [];
      renderCart();
    }
  }

  function renderCart() {
    const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    cartBadge.textContent = totalItems;
    cartTotal.textContent = "₹" + totalPrice.toLocaleString();

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = `
        <div class="empty-cart">
          <i class="fas fa-shopping-bag"></i>
          <p>Your cart is empty.</p>
        </div>
      `;
      drawerTotal.textContent = "₹0";
      checkoutBtn.style.display = "none";
      checkoutForm.classList.remove("active");
      isCheckoutMode = false;
      return;
    }

    checkoutBtn.style.display = "block";

    let html = "";
    cart.forEach((item) => {
      html += `
        <div class="cart-item">
          <div class="item-info">
            <span class="item-name">${item.name}</span>
            <span class="item-price">₹${item.price.toLocaleString()}</span>
          </div>
          <div class="item-qty">
            <button class="qty-decr" data-id="${item.id}">−</button>
            <span class="qty-num">${item.qty}</span>
            <button class="qty-incr" data-id="${item.id}">+</button>
            <button class="item-remove" data-id="${item.id}" aria-label="Remove item"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      `;
    });
    cartItemsContainer.innerHTML = html;
    drawerTotal.textContent = "₹" + totalPrice.toLocaleString();

    document.querySelectorAll(".qty-incr").forEach(btn => {
      btn.addEventListener("click", function(e) {
        e.stopPropagation();
        const id = this.getAttribute("data-id");
        updateCartItem(id, 1);
      });
    });
    document.querySelectorAll(".qty-decr").forEach(btn => {
      btn.addEventListener("click", function(e) {
        e.stopPropagation();
        const id = this.getAttribute("data-id");
        const item = cart.find(i => i.id == id);
        if (item && item.qty > 1) {
          updateCartItem(id, -1);
        } else {
          removeCartItem(id);
        }
      });
    });
    document.querySelectorAll(".item-remove").forEach(btn => {
      btn.addEventListener("click", function(e) {
        e.stopPropagation();
        const id = this.getAttribute("data-id");
        removeCartItem(id);
      });
    });
  }

  async function addToCart(productId, name, price) {
    const result = await apiCall("api/cart?action=add", "POST", {
      product_id: productId,
      name: name,
      price: price,
      qty: 1
    });
    if (result.success) {
      cart = result.data.cart || [];
      renderCart();
      cartBadge.classList.add("pop");
      setTimeout(() => cartBadge.classList.remove("pop"), 300);
      showToast(name + " added to cart");
    } else {
      showToast(result.message || "Error adding to cart");
    }
  }

  async function updateCartItem(productId, delta) {
    const item = cart.find(i => i.id == productId);
    if (!item) return;
    const newQty = Math.max(0, item.qty + delta);
    if (newQty === 0) {
      removeCartItem(productId);
      return;
    }
    const result = await apiCall("api/cart?action=update", "POST", {
      product_id: productId,
      qty: newQty
    });
    if (result.success) {
      cart = result.data.cart || [];
      renderCart();
    }
  }

  async function removeCartItem(productId) {
    const result = await apiCall("api/cart?action=remove", "POST", {
      product_id: productId
    });
    if (result.success) {
      cart = result.data.cart || [];
      renderCart();
      showToast("Item removed from cart");
    }
  }

  function toggleCheckout() {
    if (cart.length === 0) {
      showToast("Your cart is empty");
      return;
    }
    isCheckoutMode = !isCheckoutMode;
    if (isCheckoutMode) {
      checkoutForm.classList.add("active");
      checkoutBtn.textContent = "Back to Cart";
      checkoutBtn.style.background = "var(--text-muted)";
    } else {
      checkoutForm.classList.remove("active");
      checkoutBtn.textContent = "Proceed to Checkout";
      checkoutBtn.style.background = "";
    }
  }

  async function submitOrder() {
    const name = document.getElementById("checkoutName").value.trim();
    const email = document.getElementById("checkoutEmail").value.trim();
    const phone = document.getElementById("checkoutPhone").value.trim();
    const address = document.getElementById("checkoutAddress").value.trim();

    if (!name || !email || !phone || !address) {
      showToast("Please fill in all required fields");
      return;
    }

    if (!email.includes("@")) {
      showToast("Please enter a valid email address");
      return;
    }

    if (!/^[0-9]{10}$/.test(phone)) {
      showToast("Please enter a valid 10-digit phone number");
      return;
    }

    submitOrderBtn.disabled = true;
    submitOrderBtn.textContent = "Processing...";

    const result = await apiCall("api/checkout", "POST", {
      name, email, phone, address
    });

    submitOrderBtn.disabled = false;
    submitOrderBtn.textContent = "Place Order";

    if (result.success) {
      showToast("🎉 Order placed! We will contact you shortly.");
      cart = [];
      renderCart();
      isCheckoutMode = false;
      checkoutForm.classList.remove("active");
      checkoutBtn.textContent = "Proceed to Checkout";
      checkoutBtn.style.background = "";
      document.getElementById("checkoutName").value = "";
      document.getElementById("checkoutEmail").value = "";
      document.getElementById("checkoutPhone").value = "";
      document.getElementById("checkoutAddress").value = "";
      closeCart();
    } else {
      showToast(result.message || "Error placing order");
    }
  }

  function showToast(msg) {
    toastMsg.textContent = msg;
    toast.classList.add("show");
    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => toast.classList.remove("show"), 3000);
  }

  function openCart() {
    cartDrawer.classList.add("open");
    cartOverlay.classList.add("active");
    document.body.style.overflow = "hidden";
    if (isCheckoutMode) {
      isCheckoutMode = false;
      checkoutForm.classList.remove("active");
      checkoutBtn.textContent = "Proceed to Checkout";
      checkoutBtn.style.background = "";
    }
  }
  
  function closeCart() {
    cartDrawer.classList.remove("open");
    cartOverlay.classList.remove("active");
    document.body.style.overflow = "";
  }

  cartFloat.addEventListener("click", openCart);
  cartClose.addEventListener("click", closeCart);
  cartOverlay.addEventListener("click", closeCart);

  checkoutBtn.addEventListener("click", toggleCheckout);
  submitOrderBtn.addEventListener("click", submitOrder);

  document.querySelectorAll(".btn-add-cart").forEach(btn => {
    btn.addEventListener("click", function(e) {
      e.stopPropagation();
      const id = this.getAttribute("data-product-id");
      const name = this.getAttribute("data-product-name");
      const price = this.getAttribute("data-product-price");
      addToCart(id, name, price);

      this.classList.add("added");
      this.innerHTML = "<i class=\"fas fa-check\"></i> Added";
      setTimeout(() => {
        this.classList.remove("added");
        this.innerHTML = "<i class=\"fas fa-shopping-cart\"></i> Add to Cart";
      }, 1800);
    });
  });

  const filterBtns = document.querySelectorAll(".filter-btn");
  const products = document.querySelectorAll(".product-card");

  filterBtns.forEach(btn => {
    btn.addEventListener("click", function() {
      filterBtns.forEach(b => b.classList.remove("active"));
      this.classList.add("active");
      const filter = this.getAttribute("data-filter");
      products.forEach(card => {
        const category = card.getAttribute("data-category");
        card.style.display = (filter === "all" || category === filter) ? "flex" : "none";
      });
    });
  });

  loadCart();
  console.log("Elegancia · Products page loaded");
})();
</script>
';

include INCLUDES_PATH . '/footer.php';
?>