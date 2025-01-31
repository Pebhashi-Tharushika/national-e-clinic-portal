<?php
session_start();

require_once 'includes/clinic-functions.inc.php';

// Map province_name to database value
$provinceMap = [
    'Central' => 'central_province',
    'Eastern' => 'eastern_province',
    'Northern' => 'northern_province',
    'North Western' => 'north_western_province',
    'Western' => 'western_province',
    'Southern' => 'southern_province',
    'Sabaragamuwa' => 'sabaragamuwa_province',
    'Uva' => 'uva_province',
    'North Central' => 'north_central_province'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['clinic_category']) && isset($_POST['province']) && isset($_POST['hospital'])) {
        $province = $_POST['province'];
        $hospital = $_POST['hospital'];
        $clinicCategory = $_POST['clinic_category'];

        $provinceName = $provinceMap[$province];

        $clinicDetails = getClinicDetails($provinceName, $hospital, $clinicCategory);
        sendResponse($clinicDetails);
    }

    if (isset($_POST['hospital_category']) && isset($_POST['district']) && isset($_POST['province'])) {
        $hospital_category = $_POST['hospital_category'];
        $district = $_POST['district'];
        $province = $_POST['province'];

        $hospitals = getHospitalsByProvinceAndDistrictAndCategory($hospital_category, $district, $province);
        sendResponse($hospitals);
    }

    if (isset($_POST['hospital']) && isset($_POST['province'])) {
        $hospitalName = $_POST['hospital'];
        $province = $_POST['province'];
        $provinceName = $provinceMap[$province];

        $clinicCategories = getClinicCategoriesByHospital($hospitalName, $provinceName);
        sendResponse($clinicCategories);
    }


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

    if (isset($_POST['district'])) {
        $district = $_POST['district'];

        $instituteType = getInstituteTypeByDistrict($district);
        sendResponse($instituteType);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    sendResponse(getAllClinicCategories());
}

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}



?>