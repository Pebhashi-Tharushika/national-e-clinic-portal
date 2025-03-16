<?php

// Database connection
require_once __DIR__ . '/../../includes/dbh.inc.php';

// Function to add new clinic category
function saveNewClinicCategory($clinicCategory)
{
    global $conn;
    $query = "INSERT INTO clinics_categories (clinic_name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query: ' . mysqli_error($conn)
        ];
    }

    mysqli_stmt_bind_param($stmt, 's', $clinicCategory);
    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return $result
        ? ['status' => 'success', 'message' => 'New clinic category added successfully.']
        : ['status' => 'error', 'message' => 'New clinic category not added.'];
}

function getClinicInfoByProvinceAndCategory($provinceTable,$clinic){
    global $conn;

    $query = "SELECT p.id, h.hospital_name, i.institute_type, c.clinic_name, p.clinic_place, p.clinic_date, p.clinic_time, p.active
    FROM `$provinceTable` p
    JOIN hospitals h ON p.hospital_id = h.id
    JOIN institutes i ON h.institute_type_id = i.id
    JOIN clinics_categories c ON p.clinic_category_id = c.id
    WHERE c.clinic_name=?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt,'s',$clinic);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $clinics = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clinics[] = $row;
        }

        mysqli_stmt_close($stmt);

        return !empty($clinics) ?
            ['status' => 'success', 'data' => $clinics, 'message' => 'Clinic fetched successfully.'] :
            ['status' => 'error', 'message' => 'No clinic found.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}


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