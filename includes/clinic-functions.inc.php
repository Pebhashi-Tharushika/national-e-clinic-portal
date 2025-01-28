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

function isExistProvince($province)
{
    global $conn;

    $query = "SELECT id FROM provinces WHERE province_name = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $province);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        $exists = mysqli_num_rows($result) > 0; // Boolean check
        mysqli_stmt_close($stmt);
        return $exists;
    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];
        
    }
    
}


// Function to get all districts in a province

function getDistrictsByProvince($province)
{
    global $conn;

    $query = "SELECT d.`district_name` FROM `districts` d JOIN `provinces` p ON d.`province_id` = p.`id` WHERE p.`province_name` = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $province);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $districts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $districts[] = $row; // Store each row in the array
        }

        mysqli_stmt_close($stmt); // Close statement
        
        return !empty($districts) ? 
    ['status' => 'success', 'data' => $districts, 'message' => 'Districts fetched successfully.'] : 
    ['status' => 'error', 'message' => 'No districts found.'];

        
    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];
        
    }
}

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