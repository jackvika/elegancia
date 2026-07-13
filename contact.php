<?php
// contact.php - Contact page
require_once 'config.php';
$page_title = 'Contact';
$current_page = 'contact.php';

$additional_css = '
<style>
  .contact-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 50px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .contact-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .contact-hero .breadcrumb a { color: var(--gold); }
  .contact-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-top: 20px;
  }
  .contact-info-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 32px 28px;
    border: 1px solid rgba(213,168,81,0.06);
  }
  .contact-info-card h3 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 20px;
  }
  .contact-info-card h3 i {
    color: var(--gold);
    margin-right: 10px;
  }
  .contact-info-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 18px;
  }
  .contact-info-item .icon-box {
    width: 44px;
    height: 44px;
    min-width: 44px;
    background: rgba(213,168,81,0.06);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 1.1rem;
    border: 1px solid rgba(213,168,81,0.06);
  }
  .contact-info-item .info-content h5 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 2px;
  }
  .contact-info-item .info-content p,
  .contact-info-item .info-content a {
    color: var(--text-muted);
    font-size: 0.85rem;
    line-height: 1.5;
    transition: color 0.3s var(--ease);
  }
  .contact-info-item .info-content a:hover {
    color: var(--gold);
  }

  .contact-form-wrapper {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 32px 28px;
    border: 1px solid rgba(213,168,81,0.06);
  }
  .contact-form-wrapper h3 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 20px;
  }
  .contact-form-wrapper h3 i {
    color: var(--gold);
    margin-right: 10px;
  }
  .form-group {
    margin-bottom: 16px;
  }
  .form-group label {
    display: block;
    color: var(--text-muted);
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
  }
  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    background: var(--dark);
    border: 1px solid rgba(213,168,81,0.06);
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    color: var(--text-strong);
    font-family: inherit;
    font-size: 0.9rem;
    transition: border 0.3s var(--ease);
  }
  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    border-color: var(--gold);
    outline: none;
  }
  .form-group input::placeholder,
  .form-group textarea::placeholder {
    color: rgba(224,221,208,0.2);
  }
  .form-group textarea {
    resize: vertical;
    min-height: 120px;
  }
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  .btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: var(--gold);
    color: var(--dark);
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s var(--ease);
    width: 100%;
  }
  .btn-submit:hover {
    background: var(--gold-dark);
    transform: scale(1.02);
  }
  .btn-submit:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .map-section {
    margin-top: 40px;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(213,168,81,0.06);
  }
  .map-section iframe {
    width: 100%;
    height: 320px;
    border: none;
    display: block;
  }

  .social-links-contact {
    display: flex;
    gap: 12px;
    margin-top: 20px;
    flex-wrap: wrap;
  }
  .social-links-contact a {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid rgba(213,168,81,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    transition: all 0.3s var(--ease);
    font-size: 1rem;
  }
  .social-links-contact a:hover {
    background: var(--gold);
    color: var(--dark);
    border-color: var(--gold);
    transform: translateY(-3px);
  }

  .business-hours {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(213,168,81,0.04);
  }
  .business-hours .hour-item {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: var(--text-muted);
    padding: 4px 0;
  }
  .business-hours .hour-item .day {
    color: var(--text-strong);
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
    transition: all 0.4s var(--ease);
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

  @media (max-width: 992px) {
    .contact-grid { grid-template-columns: 1fr; gap: 30px; }
    .contact-hero { padding: 100px 0 30px; }
  }
  @media (max-width: 480px) {
    .form-row { grid-template-columns: 1fr; }
    .contact-info-card,
    .contact-form-wrapper { padding: 20px 16px; }
    .map-section iframe { height: 200px; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== CONTACT HERO ===== -->
<section class="contact-hero" aria-label="Contact">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Contact</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Get in <span class="text-gradient-gold">Touch</span></h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Have a question or need a custom solution? Reach out to our team and let\'s bring your vision to life.</p>
  </div>
</section>

<!-- ===== CONTACT SECTION ===== -->
<section class="section-padding" style="padding-top: 10px;" aria-label="Contact information and form">
  <div class="container">
    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="contact-info-card reveal">
        <h3><i class="fas fa-address-card"></i> Contact Information</h3>
        
        <div class="contact-info-item">
          <div class="icon-box"><i class="fas fa-store"></i></div>
          <div class="info-content">
            <h5>Visit Us</h5>
            <p><?php echo COMPANY_ADDRESS; ?></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
          <div class="info-content">
            <h5>Call Us</h5>
            <a href="tel:<?php echo COMPANY_PHONE; ?>"><?php echo COMPANY_PHONE; ?></a>
            <p>Mon–Sat, 9:00 AM – 6:00 PM</p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="icon-box"><i class="fas fa-envelope"></i></div>
          <div class="info-content">
            <h5>Email Us</h5>
            <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="icon-box"><i class="fab fa-whatsapp"></i></div>
          <div class="info-content">
            <h5>WhatsApp</h5>
            <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>">+<?php echo WHATSAPP_NUMBER; ?></a>
          </div>
        </div>

        <div class="business-hours">
          <div class="hour-item"><span class="day">Monday – Friday</span> <span>9:00 AM – 6:00 PM</span></div>
          <div class="hour-item"><span class="day">Saturday</span> <span>9:00 AM – 4:00 PM</span></div>
          <div class="hour-item"><span class="day">Sunday</span> <span>Closed</span></div>
        </div>

        <div class="social-links-contact">
          <a href="<?php echo SOCIAL_FACEBOOK; ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="<?php echo SOCIAL_INSTAGRAM; ?>" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="<?php echo SOCIAL_LINKEDIN; ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          <a href="<?php echo SOCIAL_YOUTUBE; ?>" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-wrapper reveal">
        <h3><i class="fas fa-paper-plane"></i> Send a Message</h3>
        <form id="contactForm" method="POST" action="#">
          <div class="form-row">
            <div class="form-group">
              <label for="fullName">Full Name *</label>
              <input type="text" id="fullName" placeholder="Your full name" required />
            </div>
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" placeholder="your@email.com" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" placeholder="+91 98765 43210" />
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <select id="subject">
                <option value="general">General Inquiry</option>
                <option value="quote">Request a Quote</option>
                <option value="order">Order Assistance</option>
                <option value="dealer">Dealer / Partner</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" placeholder="Tell us about your project or requirement..." required></textarea>
          </div>
          <button type="submit" class="btn-submit" id="contactSubmit">
            Send Message <i class="fas fa-arrow-right"></i>
          </button>
          <p style="font-size: 0.7rem; color: var(--text-muted); text-align: center; margin-top: 12px;">
            <i class="fas fa-lock"></i> Your information is safe with us.
          </p>
        </form>
      </div>
    </div>

    <!-- Map -->
    <div class="map-section reveal">
      <iframe 
        src="<?php echo GOOGLE_MAPS_URL; ?>" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="Elegancia location map"
      ></iframe>
    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section" aria-label="Request a quote">
  <div class="container">
    <span class="cta-badge">Get Started</span>
    <h2 class="cta-title">Ready to Transform Your <span class="text-gradient-gold">Space?</span></h2>
    <p class="cta-sub">Let's discuss your project and find the perfect interior solutions for your needs.</p>
    <div class="cta-buttons">
      <a href="#" class="btn-primary btn-lg">Request a Quote <i class="fas fa-arrow-right"></i></a>
      <a href="tel:<?php echo COMPANY_PHONE; ?>" class="btn-outline-light btn-lg">Call Now <i class="fas fa-phone"></i></a>
    </div>
  </div>
</section>

<!-- Toast -->
<div class="toast-message" id="contactToast">
  <span class="toast-icon"><i class="fas fa-check-circle"></i></span>
  <span id="toastMessage">Message sent successfully!</span>
</div>

<?php
$additional_js = '
<script>
(function() {
  "use strict";

  const form = document.getElementById("contactForm");
  const submitBtn = document.getElementById("contactSubmit");
  const toast = document.getElementById("contactToast");
  const toastMsg = document.getElementById("toastMessage");
  const toastIcon = toast.querySelector(".toast-icon i");

  function showToast(message, success = true) {
    toastMsg.textContent = message;
    toastIcon.className = success ? "fas fa-check-circle" : "fas fa-exclamation-circle";
    toast.className = "toast-message show " + (success ? "success" : "error");
    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => {
      toast.classList.remove("show");
    }, 4000);
  }

  form.addEventListener("submit", async function(e) {
    e.preventDefault();
    
    const name = document.getElementById("fullName").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
      showToast("Please fill in all required fields", false);
      return;
    }

    if (!email.includes("@")) {
      showToast("Please enter a valid email address", false);
      return;
    }

    if (phone && !/^[0-9]{10}$/.test(phone.replace(/[^0-9]/g, ""))) {
      showToast("Please enter a valid 10-digit phone number", false);
      return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML = "Sending... <i class=\"fas fa-spinner fa-spin\"></i>";

    try {
      const response = await fetch("api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email, phone, subject, message })
      });
      const result = await response.json();

      if (result.success) {
        showToast(result.message || "Message sent successfully!");
        form.reset();
      } else {
        showToast(result.message || "Error sending message", false);
      }
    } catch (error) {
      showToast("Network error. Please try again.", false);
    }

    submitBtn.disabled = false;
    submitBtn.innerHTML = "Send Message <i class=\"fas fa-arrow-right\"></i>";
  });

  console.log("Elegancia · Contact page loaded");
})();
</script>
';

include INCLUDES_PATH . '/footer.php';
?>