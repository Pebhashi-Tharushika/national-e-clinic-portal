<section id="main-section">
    <?php
    // Define allowed contents
    $allowedContents = [
        'mnu1' => 'admin-dashboard.php',
        'mnu2' => 'admin-patient.php',
        'mnu3' => 'admin-appointment.php',
        'mnu4' => 'admin-clinic.php',
        'mnu5' => 'admin-request.php'
    ];

    // Get 'content' from URL, default to 'mnu1'
    $content = isset($_GET['content']) && array_key_exists($_GET['content'], $allowedContents) ? $_GET['content'] : 'mnu1';
    
    // Include the corresponding file
    include_once $allowedContents[$content];
    ?>
</section>


<div class="sidebar" id="sidebar">
    <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu1">
        <div id="mnu1" class="menu">
            <h3>Dashboard</h3>
            <span><i class="fa-light fa-objects-column"></i></span>
        </div>
    </a>

    <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu2">
        <div id="mnu2" class="menu">
            <h3>Patients</h3>
            <span><i class="fa-sharp fa-regular fa-bed-pulse"></i></span>
        </div>
    </a>

    <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu3">
        <div id="mnu3" class="menu">
            <h3>Appointments</h3>
            <span><i class="fa-regular fa-calendar-check"></i></span>
        </div>
    </a>

    <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu4">
        <div id="mnu4" class="menu">
            <h3>Clinics</h3>
            <span><i class="fa-regular fa-hospital-user"></i></span>
        </div>
    </a>

    <a href="/national-e-clinic-portal/index.php?page=admin&content=mnu5">
        <div id="mnu5" class="menu">
            <h3>Request</h3>
            <span><i class="fa-regular fa-comment-medical"></i></span>
        </div>
    </a>
</div>


