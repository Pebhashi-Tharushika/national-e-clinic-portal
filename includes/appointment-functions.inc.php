<?php

require_once 'dbh.inc.php';

// Function to fetch profiles 
function getProfiles()
{
    global $conn; // Use global to access the database connection
    $query = "SELECT id, first_name, last_name, province FROM patient_profiles WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $userId = $_SESSION["userId"];
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $profiles = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $profiles[] = $row;
        }

        return !empty($profiles) ?
            ['status' => 'success', 'data' => $profiles, 'message' => 'Profiles fetched successfully.'] :
            ['status' => 'error', 'message' => 'No profiles found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

// Function to fetch clinic categories 
function getHospitalsByProvinceAndClinicCategory($provinceTable, $provinceName, $clinicCategoryId) 
{
    global $conn; 
    $query = "SELECT DISTINCT h.id, h.hospital_name, h.institute_type_id FROM hospitals h
                JOIN provinces p ON p.id = h.province_id
                JOIN $provinceTable c ON c.hospital_Id = h.id
                WHERE p.province_name=? AND c.clinic_category_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $provinceName, $clinicCategoryId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $hospitals = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $hospitals[] = $row;
        }

        return !empty($hospitals) ?
            ['status' => 'success', 'data' => $hospitals, 'message' => 'Hospitals fetched successfully.'] :
            ['status' => 'error', 'message' => 'No hospitals found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

?>