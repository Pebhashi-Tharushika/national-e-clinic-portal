<?php
session_start();

require_once 'admin-appointment-functions.inc.php';
require_once 'utility-functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['province']))  {
    $provinceName = $_GET['province'];
   $appointments = getAppointmentsByProvince(convertProvinceNameToTable($provinceName,'appointment_'));
    sendResponse($appointments);
}