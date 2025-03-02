<section id="admin-patient-container">

  <div id="patient-info-wrapper">

    <div class="patient-info" id="patient-info-header">
      <h3 id="patient-info-title">REGISTERED PATIENTS</h3>
      <h6>As per our privacy policy, we collect and store certain personal information of patients in the system.
        We <strong>prioritize the privacy of every individual</strong>, just as we value our own and <strong>ensure data
          integrity</strong> to maintain patients' trust in our healthcare
        services. This allows us to provide personalized treatment and medication plans while securely managing medical
        history. We
        are committed to protecting patients' privacy and ensuring the secure handling and maintenance of their
        information.</h6>
    </div>
    <div class="patient-info" id="patient-info-search">
      <div id="input-set">
        <!-- Dropdown -->
        <div class="dropdown" id="search-by-dropdown">
          <button id="btn-dropdown" class="dropdown-button">
            <span>
              ALL
            </span>
            <span>
              <i class="fa-solid fa-caret-down"></i>
            </span>
          </button>
          <ul id="mnu-dropdown" class="dropdown-menu">
            <li data-value="">ALL</li>
            <li data-value="0">NAME</li>
            <li data-value="1">NIC</li>
            <li data-value="2">EMAIL</li>
            <li data-value="3">PHONE NO</li>
          </ul>
        </div>

        <!-- Search Input -->
        <input type="text" id="searchInput" class="search-input" placeholder="Search Here">

        <!-- Search Button -->
        <div id="search-btn" class="search-button">
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
    </div>
    <div class="patient-info" id="patient-table">
      <h6>Details of Patient</h6>
      <div id="tblWrapper">
        <div id="tblContainer">
          <table id="patientTable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th rowspan="2">Patient Name</th>
                <th rowspan="2">NIC</th>
                <th rowspan="2">Email</th>
                <th rowspan="2">Phone No.</th>
                <th rowspan="2">Address</th>
                <th rowspan="2">Province</th>
                <th rowspan="2">Date of Birth</th>
                <th id="age-center" colspan="3">Age</th>
                <th rowspan="2">User</th>
                <th rowspan="2">Action</th>
              </tr>
              <tr>
                <th>years</th>
                <th>months</th>
                <th>days</th>
              </tr>
            </thead>
            <tbody></tbody>

          </table>
        </div>
        
      </div>

    </div>
</section>