<?php
require_once 'dbh.inc.php';

function getAppointmentsByProvince($provinceTable)
{
    global $conn;
    $query = "SELECT DISTINCT h.hospital_name, c.clinic_name FROM $provinceTable p
                JOIN hospitals h ON p.hospital_id = h.id
                JOIN clinics_categories c ON p.clinic_id = c.id";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        mysqli_stmt_close($stmt);

        return !empty($appointments) ?
            ['status' => 'success', 'data' => $appointments, 'message' => 'Appointments fetched successfully.'] :
            ['status' => 'error', 'message' => 'No appointments found.'];

    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getFilteredAppointments($provinceTable, $data)
{
    global $conn;

    $query = "SELECT 
                    h.hospital_name,
                    i.institute_type, 
                    c.clinic_name, 
                    pp.first_name, 
                    pp.last_name, 
                    pp.nic, 
                    COALESCE(u.name, a.name) AS user_name, 
                    COALESCE(u.email, a.email) AS user_email,
                    p.appointment_date,
                    p.time_period,
                    p.created_at,
                    p.status
              FROM $provinceTable p
              JOIN hospitals h ON p.hospital_id = h.id
              JOIN institutes i ON h.institute_type_id = i.id
              JOIN clinics_categories c ON p.clinic_id = c.id
              JOIN patient_profiles pp ON p.profile_id = pp.id
              LEFT JOIN clinic_users u ON p.user_id = u.user_id
              LEFT JOIN admins a ON p.user_id = a.admin_id";

    // Initialize filters and parameters array
    $filters = [];
    $params = [];
    $types = "";

    // Check and add filters dynamically with LIKE operator
    if (!empty($data['cb-hospital'])) {
        $filters[] = "h.hospital_name LIKE ?";
        $params[] = "%" . $data['cb-hospital'] . "%";  // Use % for wildcard search
        $types .= "s"; // String
    }
    if (!empty($data['cb-clinic'])) {
        $filters[] = "c.clinic_name LIKE ?";
        $params[] = "%" . $data['cb-clinic'] . "%";
        $types .= "s";
    }
    if (!empty($data['cb-patient'])) {
        $filters[] = "pp.nic LIKE ?";
        $params[] = "%" . $data['cb-patient'] . "%";
        $types .= "s";
    }
    if (!empty($data['cb-user'])) {
        $filters[] = "(u.email LIKE ? OR a.email LIKE ?)";
        $params[] = "%" . $data['cb-user'] . "%";
        $params[] = "%" . $data['cb-user'] . "%";
        $types .= "ss";
    }
    if (!empty($data['cb-appointment-date'])) {
        $filters[] = "p.appointment_date LIKE ?";
        $params[] = "%" . $data['cb-appointment-date'] . "%";
        $types .= "s";
    }
    if (!empty($data['cb-reserved-date'])) {
        $filters[] = "p.created_at LIKE ?";
        $params[] = "%" . $data['cb-reserved-date'] . "%";
        $types .= "s";
    }
    if (!empty($data['cb-status'])) {
        $filters[] = "p.status LIKE ?";
        $params[] = "%" . $data['cb-status'] . "%";
        $types .= "s";
    }

    // Append WHERE clause if filters exist
    if (!empty($filters)) {
        $query .= " WHERE " . implode(" AND ", $filters);
    }

    // Prepare statement
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query.'];
    }

    // Bind parameters dynamically if any exist
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    // Execute statement
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }

    mysqli_stmt_close($stmt);

    return !empty($appointments)
        ? ['status' => 'success', 'data' => $appointments, 'message' => 'Appointments fetched successfully.']
        : ['status' => 'error', 'message' => 'No appointments found.'];
}

?>