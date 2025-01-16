<section id="content-and-carousel">
  <div id="content-and-carousel-container">
    <div id="content-container">
      <div id="main-content">
        <h2 class="blob"> Book Your Hospital Visit, Anytime, Anywhere, <br> Just a Click Away.</h2>
        <div class="button-wrapper">
          <a href="#getting-started">
            <div id="btn-gs" class="button">Getting Started
              <i class="fa-solid fa-circle-chevron-down fa-bounce"></i>
            </div>
          </a>

          <a href="/national-e-clinic-portal/see-clinic-details.php">
            <div id="btn-clinic-data" class="button">See Clinic Details</div>
          </a>
        </div>
      </div>
    </div>

    <div id="carousel-container" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carousel-container" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/national-e-clinic-portal/images/baby-patient.webp" class="d-block w-100" alt="image1">
        </div>
        <div class="carousel-item">
          <img src="/national-e-clinic-portal/images/adult-patient.jpg" class="d-block w-100" alt="image2">
        </div>
        <div class="carousel-item">
          <img src="/national-e-clinic-portal/images/consult-patient.jpg" class="d-block w-100" alt="image3">
        </div>
        <div class="carousel-item">
          <img src="/national-e-clinic-portal/images/measuring-blood-pressure.jpg" class="d-block w-100" alt="image4">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel-container" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel-container" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>


</section>

<section id="getting-started">
  <div class="container">
    <div class="row">

      <div class="col-5" id="gs-img"></div>

      <div class="col-7" id="gs-step">
        <div class="slogan">Take the First Step Toward a Healthier Life in Just a Minute</div><br>

        <div id="getting-started-title">Getting Started</div>

        <div id="getting-started-content">With just a few simple steps, you can unlock the convenience of our National
          E-Clinic Portal. Create an account, set up a patient profile, and access a world of seamless healthcare
          clinic
          services right at your fingertips.</div>

        <div class="icon-wrapper">

          <!-- Check if the user is logged in -->
          <!-- User is logged in, create a link to the profile page -->
          <!-- User is not logged in, create a link to the login page -->
          <div class="icon">
            <?php
            if (isset($_SESSION["username"])) {
              echo '<a href="profile/DetailsAprovepage.php"><i class="fa-solid fa-user"></i></a>';
            } else {
              echo '<a href="login.php"><i class="fa-solid fa-user"></i></a>';
            }
            ?>
            <p>Create Your Profile</p>
          </div>

          <div class="icon">
            <?php
            if (isset($_SESSION["username"])) {
              echo '<a href="Appointment/book_appointment.php"><i class="fa-solid fa-plus-large"></i></a>';
            } else {
              echo '<a href="login.php"><i class="fa-solid fa-plus-large"></i></a>';
            }
            ?>

            <p>Book Your Appointment</p>
          </div>

          <div class="icon">
            <?php
            if (isset($_SESSION["username"])) {
              echo '<a href="Appointment/view_appointment.php"><i class="fa-solid fa-eye"></i></a>';
            } else {
              echo '<a href="login.php"><i class="fa-solid fa-eye"></i></a>';
            }
            ?>
            <p>View My Appointmnets</p>
          </div>

          <!-- <div class="icon">
    <?php
    echo '<a href="FAQ/FAQ.php"><i class="fa fa-comments"></i></a>';
    ?>
    <p>FAQs</p>
  </div> -->

        </div>
      </div>
    </div>


  </div>
</section>

