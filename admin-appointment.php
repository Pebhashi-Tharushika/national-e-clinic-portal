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
              <input type="checkbox" id="cb-appointment-date" name="filter" value="cb-appointment-date">
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
                </div>
              </div>
              <div class="col" data-filter="clinic">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <select name="clinic" id="clinic">
                    <option value="" hidden>Select Clinic</option>
                  </select>
                </div>
              </div>
              <div class="col" data-filter="patient">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="patient" name="patient" placeholder="Patient NIC">
                </div>
              </div>
              <div class="col" data-filter="user">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="user" name="user" placeholder="User E-Mail">
                </div>
              </div>
              <div class="col" data-filter="appointment-date">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="appointment-date" name="appointment-date" placeholder="Appointment Date"
                    onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
              </div>
              <div class="col" data-filter="reserved-date">
                <div class="ps-1 pe-1 pt-0 pb-1">
                  <input type="text" id="reserved-date" name="reserved-date" placeholder="Reserved Date"
                    onfocus="(this.type='date')" onblur="(this.type='text')">
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

    </div>
    <div id="appointment-table-container"></div>
  </div>

  </div>



</section>