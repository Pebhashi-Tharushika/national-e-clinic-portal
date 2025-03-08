document.addEventListener('DOMContentLoaded', () => {

    const provinces = document.querySelectorAll('.province');
    const searchContent = document.getElementById('patient-appointment-content2');
    const checkboxes = document.querySelectorAll('#filter-options input[type="checkbox"]');
    const selectSection = document.getElementById('filter-select');
    const allSearchFieldCols = document.querySelectorAll('#filter-select .col');
    const allSearchFields = document.querySelectorAll('#filter-select select, #filter-select input');

    const btnReset = document.getElementById('b-reset');
    const btnSearch = document.getElementById('b-search');

    const tblBody = document.querySelector('#table-container table tbody');
    const tblFooter = document.querySelector('#table-container table tfoot');
    const tblContainer = document.getElementById("table-container");

    let selectedFilters = {};

    let provinceName = '';

    let invalidFields = [];

    let selectedHospital = '';
    let selectedClinic = '';
    let patientNic = '';
    let userEmail = '';
    let appointmentDate = '';
    let reservedDate = '';
    let selectedStatus = '';

    provinces.forEach(element => {
        element.addEventListener('click', event => {

            //remove previous clicked province and show current clicked province
            provinces.forEach(p => p.classList.remove('active'));
            element.classList.add('active');

            resetFilters();

            searchContent.style.display = 'flex'; // show search content (province title,cb-filters, input,select, search and reset button)
            provinceName = event.target.textContent.trim() // Get text of the clicked div
            document.querySelector('#patient-appointment-content2 > h4').innerText = provinceName + " Appointments"; // change title w.r.t clicked province

            getFilterSelectData(); // get hospital and clinic data w.r.t province

            // auto scroll to bottom 
            if (window.scrollY < window.innerHeight * 0.5) {
                window.scrollBy({ top: window.innerHeight * 0.5 - window.scrollY, behavior: 'smooth' });
            }

        });
    });


    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {

            selectSection.style.display = 'block'; // show section includes select and input

            let select = document.querySelector(`#filter-select .col[data-filter="${checkbox.value.replace('cb-', '')}"]`);
            if (select) {
                select.style.display = checkbox.checked ? 'block' : 'none'; // Show select/input for only selected checkboxes

                if (checkbox.checked) {
                    selectedFilters[checkbox.value] = select.value; //if checked, add filter and value to array
                } else {
                    let keyToRemove = checkbox.value;
                    delete selectedFilters[keyToRemove]; // if unchecked, remove filter and value from array
                    resetField(document.getElementById(checkbox.value.replace('cb-', ''))); // reset check box's field value
                    //reset error msg
                    document.getElementById(checkbox.value.replace('cb-', '').concat('-error')).style.display = 'none'; // hide error msg of unchecked one
                    invalidFields = invalidFields.filter(str => str !== checkbox.value); //remove unchecked one from error list
                }
            }

            disableButton(Object.keys(selectedFilters).length === 0); // if no any checked cb, disable search and reset button

            tblContainer.style.display = 'none'; // hide table

        });
    });

    document.getElementById('hospital')?.addEventListener('change', event => {
        selectedHospital = event.target.value;
    });

    document.getElementById('clinic')?.addEventListener('change', event => {
        selectedClinic = event.target.value;
    });

    document.getElementById('status')?.addEventListener('change', event => {
        selectedStatus = event.target.value;
    });

    btnSearch?.addEventListener('click', () => {
        patientNic = document.getElementById('patient').value.trim();
        userEmail = document.getElementById('user').value.trim();

        appointmentDate = document.getElementById('appointment-date').value.trim();
        reservedDate = document.getElementById('reserved-date').value.trim();

        const keyMappings = {
            'cb-hospital': selectedHospital,
            'cb-clinic': selectedClinic,
            'cb-patient': patientNic,
            'cb-user': userEmail,
            'cb-appointment-date': appointmentDate,
            'cb-reserved-date': reservedDate,
            'cb-status': selectedStatus
        };

        Object.keys(selectedFilters).forEach(key => {
            selectedFilters[key] = capitalizeFirstLetter(keyMappings[key] || '');
        });

        resetAllErrors();

        // validate filer-object
        if (validateObject(selectedFilters)) {
            getAppointments();
        } else {
            showErrors();
        }

    });

    btnReset?.addEventListener('click', () => resetFilters());




    function validateObject(obj) {
        Object.keys(obj).forEach(key => {
            if (obj[key] === undefined || obj[key] === null || obj[key] === '') {
                invalidFields.push(key);
            }
        });
        return invalidFields.length === 0;
    }

    function showErrors() {
        invalidFields.forEach(key => {
            fieldId = key.replace('cb-', '').concat('-error');
            document.getElementById(fieldId).style.display = 'block';
        });
    }

    function resetFilters() {
        // unchecked all filters
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        Object.keys(selectedFilters).forEach(key => delete selectedFilters[key]); //remove all filters in array

        //reset all fields (select, input)
        allSearchFields.forEach(field => {
            resetField(field);
        });

        resetAllErrors();

        allSearchFieldCols.forEach(selector => selector.style.display = 'none'); // Hide all fields (select, input)

        disableButton(true);

        tblContainer.style.display = 'none'; //hide table

    }

    //reset all error msg
    function resetAllErrors() {
        invalidFields = []; // remove all error-fields in array
        document.querySelectorAll('.error-message').forEach(msg => msg.style.display = 'none'); // hide all error msg
    }

    function disableButton(isDisable) {
        const btns = document.querySelectorAll('#button-wrapper>button').forEach(btn => btn.disabled = isDisable);
    }

    function getFilterSelectData() {
        provinceName = provinceName.replace('Province', '').trim();
        $.ajax({
            type: 'GET',
            url: `/national-e-clinic-portal/includes/admin-appointment/admin-appointment-fetch.inc.php?province=${provinceName}`,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    populateDropdown('hospital', getUniqueValues(response.data, 'hospital_name'), 'Select Hospital');
                    populateDropdown('clinic', getUniqueValues(response.data, 'clinic_name'), 'Select Clinic');
                    populateDropdown('status', ['APPROVED', 'PENDING', 'REJECTED'], 'Select Status');
                } else if (response.status === "error") {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Error fetching select options: ' + error);
            }
        });
    }

    function getAppointments() {
        provinceName = provinceName.replace('Province', '').trim();
        $.ajax({
            type: 'POST',
            url: `/national-e-clinic-portal/includes/admin-appointment/admin-appointment-fetch.inc.php?province=${provinceName}`,
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(selectedFilters),
            success: function (response) {
                if (response.status === "success") {
                    populateTable(response.data);
                } else if (response.status === "error") {
                    populateTable([]);
                }
            },
            error: function (xhr, status, error) {
                alert('Error fetching appointments: ' + error);
            }
        });


    }

    function populateTable(result) {
        let lastcolumn = document.querySelectorAll('#table-container table th:last-child, #table-container table td:last-child');

        tblContainer.style.display = 'block';

        tblBody.innerHTML = ''; // Clear previous table rows

        if (result.length === 0) {
            tblFooter.style.display = 'table-footer-group';
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
            let hospitalName = data.hospital_name || '';
            let instituteType = data.institute_type || '';
            let clinicName = data.clinic_name || '';
            let appointmentDate = data.appointment_date || '';
            let timePeriod = data.time_period || '';
            let userName = data.user_name || '';
            let userEmail = data.user_email || '';
            let createdAt = data.created_at || '';
            let status = data.status || '';
            let appointmentId = data.id || '';

            let htmlContent = `<tr id=${appointmentId}>
                                <td>${firstName} ${lastName}</td>
                                <td>${nic}</td>
                                <td>${hospitalName} ${instituteType}</td>
                                <td>${clinicName}</td>
                                <td>${appointmentDate}</td>
                                <td>${timePeriod}</td>
                                <td>${userName}</td>
                                <td>${userEmail}</td>
                                <td>${createdAt}</td>
                                <td>${status}</td>
                                <td>
                                    <div>
                                        <div class="btnApprove">
                                            <i class="fa-solid fa-octagon-check"></i> Approve
                                        </div>
                                        <div class="btnReject">
                                            <i class="fa-solid fa-octagon-xmark"></i> Reject
                                        </div>
                                    </div>
                                </td>
                              </tr>`;

            // Insert new row into table body
            tblBody.insertAdjacentHTML('beforeend', htmlContent);

            // Select buttons in the newly inserted row
            let row = tblBody.lastElementChild;
            let btnApprove = row.querySelector('.btnApprove');
            let btnReject = row.querySelector('.btnReject');

            if (status === 'APPROVED') {
                btnApprove.classList.add('disabled');
                btnReject.classList.add('disabled');
            }

            // Attach event listeners with confirmation
            btnApprove.addEventListener('click', function () {
                if (confirmApproveOrReject('approve')) {
                    processApproval('approve', row.id,btnApprove,btnReject);
                }
            });

            btnReject.addEventListener('click', function () {
                if (confirmApproveOrReject('reject')) {
                    processApproval('reject', row.id,btnApprove,btnReject);
                }
            });

        });

    }

    // Alert to confirm approve or reject
    function confirmApproveOrReject(action) {
        return confirm(`Are you sure you want to ${action} the appointment?`);
    }

    function processApproval(action, appointmentId,btnApprove,btnReject) {
        provinceName = provinceName.replace('Province', '').trim();

        let appointmentStatus = action === 'approve' ? "APPROVED" : action === 'reject' ? "REJECTED" : null;
        if (!appointmentStatus) {
            alert("Invalid action specified.");
            return;
        }

        $.ajax({
            type: 'PUT',
            url: "/national-e-clinic-portal/includes/admin-appointment/admin-appointment-approve.inc.php",
            data: JSON.stringify({
                province: provinceName, 
                status: appointmentStatus,
                id: appointmentId
            }),
            contentType: "application/json", 
            success: function (response) {
                alert(response.message);
                btnApprove.classList.add('disabled');
                btnReject.classList.add('disabled');
            },
            error: function (xhr, status, error) {
                alert('Error in appointment approval process:', error);
            }
        });
        
    }

    // Function to get unique values from an array of objects
    function getUniqueValues(data, key) {
        return [...new Set(data.map(item => item[key]).filter(value => value !== null))];
    }

    // Function to populate dropdowns
    function populateDropdown(dropdownId, values, defaultText) {

        const dropdown = $("#" + dropdownId);
        dropdown.empty().append(`<option value="" hidden>${defaultText}</option>`); // Clear & add default option

        values.forEach(value => {
            dropdown.append($('<option></option>')
                .attr("value", value.toLowerCase())
                .text(value));
        });

    }

    function resetField(field) {

        if (field instanceof HTMLSelectElement) { // Check for <select> elements

            let fieldId = field.id;
            const defaultText = "Select " + capitalizeFirstLetter(fieldId);

            // Find the option with the default placeholder text and make it selected
            const defaultOption = Array.from(field.options).find(option => option.text === defaultText);

            if (defaultOption) {
                defaultOption.selected = true;
            }

            // clear selected value storage
            if (fieldId === 'hospital') {
                selectedHospital = '';
            } else if (fieldId === 'clinic') {
                selectedClinic = '';
            } else if (fieldId === 'status') {
                selectedStatus = '';
            }

        } else if (field instanceof HTMLInputElement) { // Check for <input> elements
            field.value = ''; // Clear the input field value
        }

    }

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

    /* --------------------- table scroll bar ---------------- */

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