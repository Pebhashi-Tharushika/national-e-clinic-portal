<?php
session_start();

require_once './admin-appointment-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['province']))  {
    $provinceName = $_GET['province'];
   $appointments = getAppointmentsByProvince(convertProvinceNameToTable($provinceName,'appointment_'));
    sendResponse($appointments);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['province']) ){
    $provinceName = $_GET['province'];

    $json = file_get_contents("php://input"); // Get the raw JSON input

    $data = json_decode($json, true); // Decode JSON into a PHP associative array

    // Check if decoding was successful
    if ($data === null) {
        sendResponse(["status" => "error", "message" => "Invalid JSON data"]);
    }

   $filtered_appointments = getFilteredAppointments(convertProvinceNameToTable($provinceName,'appointment_'),$data);
   sendResponse($filtered_appointments);
}

?>
