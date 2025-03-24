<?php
session_start();

require_once './admin-clinic-functions.inc.php';
require_once '../clinic/clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['add']) ){

    $json = file_get_contents("php://input"); // Get the raw JSON input

    $data = json_decode($json, true); // Decode JSON into a PHP associative array

    // Check if decoding was successful
    if ($data === null) {
        sendResponse(["status" => "error", "message" => "Invalid JSON data"]);
    }

    $add = $_GET['add'];

    if($add === 'category'){
        $result = saveNewClinicCategory($data['clinic_category']);
        sendResponse($result);
    }

    if($add === 'clinic'){

        $startTime = convertTo12HourFormat($data['startTime']);
        $endTime = convertTo12HourFormat($data['endTime']);
        $timeSlot = $startTime . " - " . $endTime;

        $data['time_slot'] = $timeSlot;
        
        $result = addNewClinic(convertProvinceNameToTable($data['province'], 'clinic_'),$data);
        sendResponse($result);
    }

    
}


?>