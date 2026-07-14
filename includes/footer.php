<?php
// includes/footer.php - Global footer
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE
?>
</main>

<!-- ===== FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <span class="logo-elegancia">ELEGANCIA</span>
        <span class="logo-tag">premium interior solutions</span>
        <p>Manufactured by <?php echo COMPANY_NAME; ?></p>
      </div>
      <div>
        <h6>Quick Links</h6>
        <ul>
          <li><a href="#" class="footer-link">Collections</a></li>
          <li><a href="aboutus.php" class="footer-link">About</a></li>
          <li><a href="contact.php" class="footer-link">Contact</a></li>
        </ul>
      </div>
      <div>
        <h6>Products</h6>
        <ul>
          <li><a href="#" class="footer-link">Wall Panels</a></li>
          <li><a href="#" class="footer-link">Mouldings</a></li>
          <li><a href="#" class="footer-link">Cornices</a></li>
        </ul>
      </div>
      <div>
        <h6>Newsletter</h6>
        <div class="newsletter">
          <input type="email" placeholder="Your email" aria-label="Email for newsletter" />
          <button aria-label="Subscribe"><i class="fas fa-arrow-right"></i></button>
        </div>
        <div class="social-icons">
          <a href="<?php echo SOCIAL_FACEBOOK; ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="<?php echo SOCIAL_INSTAGRAM; ?>" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="<?php echo SOCIAL_LINKEDIN; ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2026 Elegancia · <?php echo COMPANY_NAME; ?>. All Rights Reserved.
    </div>
  </div>
</footer>

<!-- ===== SCRIPTS ===== -->
<script src="assets/js/menu.js"></script>
<script src="assets/js/slider.js"></script>
<script src="assets/js/animation.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/dropdown.js"></script>
<script src="assets/js/dropdown-touch.js"></script>

<!-- Inline script for loading overlay -->
<script>
  (function() {
    window.addEventListener('load', function() {
      const overlay = document.getElementById('loadingOverlay');
      if (overlay) {
        overlay.classList.add('hidden');
        setTimeout(function() { overlay.style.display = 'none'; }, 500);
      }
    });
  })();
</script>

<?php if (isset($additional_js)): echo $additional_js; endif; ?>

</body>
</html>