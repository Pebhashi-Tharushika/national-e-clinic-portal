<?php
// Database connection
require_once __DIR__ . '/../includes/dbh.inc.php';

// Whitelist valid province names to prevent SQL injection
$allowedProvinces = ['central_province', 'eastern_province', 'northern_province', 'north_western_province', 'western_province', 'southern_province', 'sabaragamuwa_province', 'uva_province', 'north_central_province'];


// Handle AJAX delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteClinic') {
    if (isset($_POST['id'], $_POST['province'])) {
        $clinicId = intval($_POST['id']); // Sanitize ID
        $province = $_POST['province'];

        // Validate province name
        if (in_array($province, $allowedProvinces)) {
            deleteClinic($clinicId, $province);
        } else {
            echo 'invalid_province';
        }
    } else {
        echo 'invalid_request';
    }
}


// Function to get all clinic details
function getClinicDetails($province)
{
    global $conn, $allowedProvinces;

    if (!in_array($province, $allowedProvinces)) {
        return false; // Invalid province input
    }

    // Safely build the query after validation
    $clinicQuery = "SELECT Clinic_Id, Clinic_Name, Clinic_Place, Clinic_Date, Clinic_Time FROM `$province`";
    $stmt = mysqli_prepare($conn, $clinicQuery);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $clinics = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clinics[] = $row; // Store each row in the array
        }

        mysqli_stmt_close($stmt); // Close statement
        return $clinics; // Return the array of clinic details
    } else {
        return false; // Query failed
    }
}


// Function to add a clinic
function addClinic($province, $clinicName, $clinicPlace, $clinicDate, $clinicTime)
{
    global $conn;
    $sql = "INSERT INTO `$province` (Clinic_Name, Clinic_Place, Clinic_Date, Clinic_Time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $clinicName, $clinicPlace, $clinicDate, $clinicTime);
    return mysqli_stmt_execute($stmt);
}

// Function to convert 24-hour format to 12-hour format with AM/PM
function convertTo12HourFormat($time)
{
    $dateTime = DateTime::createFromFormat('H:i', $time);
    return $dateTime ? $dateTime->format('h:i A') : '';
}


// Function to delete clinic by ID
function deleteClinic($id, $province)
{
    global $conn;

    $sql = "DELETE FROM `$province` WHERE Clinic_Id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo 'success';
        } else {
            echo 'error';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'error';
    }
}
?>