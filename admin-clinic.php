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

    <div class="patient-clinic" id="clinic-category-title">
      <h4>All Clinic Categories</h4>
    </div>

    <div class="patient-clinic" id="clinic-categories-container">
      <div id="add-clinic-categories">
        <p>
          <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-clinics"
            aria-expanded="false" aria-controls="collapseWidthExample">
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

    <!-- <div class="patient-clinic" id="patient-clinic-content2">
      <h4>Central Province clinic</h4>

      <div id="filter-container">

        <div id="filter-form">
          <div id="filter-title">
            <i class="fa-regular fa-filter-list"></i>
            <p>Filter By:</p>
          </div>

          <div id="filter-options">

            <div>
              <input type="checkbox" id="cb-hospital" name="filter" value="cb-hospital">
              <label for="hospital">Hospital</label>
            </div>

            <div>
              <input type="checkbox" id="cb-clinic" name="filter" value="cb-clinic">
              <label for="clinic">Clinic</label>
            </div>

            <div>
              <input type="checkbox" id="cb-patient" name="filter" value="cb-patient">
              <label for="patient">Patient</label>
            </div>

            <div>
              <input type="checkbox" id="cb-user" name="filter" value="cb-user">
              <label for="user">User</label>
            </div>
            <div>
              <input type="checkbox" id="cb-clinic-date" name="filter" value="cb-appointment-date">
              <label for="appointment-date">Appointment Date</label>
            </div>

            <div>
              <input type="checkbox" id="cb-reserved-date" name="filter" value="cb-reserved-date">
              <label for="reserved-date">Reserved Date</label>
            </div>

            <div>
              <input type="checkbox" id="cb-status" name="filter" value="cb-status">
              <label for="status">Status</label>
            </div>

          </div>

          <div id="filter-select">
            <div class="row row-cols-6 gx-4 gy-2">
              <div class="col" data-filter="hospital">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="hospital" id="hospital">
                    <option value="" hidden>Select Hospital</option>
                  </select>
                  <span id="hospital-error" class="error-message">required*</span>
                </div>
              </div>
              <div class="col" data-filter="clinic">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="clinic" id="clinic">
                    <option value="" hidden>Select Clinic</option>
                  </select>
                  <span id="clinic-error" class="error-message">required*</span>
                </div>
              </div>
              <div class="col" data-filter="patient">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="patient" name="patient" placeholder="Patient NIC">
                  <span id="patient-error" class="error-message">required*</span>
                </div>
              </div>
              <div class="col" data-filter="user">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="user" name="user" placeholder="User E-Mail">
                  <span id="user-error" class="error-message">required*</span>
                </div>
              </div>
              <div class="col" data-filter="appointment-date">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="appointment-date" name="appointment-date" placeholder="Appointment Date"
                    onfocus="(this.type='date')" onblur="(this.type='text')">
                  <span id="appointment-date-error" class="error-message">required*</span>
                </div>
              </div>
              <div class="col" data-filter="reserved-date">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="reserved-date" name="reserved-date" placeholder="Reserved Date"
                    onfocus="(this.type='date')" onblur="(this.type='text')">
                  <span id="reserved-date-error" class="error-message">required*</span>
                </div>
              </div>

              <div class="col" data-filter="status">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="status" id="status">
                    <option value="" hidden>Select Status</option>
                    <option value="approved">APPROVED</option>
                    <option value="pending">PENDING</option>
                    <option value="rejected">REJECTED</option>
                  </select>
                  <span id="status-error" class="error-message">required*</span>
                </div>
              </div>
            </div>
          </div>

          <div id="button-wrapper">
            <button id="b-reset" disabled>RESET</button>
            <button id="b-search" disabled>SEARCH</button>
          </div>
        </div>



      </div>

      <div id="table-container">
        <table>
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Patient NIC</th>
              <th>Hospital</th>
              <th>Clinic</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>Reserved At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <td colspan="11">Not found clinics</td>
            </tr>
          </tfoot>

        </table>
      </div>

    </div> -->

  </div>
</section>