<section id="how-to-work">
  <div id="how-to-work-title">How Does It Work?</div>
  <div id="how-to-work-content">The National E-Clinic Portal, under the Ministry of Health Sri Lanka, is your trusted
    gateway to government clinics across the country.</div>
  <div id="grid-wrapper">
    <div class="grid text-center">
      <div class="g-col-3">
        <div><i class="fa-solid fa-users-medical"></i></div>
        <div class="title">Comprehensive Registration</div>
        <div class="content">Anyone in Sri Lanka can register to maintain a clear and updated patient profile with
          essential medical details.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fa-solid fa-hospital"></i></div>
        <div class="title">Streamlined Clinic Coordination</div>
        <div class="content">Our dedicated team ensures that clinics under mainstream hospitals in Sri Lanka are
          well-organized, accessible.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fa-solid fa-hourglass-clock"></i></div>
        <div class="title">Stay Updated on Schedules</div>
        <div class="content">Effortlessly view clinic schedules and receive timely updates on upcoming appointments to
          stay informed.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fa-regular fa-calendar-days"></i></div>
        <div class="title">Effortless Clinic Reservations</div>
        <div class="content">Book your clinic visits digitally, saving time and eliminating the hassle of long queues
          and manual bookings.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>

      <div class="g-col-3">
        <div><i class="fa-solid fa-hand-holding-medical"></i></div>
        <div class="title">Reliable Healthcare Services</div>
        <div class="content">high-quality healthcare services delivered by skilled professionals using
          state-of-the-art
          facilities at government clinics.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fa-solid fa-clipboard-medical"></i></div>
        <div class="title">Seamless Medical Record Access</div>
        <div class="content">Securely access and manage your medical records online, enabling continuity of care and
          easy information sharing with healthcare providers.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fas fa-user-headset"></i></div>
        <div class="title">Personalized <br> Assistance</div>
        <div class="content">Our dedicated staff provides prompt medical support, home treatment guidance, and
          addresses
          patient queries via call or email.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
      <div class="g-col-3">
        <div><i class="fa-solid fa-clock-rotate-left"></i></div>
        <div class="title">Boundless <br> Accessibility</div>
        <div class="content">Provide 24/7 access to the portal, allowing you to Stay connected to your healthcare
          anytime, anywhere, from any device.</div>
        <div class="learn-more"><a href="">Learn more</a></div>
      </div>
    </div>
  </div>
</section>

<section id="why-choose">
    <h1 id="why-choose-title">Why Choose the National E-Clinic Portal?</h1> 
  
  <div id="why-choose-content">
    <ul class="accordion-group" id="accordion">
      <li class="accordion-item">
        <div class="accordion-overlay">
          <h3>Empowered Healthcare Access</h3>
          <h4>1&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="/national-e-clinic-portal/images/medical-staff-icon.png" alt="logo">
          <h2>Empowered Healthcare Access</h2>
          <p>The National E-Clinic Portal offers universal health coverage, accessible 24/7, 365 days a year across
            Sri
            Lanka. With the integration of advanced technologies, it ensures that healthcare is within reach for
            everyone, regardless of location or socio-economic status.</p>
        </div>
      </li>
      <li class="accordion-item">
        <div class="accordion-overlay">
          <h3>Premium Quality Service</h3>
          <h4>2&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="/national-e-clinic-portal/images/medical-staff-icon.png" alt="logo">
          <h2>Premium Quality Service</h2>
          <p>The portal is backed by highly experienced, SLMC-registered doctors, exclusively trained SLNC-registered
            nurses, and qualified staff. All medicines and services comply with international standards, including
            NMRA
            registration and GMP practices aligned with WHO guidelines, ensuring top-tier healthcare.</p>
        </div>
      </li>
      <li class="accordion-item">
        <div class="accordion-overlay">
          <h3>Seamless Experience</h3>
          <h4>3&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="/national-e-clinic-portal/images/medical-staff-icon.png" alt="logo">
          <h2>Seamless Experience</h2>
          <p>From registration to reservations, every step is simplified and streamlined for a hassle-free experience.
            The portal harnesses modern tools and technologies to provide efficient and effective healthcare services,
            ensuring that users can access care with ease.</p>
        </div>
      </li>
      <li class="accordion-item">
        <div class="accordion-overlay">
          <h3>Free Healthcare Services</h3>
          <h4>4&nbsp;-&nbsp;</h4>
        </div>
        <section class="accordion-content">
        </section>
        <div class="article">
          <img src="/national-e-clinic-portal/images/medical-staff-icon.png" alt="logo">
          <h2>Free Healthcare Services</h2>
          <p>The National E-Clinic Portal aligns with Sri Lanka’s longstanding tradition of providing free healthcare.
            All services, including consultations, laboratory tests, medications, and operations, are offered at no
            cost, reinforcing the country’s commitment to ensuring healthcare accessibility for all citizens.</p>
        </div>
      </li>
    </ul>
  </div>
  <div id="why-choose-percentage" class="row justify-content-evenly">
    <div class="col-4">
      <div class="percentage-content">
        <div class="percentage-counter">
          <span class="percentage">0</span>
          <span>%</span>
        </div>
        <div class="percentage-counter-title">Quality Ensured</div>
      </div>
      <div class="text-content">
        <p>Our commitment to 100% assurance in healthcare excellence ensures consistency in quality.</p>
      </div>
    </div>
    <div class="col-4">
    <div class="percentage-content">
        <div class="percentage-counter">
          <span class="percentage">0</span>
          <span>%</span>
        </div>
        <div class="percentage-counter-title">Patient Satisfaction</div>
      </div>
      <div class="text-content">
        <p>We strive for patients’ happiness by ensuring their convenience, comfort and well-being.</p>
      </div>
    </div>
  </div>
</section>