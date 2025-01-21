<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>National E Clinic Portal</title>

  <!-- favicon -->
  <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <!-- to add icons from boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="/national-e-clinic-portal/style/back-to-home.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/register-and-login.css">

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <script defer src="/national-e-clinic-portal/js/register-and-login.js"></script>

</head>

<body>

  <?php
  include_once 'back-to-home.php';
  ?>


  <div class="login-wrapper">
    <?php
    $action = isset($_GET['action']) && $_GET['action'] === 'register' ? 'active' : '';
    ?>
    <div class="login-container <?php echo $action; ?>">

      <!-- to login -->
      <span class="bg-animate-login"></span>

      <div class="form-box login">
        <h2 class="animation" style="--hidden-rate:0;--display-rate:22">User Login</h2>
        <form action="/national-e-clinic-portal/includes/login.inc.php" method="post">

          <div class="input-box animation" style="--hidden-rate:1;--display-rate:23">
            <input type="text" id="fname" name="username" required>
            <label>Username</label>
            <i class='bx bxs-user'></i>
          </div>

          <div class="input-box animation" style="--hidden-rate:2;--display-rate:24">
            <input type="password" id="pwd" name="pwd" required>
            <label>Password</label>
            <i class='bx bxs-lock-alt'></i>
          </div>

          <div class="pwd-forgot-remember animation" style="--hidden-rate:3;--display-rate:25">

            <div id="remember-me">
              <input type="checkbox" id="remember-check">
              <label id="lbl-remember-me" for="remember-check">Remember me</label>
            </div>

            <div id="pwd-forgot">
              <a href="#" class="pwd-forgot-link">Forgot my password?</a>
            </div>

          </div>



          <button type="submit" name="submit1" class="btn animation"
            style="--hidden-rate:3;--display-rate:25">Login</button>

          <div class="logreg-link animation" style="--hidden-rate:4;--display-rate:26">
            <p>Don't have an account? <a href="#" class="register-link">Sign up</a></p>
          </div>

        </form>
      </div>

      <div class="info-text login">
        <h2 class="animation" style="--hidden-rate:0;--display-rate:22">Welcome to National E-Clinic Portal</h2><br><br>
        <p class="animation" style="--hidden-rate:1;--display-rate:23">Enter your personal details and start journey
          with us</p>
      </div>

      <!-- to register -->
      <span class="bg-animate-register"></span>

      <div class="form-box register">
        <h2 class="animation" style="--hidden-rate:17;--display-rate:0">Sign up</h2>

        <form id="signupForm" novalidate>

          <div id="scroll-container">
            <div class="input-box animation" style="--hidden-rate:18;--display-rate:1">
              <input type="text" id="name" name="name" required>
              <label for="name">Name</label>
              <i class='bx bxs-user'></i>
              <span id="nameError" class="error-message"></span>
            </div>

            <div class="input-box animation" style="--hidden-rate:19;--display-rate:2">
              <input type="text" id="email" name="email" required>
              <label for="email">Email</label>
              <i class='bx bxs-envelope'></i>
              <span id="emailError" class="error-message"></span>
            </div>

            <div class="input-box animation"
              style="--hidden-rate:20;--display-rate:3;margin-bottom: calc(3.3* 1.5625rem)">
              <input type="password" id="password" name="pwd" required>
              <label for="password">Password</label>
              <i class='bx bxs-lock-alt'></i>
              <div id="password-info">
                <i class='bx bx-info-circle'></i>
                <p>
                  Password must be at least 12 characters, 1 uppercase letter, 1 lowercase letter, 1 number and 1
                  special
                  character.
                </p>
              </div>

              <span id="passwordError" class="error-message"></span>
            </div>

            <div class="input-box animation" style="--hidden-rate:20;--display-rate:3">
              <input type="password" id="confirmPassword" name="confirmPassword" required>
              <label for="confirmPassword">Confirm Password</label>
              <i class='bx bxs-lock-alt'></i>
              <span id="confirmPasswordError" class="error-message"></span>
            </div>

            <div class="input-box animation" style="--hidden-rate:21;--display-rate:4">
              <select name="role" id="role" required>
                <option value="" disabled selected hidden></option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
              <label for="role">Role</label>
              <span id="roleError" class="error-message"></span>
            </div>

            <div class="input-box animation" style="--hidden-rate:21;--display-rate:4" id="adminCodeDiv">
              <input type="password" id="adminCode" name="adminCode">
              <label for="adminCode">Admin Code</label>
              <i class='bx bxs-check-shield'></i>
              <span id="adminCodeError" class="error-message"></span>
            </div>

          </div>




          <div id="agreement" class="animation" style="--hidden-rate:22;--display-rate:5">
            By creating an account, you agree to our
            <a href="http://localhost/national-e-clinic-portal/index.php?page=tac" target="_blank"
              rel="noopener noreferrer">Terms of Use</a> and
            <a href="http://localhost/national-e-clinic-portal/index.php?page=privacy-policy" target="_blank"
              rel="noopener noreferrer">Privacy
              Policy</a>.
          </div>

          <button type="submit" class="btn animation" style="--hidden-rate:23;--display-rate:6">Sign Up</button>

          <div class="logreg-link animation" style="--hidden-rate:24;--display-rate:7">
            <p>Already have an account? <a href="#" class="login-link ">Log in</a></p>
          </div>
        </form>
      </div>

      <div class="info-text register">
        <h2 class="animation" style="--hidden-rate:17;--display-rate:0">Welcome to National <br> E-Clinic Portal</h2>
        <br><br>
        <p class="animation" style="--hidden-rate:18;--display-rate:1">To keep connected with us please login with your
          personal info</p>
      </div>

    </div>
  </div>


  <!-- <div class="modal fade" id="admin-code-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Admin Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="admin-code" class="col-form-label">Admin Code:</label>
              <input type="text" class="form-control" id="admin-code">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">OK</button>
        </div>
      </div>
    </div>
  </div> -->


</body>

</html>