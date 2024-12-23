<?php 
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National E Clinic Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Lato:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="icon" href="images/logo_v.png" type="image/png">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/5a39afcc99.js" crossorigin="anonymous"></script>
    <script defer src="header.js"></script>
</head>
<body>
    

  <section id="header-container">
    <div id="header-wrapper">
      <header>
        <div class="logo"><img src="images/logo_h.png" alt="logo"/></div>
        <div class="nav">
          <a class="nav-item" href="home/home.php">Home</a>
          <a class="nav-item" href="about_us/about_us.php">About Us</a>
          <a class="nav-item" href="about_us/about_us.php">Services</a>
          <div id="dropdown-account" class="dropdown">
            <a class="nav-item" href="#" id="account-link">Account</a>
            <div class="dropdown-content" id="dropdown-menu">
              <!-- Show Log In and Register only if user is NOT logged in -->
              <?php if (!isset($_SESSION['username']) && !isset($_SESSION['adminName'])): ?>
                <a href="login.html">Log In</a>
                <a href="register.html">Register</a>
              <?php endif; ?>

              <!-- Show Profile, Settings, and Logout only if user IS logged in -->
              <?php if (isset($_SESSION['username']) || isset($_SESSION['adminName'])): ?>
                <a href="profile.html">Profile</a>
                <a href="settings.html">Settings</a>
                <a href="logout.html">Logout</a>
              <?php endif; ?>
            </div>
          </div>
          <div id="dropdown-contact" class='dropdown'>
            <a class="nav-item" href="#" id="contact-link">Contact</a>
            <div class="dropdown-content" id="dropdown-menu">
                <a href="support.html">Support</a>
                <a href="faq.html">FAQs</a>
            </div>
          </div>
        </div>
        
      </header>
    </div>
    <div id="content-and-carousel">
      <div id="content-wrapper">
        <div id="content">
          <h2 class="blob"> Book Your Hospital Visit, Anytime, Anywhere, <br> Just a Click Away.</h2>
          <div class="button-wrapper">
            <a href="#">
              <div id="btn-how-work" class="button">Getting Started
                  <i class="fa-solid fa-circle-chevron-down fa-bounce" style="--fa-bounce-start-scale-x: 1;--fa-bounce-start-scale-y: 1;--fa-bounce-jump-scale-x: 1;--fa-bounce-jump-scale-y: 1;--fa-bounce-land-scale-x: 1;--fa-bounce-land-scale-y: 1;--fa-bounce-rebound: 0; margin-left:5px"></i>
              </div>
            </a>
            
            <a href="clinic_details/SeeDetails.php">
              <div id="btn-clinic-data" class="button">See Clinic Details</div>
            </a>
          </div>
        </div>
      </div>

      <div id="carousel-container" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/baby_patient.webp" class="d-block w-100" alt="image1">
            </div>
            <div class="carousel-item">
              <img src="images/adult_patient.jpg" class="d-block w-100" alt="image2">
            </div>
            <div class="carousel-item">
              <img src="images/consult_patient.jpg" class="d-block w-100" alt="image3">
            </div>
            <div class="carousel-item">
              <img src="images/measuring_blood_pressure.jpg" class="d-block w-100" alt="image4">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel-container" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel-container" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </div>
      
    </div>
  </section>

