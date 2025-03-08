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

    <div class="patient-info" id="patient-info-title">
      <h4>Basic Personal Information of Patients</h4>
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

    <div class="patient-info" id="patient-info-table">

      <div id="tblWrapper">

        <div id="tblContainer">
          <table id="patientTable" class="table table-bordered table-striped">
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

    <div class="patient-info" id="patient-info-title">
      <h4>Medical Clinic Information of Patients</h4>
    </div>

    <div class="patient-info">

      <!-- Search NIC -->
      <div class="mb-4" id="search-nic-wrapper">

        <div id="search-nic-container">
          <label for="search-nic" class="form-label">Patient's NIC</label>
          <input type="text" class="form-control input-text" id="search-nic" placeholder="Please enter NIC"
            maxlength="12">
          <button class="btn" id="btn-search-patient">Search <i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div class="invalid-field">required*</div>
      </div>

      <!-- Form Fields -->
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">Patient Name</label>
          <input type="text" class="form-control input-text" readonly>
        </div>
        <div class="col-md-4">
          <label class="form-label">Clinic</label>
          <select class="form-select input-select" disabled>
            <option value="">Select Clinic</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Hospital</label>
          <select class="form-select input-select" disabled>
            <option>Select Hospital</option>
          </select>
        </div>
        <!-- <div class="col-md-2">
            <label class="form-label">Dropdown</label>
            <select class="form-select">
              <option>Option 1</option>
              <option>Option 2</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Last 6 months</label>
            <select class="form-select">
              <option>Last 6 months</option>
              <option>Last 1 year</option>
            </select>
          </div> -->
      </div>

      <!-- Filter Buttons -->
      <div class="mb-3">
        <div class="btn-group filter-btn-group" role="group">
          <button type="button" class="btn btn-light active" data-filter="all">ALL</button>
          <button type="button" class="btn btn-light" data-filter="approved">Approved</button>
          <button type="button" class="btn btn-light" data-filter="pending">Pending</button>
          <button type="button" class="btn btn-light" data-filter="rejected">Rejected</button>
        </div>
      </div>

      <!-- Data Table -->
      <table id="appointmentTable" class="display table table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Appointment Status</th>
            <th>Absent/Present</th>
            <th>Doctor</th>
            <th>Prescriptions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-03-01</td>
            <td>10:00 AM</td>
            <td>Approved</td>
            <td>Present</td>
            <td>Dr. Smith</td>
            <td>Paracetamol</td>
          </tr>
          <tr>
            <td>2025-03-02</td>
            <td>11:30 AM</td>
            <td>Pending</td>
            <td>Absent</td>
            <td>Dr. John</td>
            <td>Ibuprofen</td>
          </tr>
          <tr>
            <td>2025-03-03</td>
            <td>02:00 PM</td>
            <td>Rejected</td>
            <td>Absent</td>
            <td>Dr. Lee</td>
            <td>Aspirin</td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination (Handled by DataTables) -->

    </div>

  </div>

  <!-- User Info - modal -->
  <div class="modal" tabindex="-1" id="user-info-modal">
    <div class="modal-dialog">
      <div class="modal-content" id="m-content">

        <div class="modal-header">
          <h5 class="modal-title">Portal User Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="container overflow-hidden">
            <div class="row gy-1">
              <div class="col-6 user-info">
                <div class="p-1" id="user-id"><strong>User Id :</strong></div>
              </div>
              <div class="col-6 user-info">
                <div class="p-1" id="user-id-val"></div>
              </div>
              <div class="col-6 user-info">
                <div class="p-1" id="user-name"><strong>User Name :</strong></div>
              </div>
              <div class="col-6 user-info">
                <div class="p-1" id="user-name-val"></div>
              </div>
              <div class="col-6 user-info">
                <div class="p-1" id="user-email"><strong>User Email :</strong></div>
              </div>
              <div class="col-6 user-info">
                <div class="p-1" id="user-email-val"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- patient update form - modal -->
  <div class="modal" id="patient-update-form" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Update Patient Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container overflow-hidden">
            <form id="updatePatientForm">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="patientName" class="form-label">Patient Name</label>
                    <input type="text" class="form-control" id="patientName" placeholder="Enter patient name">
                  </div>
                  <div class="mb-3">
                    <label for="nic" class="form-label">NIC</label>
                    <input type="text" class="form-control" id="nic" placeholder="Enter NIC">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone No.</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                  </div>
                  <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <select class="form-select" id="province" name="province">
                      <option value="" disabled selected>Select Province</option>
                      <option value="Central">Central</option>
                      <option value="Eastern">Eastern</option>
                      <option value="North Central">North Central</option>
                      <option value="North Western">North Western</option>
                      <option value="Northern">Northern</option>
                      <option value="Sabaragamuwa">Sabaragamuwa</option>
                      <option value="Southern">Southern</option>
                      <option value="Uva">Uva</option>
                      <option value="Western">Western</option>
                    </select>
                  </div>

                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="address1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="address1" placeholder="Enter address line 1">
                  </div>
                  <div class="mb-3">
                    <label for="address2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address2" placeholder="Enter address line 2">
                  </div>
                  <div class="mb-3">
                    <label for="address3" class="form-label">Address Line 3</label>
                    <input type="text" class="form-control" id="address3" placeholder="Enter address line 3">
                  </div>
                  <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob">
                  </div>


                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <!-- Buttons -->
          <div class="d-flex justify-content-end pt-4">
            <button type="button" class="btn btn-primary me-2 mt-2" id="btnUpdate">Save changes</button>
            <button type="button" class="btn btn-secondary me-2 mt-2" id="btnClear">Clear</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>