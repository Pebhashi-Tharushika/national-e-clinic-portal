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
?>