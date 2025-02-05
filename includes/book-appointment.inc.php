<?php
session_start();

require_once 'appointment-functions.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    sendResponse(getProfiles());
}

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}


?>