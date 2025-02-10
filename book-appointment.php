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
    <link rel="stylesheet" href="/national-e-clinic-portal/style/book-appointment.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="/national-e-clinic-portal/js/book-appointment.js"></script>
</head>

<body>

    <?php
    include_once 'back-to-home.php';
    ?>

    <section id="book-appointment">
        <div id="form-wrapper">
            <div id="image-container"></div>
            <div id="form-container">
                <h1>Book an Appointment</h1>
                <form id="appointmentForm" method="POST" novalidate>
                    <!-- Select Profile -->
                    <label for="profile_name">Select Profile:</label>
                    <select id="profile_name" name="profile_name" required>
                        <option value="" hidden>Select Profile</option>
                    </select>

                    <!-- Select Clinic -->
                    <label for="clinic_name">Select Clinic:</label>
                    <select id="clinic_name" name="clinic_name" required>
                        <option value="" hidden>Select Clinic</option>
                    </select>

                    <!-- Select Hospital (Dynamically Populated) -->
                    <label for="hospital_name">Select Hospital:</label>
                    <select id="hospital_name" name="hospital_name" required>
                        <option value="" hidden>Select Hospital</option>
                    </select>

                    <!-- Appointment Date -->
                    <label for="appointment_date">Appointment Date:</label>
                    <!-- prevent manual typing date -->
                    <input type="date" id="appointment_date" name="appointment_date" required onkeydown="return false;">

                    <!-- Appointment Time -->
                    <label for="appointment_time">Appointment Time:</label>
                    <select id="appointment_time" name="appointment_time" required>
                        <option value="" hidden>Select Time</option>
                        <!-- Time slots will be dynamically populated -->
                    </select>

                    <!-- Submit Button -->
                    <button id="btn-submit" type="button">Book Appointment</button>
                </form>

            </div>
        </div>

    </section>


</body>

</html>