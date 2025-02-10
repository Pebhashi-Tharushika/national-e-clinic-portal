<?php

// Map province_name to database value
function convertProvinceNameToTable($province,$prefix)
{
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

function sendResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>