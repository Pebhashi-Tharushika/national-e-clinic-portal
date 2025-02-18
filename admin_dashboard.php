
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/national-e-clinic-portal/dashbord_style.css">
    <title>Admin Dashboard</title>
   
</head>

<body>
    <div class="sidebar" id="sidebar">
        <h2>Admin Menu</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="patients.php">Patients</a>
        <a href="admin_appointments.php">Appointments</a>
        <a href="clinic.php">Clinics</a>
        <a href="questions.php">Medical Questions</a>
        <a href="admin_setting.php">Settings</a>
        <a href="admin_login.php">Logout</a>
    </div>

    <div class="content" id="content">
        <header>
            <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>
            <h1>Welcome to the Admin Dashboard</h1>
        </header>
        <main>
            <h2>Dashboard Overview</h2>
            <div class="dashboard-card">
                <h3>Total Patients</h3>
                <p id="totalPatients">150</p>
            </div>
            <div class="dashboard-card">
                <h3>Total Appointments</h3>
                <p id="totalAppointments">200</p>
            </div>
            <div class="dashboard-card">
                <h3>Doctors Available</h3>
                <p id="doctorsAvailable">12</p>
            </div>
            <button class="logout-button" onclick="logout()">Logout</button>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            sidebar.classList.toggle("active");
            content.classList.toggle("active");

            // Adjust content width based on sidebar visibility
            if (sidebar.classList.contains("active")) {
                content.style.width = "calc(100% - 250px)";
            } else {
                content.style.width = "100%";
            }
        }

        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../index.php"; // Redirect to logout
            }
        }

        // Mock data simulation (optional)
        document.getElementById("totalPatients").innerText = 150 + Math.floor(Math.random() * 10); // Random patients
        document.getElementById("totalAppointments").innerText = 200 + Math.floor(Math.random() * 5); // Random appointments
        document.getElementById("doctorsAvailable").innerText = 12 + Math.floor(Math.random() * 3); // Random doctors
    </script>
</body>

</html>