document.addEventListener("DOMContentLoaded", function () {
  const btnDropdown = document.getElementById("btn-dropdown");
  const mnuDropdown = document.getElementById("mnu-dropdown");

  let selectedColumn = '';
  var searchTerm = '';

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  var table = $('#patientTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    ordering: true,
    info: true,
    scrollX: true,
    dom: 'lrtip',
    // Add event listener to redraw tooltips when the table is redrawn or when page changes
    drawCallback: function (settings) {
      initializeTooltips(); // Initialize tooltips after each table redraw (page change)
    }
  });



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

  getAllPatients();

  // Handle Search Button Click
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



  function toggleDisplayMenu(show) {
    mnuDropdown.style.display = show;
  }

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

      let addressParts = [addressLine1];
      if (addressLine2) addressParts.push(addressLine2);
      if (addressLine3) addressParts.push(addressLine3);
      let fullAddress = addressParts.join(', ');

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
                  data-user-id="${userId}" 
                  data-patient-id="${patientId}">
              <i class="fa-solid fa-eye" 
              data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Show User" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
          </div>`,
        `<div class="edit-patient-info" 
                  data-patient-id="${patientId}">
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

  $('tbody').on('click', '.edit-patient-info', function () {
    console.log('Edit button clicked');
    showEditPane();
  });

  $('tbody').on('click', '.show-user-info', function () {
    let userEmail = $(this).data('user-email');
    let userName = $(this).data('user-name');
    let userId = $(this).data('user-id');

    $('#user-id-val').text(userId);
    $('#user-name-val').text(userName);
    $('#user-email-val').text(userEmail);

  });

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

  function showEditPane() { }



});

