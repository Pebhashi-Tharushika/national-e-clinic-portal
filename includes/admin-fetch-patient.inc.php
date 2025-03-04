<?php
session_start();

require_once 'admin-patient-functions.inc.php';
require_once 'utility-functions.inc.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET'){
   $patients = getAllPatients();
   sendResponse($patients );
}

?>
