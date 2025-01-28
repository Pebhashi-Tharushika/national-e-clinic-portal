<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['province'])) {
        $province = $_POST['province'];
        include_once 'includes/clinic-functions.inc.php';

        // Validate the province
        $response = isExistProvince($province);

        if ($response['status'] == 'error') {
            sendResponse($response);
        } else {
            if (!$response) {
                sendResponse([
                    'status' => 'error',
                    'message' => 'Province does not exist'
                ]);
            }
        }

        $districts = getDistrictsByProvince($province); // Fetch Districts.

        sendResponse($districts);
    }
}

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}



?>

