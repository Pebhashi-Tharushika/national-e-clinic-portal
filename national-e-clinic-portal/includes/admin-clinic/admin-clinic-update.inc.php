<?php
session_start();

require_once './admin-clinic-functions.inc.php';
require_once '../clinic/clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_GET['change'])) {

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

        $result = toggleActiveStatusOfClinic($id, convertProvinceNameToTable($province, 'clinic_'), $status);
        sendResponse($result);

    } else {
        $json = file_get_contents("php://input"); // Get the raw JSON input

        $data = json_decode($json, true); // Decode JSON into a PHP associative array

        // Check if decoding was successful
        if ($data === null) {
            sendResponse(["status" => "error", "message" => "Invalid JSON data"]);
        }

        $province = $data['province'];
        $previous_province = $data['previousProvince'];

        $isUpdateProvince = $province !== $previous_province;


        $startTime = convertTo12HourFormat($data['startTime']);
        $endTime = convertTo12HourFormat($data['endTime']);
        $timeSlot = $startTime . " - " . $endTime;

        $data['time_slot'] = $timeSlot;

        if ($isUpdateProvince) {

            $id = $data['clinicId'];
            $status = false;

            $result1 = toggleActiveStatusOfClinic($id, convertProvinceNameToTable($previous_province, 'clinic_'), $status);

            if ($result1['status'] === 'success') {

                $result2 = addNewClinic(convertProvinceNameToTable($province, 'clinic_'), $data);
                $result = $result2['status'] === 'success'
                    ? ['status' => 'success', 'data' => $time_slot, 'message' => 'Clinic ' . $id . ' updated successfully.']
                    : ['status' => 'error', 'message' => 'Clinic not updated-province.'];
                sendResponse($result);

            } else if ($result1['status'] === 'error') {
                sendResponse(['status' => 'error', 'message' => 'Clinic not updated-toggle.']);
            }


        } else {
            $result = updateClinicInfo(convertProvinceNameToTable($province, 'clinic_'), $data);
            sendResponse($result);
        }
    }

}



?>