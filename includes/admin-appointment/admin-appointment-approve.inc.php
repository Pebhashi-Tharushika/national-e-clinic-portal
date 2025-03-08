<?php
session_start();

require_once './admin-appointment-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $inputData = file_get_contents("php://input");
    $decodedData = json_decode($inputData, true);

    if (isset($decodedData['province']) && isset($decodedData['status']) && isset($decodedData['id'])) {
        $provinceName = $decodedData['province'];
        $status = $decodedData['status'];
        $appointmentId = $decodedData['id'];

        $result = ApproveOrRejectAppointments(convertProvinceNameToTable($provinceName, 'appointment_'), $status, $appointmentId);
        sendResponse($result);
    } else {
        sendResponse(['status' => 'error', 'message' => 'Missing required fields.']);
    }
}


?>