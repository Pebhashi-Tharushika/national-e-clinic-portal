<?php include_once 'header.php'
?>

<section id="getting-started">
  <div class="container">

    <div class="slogan">Take the First Step Toward a Healthier Life in Just a Minute</div><br>
    
    <div class="title">Getting Started</div>
    
    <div class="content">The National E-Clinic Portal, under the Ministry of Health Sri Lanka, is your trusted gateway to government clinics across the country. Here’s how it works:</div>
    
    <div class="icon-wrapper">

      <div class="icon">
          <?php 
          // Check if the user is logged in
          if (isset($_SESSION["username"])) {
              // User is logged in, create a link to the profile page
              echo '<a href="profile/DetailsAprove page.php"><i class="fa fa-heart"></i></a>';
          } else {
              // User is not logged in, create a link to the login page
              echo '<a href="login.php"><i class="fa fa-heart"></i></a>';
          }
          ?>
          <p>Create Your Profile</p>
      </div>
     
      <div class="icon">
        <?php 
          // Check if the user is logged in
          if (isset($_SESSION["username"])) {
              // User is logged in, create a link to the profile page
              echo '<a href="Appointment/book_appointment.php"><i class="fa fa-plus"></i></a>';
          } else {
              // User is not logged in, create a link to the login page
              echo '<a href="login.php"><i class="fa fa-plus"></i></a>';
          }
        ?>
        
        <p>Book Your Appointment</p>
      </div>

      <div class="icon">
        <?php 
            // Check if the user is logged in
            if (isset($_SESSION["username"])) {
                // User is logged in, create a link to the profile page
                echo '<a href="Appointment/view_appointment.php"><i class="fa fa-coffee"></i></a>';
            } else {
                // User is not logged in, create a link to the login page
                echo '<a href="login.php"><i class="fa fa-coffee"></i></a>';
            }
          ?>
        <p>View My Appoinmnets</p>
      </div>

    </div>

  </div>
</section>

<section id="how-to-work">
  <div class="title">How Does It Work?</div>
  <div class="content">The National E-Clinic Portal, under the Ministry of Health Sri Lanka, is your trusted gateway to government clinics across the country.</div>
  <div id="grid-wrapper">
    <div class="grid text-center">
        <div class="g-col-3">
          <div><i class="fa-solid fa-users"></i></div>
          <div id="title">Comprehensive Registration</div>
          <div id="content">Anyone in Sri Lanka can register to maintain a clear and updated patient profile with essential medical details.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-sharp-duotone fa-solid fa-hospital"></i></div>
          <div id="title">Streamlined Clinic Coordination</div>
          <div id="content">Our dedicated team ensures that clinics under mainstream hospitals in Sri Lanka are well-organized, accessible.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-hourglass-half"></i></div>
          <div id="title">Stay Updated on Schedules</div>
          <div id="content">Effortlessly view clinic schedules and receive timely updates on upcoming appointments to stay informed.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-regular fa-calendar-days"></i></div>
          <div id="title">Effortless Clinic Reservations</div>
          <div id="content">Book your clinic visits digitally, saving time and eliminating the hassle of long queues and manual bookings.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>

        <div class="g-col-3">
          <div><i class="fa-solid fa-hand-holding-medical"></i></div>
          <div id="title">Reliable Healthcare Services</div>
          <div id="content">high-quality healthcare services delivered by skilled professionals using state-of-the-art facilities at government clinics.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-laptop-medical"></i></div>
          <div id="title">Seamless Medical Record Access</div>
          <div id="content">Securely access and manage your medical records online, enabling continuity of care and easy information sharing with healthcare providers.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-comment-medical"></i></div>
          <div id="title">Enhanced <br> Communication</div>
          <div id="content">Receive notifications and reminders for appointments and follow-ups to ensure timely healthcare access.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-clock-rotate-left"></i></div>
          <div id="title">Boundless <br> Accessibility</div>
          <div id="content">Provide 24/7 access the portal, allowing you to Stay connected to your healthcare anytime, anywhere, from any device.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
      </div>
  </div>
</section>


<?php include_once 'footer.php'
?>