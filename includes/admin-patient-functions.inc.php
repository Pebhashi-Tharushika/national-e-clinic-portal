<?php
require_once 'dbh.inc.php';

function getAllPatients()
{
    global $conn;

    $query = "SELECT 
                    p.id, 
                    p.first_name, 
                    p.last_name,
                    p.email, 
                    p.nic, 
                    p.phone,
                    p.birth_date,
                    p.address_line1,
                    p.address_line2,
                    p.address_line3,
                    p.province,
                    COALESCE(u.user_id, a.admin_id) AS user_id,
                    COALESCE(u.name, a.name) AS user_name, 
                    COALESCE(u.email, a.email) AS user_email
              FROM patient_profiles p
              LEFT JOIN clinic_users u ON p.user_id = u.user_id
              LEFT JOIN admins a ON p.user_id = a.admin_id";


    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query.'];
    }


    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $patients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $patients[] = $row;
    }

    mysqli_stmt_close($stmt);

    return !empty($patients)
        ? ['status' => 'success', 'data' => $patients, 'message' => 'Patients fetched successfully.']
        : ['status' => 'error', 'message' => 'No patients found.'];
}

function updatePatientInfo($data)
{
    global $conn;

    $query = "UPDATE patient_profiles SET 
    first_name=?, last_name=?, nic=?, email=?, phone=?, birth_date=?, address_line1=?, address_line2=?, address_line3=?, province=?
    WHERE id=?";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query.'];
    }

    $name = $data['name'];
    $names = explode(' ', $name, 2);  // Split name by first space into two parts
    $firstName = $names[0];
    $lastName = isset($names[1]) ? $names[1] : ''; // Handle cases where there's no last name

    mysqli_stmt_bind_param($stmt, "ssssssssssi", 
        $firstName, $lastName, $data['nic'], $data['email'], 
        $data['phone'], $data['dob'], $data['address1'], 
        $data['address2'], $data['address3'], $data['province'], $data['patientId']
    );

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $result
        ? ['status' => 'success', 'message' => 'Patient ' . $data['patientId'] . ' updated successfully.']
        : ['status' => 'error', 'message' => 'Patient not updated.'];
    
}


?>