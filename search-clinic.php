<?php
session_start();

require_once 'includes/clinic-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['province'])) {
        $province = $_POST['province'];

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

    if(isset($_POST['district'])){
        $district = $_POST['district'];

       $instituteType = getInstituteType($district);
sendResponse($instituteType);
    }
}

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}



?>

