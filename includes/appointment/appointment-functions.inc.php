<?php
require_once __DIR__ . '/../../includes/dbh.inc.php';

// fetch profiles 
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

        mysqli_stmt_close($stmt);

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

// fetch clinic categories 
function getHospitalsByProvinceAndClinicCategory($provinceTable, $provinceName, $clinicCategoryId)
{
    global $conn;
    $query = "SELECT DISTINCT h.id, h.hospital_name, i.institute_type FROM hospitals h
                JOIN institutes i ON i.id = h.institute_type_id
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

        mysqli_stmt_close($stmt);

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

// fetch available days
function getClinicAvailableDays($provinceTable, $clinicCategoryId, $hospitalId)
{
    global $conn;
    $query = "SELECT clinic_date, clinic_time FROM $provinceTable WHERE hospital_id=? AND clinic_category_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $hospitalId, $clinicCategoryId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $clinicAvailableDays = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clinicAvailableDays[] = $row;
        }

        mysqli_stmt_close($stmt);

        return !empty($clinicAvailableDays) ?
            ['status' => 'success', 'data' => $clinicAvailableDays, 'message' => 'Clinic available days fetched successfully.'] :
            ['status' => 'error', 'message' => 'No clinic available days found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

// fetch already booked time solts
function getAlreadyBookedTimeSolts($provinceTable, $clinicCategoryId, $hospitalId, $appointmentDate)
{
    global $conn;
    $query = "SELECT time_period, `status` FROM $provinceTable WHERE hospital_id=? AND clinic_id=? AND appointment_date=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $hospitalId, $clinicCategoryId, $appointmentDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        mysqli_stmt_close($stmt);
        return !empty($appointments) ?
            ['status' => 'success', 'data' => $appointments, 'message' => 'Alrady booked appointments fetched successfully.'] :
            ['status' => 'error', 'message' => 'No alrady booked appointments found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function saveAppointment($provinceTable, $patientId, $clinicCategoryId, $hospitalId, $appointmentDate, $appointmentTime)
{
    global $conn;
    $query = "INSERT INTO $provinceTable (hospital_id, clinic_id, profile_id, user_id, appointment_date, time_period) 
                VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        // Get user_id from the current logged-in user (session userid)
        $userId = $_SESSION["userId"];
        mysqli_stmt_bind_param($stmt, "iiisss", $hospitalId, $clinicCategoryId, $patientId, $userId, $appointmentDate, $appointmentTime);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt); // Close statement

        return $result ?
            ['status' => 'success', 'message' => 'Appointment saved successfully.'] :
            ['status' => 'error', 'message' => 'Error during saving appointment.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getAllBookedAppointments($appointmentTable,$clinicTable)
{
    global $conn;
    $query = "SELECT h.hospital_name, i.institute_type, c.clinic_name, b.clinic_place, p.first_name, p.last_name, p.province, a.appointment_date, a.time_period ,a.`status` 
                FROM $appointmentTable a 
                JOIN hospitals h ON a.hospital_id = h.id 
                JOIN patient_profiles p ON a.profile_id = p.id
                JOIN clinics_categories c ON a.clinic_id = c.id
                JOIN institutes i ON h.institute_type_id = i.id
                JOIN $clinicTable b ON a.clinic_id = b.clinic_category_id AND a.hospital_id = b.hospital_id
                WHERE a.user_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $userId = $_SESSION["userId"]; // Get logged-in user ID
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        mysqli_stmt_close($stmt);
        return !empty($appointments) ?
            ['status' => 'success', 'data' => $appointments, 'message' => 'All appointments fetched successfully.'] :
            ['status' => 'error', 'message' => 'No appointments found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getPatientProvincesByUser(){
    
    global $conn;
    $query = "SELECT DISTINCT province FROM patient_profiles WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $userId = $_SESSION["userId"]; // Get logged-in user ID
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $provinces = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $provinces[] = $row;
        }

        mysqli_stmt_close($stmt);
        return !empty($provinces) ?
            ['status' => 'success', 'data' => $provinces, 'message' => 'All provinces fetched successfully.'] :
            ['status' => 'error', 'message' => 'No provinces found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getNameByUserId(){
    global $conn;
    $table = $_SESSION['isAdmin'] ? "admins" : "clinic_users";
    $column = $_SESSION['isAdmin'] ? "admin_id" : "user_id";
    $query = "SELECT `name` FROM $table WHERE $column=?";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $userId = $_SESSION["userId"]; // Get logged-in user ID
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $name = '';
        if ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name']; // Get the name only
        }

        mysqli_stmt_close($stmt);
        return ($name !== '') ?
            ['status' => 'success', 'data' => $name, 'message' => 'Current logged user name fetched successfully.'] :
            ['status' => 'error', 'message' => 'No current logged user name found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
    
}

?>