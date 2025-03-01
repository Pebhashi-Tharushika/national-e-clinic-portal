document.addEventListener("DOMContentLoaded", function () {
  const btnDropdown = document.getElementById("btn-dropdown");
  const mnuDropdown = document.getElementById("mnu-dropdown");
  const btnSearch = document.getElementById("search-btn");

  const tblContainer = document.getElementById("tblContainer");
  const tblBody = document.querySelector('#tblContainer table tbody');
  const tblFooter = document.querySelector('#tblContainer table tfoot');
  const tblFooterText = document.querySelector('#tblContainer table tfoot tr td');

  let lastcolumn = document.querySelectorAll('#tblContainer table th:last-child, #tblContainer table td:last-child');

  lastcolumn.forEach(e => e.classList.add('unfreeze'));

  // Dropdown Toggle
  btnDropdown?.addEventListener("click", function () {
    toggleDisplayMenu(mnuDropdown.style.display === "block" ? "none" : "block");
  });

  // Dropdown Item Selection
  document.querySelectorAll("#mnu-dropdown li").forEach(item => {
    item.addEventListener("click", function () {
      document.querySelector("#btn-dropdown > span:first-child").textContent = this.textContent;
      toggleDisplayMenu("none");
    });
  });

  // Close Dropdown When Clicking Outside
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".dropdown")) {
      toggleDisplayMenu("none");
    }
  });

  // Handle Search Button Click
  btnSearch?.addEventListener("click", function () {
    let searchBy = btnDropdown.textContent;
    let searchText = document.getElementById("search-input").value;

    $.ajax({
      type: 'POST',
      url: `/national-e-clinic-portal/includes/admin-fetch-patient.inc.php`,
      data: {
        search_by: searchBy,
        search_text: searchText
      },
      success: function (response) {
        if (response.status === "success") {
          populateTable(response.data);
        } else if (response.status === "error") {
          populateTable([]);
        }

      },
      error: function (xhr, status, error) {
        alert('Error fetching patients: ' + error);
      }
    });
  });


  function toggleDisplayMenu(show) {
    mnuDropdown.style.display = show;
  }

  function populateTable(result) {

    tblBody.innerHTML = ''; // Clear previous table rows

    if (result.length === 0) {
      tblFooter.style.display = 'table-footer-group';
      tblFooterText.textContent = 'Not found patients';
      lastcolumn.forEach(e => e.classList.add('unfreeze'));
      return;
    }

    tblFooter.style.display = 'none';
    lastcolumn.forEach(e => e.classList.remove('unfreeze'));

    result.forEach(data => {
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

      let year, month, day;
      if (birthDate !== '') {
        let age = calculateAge(birthDate);
        console.log(age);
        let ageArray = age.split(' ');
        console.log(ageArray)
        year = ageArray[0];
        month = ageArray[1];
        day = ageArray[2];
        console.log('year- ', year);
        console.log('month- ', month);
        console.log('day- ', day);
      } else {
        year = '';
        month = '';
        day = '';
      }

      let addressParts = [addressLine1]; 
      if (addressLine2) addressParts.push(addressLine2); 
      if (addressLine3) addressParts.push(addressLine3); 

      let fullAddress = addressParts.join(', '); 

      let htmlContent = `<tr id=${patientId}>
                            <td>${firstName} ${lastName}</td>
                            <td>${nic}</td>
                            <td>${email}</td>
                            <td>${phone}</td>
                            <td>${fullAddress}</td>
                            <td>${province}</td>
                            <td>${birthDate}</td>
                            <td>${year}</td>
                            <td>${month}</td>
                            <td>${day}</td>
                            <td><div class=user-info><i class="fa-solid fa-eye"></i></div></td>
                            <td>
                               <div class="edit-user-info"><i class="fa-solid fa-pen-to-square"></i></div>
                            </td>
                          </tr>`;

      // Insert new row into table body
      tblBody.insertAdjacentHTML('beforeend', htmlContent);

      let row = tblBody.lastElementChild;
      let btnUserInfo = row.querySelector('.user-info');
      let btnEdit = row.querySelector('.edit-user-info');

      // Attach event listeners with confirmation
      btnEdit.addEventListener('click', function () {
        console.log('edit');
      });

      btnUserInfo.addEventListener('click', function () {
        console.log('user');
      });

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

  /* ----------------- scroll-bar--------------- */

  tblContainer?.addEventListener("scroll", function () {
    if (tblContainer.scrollLeft === 0) {
      tblContainer.style.borderLeftWidth = '0px';
    } else {
      tblContainer.style.borderLeft = '1px solid var(--color-1)';
    }


    if (tblContainer.scrollLeft + tblContainer.clientWidth >= tblContainer.scrollWidth) {
      tblContainer.style.borderRightWidth = '0px';
    } else {
      tblContainer.style.borderRight = '1px solid var(--color-1)';
    }
  });
});

