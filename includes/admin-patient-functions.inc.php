<?php
require_once 'dbh.inc.php';

function getPatients($searchBy, $searchText)
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

    // Initialize filters and parameters array
    $filters = "";
    $types = "";
    $params = [];
    $searchBy = trim(strtoupper($searchBy));

    // Search conditions
    if ($searchBy === 'ALL') {
        // Joins multiple column values into a single string using a specified separator (' ') and ignoring NULL values.
        $filters = "CONCAT_WS(' ', p.user_id, p.first_name, p.last_name, p.email, p.nic, p.phone,p.birth_date, p.address_line1, p.address_line2, p.address_line3, p.province) LIKE ?";
        $params[] = "%" . $searchText . "%";
        $types .= "s";
    } elseif ($searchBy === 'NAME') {
        $filters = "(p.first_name LIKE ? OR p.last_name LIKE ?)";
        $params[] = "%" . $searchText . "%";
        $params[] = "%" . $searchText . "%";
        $types .= "ss";
    } elseif ($searchBy === 'NIC') {
        $filters = "p.nic LIKE ?";
        $params[] = "%" . $searchText . "%";
        $types .= "s";
    } elseif ($searchBy === 'PHONE NO') {
        $filters = "p.phone LIKE ?";
        $params[] = "%" . $searchText . "%";
        $types .= "s";
    } elseif ($searchBy === 'EMAIL') {
        $filters = "p.email LIKE ?";
        $params[] = "%" . $searchText . "%";
        $types .= "s";
    }

    // Append WHERE clause if filters exist
    if (!empty($filters)) {
        $query .= " WHERE " . $filters;
    }

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        return ['status' => 'error', 'message' => 'Error preparing query.'];
    }

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
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


?>