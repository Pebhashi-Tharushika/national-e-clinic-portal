<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>National E Clinic Portal</title>

  <!-- favicon -->
  <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

  <!-- to add icons from boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="/national-e-clinic-portal/style/back-to-home.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/login.css">

  <script defer src="/national-e-clinic-portal/js/register-and-login.js"></script>

</head>

<body>

  <?php
  include_once 'back-to-home.php';
  ?>

  <div class="login-wrapper">
    <div class="login-container">

      <!-- to login -->
      <span class="bg-animate-login"></span>

      <div id="1" class="form-box login">
        <h2 class="animation" style="--hidden-rate:0;--display-rate:21">User Login</h2>
        <form action="includes/login.inc.php" method="post">

          <div class="input-box animation" style="--hidden-rate:1;--display-rate:22">
            <input type="text" id="fname" name="uid" required>
            <label>Username</label>
            <i class='bx bxs-user'></i>
          </div>

          <div class="input-box animation" style="--hidden-rate:2;--display-rate:23">
            <input type="password" id="fname" name="pwd" required>
            <label>Password</label>
            <i class='bx bxs-lock-alt'></i>
          </div>

          <button type="submit" name="submit1" class="btn animation" style="--hidden-rate:3;--display-rate:24">Login</button>
          
          <div class="logreg-link animation" style="--hidden-rate:4;--display-rate:25">
            <p>Don't have and account? <a href="#" class="register-link">Sign up</a></p>
          </div>

        </form>
      </div>

      <div id="3" class="info-text login">
        <h2 class="animation" style="--hidden-rate:0;--display-rate:20">Welcome to National E-Clinic Portal</h2><br><br>
        <p class="animation" style="--hidden-rate:1;--display-rate:21">Heal at Hand</p>
      </div>

      <!-- to register -->
      <span class="bg-animate-register"></span>

      <div id="2" class="form-box register">
        <h2 class="animation" style="--hidden-rate:17;--display-rate:0">Sign up</h2>

        <form action="includes/signup.inc.php" method="post">

          <div class="input-box animation" style="--hidden-rate:18;--display-rate:1">
            <input type="text" name="name" required>
            <label>Name</label>
            <i class='bx bxs-user'></i>
          </div>

          <div class="input-box animation" style="--hidden-rate:20;--display-rate:3">
            <input type="text" name="email" required>
            <label>Email</label>
            <i class='bx bxs-envelope'></i>
          </div>

          <div class="input-box animation" style="--hidden-rate:19;--display-rate:2">
            <input type="text" name="uid" required>
            <label>Username</label>
            <i class='bx bxs-id-card'></i>
          </div>

          <div id="4" class="input-box animation" style="--hidden-rate:21;--display-rate:4">
            <input type="password" name="pwd" required>
            <label>Password</label>
            <i class='bx bxs-lock-alt'></i>
          </div>

          <div id="4" class="input-box animation" style="--hidden-rate:21;--display-rate:4">
            <input type="password" name="pwdrepeat" required>
            <label> Confirm Password</label>
            <i class='bx bxs-lock-alt'></i>
          </div>


          <button name="submit" type="submit" class="btn animation" style="--hidden-rate:22;--display-rate:5">Sign up</button>
          
          <div class="logreg-link animation" style="--hidden-rate:23;--display-rate:6">
            <p>Already have and account? <a href="#" class="login-link ">Log in</a></p>
          </div>
        </form>
      </div>

      <div class="info-text register">
        <h2 class="animation" style="--hidden-rate:17;--display-rate:0">Welcome to National E-Clinic Portal</h2><br><br>
        <p class="animation" style="--hidden-rate:18;--display-rate:1">Heal at Hand</p>
      </div>

    </div>
  </div>


</body>

</html>