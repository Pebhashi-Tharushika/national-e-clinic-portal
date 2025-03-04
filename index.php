<?php
session_start();
if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
  unset($_SESSION['step1'], $_SESSION['step2']);
}
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
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;900&display=swap" rel="stylesheet">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <!-- favicon -->
  <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">


  <link rel="stylesheet" href="/national-e-clinic-portal/style/header.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/footer.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/home.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/about-us.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/services.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/tac.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/privacy-policy.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/faq.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/support.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/admin.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/admin-dashboard.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/admin-appointment.css">
  <link rel="stylesheet" href="/national-e-clinic-portal/style/admin-patient.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    

  <!-- chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


  <script defer src="/national-e-clinic-portal/js/header.js"></script>
  <script defer src="/national-e-clinic-portal/js/footer.js"></script>
  <script defer src="/national-e-clinic-portal/js/home.js"></script>
  <script defer src="/national-e-clinic-portal/js/faq.js"></script>
  <script defer src="/national-e-clinic-portal/js/support.js"></script>
  <script defer src="/national-e-clinic-portal/js/admin.js"></script>
  <script defer src="/national-e-clinic-portal/js/admin-dashboard.js"></script>
  <script defer src="/national-e-clinic-portal/js/admin-appointment.js"></script>
  <script defer src="/national-e-clinic-portal/js/admin-patient.js"></script>

</head>

<body>

  <?php
  // Define an array of allowed pages to prevent unauthorized file access
  $allowedPages = ['home', 'about-us', 'services', 'support', 'faq', 'tac', 'privacy-policy', 'admin'];

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