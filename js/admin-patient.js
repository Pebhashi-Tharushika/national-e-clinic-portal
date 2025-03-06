document.addEventListener("DOMContentLoaded", function () {
  const btnDropdown = document.getElementById("btn-dropdown");
  const mnuDropdown = document.getElementById("mnu-dropdown");

  const btnClear = document.getElementById("btnClear");

  let selectedColumn = '';
  var searchTerm = '';

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  // Initialize table
  var table = $('#patientTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    ordering: true,
    info: true,
    scrollX: true, // Enables horizontal scrolling
    fixedColumns: {
      right: 2  // Freezes the last 2 columns
    },
    dom: 'lrtip',
    drawCallback: function (settings) { // Add event listener to redraw tooltips when the table is redrawn or when page changes
      initializeTooltips(); // Initialize tooltips after each table redraw (page change)
    }
  });


  /* ----------------------------------- search - dropdown --------------------------------- */

  // Dropdown Toggle
  btnDropdown?.addEventListener("click", function () {
    toggleDisplayMenu(mnuDropdown.style.display === "block" ? "none" : "block");
  });

  // Dropdown Item Selection
  document.querySelectorAll("#mnu-dropdown li").forEach(item => {
    item.addEventListener("click", function () {
      document.querySelector("#btn-dropdown > span:first-child").textContent = this.textContent;
      selectedColumn = $(this).attr('data-value');
      searchTable();
      toggleDisplayMenu("none");
    });
  });

  // Close Dropdown When Clicking Outside
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".dropdown")) {
      toggleDisplayMenu("none");
    }
  });

  function toggleDisplayMenu(show) {
    mnuDropdown.style.display = show;
  }




  /* -------------------------------------- dynamic search ---------------------------------- */

  // Dynamic search 
  $('#searchInput').on('keyup', function () {
    searchTerm = this.value;
    searchTable();
  });

  function searchTable() {
    table.search('').columns().search('').draw(); // Clear previous filters

    if (selectedColumn === "") {
      // Global search
      table.search(searchTerm).draw();
    } else {
      // Individual column search
      table.column(selectedColumn).search(searchTerm).draw();
    }
  }

  /* ------------------------------------- get all patients list ----------------------------------- */

  getAllPatients();

  function getAllPatients() {

    $.ajax({
      type: 'GET',
      url: `/national-e-clinic-portal/includes/admin-fetch-patient.inc.php`,
      success: function (response) {
        if (response.status === "success") {
          insertTableData(response.data);
        } else if (response.status === "error") {
          alert(response.message);
        }

      },
      error: function (xhr, status, error) {
        alert('Error fetching patients: ' + error);
      }
    });
  }


  /* ---------------------------------- display patients infor in table --------------------------- */

  // Function to initialize tooltips
  function initializeTooltips() {
    // Dispose any existing tooltips to avoid multiple initializations
    $('[data-bs-toggle="tooltip"]').tooltip('dispose');

    // Initialize tooltips for new rows
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => {
      new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  function insertTableData(patients) {
    table.clear(); // Clear existing data

    if (patients.length === 0) {
      return;
    }

    patients.forEach(data => {
      // Your existing code to build the table row (data insertion)
      let firstName = data.first_name || '';
      let lastName = data.last_name || '';
      let nic = data.nic || '';
      let birthDate = data.birth_date || '';
      let email = data.email || '';
      let phone = data.phone || '';
      let addressLine1 = data.address_line1 || '';
      let addressLine2 = data.address_line2 || '';
      let addressLine3 = data.address_line3 || '';
      let province = data.province || '';
      let userEmail = data.user_email || '';
      let userName = data.user_name || '';
      let userId = data.user_id || '';
      let patientId = data.id || '';

      let year = '', month = '', day = '';

      if (birthDate) {
        let age = calculateAge(birthDate).split(' ');
        year = age[0];
        month = age[1];
        day = age[2];
      }


      let fullAddress = getFullAddress(addressLine1, addressLine2, addressLine3);

      // Add the new row with tooltip data
      table.row.add([
        `${firstName} ${lastName}`,
        nic,
        email,
        phone,
        fullAddress,
        province,
        birthDate,
        year,
        month,
        day,
        `<div class="show-user-info" data-bs-toggle="modal" data-bs-target="#user-info-modal"
                  data-user-email="${userEmail}" 
                  data-user-name="${userName}" 
                  data-user-id="${userId}" >
              <i class="fa-solid fa-eye" 
              data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Show User" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
          </div>`,
        `<div class="edit-patient-info" data-patient-id="${patientId}">
              <i class="fa-solid fa-pen-to-square" 
              data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Edit" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
          </div>`
      ]);

      // Redraw the table after each insertion
      table.draw();
    });

    // Initialize tooltips after table redraw
    initializeTooltips();
  }

  function getFullAddress(addressLine1, addressLine2, addressLine3) {
    let addressParts = [addressLine1];
    if (addressLine2) addressParts.push(addressLine2);
    if (addressLine3) addressParts.push(addressLine3);
    return addressParts.join(', ');
  }

  function calculateAge(birthDateString) {

    let birthDate = new Date(birthDateString); // Parse string into a Date object
    let today = new Date();

    // Calculate differences
    let years = today.getFullYear() - birthDate.getFullYear();
    let months = today.getMonth() - birthDate.getMonth();
    let days = today.getDate() - birthDate.getDate();

    // Adjust months and years
    if (days < 0) {
      months -= 1;
      let previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
      days += previousMonth.getDate();
    }

    if (months < 0) {
      years -= 1;
      months += 12;
    }

    // Format the result
    return `${years} ${String(months).padStart(2, '0')} ${String(days).padStart(2, '0')}`;
  }


  /* ----------------------------------- show user infor ---------------------------------------- */

  $('tbody').on('click', '.show-user-info', function () {
    let userEmail = $(this).data('user-email');
    let userName = $(this).data('user-name');
    let userId = $(this).data('user-id');

    $('#user-id-val').text(userId);
    $('#user-name-val').text(userName);
    $('#user-email-val').text(userEmail);

  });


  /* -------------------------------------- update table infor ----------------------------------- */

  // Function to extract user info 
  function getUserInfo(row) {
    let userColumn = row.find('.show-user-info'); // Find the div inside the column
    return {
      userEmail: userColumn.attr("data-user-email"),
      userName: userColumn.attr("data-user-name"),
      userId: userColumn.attr("data-user-id")
    };
  }

  // Function to update the row in DataTables
  function updateTableRow(rowIndex, updatedData, userInfo, patientId) {
    let age = calculateAge(updatedData.dob).split(' ');
    let year = age[0], month = age[1], day = age[2];
    let address = getFullAddress(updatedData.address1, updatedData.address2, updatedData.address3);

    table.row(rowIndex).data([
      updatedData.name,
      updatedData.nic,
      updatedData.email,
      updatedData.phone,
      address,
      updatedData.province,
      updatedData.dob,
      year,
      month,
      day,
      `<div class="show-user-info" data-bs-toggle="modal" data-bs-target="#user-info-modal"
           data-user-email="${userInfo.userEmail}" 
           data-user-name="${userInfo.userName}" 
           data-user-id="${userInfo.userId}" >
          <i class="fa-solid fa-eye" 
              data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Show User" 
              data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
      </div>`,
      `<div class="edit-patient-info" data-patient-id="${patientId}">
          <i class="fa-solid fa-pen-to-square" 
              data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Edit" 
              data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
      </div>`
    ]).draw(false);
  }

  // Main event handler for edit click
  $('tbody').on('click', '.edit-patient-info', function () {
    const row = $(this).closest('tr');  // Get the closest row
    let rowIndex = table.row(row).index(); // Get row index in DataTables

    let address = row.find('td').eq(4).text();
    let addressArray = address.split(',');

    // Retrieve all table cell values
    const patientData = {
      name: row.find('td').eq(0).text(),
      nic: row.find('td').eq(1).text(),
      email: row.find('td').eq(2).text(),
      phone: row.find('td').eq(3).text(),
      address1: addressArray[0],
      address2: addressArray.length >= 2 ? addressArray[1] : '',
      address3: addressArray.length === 3 ? addressArray[2] : '',
      province: row.find('td').eq(5).text(),
      dob: row.find('td').eq(6).text()
    };

    openUpdateModal(patientData); // Open modal and populate form fields

    let userInfo = getUserInfo(row);

    let patientId = $(this).attr("data-patient-id");

    // Unbind previous click event to prevent duplicates
    $("#btnUpdate").off('click').on('click', function () {

      let isValid = validateForm();

      // Remove error message when user starts typing
      $("input, select").on("input change", function () {
        $(this).removeClass("is-invalid");
        $(this).next(".invalid-feedback").remove();
      });


      // If form is valid, proceed with form submission logic
      if (isValid) {

        // Collect updated data
        const updatedData = {
          patientId: patientId,
          name: $('#patientName').val(),
          nic: $('#nic').val(),
          email: $('#email').val(),
          phone: $('#phone').val(),
          address1: $('#address1').val(),
          address2: $('#address2').val(),
          address3: $('#address3').val(),
          province: $('#province').val(),
          dob: $('#dob').val()
        };

        // AJAX request to update the patient data
        $.ajax({
          type: 'POST',
          url: `/national-e-clinic-portal/includes/admin-update-patient.inc.php`,
          dataType: "json",
          contentType: "application/json",
          data: JSON.stringify(updatedData),
          success: function (response) {
            if (response.status === "success") {
              btnClear.click(); // Clear fields
              $('#patient-update-form').modal('hide'); // Close modal
              updateTableRow(rowIndex, updatedData, userInfo, patientId); // Update DataTables row
              alert(response.message);
            }
          },
          error: function (xhr, status, error) {
            alert('Error updating patient: ' + error);
          }
        });

      }

    });
  });

  function validateField(id, errorMessage) {
    let input = $("#" + id);
    let value = input.val().trim();

    if (value === "") {
      if (input.next(".invalid-feedback").length === 0) {
        input.after(`<div class="invalid-feedback" style="color: red;">${errorMessage}</div>`);
      }
      input.addClass("is-invalid");
      return false; 
    }
    return true; 
  }

  function validateForm() {
    let isValid = true; // Assume form is valid initially

    isValid &= validateField("patientName", "Patient name is required.");
    isValid &= validateField("nic", "NIC is required.");
    isValid &= validateField("email", "Valid email is required.");
    isValid &= validateField("phone", "Phone number is required.");
    isValid &= validateField("address1", "Address Line 1 is required.");
    isValid &= validateField("dob", "Date of birth is required.");

    isValid = Boolean(isValid); // Convert numeric result to true/false

    let province = $("#province");
      if (!province.val() || province.val() === "") {
        province.addClass("is-invalid");
        if (province.next(".invalid-feedback").length === 0) {
          province.after(`<div class="invalid-feedback">Province selection is required.</div>`);
        }
        isValid = false;
      } else {
        province.removeClass("is-invalid");
        province.next(".invalid-feedback").remove();
      }

    return isValid;
  }


  // Function to populate the modal form fields
  function openUpdateModal(patient) {
    $("#patientName").val(patient.name);
    $("#nic").val(patient.nic);
    $("#email").val(patient.email);
    $("#phone").val(patient.phone);
    $("#address1").val(patient.address1);
    $("#address2").val(patient.address2);
    $("#address3").val(patient.address3);
    $("#dob").val(patient.dob);
    $("#province").val(patient.province);

    // Open the modal
    let modal = new bootstrap.Modal($('#patient-update-form'));
    modal.show();
  }

  // clear update patient details form
  btnClear?.addEventListener("click", function () {
    document.getElementById("updatePatientForm").reset();
  });

});

