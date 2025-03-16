<?php
session_start();

require_once './admin-clinic-functions.inc.php';
require_once '../utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['province']) && isset($_GET['clinic'])) {

    $province = $_GET['province'];
    $clinic = $_GET['clinic'];

    $result = getClinicInfoByProvinceAndCategory(convertProvinceNameToTable($province, 'clinic_'),$clinic);
    sendResponse($result);
}
