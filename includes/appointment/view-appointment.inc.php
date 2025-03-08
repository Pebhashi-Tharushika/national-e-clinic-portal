<?php
session_start();

require_once './appointment-functions.inc.php';
require_once '../utility-functions.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $response;
    if (isset($_GET['data'])) {
        if ($_GET['data'] === 'province') {
            $response = getPatientProvincesByUser();
        } elseif ($_GET['data'] === 'name') {
            $response = getNameByUserId();
        } else {
            $response = ["error" => "Invalid data parameter"];
        }
    } else {
        $response = ["error" => "No data parameter provided"];
    }
    sendResponse($response);

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['province'])) {
    $provinceName = $_POST['province'];
    sendResponse(getAllBookedAppointments(convertProvinceNameToTable($provinceName,'appointment_'),
    convertProvinceNameToTable($provinceName,'clinic_')));
}
?>