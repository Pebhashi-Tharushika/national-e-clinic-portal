<?php
session_start();

require_once './admin-patient-functions.inc.php';
require_once '../utility-functions.inc.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nic'])) {
   $nic = $_GET['nic'];

   $array = getProvinceByNic($nic);
   $province = $array['data'];

   $patientsInfor = getPatientInfoByNic($nic, convertProvinceNameToTable($province, 'appointment_'));
   
   if (isset($patientsInfor['data'])) {
      $patientsInfor['data'] = [
          'patientInfo' => $patientsInfor['data'],
          'province' => $province
      ];
  }
   sendResponse($patientsInfor);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $patients = getAllPatients();
   sendResponse($patients);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $data = json_decode(file_get_contents('php://input'), true);
   $province = $data['province'];
   $nic = $data['nic'];
   $clinic = $data['clinic'];
   $hospital = $data['hospital'];

   $clinicInfo = getPatientClinicInfo(convertProvinceNameToTable($province, 'appointment_'),$nic, $clinic, $hospital);
   sendResponse($clinicInfo);
} 

?>