<?php include_once 'header.php'
?>
      
<section id="getting-started">
  <div class="container">

    <div class="slogan">Take the First Step Toward a Healthier Life in Just a Minute</div><br>
    
    <div class="title">Getting Started</div>
    
    <div class="content">With just a few simple steps, you can unlock the convenience of our National E-Clinic Portal. Create an account, set up a patient profile, and access a world of seamless healthcare clinic services right at your fingertips.</div>
    
    <div class="icon-wrapper">

      <div class="icon">
          <?php 
          // Check if the user is logged in
          if (isset($_SESSION["username"])) {
              // User is logged in, create a link to the profile page
              echo '<a href="profile/DetailsAprove page.php"><i class="fa-solid fa-user"></i></a>';
          } else {
              // User is not logged in, create a link to the login page
              echo '<a href="login.php"><i class="fa-solid fa-user"></i></a>';
          }
          ?>
          <p>Create Your Profile</p>
      </div>
     
      <div class="icon">
        <?php 
          // Check if the user is logged in
          if (isset($_SESSION["username"])) {
              // User is logged in, create a link to the profile page
              echo '<a href="Appointment/book_appointment.php"><i class="fa-solid fa-plus-large"></i></a>';
          } else {
              // User is not logged in, create a link to the login page
              echo '<a href="login.php"><i class="fa-solid fa-plus-large"></i></a>';
          }
        ?>
        
        <p>Book Your Appointment</p>
      </div>

      <div class="icon">
        <?php 
            // Check if the user is logged in
            if (isset($_SESSION["username"])) {
                // User is logged in, create a link to the profile page
                echo '<a href="Appointment/view_appointment.php"><i class="fa-solid fa-eye"></i></a>';
            } else {
                // User is not logged in, create a link to the login page
                echo '<a href="login.php"><i class="fa-solid fa-eye"></i></a>';
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
          <div><i class="fa-solid fa-users-medical"></i></div>
          <div id="title">Comprehensive Registration</div>
          <div id="content">Anyone in Sri Lanka can register to maintain a clear and updated patient profile with essential medical details.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-hospital"></i></div>
          <div id="title">Streamlined Clinic Coordination</div>
          <div id="content">Our dedicated team ensures that clinics under mainstream hospitals in Sri Lanka are well-organized, accessible.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fa-solid fa-hourglass-clock"></i></div>
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
          <div><i class="fa-solid fa-clipboard-medical"></i></div>
          <div id="title">Seamless Medical Record Access</div>
          <div id="content">Securely access and manage your medical records online, enabling continuity of care and easy information sharing with healthcare providers.</div>
          <div id="learn-more"><a href="">Learn more</a></div>
        </div>
        <div class="g-col-3">
          <div><i class="fas fa-user-headset"></i></div>
          <div id="title">Personalized <br> Assistance</div>
          <div id="content">Our dedicated staff provides prompt medical support, home treatment guidance, and addresses patient queries via call or email.</div>
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

<section id="why-choose">
  <div class="title">Why Choose the National E-Clinic Portal?</div>
  <div id="content">
    <ul class="accordion-group" id="accordion">
      <li class="accordion-item" >
        <div class="accordion-overlay">
          <h3>Empowered Healthcare Access</h3>
          <h4>1&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="images/medical_staff.png" alt="logo">
          <h2>Empowered Healthcare Access</h2>
          <p>The National E-Clinic Portal offers universal health coverage, accessible 24/7, 365 days a year across Sri Lanka. With the integration of advanced technologies, it ensures that healthcare is within reach for everyone, regardless of location or socio-economic status.</p>
        </div>
      </li>
      <li class="accordion-item" >
        <div class="accordion-overlay">
          <h3>Premium Quality Service</h3>
          <h4>2&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="images/medical_staff.png" alt="logo">
          <h2>Premium Quality Service</h2>
          <p>The portal is backed by highly experienced, SLMC-registered doctors, exclusively trained SLNC-registered nurses, and qualified staff. All medicines and services comply with international standards, including NMRA registration and GMP practices aligned with WHO guidelines, ensuring top-tier healthcare.</p>
        </div>
      </li>
      <li class="accordion-item" >
        <div class="accordion-overlay">
          <h3>Seamless Experience</h3>
          <h4>3&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="images/medical_staff.png" alt="logo">
          <h2>Seamless Experience</h2>
          <p>From registration to reservations, every step is simplified and streamlined for a hassle-free experience. The portal harnesses modern tools and technologies to provide efficient and effective healthcare services, ensuring that users can access care with ease.</p>
        </div>
      </li>
      <li class="accordion-item" >
        <div class="accordion-overlay">
          <h3>Free Healthcare Services</h3>
          <h4>4&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="images/medical_staff.png" alt="logo">
          <h2>Free Healthcare Services</h2>
          <p>The National E-Clinic Portal aligns with Sri Lanka’s longstanding tradition of providing free healthcare. All services, including consultations, laboratory tests, medications, and operations, are offered at no cost, reinforcing the country’s commitment to ensuring healthcare accessibility for all citizens.</p>
        </div>
      </li>           
    </ul>
  </div> 
</section>

<?php include_once 'footer.php'
?>