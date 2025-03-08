<?php
session_start();

require_once './appointment-functions.inc.php';
require_once '../clinic/clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response;
    if (isset($_GET['request'])) {
        if ($_GET['request'] === 'profile') {
            $response = getProfiles();
        } elseif ($_GET['request'] === 'clinic') {
            $response = getAllClinicCategories();
        } else {
            $response = ["error" => "Invalid request parameter"];
        }
    } else {
        $response = ["error" => "No request parameter provided"];
    }
    sendResponse($response);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['province']) && isset($_POST['patient_id']) && isset($_POST['clinic_id']) && isset($_POST['hospital_id']) && isset($_POST['clinic_date']) && isset($_POST['clinic_time_period']) ) {
        $provinceName = $_POST['province'];
        $patientId = $_POST['patient_id'];
        $clinicCategoryId = $_POST['clinic_id'];
        $hospitalId = $_POST['hospital_id'];
        $appointmentDate = $_POST['clinic_date'];
        $appointmentTime = $_POST['clinic_time_period'];

        $result = saveAppointment(convertProvinceNameToTable($provinceName,'appointment_'),$patientId, $clinicCategoryId, $hospitalId, $appointmentDate, $appointmentTime);
        sendResponse($result);
    }

    if (isset($_POST['province']) && isset($_POST['clinic_id']) && isset($_POST['hospital_id']) && isset($_POST['appointment_date'])) {
        $provinceName = $_POST['province'];
        $clinicCategoryId = $_POST['clinic_id'];
        $hospitalId = $_POST['hospital_id'];
        $appointmentDate = $_POST['appointment_date'];

        $timeSolts = getAlreadyBookedTimeSolts(convertProvinceNameToTable($provinceName,'appointment_'), $clinicCategoryId, $hospitalId, $appointmentDate);
        sendResponse($timeSolts);
    }

    if (isset($_POST['province']) && isset($_POST['clinic_id']) && isset($_POST['hospital_id'])) {
        $provinceName = $_POST['province'];
        $clinicCategoryId = $_POST['clinic_id'];
        $hospitalId = $_POST['hospital_id'];

        $days = getClinicAvailableDays(convertProvinceNameToTable($provinceName,'clinic_'), $clinicCategoryId, $hospitalId);
        sendResponse($days);
    }


    if (isset($_POST['province']) && isset($_POST['clinic_id'])) {
        $provinceName = $_POST['province'];
        $clinicCategoryId = $_POST['clinic_id'];

        $hospitals = getHospitalsByProvinceAndClinicCategory(convertProvinceNameToTable($provinceName,'clinic_'), $provinceName, $clinicCategoryId);
        sendResponse($hospitals);
    }
}


?>