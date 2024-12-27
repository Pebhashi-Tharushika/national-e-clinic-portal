<header>
  <div id="header-wrapper">

    <div id="header-logo">
      <img src="/national-e-clinic-portal/images/logo-h.png" alt="logo" />
    </div>
    <div id="nav">
      <a class="nav-item" href="">Home</a>
      <a class="nav-item" href="/national-e-clinic-portal/about-us/about-us.php">About Us</a>
      <a class="nav-item" href="/national-e-clinic-portal/service/service.php">Services</a>
      <div id="dropdown-account" class="dropdown">
        <a class="nav-item" href="#" id="account-link">Account</a>
        <div class="dropdown-content" id="dropdown-menu">
          <!-- Show Log In and Register only if user is NOT logged in -->
          <?php if (!isset($_SESSION['username']) && !isset($_SESSION['adminName'])): ?>
            <a href="/national-e-clinic-portal/login/login.html">Log In</a>
            <a href="/national-e-clinic-portal/register/register.html">Register</a>
          <?php endif; ?>

          <!-- Show Profile, Settings, and Logout only if user IS logged in -->
          <?php if (isset($_SESSION['username']) || isset($_SESSION['adminName'])): ?>
            <a href="/national-e-clinic-portal/profile/profile.html">Profile</a>
            <a href="/national-e-clinic-portal/setting/settings.html">Settings</a>
            <a href="/national-e-clinic-portal/index.php">Logout</a>
          <?php endif; ?>
        </div>
      </div>
      <div id="dropdown-contact" class='dropdown'>
        <a class="nav-item" href="#" id="contact-link">Contact</a>
        <div class="dropdown-content" id="dropdown-menu">
          <a href="/national-e-clinic-portal/support/support.html">Support</a>
          <a href="/national-e-clinic-portal/faq/faq.html">FAQs</a>
        </div>
      </div>
    </div>

  </div>
</header>