<?php

// Initialize form step and values
$errors = [];
$step = 1;

// Retrieve saved values from session if available
$step1_values = $_SESSION['step1'] ?? [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'nic' => '',
    'phone' => ''
];

$step2_values = $_SESSION['step2'] ?? [
    'bdate' => '',
    'address' => '',
    'address1' => '',
    'address2' => '',
    'province' => ''
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check which button was clicked and adjust the step accordingly

    if (isset($_POST['next'])) {

        // Collect form data
        $step1_values = $_POST['step1'];

        $fname = $step1_values['fname'] ?? '';
        $lname = $step1_values['lname'] ?? '';
        $email = $step1_values['email'] ?? '';
        $nic = $step1_values['nic'] ?? '';
        $phone = $step1_values['phone'] ?? '';


        // Validate Step 1 fields 
        if (empty($fname)) {
            $errors['fname'] = "First name is required";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
            $errors['fname'] = "Invalid First name";
        }

        if (empty($lname)) {
            $errors['lname'] = "Last name is required";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
            $errors['lname'] = "Invalid Last name";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }

        if (empty($nic)) {
            $errors['nic'] = "NIC is required";
        } elseif (!preg_match("/^(?:19|20)?\d{2}[0-9]{10}|[0-9]{9}[x|X|v|V]$/", $nic)) {
            $errors['nic'] = "Invalid NIC";
        }

        if (empty($phone)) {
            $errors['phone'] = "Phone number is required";
        } elseif (!preg_match("/^(0\d{9}|\+94\s\d{9})$/", $phone)) {
            $errors['phone'] = "Invalid phone number";
        }

        $_SESSION['step1'] = $step1_values;// Store step1 values in session


        // If no errors, proceed to Step 2, Stay on Step 1 if there are validation errors
        $step = empty($errors) ? 2 : 1;

    } elseif (isset($_POST['back'])) {
        $bdate = $_POST['step2']['bdate'] ?? '';
        $address1 = $_POST['step2']['address'] ?? '';
        $address2 = $_POST['step2']['address1'] ?? '';
        $address3 = $_POST['step2']['address2'] ?? '';
        $province = $_POST['step2']['province'] ?? '';

        $_SESSION['step2'] = $_POST['step2']; // Store step2 values in session

        $step = 1; // Move back to Step 1

    } elseif (isset($_POST['submit'])) {
        $step2_values = $_POST['step2'];

        // Collect form data
        $bdate = $step2_values['bdate'] ?? '';
        $address1 = $step2_values['address'] ?? '';
        $address2 = $step2_values['address1'] ?? '';
        $address3 = $step2_values['address2'] ?? '';
        $province = $step2_values['province'] ?? '';

        // Validate Step 2 fields 
        if (empty($bdate)) {
            $errors['bdate'] = "Date of birth is required";
        } elseif (new DateTime($bdate) >= new DateTime()) {
            $errors['bdate'] = "Invalid date of birth";
        }

        if (empty($address1)) {
            $errors['address'] = "Address is required";
        }

        if (empty($province)) {
            $errors['province'] = "Province is required";
        }

        $_SESSION['step2'] = $_POST['step2']; // Store step2 values in session


        // If no errors, proceed 
        if (empty($errors)) {
            require_once __DIR__ . '/../../includes/dbh.inc.php';

            // Retrieve values from session for Step 1
            if (isset($_SESSION['step1'])) {
                $fname = $_SESSION['step1']['fname'] ?? '';
                $lname = $_SESSION['step1']['lname'] ?? '';
                $email = $_SESSION['step1']['email'] ?? '';
                $nic = $_SESSION['step1']['nic'] ?? '';
                $phone = $_SESSION['step1']['phone'] ?? '';
            }

            // Save the profile data to the database
            $result = createPatientProfile($conn, $fname, $lname, $email, $nic, $phone, $bdate, $address1, $address2, $address3, $province);

            $message = $result['message'];


            if ($result['status'] === 'success') {
                // Clear session data after successful submission
                unset($_SESSION['step1'], $_SESSION['step2']);

                header("Location: /national-e-clinic-portal/index.php"); //redirect to index.php
                exit; // Ensure that no further code is executed

            } else {
                // Display error message in alert
                echo "<script>
                    alert('{$message}');
                </script>";
            }




        } else {
            $step = 2;
        }
    }
}


// Function to create a new profile
function createPatientProfile($conn, $fname, $lname, $email, $nic, $phone, $bdate, $address1, $address2, $address3, $province)
{
    $query = "INSERT INTO patient_profiles (user_id, first_name, last_name, email, nic, phone, birth_date, address_line1, address_line2, address_line3, province) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Get username from the current logged-in user (session userid)
        $userId = $_SESSION['userId'];
        mysqli_stmt_bind_param($stmt, "sssssssssss", $userId, $fname, $lname, $email, $nic, $phone, $bdate, $address1, $address2, $address3, $province);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt); // Close statement

        return $result ?
            ['status' => 'success', 'message' => 'Profile saved successfully.'] :
            ['status' => 'error', 'message' => 'Error during saving profile.'];


    } else {
        return [
            'status' => 'error',
            'message' => 'Error during preparing query.'
        ];

    }
}
?>