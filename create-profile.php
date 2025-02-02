<?php
session_start();

// Initialize form step and values
$errors = [];
$step = 1;
$fname = $lname = $email = $nic = $phone = $bdate = $address1 = $address2 = $address3 = $province = ""; // Default values
$step1_values = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'nic' => '',
    'phone' => ''
];

$step2_values = [
    'bdate' => '',
    'address' => '',
    'address1' => '',
    'address2' => '',
    'province' => ''
];


// Check which button was clicked and adjust the step accordingly
if (isset($_POST['next'])) {

    // Collect form data
    $fname = $_POST['step1']['fname'] ?? '';
    $lname = $_POST['step1']['lname'] ?? '';
    $email = $_POST['step1']['email'] ?? '';
    $nic = $_POST['step1']['nic'] ?? '';
    $phone = $_POST['step1']['phone'] ?? '';

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

    $_SESSION['step1'] = $_POST['step1']; // Store step1 values in session

    // If no errors, proceed to Step 2
    if (empty($errors)) {

        $step = 2; // Move to Step 2
    } else {
        $step = 1; // Stay on Step 1 if there are validation errors
    }

} elseif (isset($_POST['back'])) {

    $bdate = $_POST['step2']['bdate'] ?? '';
    $address1 = $_POST['step2']['address'] ?? '';
    $address2 = $_POST['step2']['address1'] ?? '';
    $address3 = $_POST['step2']['address2'] ?? '';
    $province = $_POST['step2']['province'] ?? '';

    $_SESSION['step2'] = $_POST['step2']; // Store step2 values in session

    $step = 1; // Move back to Step 1

} elseif (isset($_POST['submit'])) {

    // Collect form data
    $bdate = $_POST['step2']['bdate'] ?? '';
    $address1 = $_POST['step2']['address'] ?? '';
    $address2 = $_POST['step2']['address1'] ?? '';
    $address3 = $_POST['step2']['address2'] ?? '';
    $province = $_POST['step2']['province'] ?? '';

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
        require_once 'dbh.inc.php';
        require_once 'functions.profile.php';

        // Retrieve values from session for Step 1
        if (isset($_SESSION['step1'])) {
            $fname = $_SESSION['step1']['fname'] ?? '';
            $lname = $_SESSION['step1']['lname'] ?? '';
            $email = $_SESSION['step1']['email'] ?? '';
            $nic = $_SESSION['step1']['nic'] ?? '';
            $phone = $_SESSION['step1']['phone'] ?? '';
        }

        // Save the profile data to the database
        createPatientProfile($conn, $fname, $lname, $email, $nic, $phone, $bdate, $address1, $address2, $address3, $province);


    } else {
        $step = 2; // Stay on Step 2 if there are validation errors
    }

}

// Retrieve saved values from session if available (for pre-filling the form)
if (isset($_SESSION['step1'])) {
    $step1_values = $_SESSION['step1'];
}

