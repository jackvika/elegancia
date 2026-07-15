<?php
// privacy-policy.php - Privacy Policy page
require_once 'config.php';
$page_title = 'Privacy Policy';
$current_page = 'privacy-policy.php';

$additional_css = '
<style>
  .privacy-hero {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
    padding: 140px 0 50px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .privacy-hero .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(224,221,208,0.3);
    margin-bottom: 12px;
  }
  .privacy-hero .breadcrumb a { color: var(--gold); }
  .privacy-hero .breadcrumb span { color: rgba(224,221,208,0.2); }

  .privacy-content {
    max-width: 860px;
    margin: 0 auto;
    padding: 20px 0 40px;
  }
  .privacy-content .last-updated {
    font-size: 0.85rem;
    color: var(--text-muted);
    text-align: center;
    margin-bottom: 30px;
    border-bottom: 1px solid rgba(213,168,81,0.04);
    padding-bottom: 16px;
  }
  .privacy-content h2 {
    color: var(--text-strong);
    font-weight: 600;
    font-size: 1.4rem;
    margin-top: 32px;
    margin-bottom: 10px;
    letter-spacing: -0.3px;
  }
  .privacy-content h2 i {
    color: var(--gold);
    margin-right: 10px;
    font-size: 1.2rem;
  }
  .privacy-content p {
    color: var(--text-body);
    line-height: 1.8;
    margin-bottom: 14px;
    font-size: 0.95rem;
  }
  .privacy-content ul {
    color: var(--text-body);
    line-height: 1.8;
    margin-bottom: 16px;
    padding-left: 24px;
    list-style: none;
  }
  .privacy-content ul li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 6px;
    font-size: 0.95rem;
  }
  .privacy-content ul li::before {
    content: "▸";
    position: absolute;
    left: 0;
    color: var(--gold);
    font-weight: 700;
  }
  .privacy-content .highlight-box {
    background: var(--dark-light);
    border-left: 3px solid var(--gold);
    padding: 18px 24px;
    border-radius: var(--radius-sm);
    margin: 24px 0;
    border: 1px solid rgba(213,168,81,0.04);
    border-left-width: 4px;
  }
  .privacy-content .highlight-box p {
    margin-bottom: 0;
    color: var(--text-strong);
    font-weight: 400;
  }
  .privacy-content .highlight-box strong {
    color: var(--gold);
  }
  .privacy-content .contact-ref {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 20px 28px;
    margin-top: 32px;
    border: 1px solid rgba(213,168,81,0.06);
    text-align: center;
  }
  .privacy-content .contact-ref p {
    margin-bottom: 4px;
  }
  .privacy-content .contact-ref a {
    color: var(--gold);
    font-weight: 500;
    transition: color 0.3s ease;
  }
  .privacy-content .contact-ref a:hover {
    color: var(--gold-dark);
    text-decoration: underline;
  }

  @media (max-width: 768px) {
    .privacy-hero { padding: 100px 0 30px; }
    .privacy-content { padding: 10px 0 30px; }
    .privacy-content h2 { font-size: 1.2rem; }
  }
  @media (max-width: 480px) {
    .privacy-content .highlight-box { padding: 14px 16px; }
    .privacy-content .contact-ref { padding: 16px; }
  }
</style>
';

include INCLUDES_PATH . '/header.php';
?>

<!-- ===== PRIVACY HERO ===== -->
<section class="privacy-hero" aria-label="Privacy Policy">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a> <span>/</span> <span>Privacy Policy</span>
    </div>
    <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.4rem);">Privacy <span class="text-gradient-gold">Policy</span></h1>
    <p class="hero-sub" style="max-width: 600px; margin: 0 auto;">Your privacy matters to us. Learn how we collect, use, and protect your information.</p>
  </div>
</section>

