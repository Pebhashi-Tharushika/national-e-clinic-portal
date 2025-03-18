<?php
session_start();

require_once './admin-clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $json = file_get_contents("php://input"); // Get the raw JSON input

    $data = json_decode($json, true); // Decode JSON into a PHP associative array

    // Check if decoding was successful
    if ($data === null) {
        sendResponse(["status" => "error", "message" => "Invalid JSON data"]);
    }

    // Validate input data
    $id = $data['id'] ?? null;
    $province = $data['province'] ?? null;
    $status = $data['status'] ?? null;

    if (!$id || !$province || !isset($status)) {
        sendResponse(["status" => "error", "message" => "Missing required fields"]);
    }

   $result = toggleActiveStatusOfClinic($id,convertProvinceNameToTable($province, 'clinic_'),$status);
   sendResponse($result);
}


?>