if (isset($_SESSION['step2'])) {
    $step2_values = $_SESSION['step2'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National E Clinic Portal</title>

    <!-- favicon -->
    <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

    <!-- to add icons from boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/national-e-clinic-portal/style/back-to-home.css">
    <link rel="stylesheet" href="/national-e-clinic-portal/style/create-profile.css">

    <script defer src="/national-e-clinic-portal/js/create-profile.js"></script>

</head>

<body>

    <?php
    include_once 'back-to-home.php';
    ?>

    <section id="create-profile">
        <div id="form-wrapper">
            <div id="image-container"></div>
            <div id="form-container">
                <h1 class="topic"><b>Create Profile</b></h1>

                <?php if ($step == 1): ?>
                    <!-- Step 1 Form -->
                    <form id="step1Form" method="POST" action="save_profile.php" novalidate>
                        <div id="step1" class="form-step">
                            <input type="hidden" name="step" value="1"> <!-- Ensure step 1 is identified -->

                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="step1[fname]" placeholder="Enter your first name"
                                value="<?php echo htmlspecialchars($step1_values['fname']); ?>" required>
                            <?php if (isset($errors['fname']))
                                echo "<p class='error'>" . $errors['fname'] . "</p>"; ?>
                            <br>

                            <label for="lname">Last Name:</label>
                            <input type="text" name="step1[lname]" placeholder="Enter your last name"
                                value="<?php echo htmlspecialchars($step1_values['lname']); ?>" required>
                            <?php if (isset($errors['lname']))
                                echo "<p class='error'>" . $errors['lname'] . "</p>"; ?>
                            <br>

                            <label for="email">Email:</label>
                            <input type="email" name="step1[email]" placeholder="Enter your Email"
                                value="<?php echo htmlspecialchars($step1_values['email']); ?>" required>
                            <?php if (isset($errors['email']))
                                echo "<p class='error'>" . $errors['email'] . "</p>"; ?>
                            <br>

                            <label for="nic">NIC:</label>
                            <input type="text" name="step1[nic]" placeholder="Enter NIC number"
                                value="<?php echo htmlspecialchars($step1_values['nic']); ?>" required>
                            <?php if (isset($errors['nic']))
                                echo "<p class='error'>" . $errors['nic'] . "</p>"; ?>
                            <br>

                            <label for="phone">Phone:</label>
                            <input type="tel" name="step1[phone]" placeholder="Enter your Phone Number"
                                value="<?php echo htmlspecialchars($step1_values['phone']); ?>" required>
                            <?php if (isset($errors['phone']))
                                echo "<p class='error'>" . $errors['phone'] . "</p>"; ?>
                            <br>

                            <button type="submit" name="next">Next</button>
                        </div>
                    </form>
                <?php endif; ?>

                <?php if ($step == 2): ?>
                    <!-- Step 2 Form -->
                    <form id="step2Form" method="POST" action="save_profile.php" novalidate>
                        <div id="step2" class="form-step">
                            <input type="hidden" name="step" value="2"> <!-- Ensure step 2 is identified -->

                            <label for="bdate">Birth Date:</label>
                            <input type="date" name="step2[bdate]"
                                value="<?php echo htmlspecialchars($step2_values['bdate']); ?>" required>
                            <?php if (isset($errors['bdate']))
                                echo "<p class='error'>" . $errors['bdate'] . "</p>"; ?>
                            <br>

                            <label for="address">Address</label>
                            <input type="text" name="step2[address]" placeholder="Address line 1"
                                value="<?php echo htmlspecialchars($step2_values['address']); ?>" required>
                            <?php if (isset($errors['address']))
                                echo "<p class='error'>" . $errors['address'] . "</p>"; ?>
                            <br>

                            <input type="text" name="step2[address1]" placeholder="Address line 2"
                                value="<?php echo htmlspecialchars($step2_values['address1']); ?>" required>
                            <br>
                            <input type="text" name="step2[address2]" placeholder="Address line 3"
                                value="<?php echo htmlspecialchars($step2_values['address2']); ?>" required>
                            <br>

                            <label for="province">Select a Province</label>
                            <select id="province" name="step2[province]" required>
                                <option value="">Please select your province</option>
                                <option value="northern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'northern' ? 'selected' : ''; ?>>Northern</option>
                                <option value="north-western" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'north-western' ? 'selected' : ''; ?>>North Western</option>
                                <option value="western" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'western' ? 'selected' : ''; ?>>Western</option>
                                <option value="north-central" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'north-central' ? 'selected' : ''; ?>>North Central</option>
                                <option value="central" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'central' ? 'selected' : ''; ?>>Central</option>
                                <option value="sabaragamuwa" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'sabaragamuwa' ? 'selected' : ''; ?>>Sabaragamuwa</option>
                                <option value="eastern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'eastern' ? 'selected' : ''; ?>>Eastern</option>
                                <option value="uva" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'uva' ? 'selected' : ''; ?>>Uva</option>
                                <option value="southern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'southern' ? 'selected' : ''; ?>>Southern</option>
                            </select>
                            <?php if (isset($errors['province']))
                                echo "<p class='error'>" . $errors['province'] . "</p>"; ?>
                            <br>

                            <button type="submit" name="back">Back</button>
                            <button type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>

    </section>



    <!-- <script>
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('status') && urlParams.get('status') === 'success') {
                // Clear local form data
                document.getElementById('step1Form').reset();
                document.getElementById('step2Form').reset();
            }
        };
    </script> -->

</body>

</html>