<?php
// Database connection
require_once __DIR__ . '/../includes/dbh.inc.php';

// Whitelist valid province names to prevent SQL injection
$allowedProvinces = ['Central', 
                        'Eastern', 
                        'Northern',
                        'North Central', 
                        'North Western', 
                        'Sabaragamuwa', 
                        'Southern', 
                        'Uva', 
                        'Western'
                    ];


// Handle AJAX delete request
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteClinic') {
//     if (isset($_POST['id'], $_POST['province'])) {
//         $clinicId = intval($_POST['id']); // Sanitize ID
//         $province = $_POST['province'];

//         // Validate province name
//         if (in_array($province, $allowedProvinces)) {
//             deleteClinic($clinicId, $province);
//         } else {
//             echo 'invalid_province';
//         }
//     } else {
//         echo 'invalid_request';
//     }
// }

function isExistProvince($province)
{
    global $conn;

    $query = "SELECT id FROM provinces WHERE province_name = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $province);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $exists = mysqli_num_rows($result) > 0; // Boolean check
        mysqli_stmt_close($stmt);
        return $exists;
    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }

}

function getDistrictsByProvince($province)
{
    global $conn;

    $query = "SELECT d.`district_name` FROM `districts` d JOIN `provinces` p ON d.`province_id` = p.`id` WHERE p.`province_name` = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $province);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $districts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $districts[] = $row; // Store each row in the array
        }

        mysqli_stmt_close($stmt); // Close statement

        return !empty($districts) ?
            ['status' => 'success', 'data' => $districts, 'message' => 'Districts fetched successfully.'] :
            ['status' => 'error', 'message' => 'No districts found.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getInstituteTypeByDistrict($district)
{
    global $conn;

    $query = "SELECT DISTINCT i.institute_type
                FROM districts d
                JOIN hospitals h ON d.id = h.district_id
                JOIN institutes i ON h.institute_type_id = i.id
                WHERE d.district_name = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $district);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $instituteTypes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $instituteTypes[] = $row; // Store each row in the array
        }

        mysqli_stmt_close($stmt);

        return !empty($instituteTypes) ?
            ['status' => 'success', 'data' => $instituteTypes, 'message' => 'Hospital categories fetched successfully.'] :
            ['status' => 'error', 'message' => 'No hospital categories found.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

function getHospitalsByProvinceAndDistrictAndCategory($hospital_category, $district, $province)
{
    global $conn;

    $query = "SELECT h.hospital_name FROM hospitals h 
                JOIN districts d ON h.district_id = d.id
                JOIN provinces p ON h.province_id = p.id
                JOIN institutes i ON h.institute_type_id = i.id 
                WHERE p.province_name = ? AND d.district_name = ? AND i.institute_type=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $province, $district, $hospital_category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $hospitals = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $hospitals[] = $row;
        }

        mysqli_stmt_close($stmt);

        return !empty($hospitals) ?
            ['status' => 'success', 'data' => $hospitals, 'message' => 'Hospitals fetched successfully.'] :
            ['status' => 'error', 'message' => 'No hospitals found.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}

// function getClinicCategoriesByHospital($hospitalName, $provinceName)
// {
//     global $conn, $allowedProvinces;

//     if (in_array($provinceName, $allowedProvinces)) {
//         $provinceTable = 'clinic_' . $provinceName;
//         $query = "SELECT DISTINCT c.clinic_name FROM clinics_categories c
//                   JOIN $provinceTable p ON p.clinic_category_id = c.id
//                   JOIN hospitals h ON p.hospital_Id = h.id
//                   WHERE h.hospital_name = ?";

//         $stmt = mysqli_prepare($conn, $query);

//         if ($stmt) {
//             mysqli_stmt_bind_param($stmt, "s", $hospitalName);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);

//             $clinicCategories = [];
//             while ($row = mysqli_fetch_assoc($result)) {
//                 $clinicCategories[] = $row;
//             }

//             mysqli_stmt_close($stmt);

//             return !empty($clinicCategories) ?
//                 ['status' => 'success', 'data' => $clinicCategories, 'message' => 'Clinic categories fetched successfully.'] :
//                 ['status' => 'error', 'message' => 'No clinic categories found.'];


//         } else {
//             return [
//                 'status' => 'error',
//                 'message' => 'Error during preparing query.'
//             ];

//         }
//     } else {
//         die("Invalid province name.");
//     }
// }

function getAllClinicCategories()
{
    global $conn;

    
        
        $query = "SELECT * FROM clinics_categories";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $clinicCategories = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $clinicCategories[] = $row;
            }

            mysqli_stmt_close($stmt);

            return !empty($clinicCategories) ?
                ['status' => 'success', 'data' => $clinicCategories, 'message' => 'Clinic categories fetched successfully.'] :
                ['status' => 'error', 'message' => 'No clinic categories found.'];


        } else {
            return [
                'status' => 'error',
                'message' => 'Error during preparing query.'
            ];

        }

}

function getClinicDetails($provinceTable,$provinceName,$hospital,$clinicCategory)
{
    global $conn, $allowedProvinces;

    if (!in_array($provinceName, $allowedProvinces)) {
        return [
            'status' => 'error',
            'message' => 'Invalid province.'
        ];
    }


    $query = "SELECT clinic_place, clinic_date, clinic_time FROM $provinceTable p
                JOIN clinics_categories c ON p.clinic_category_id = c.id
                JOIN hospitals h ON p.hospital_id = h.id
                WHERE h.hospital_name = ? AND c.clinic_name = ?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $hospital,$clinicCategory);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $clinics = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clinics[] = $row; 
        }

        mysqli_stmt_close($stmt); 

        return !empty($clinics) ?
                ['status' => 'success', 'data' => $clinics, 'message' => 'Clinic deatils fetched successfully.'] :
                ['status' => 'error', 'message' => 'No clinic details found.'];
  
    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];
    }
}


// Function to add a clinic
function addClinic($province, $clinicName, $clinicPlace, $clinicDate, $clinicTime)
{
    global $conn;
    $sql = "INSERT INTO `$province` (Clinic_Name, Clinic_Place, Clinic_Date, Clinic_Time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $clinicName, $clinicPlace, $clinicDate, $clinicTime);
    return mysqli_stmt_execute($stmt);
}

// Function to convert 24-hour format to 12-hour format with AM/PM
function convertTo12HourFormat($time)
{
    $dateTime = DateTime::createFromFormat('H:i', $time);
    return $dateTime ? $dateTime->format('h:i A') : '';
}


// Function to delete clinic by ID
function deleteClinic($id, $province)
{
    global $conn;

    $sql = "DELETE FROM `$province` WHERE Clinic_Id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo 'success';
        } else {
            echo 'error';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'error';
    }
}
?>