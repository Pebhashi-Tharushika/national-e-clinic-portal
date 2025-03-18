<?php
require_once __DIR__ . '/../../includes/dbh.inc.php';

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

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssi",
        $firstName,
        $lastName,
        $data['nic'],
        $data['email'],
        $data['phone'],
        $data['dob'],
        $data['address1'],
        $data['address2'],
        $data['address3'],
        $data['province'],
        $data['patientId']
    );

    $result = mysqli_stmt_execute($stmt);
    $affectedRows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return ($result && $affectedRows > 0)
        ? ['status' => 'success', 'message' => 'Patient ' . $data['patientId'] . ' updated successfully.']
        : ['status' => 'error', 'message' => 'Patient not updated.'];

}

function getProvinceByNic($nic)
{
    global $conn;
    $query = "SELECT province FROM patient_profiles WHERE nic=?";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query.'];
    }

    mysqli_stmt_bind_param($stmt, 's', $nic);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        return ['status' => 'success', 'data' => $row['province'], 'message' => 'Province fetched successfully.'];
    } else {
        return ['status' => 'error', 'message' => 'No province found for this NIC.'];
    }
}

function getPatientInfoByNic($nic, $provinceTable)
{
    global $conn;

    $query = "SELECT DISTINCT p.first_name, p.last_name, h.hospital_name, i.institute_type, c.clinic_name 
              FROM patient_profiles p 
              LEFT JOIN `$provinceTable` a ON a.profile_id = p.id
              LEFT JOIN hospitals h ON h.id = a.hospital_id
              LEFT JOIN institutes i ON i.id = h.institute_type_id
              LEFT JOIN clinics_categories c ON c.id = a.clinic_id
              WHERE p.nic = ?";


    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query: ' . mysqli_error($conn)];
    }

    mysqli_stmt_bind_param($stmt, 's', $nic);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $patient = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $patient[] = $row;
    }

    mysqli_stmt_close($stmt);

    return !empty($patient)
        ? ['status' => 'success', 'data' => $patient, 'message' => 'Patient fetched successfully.']
        : ['status' => 'error', 'message' => 'No patient found.'];
}

function getPatientClinicInfo($provinceTable, $nic, $clinic, $hospital)
{
    global $conn;

    $query = "SELECT a.appointment_date, a.time_period, a.status 
            FROM `$provinceTable` a 
            JOIN patient_profiles p ON p.id = a.profile_id
            JOIN clinics_categories c ON c.id = a.clinic_id
            JOIN hospitals h ON h.id = a.hospital_id
            WHERE p.nic=? AND c.clinic_name=? AND h.hospital_name=?";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query: ' . mysqli_error($conn)];
    }

    mysqli_stmt_bind_param($stmt, 'sss', $nic, $clinic, $hospital);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $visits = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $visits[] = $row;
    }

    mysqli_stmt_close($stmt);

    return !empty($visits)
        ? ['status' => 'success', 'data' => $visits, 'message' => 'Patient visit fetched successfully.']
        : ['status' => 'error', 'message' => 'No patient visit found.'];



}


?>