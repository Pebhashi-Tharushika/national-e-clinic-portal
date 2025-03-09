<?php

// Map province_name to database value
function convertProvinceNameToTable($province, $prefix)
{
    if (!isValidProvince($province)) {
        sendResponse([
            'status' => 'error',
            'message' => 'Invalid province.'
        ]);
    }

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

    $provinceName = $provinceMap[$province];
    return $prefix . $provinceName;
}

function isValidProvince($province)
{
    // Whitelist valid province names to prevent SQL injection
    $allowedProvinces = [
        'Central',
        'Eastern',
        'Northern',
        'North Central',
        'North Western',
        'Sabaragamuwa',
        'Southern',
        'Uva',
        'Western'
    ];

    if (!in_array($province, $allowedProvinces)) {
        return false;
    } else {
        return true;
    }

}

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>