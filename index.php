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

  <!-- normalize.css for better cross-browser consistency (instead of reset styles) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <!-- fontawesome for icons -->
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.7.2/css/pro.min.css">

  <!-- Lato - google font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&display=swap" rel="stylesheet">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <!-- favicon -->
  <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

  <link rel="stylesheet" href="/national-e-clinic-portal/style/header.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/footer.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/home.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/about-us.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/services.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/tac.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/privacy-policy.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/faq.css">

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <script defer src="/national-e-clinic-portal/js/header.js"></script>
  <script defer src="/national-e-clinic-portal/js/home.js"></script>
  <script defer src="/national-e-clinic-portal/js/faq.js"></script>
</head>

<body>

  <?php
  // Define an array of allowed pages to prevent unauthorized file access
  $allowedPages = ['home', 'about-us', 'services', 'support', 'faq', 'tac', 'privacy-policy'];

  // Get the 'page' parameter from the URL
  $page = $_GET['page'] ?? 'home';

  // Check if the requested page is in the allowed list
  if (in_array($page, $allowedPages)) {
    // Include header and footer only for valid pages
    include_once 'header.php';
    echo '<main>';
    include_once "{$page}.php";
    echo '</main>';
    include_once 'footer.php';
  } else {
    // For 404 page, exclude header and footer
    http_response_code(404);
    include_once '404.php';
  }
  ?>

</body>

</html>