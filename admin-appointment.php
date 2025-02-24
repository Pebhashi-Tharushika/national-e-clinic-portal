<section id="admin-appointment-container">

  <div id="patient-appointment-wrapper">

    <div class="patient-appointment" id="patient-appointment-header">
      <h3 id="patient-appointment-title">APPOINTMENTS OF PATIENTS</h3>
      <h6>Carefully review patient appointments for the approval process. You have the authority to permit or reject an
        appointment, but rejections must be reported to the top level of the National E-Clinic Portal with a valid
        reason and approved before proceeding. All admins are responsible for maintaining appointments in a methodical
        and regularly updated manner.</h6>
        <h6>Choose the Province:</h6>
    </div>

    <div class="patient-appointment" id="patient-appointment-content1">

      <div class="row g-5" id="btn-province-container">
        <div class="col-4 btn-province">
          <div class="p-3 province">Central Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Eastern Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">North Central Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">North Western Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Northern Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Sabaragamuwa Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Southern Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Uva Province</div>
        </div>
        <div class="col-4 btn-province">
          <div class="p-3 province">Western Province</div>
        </div>
      </div>

    </div>

    <div class="patient-appointment" id="patient-appointment-content2">
      <h4>Central Province Appointment</h4>

      <div id="filter-container">

        <form id="filter-form">
          <div id="filter-title">
            <i class="fa-regular fa-filter-list"></i>
            <p>Filter By:</p>
          </div>

          <div id="filter-options">

            <div>
              <input type="checkbox" id="hospital" name="filter" value="hospital">
              <label for="hospital">Hospital</label>
            </div>

            <div>
              <input type="checkbox" id="clinic" name="filter" value="clinic">
              <label for="clinic">Clinic</label>
            </div>

            <div>
              <input type="checkbox" id="patient" name="filter" value="patient">
              <label for="patient">Patient</label>
            </div>

            <div>
              <input type="checkbox" id="user" name="filter" value="user">
              <label for="user">User</label>
            </div>
            <div>
              <input type="checkbox" id="appointment-date" name="filter" value="appointment-date">
              <label for="appointment-date">Appointment Date</label>
            </div>

            <div>
              <input type="checkbox" id="reserved-date" name="filter" value="reserved-date">
              <label for="reserved-date">Reserved Date</label>
            </div>

          </div>

          <div id="filter-select">
            <div class="row row-cols-6 g-4">
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="hospital" id="hospital">
                    <option value="">Select Hospital</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="clinic" id="clinic">
                    <option value="">Select Clinic</option>
                  </select></div>
              </div>
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="patient" id="patient">
                    <option value="">Select Patient</option>
                  </select></div>
              </div>
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="user" id="user">
                    <option value="">Select User</option>
                  </select></div>
              </div>
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="appointment-date" id="appointment-date">
                    <option value="">Select Appointment Date</option>
                  </select></div>
              </div>
              <div class="col">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="reserved-date" id="reserved-date">
                    <option value="">Select Reserved Date</option>
                  </select></div>
              </div>
            </div>
          </div>


          <div id="button-wrapper">
            <button id="reset" disabled>RESET</button>
            <button id="search" disabled>SEARCH</button>
          </div>

        </form>

      </div>
      <div id="appointment-table-container"></div>
    </div>

  </div>



</section>