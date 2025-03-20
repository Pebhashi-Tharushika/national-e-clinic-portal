<header>
  <div id="header-wrapper">

    <div id="header-logo">
      <img src="/national-e-clinic-portal/images/logo-h.png" alt="logo" />
    </div>
    <div id="nav">
      <a class="nav-item" href="/national-e-clinic-portal/index.php?page=home" id="home-link">Home</a>
      <a class="nav-item" href="/national-e-clinic-portal/index.php?page=about-us" id="about-us-link">About Us</a>
      <a class="nav-item" href="/national-e-clinic-portal/index.php?page=services" id="services-link">Services</a>
      <div id="dropdown-account" class="dropdown">
        <a class="nav-item" href="#" id="account-link">Account</a>
        <div class="dropdown-content" id="dropdown-menu">
          <!-- Show Log In and Register only if user is NOT logged in -->
          <?php if (!isset($_SESSION['username'])): ?>
            <a href="/national-e-clinic-portal/register-and-login.php?action=login">Log In</a>
            <a href="/national-e-clinic-portal/register-and-login.php?action=register">Register</a>
          <?php endif; ?>

          <!-- Show Profile, Settings, and Logout only if user IS logged in -->
          <?php if (isset($_SESSION['username'])): ?>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
              <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu1">Admin Dashboard</a>
            <?php endif; ?>
            <a href="/national-e-clinic-portal/profile/profile.html">Profile</a>
            <a href="/national-e-clinic-portal/setting/settings.html">Settings</a>
            <a href="/national-e-clinic-portal/includes/register-login-logout/logout.inc.php" onclick="return confirmLogout();">Logout</a>
          <?php endif; ?>
        </div>
      </div>
      <div id="dropdown-contact" class='dropdown'>
        <a class="nav-item" href="#" id="contact-link">Contact</a>
        <div class="dropdown-content" id="dropdown-menu">
          <a href="/national-e-clinic-portal/index.php?page=support">Support</a>
          <a href="/national-e-clinic-portal/index.php?page=faq">FAQs</a>
        </div>
      </div>
    </div>

  </div>
</header>