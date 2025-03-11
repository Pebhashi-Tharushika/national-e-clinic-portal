<?php
session_start();

require_once './clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents("php://input"); // Get the raw JSON input

    $data = json_decode($json, true); // Decode JSON into a PHP associative array

    // Check if decoding was successful
    if ($data === null) {
        sendResponse(["status" => "error", "message" => "Invalid JSON data"]);
    }



    $result = saveNewClinicCategory($data['clinic_category']);
    sendResponse($result);



}


?>