<!-- ===== PRIVACY CONTENT ===== -->
<section class="section-padding" style="padding-top: 10px;" aria-label="Privacy policy details">
  <div class="container">
    <div class="privacy-content">

      <div class="last-updated">
        <i class="fas fa-calendar-alt" style="color: var(--gold); margin-right: 6px;"></i> Last Updated: April 1, 2026
      </div>

      <p>
        At <strong><?php echo COMPANY_NAME; ?></strong> (operating as <strong>Elegancia Premium Interiors</strong>), we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or interact with us.
      </p>

      <div class="highlight-box">
        <p><i class="fas fa-shield-alt" style="color: var(--gold); margin-right: 8px;"></i> <strong>Our Commitment:</strong> We respect your privacy and are dedicated to handling your personal data with transparency and care.</p>
      </div>

      <h2><i class="fas fa-info-circle"></i> Information We Collect</h2>
      <p>We may collect the following types of information:</p>
      <ul>
        <li><strong>Personal Identification Information:</strong> Name, email address, phone number, company name, and any other details you provide via forms or communication.</li>
        <li><strong>Usage Data:</strong> Information about your interaction with our website, such as pages visited, time spent, and referring URLs.</li>
        <li><strong>Device Information:</strong> IP address, browser type, operating system, and device identifiers for analytics and security.</li>
        <li><strong>Cookies:</strong> We use cookies to enhance your browsing experience and analyze site traffic. You can manage cookie preferences in your browser settings.</li>
      </ul>

      <h2><i class="fas fa-cogs"></i> How We Use Your Information</h2>
      <p>We use the information we collect to:</p>
      <ul>
        <li>Provide, maintain, and improve our products and services.</li>
        <li>Respond to your inquiries, process orders, and provide customer support.</li>
        <li>Send you updates, promotional materials, and other information related to our brand (you may opt-out at any time).</li>
        <li>Analyze website usage and trends to improve user experience.</li>
        <li>Comply with legal obligations and protect against fraud or security risks.</li>
      </ul>

      <h2><i class="fas fa-share-alt"></i> Sharing Your Information</h2>
      <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following cases:</p>
      <ul>
        <li><strong>Service Providers:</strong> Trusted partners who assist in operating our website, conducting business, or serving you (e.g., shipping, payment processing). These parties agree to keep your information confidential.</li>
        <li><strong>Legal Compliance:</strong> When required by law, regulation, or legal process to protect our rights or the safety of others.</li>
        <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of the transaction.</li>
      </ul>

      <h2><i class="fas fa-lock"></i> Data Security</h2>
      <p>
        We implement a variety of security measures to maintain the safety of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your data, we cannot guarantee its absolute security.
      </p>

      <h2><i class="fas fa-user-cog"></i> Your Rights</h2>
      <p>You have the right to:</p>
      <ul>
        <li><strong>Access:</strong> Request a copy of the personal information we hold about you.</li>
        <li><strong>Correction:</strong> Update or correct inaccurate or incomplete data.</li>
        <li><strong>Deletion:</strong> Request that we delete your personal information, subject to legal obligations.</li>
        <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications at any time by clicking the "unsubscribe" link in our emails or contacting us directly.</li>
      </ul>
      <p>To exercise any of these rights, please contact us using the details provided below.</p>

      <h2><i class="fas fa-child"></i> Children's Privacy</h2>
      <p>
        Our website and services are not directed at individuals under the age of 13. We do not knowingly collect personal information from children. If you believe we have inadvertently collected such data, please contact us immediately.
      </p>

      <h2><i class="fas fa-cookie-bite"></i> Cookies & Tracking</h2>
      <p>
        We use cookies to improve your experience, remember your preferences, and analyze site traffic. You can choose to disable cookies in your browser settings, but this may affect certain functionalities of our website. Third-party services (e.g., Google Analytics) may also use cookies as part of their analytics services.
      </p>

      <h2><i class="fas fa-globe"></i> Third-Party Links</h2>
      <p>
        Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review their privacy policies before providing any personal information.
      </p>

      <h2><i class="fas fa-edit"></i> Changes to This Policy</h2>
      <p>
        We reserve the right to update this Privacy Policy from time to time. Any changes will be posted on this page with a revised "Last Updated" date. We encourage you to review this policy periodically to stay informed about how we protect your information.
      </p>

      <div class="contact-ref">
        <p><i class="fas fa-envelope" style="color: var(--gold); margin-right: 6px;"></i> If you have any questions, concerns, or requests regarding this Privacy Policy, please contact us:</p>
        <p><strong><?php echo COMPANY_NAME; ?></strong></p>
        <p><?php echo COMPANY_ADDRESS; ?></p>
        <p><i class="fas fa-phone-alt" style="color: var(--gold); margin-right: 4px;"></i> <a href="tel:<?php echo COMPANY_PHONE; ?>"><?php echo COMPANY_PHONE; ?></a> &nbsp;|&nbsp; <i class="fas fa-envelope" style="color: var(--gold); margin-right: 4px;"></i> <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a></p>
      </div>

    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section" aria-label="Contact us">
  <div class="container">
    <span class="cta-badge">Have Questions?</span>
    <h2 class="cta-title">We're Here to <span class="text-gradient-gold">Help</span></h2>
    <p class="cta-sub">If you have any questions about our privacy practices or need assistance, don't hesitate to reach out.</p>
    <div class="cta-buttons">
      <a href="contact.php" class="btn-primary btn-lg">Contact Us <i class="fas fa-arrow-right"></i></a>
      <a href="tel:<?php echo COMPANY_PHONE; ?>" class="btn-outline-light btn-lg">Call Now <i class="fas fa-phone"></i></a>
    </div>
  </div>
</section>

<?php include INCLUDES_PATH . '/footer.php'; ?>