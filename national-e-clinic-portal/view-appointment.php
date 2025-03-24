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
    <link rel="stylesheet" href="/national-e-clinic-portal/style/view-appointment.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="/national-e-clinic-portal/js/view-appointment.js"></script>
</head>

<body>

    <?php
    include_once 'back-to-home.php';
    ?>

    <section>
        <div id="view-apointment">
            <div id="appointment-title">
                <h1 id="title">Clinic Appointments</h1>
            </div>

            <div id="user-details">
            </div>

            <div id="table-appointments">
                <table>
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Hospital</th>
                            <th>Clinic</th>
                            <th>Clinic Place</th>
                            <th>Clinic Date</th>
                            <th>Clinic Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>


    </section>

</body>

</html>