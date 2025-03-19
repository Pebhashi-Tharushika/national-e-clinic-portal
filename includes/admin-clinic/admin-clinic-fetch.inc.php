<?php
session_start();

require_once './admin-clinic-functions.inc.php';
require_once '../clinic/clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['province']) && isset($_GET['clinic'])) {

    $province = $_GET['province'];
    $clinic = $_GET['clinic'];

    $result = getClinicInfoByProvinceAndCategory(convertProvinceNameToTable($province, 'clinic_'),$clinic);
    sendResponse($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['province']) && isset($_GET['district'])) {

    $province = $_GET['province'];
    $district = $_GET['district'];

    $hospitals = getHospitalsByProvinceAndDistrict($province,$district);
    $districts = getDistrictsByProvince($province);

    if($districts['status'] === 'success' && $hospitals['status'] === 'success'){
        $result = ['status' => 'success', 'data' => [$districts,$hospitals], 'message' => 'Districts and hospitals fetched successfully.'] ;
    }else if($districts['status'] === 'success' && $hospitals['status'] === 'error'){
        $result = ['status' => 'd-success', 'data' => [$districts,[]], 'message' => 'Districts fetched successfully. No hospital found'];
    }else if($hospitals['status'] === 'success' && $districts['status'] === 'error'){
        $result = ['status' => 'h-success', 'data' => [[],$hospitals], 'message' => 'Hospitals fetched successfully. No district found'] ;
    }else{
        $result = ['status' => 'error', 'message' => 'No districts and hospitals found'] ;
    }

    sendResponse($result);
}
