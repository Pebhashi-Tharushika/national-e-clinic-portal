<?php
session_start();

require_once './clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['clinic_category']) && isset($_POST['province']) && isset($_POST['hospital'])) {
        $province = $_POST['province'];
        $hospital = $_POST['hospital'];
        $clinicCategory = $_POST['clinic_category'];

        // $provinceName = $provinceMap[$province];
        $provinceTable = convertProvinceNameToTable($province,'clinic_');

        $clinicDetails = getClinicDetails($provinceTable, $province,$hospital, $clinicCategory);
        sendResponse($clinicDetails);
    }

    if (isset($_POST['hospital_category']) && isset($_POST['district']) && isset($_POST['province'])) {
        $hospital_category = $_POST['hospital_category'];
        $district = $_POST['district'];
        $province = $_POST['province'];

        $hospitals = getHospitalsByProvinceAndDistrictAndCategory($hospital_category, $district, $province);
        sendResponse($hospitals);
    }

    // if (isset($_POST['hospital']) && isset($_POST['province'])) {
    //     $hospitalName = $_POST['hospital'];
    //     $province = $_POST['province'];
    //     $provinceName = $provinceMap[$province];

    //     $clinicCategories = getClinicCategoriesByHospital($hospitalName, $provinceName);
    //     sendResponse($clinicCategories);
    // }


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


?>