<?php
session_start();
require_once "./includes/patient/profile-functions.inc.php";

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
                    <form id="step1Form" method="POST" novalidate>
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
                    <form id="step2Form" method="POST" novalidate>
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
                                <option value="" hidden selected>Please select your province</option>
                                <option value="Northern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'northern' ? 'selected' : ''; ?>>Northern</option>
                                <option value="North Western" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'north-western' ? 'selected' : ''; ?>>North Western</option>
                                <option value="Western" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'western' ? 'selected' : ''; ?>>Western</option>
                                <option value="North Central" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'north-central' ? 'selected' : ''; ?>>North Central</option>
                                <option value="Central" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'central' ? 'selected' : ''; ?>>Central</option>
                                <option value="Sabaragamuwa" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'sabaragamuwa' ? 'selected' : ''; ?>>Sabaragamuwa</option>
                                <option value="Eastern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'eastern' ? 'selected' : ''; ?>>Eastern</option>
                                <option value="Uva" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'uva' ? 'selected' : ''; ?>>Uva</option>
                                <option value="Southern" <?php echo isset($step2_values['province']) && $step2_values['province'] == 'southern' ? 'selected' : ''; ?>>Southern</option>
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

</body>

</html>