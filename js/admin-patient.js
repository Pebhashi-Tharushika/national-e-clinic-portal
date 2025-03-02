document.addEventListener("DOMContentLoaded", function () {
  const btnDropdown = document.getElementById("btn-dropdown");
  const mnuDropdown = document.getElementById("mnu-dropdown");

  const tblContainer = document.getElementById("tblContainer");
  const tblBody = document.querySelector('#tblContainer table tbody');

  let selectedColumn = '';
  var searchTerm = '';

  var table = $('#patientTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    ordering: true,
    info: true,
    scrollX: true,
    dom: 'lrtip'
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

  function insertTableData(patients) {

    table.clear(); // Clear existing data

    if (patients.length === 0) {
      return;
    }

    patients.forEach(data => {
      // Ensure data exists and provide default values if missing
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
        `<div class="user-info"><i class="fa-solid fa-eye"></i></div>`,
        `<div class="edit-user-info"><i class="fa-solid fa-pen-to-square"></i></div>`
      ]);

      // Redraw the table
      table.draw();

      let row = $('tbody tr:last-child')[0]; // Get the first DOM element from jQuery object
      let btnUserInfo = row?.querySelector('.user-info');
      let btnEdit = row?.querySelector('.edit-user-info');

      // Attach event listeners safely
      btnEdit?.addEventListener('click', () => console.log('edit'));
      btnUserInfo?.addEventListener('click', () => console.log('user'));


    });

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


});

