<?php
session_start();

require_once 'admin-patient-functions.inc.php';
require_once 'utility-functions.inc.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_by']) && isset($_POST['search_text'])){
    $searchBy = $_POST['search_by'];
    $searchText = $_POST['search_text'];

   $patients = getPatients($searchBy,$searchText);
   sendResponse($patients );
}

?>
