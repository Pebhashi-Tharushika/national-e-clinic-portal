<section id="admin-clinic-container">

  <div id="patient-clinic-wrapper">

    <div class="patient-clinic" id="patient-clinic-header">
      <h3 id="patient-clinic-title">MEDICAL CLINICS</h3>
      <h6>All administrators are responsible for correctly maintaining all clinics registered in the <strong>National
          E-Clinic Portal</strong> and ensuring that the information stays up to date. Incorrect or outdated clinic data
        can mislead the entire system, affecting patients, doctors and other hospital staff.</h6>
      <h6>As an administrator, you have the authority to:</h6>
      <ul>
        <li>Register a new clinic</li>
        <li>Reschedule the currently available date and time of a clinic</li>
        <li>Change the clinic venue</li>
        <li>Assign doctors</li>
        <li>Remove inactive clinics from the system</li>
      </ul>

      <h6><strong>Note:</strong> These actions require approval from the top level of the National E-Clinic Portal. All
        administrators must ensure that clinic details are maintained systematically and updated regularly.</h6>
    </div>

    <p class="placeholder-glow patient-info">
      <span class="placeholder col-12 placeholder-xs"></span>
    </p>

    <div class="patient-clinic" id="clinic-category-title">
      <h4>All Clinic Categories</h4>
    </div>


    <div class="patient-clinic" id="clinic-categories-container">
      <div id="add-clinic-categories">
        <p>
          <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-clinics">
            <i class="fa-solid fa-circle-plus"></i>Add Clinic Category
          </button>
        </p>
        <div id="collapse-clinics-wrapper">
          <div class="collapse" id="collapse-clinics">
            <div class="card card-body" id="collapse-clinics-content">

              <div id="new-clinic-category-container">
                <label for="new-clinic-category" class="form-label">Clinic Category :</label>
                <div id="input-wrapper">
                  <input type="text" class="form-control input-text" id="new-clinic-category"
                    placeholder="Please enter name of clinic category">
                  <div class="error-field">required*</div>
                </div>
                <button class="btn btn-primary" id="btnSubmit">Submit</button>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div id="clinic-categories-content">
        <div class="row align-items-start">
          <div class="col" id="col1">
            <ul></ul>
          </div>
          <div class="col" id="col2">
            <ul></ul>
          </div>
          <div class="col" id="col3">
            <ul></ul>
          </div>
        </div>
      </div>

    </div>

    <p class="placeholder-glow patient-info" id="placeholder2">
      <span class="placeholder col-12 placeholder-xs"></span>
    </p>

    <div class="patient-clinic" id="clinic-detail-title">
      <h4>Details of All Clinics</h4>
    </div>

    <div class="patient-clinic" id="clinic-detail-container">

      <div id="btnAddClinic-wrapper">
        <button class="btn" id="btnAddClinic" type="button">
          <i class="fa-solid fa-circle-plus"></i>Add Clinic
        </button>
      </div>

      <div id="drpdwnCategory-wrapper">
        <label for="drpdwnCategory">Clinic</label>
        <select id="drpdwnCategory" class="form-select input-select">

        </select>
      </div>

      <div class="container mt-4">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="clinicTabs"></ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="tabContent"></div>
      </div>

    </div>

  </div>

  <!-- new clinic add / clinic update form - modal -->
  <div class="modal" id="add-edit-clinic-modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Update Clinic Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container overflow-hidden">
            <form id="addNewClinicOrEditClinicForm">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 lr-col">

                  <div class="mb-3">
                    <label for="clinic-category" class="form-label">Clinic Category</label>
                    <select class="form-select" id="clinic-category">
                      <option value="" disabled selected>Select Clinic Category</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <select class="form-select" id="province">
                      <option value="" disabled selected>Select Province</option>
                      <?php
                      $provinces = ["Central", "Eastern", "North Central", "Northern", "North Western", "Sabaragamuwa", "Southern", "Uva", "Western"];
                      foreach ($provinces as $province) {
                        echo "<option value='$province'>$province</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <select class="form-select" id="district" disabled>
                      <option value="" disabled selected>Select District</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="hospital" class="form-label">Hospital</label>
                    <select class="form-select" id="hospital" disabled>
                      <option value="" disabled selected>Select Hospital</option>
                    </select>
                  </div>

                </div>

                <!-- Right Column -->
                <div class="col-md-6 lr-col">

                  <div class="mb-3">
                    <label for="clinic-place" class="form-label">Clinic Place</label>
                    <input type="text" class="form-control" id="clinic-place" placeholder="Enter Clinic Place">
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="clinic-date">Clinic Day</label>
                    <select class="form-select" id="clinic-date">
                      <option value="" disabled selected>Select Clinic Day</option>
                      <?php
                      $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                      foreach ($daysOfWeek as $day) {
                        echo "<option value='$day'>$day</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="start-time">Start Time:</label>
                    <input type="time" class="form-control" id="start-time">
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="end-time">End Time:</label>
                    <input type="time" class="form-control" id="end-time">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <!-- Buttons -->
          <div class="d-flex justify-content-end pt-2">
            <button type="button" class="btn btn-primary me-2 mt-2" id="btnAddOrEdit">Save Changes</button>
            <button type="button" class="btn btn-secondary me-2 mt-2" id="btnClear">Clear</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- clinic update form - modal -->
  <div class="modal" id="edit-clinic-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Update Clinic Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container overflow-hidden">
            <form id="updateClinicForm">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="patientName" class="form-label">Clinic Name</label>
                    <input type="text" class="form-control" id="patientName" placeholder="Enter patient name">
                  </div>
                  <div class="mb-3">
                    <label for="nic" class="form-label">Hospital</label>
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