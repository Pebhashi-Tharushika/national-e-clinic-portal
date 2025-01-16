<?php
session_start();
require_once './includes/clinic-functions.inc.php';

// Get province from URL query
$provinceParam = isset($_GET['province']) ? $_GET['province'] : null;

// Map query parameter to database value
$provinceMap = [
    'central' => 'central_province',
    'eastern' => 'eastern_province',
    'northern' => 'northern_province',
    'north-western' => 'north_western_province',
    'western' => 'western_province',
    'southern' => 'southern_province',
    'sabaragamuwa' => 'sabaragamuwa_province',
    'uva' => 'uva_province',
    'north-central' => 'north_central_province'
];

// Validate the province
if (!array_key_exists($provinceParam, $provinceMap)) {
    header("Location: /national-e-clinic-portal/index.php"); // Redirect to home if invalid
    exit();
}

$provinceDB = $provinceMap[$provinceParam];
$provinceTitle = ucwords(str_replace("-", " ", $provinceParam)) . " Province";

// Fetch clinic details
$clinicDetails = getClinicDetails($provinceDB);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National E Clinic Portal</title>
    <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">
    <link rel="stylesheet" href="/national-e-clinic-portal/style/provinces.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/national-e-clinic-portal/js/province.js"></script>
</head>
<body>

<h1 class="heading">Clinic Details of <?php echo htmlspecialchars($provinceTitle); ?> Hospitals</h1>

<!-- Add Clinic Button for Admins -->
<a href="/national-e-clinic-portal/add-clinic.php?province=<?php echo htmlspecialchars($provinceParam); ?>"
   style="<?php echo isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true ? 
   'display: inline-block; padding: 10px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px;' : 
   'display: none;'; ?>">ADD CLINIC</a>

<?php
if ($clinicDetails && count($clinicDetails) > 0) {
    echo "<table id='details'>";
    echo "<tr>
            <th>Clinic Name</th>
            <th>Place</th>
            <th>Date</th>
            <th>Time</th>";
     // Conditionally add another column if the user is an admin 
    echo isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true ? '<th>Actions</th>' : '';
    echo "</tr>";

    foreach ($clinicDetails as $clinic) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Name']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Place']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Date']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Time']) . "</td>";

        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            echo '<td><button class="btnDelete" data-id="' . htmlspecialchars($clinic['Clinic_Id']) . '" data-province="' . htmlspecialchars($provinceDB) . '">DELETE</button></td>';
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No clinic records available.";
}

mysqli_close($conn);
?>


</body>
</html>
