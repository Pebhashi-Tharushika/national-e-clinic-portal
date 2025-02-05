<?php

require_once 'dbh.inc.php';

// Function to fetch profiles 
function getProfiles()
{
    global $conn; // Use global to access the database connection
    $query = "SELECT id, first_name, last_name FROM patient_profiles WHERE user_id=?";
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

?>