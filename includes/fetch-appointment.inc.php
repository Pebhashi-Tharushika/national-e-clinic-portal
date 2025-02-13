<?php
// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data)) {
    $output = "";
    foreach ($data as $row) {
        $statusClass = ($row['status'] === 'PENDING') ? 'pending' : 'approved';
        $output .= "<tr>
                <td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>
                <td>" . htmlspecialchars($row['hospital_name']) . " " . htmlspecialchars($row['institute_type']) . "</td>
                <td>" . htmlspecialchars($row['clinic_name']) . "</td>
                <td>" . htmlspecialchars($row['clinic_place']) . "</td>
                <td>" . htmlspecialchars($row['appointment_date']) . "</td>
                <td>" . htmlspecialchars($row['time_period']) . "</td>
                <td class='$statusClass'>" . htmlspecialchars($row['status']) . "</td>
            </tr>";
    }
    echo $output;
} else {
    echo "<tr><td colspan='7'>No appointments found.</td></tr>";
}
?>