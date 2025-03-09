<?php
session_start();

require_once './admin-patient-functions.inc.php';
require_once '../utility-functions.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nic'])){
   $nic = $_GET['nic'];

   $array = getProvinceByNic($nic);
   $province = $array['data'];

   $patientsInfor = getPatientInfoByNic($nic,
   convertProvinceNameToTable($province,'appointment_'));
   sendResponse($patientsInfor);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
   $patients = getAllPatients();
   sendResponse($patients );
}

?>
