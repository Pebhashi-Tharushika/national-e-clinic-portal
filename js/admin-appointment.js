document.addEventListener('DOMContentLoaded', () => {

    const provinces = document.querySelectorAll('.province');
    const searchContent = document.getElementById('patient-appointment-content2');
    const checkboxes = document.querySelectorAll('#filter-options input[type="checkbox"]');
    const selectSection = document.getElementById('filter-select');
    const allSearchFieldCols = document.querySelectorAll('#filter-select .col');
    const allSearchFields = document.querySelectorAll('#filter-select select, #filter-select input');

    const btnReset = document.getElementById('b-reset');
    const btnSearch = document.getElementById('b-search');

    let selectedFilters = {};

    let provinceName='';

    let invalidFields = [];

    let selectedHospital = '';
    let selectedClinic = '';
    let patientNic = '';
    let userEmail = '';
    let appointmentDate = '';
    let reservecDate = '';
    let selectedStatus = '';

    provinces.forEach(element => {
        element.addEventListener('click', event => {
            if (window.scrollY < window.innerHeight * 0.5) {
                window.scrollBy({ top: window.innerHeight * 0.5 - window.scrollY, behavior: 'smooth' });
            }

            provinceName = event.target.textContent.trim() // Get text of the clicked div

            provinces.forEach(p => p.classList.remove('active'));
            element.classList.add('active');

            document.querySelector('#patient-appointment-content2 > h4').innerText = provinceName + " Appointments";

            resetFilters();

            searchContent.style.display = 'flex';

            getFilterSelectData();

        });
    });


    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {

            selectSection.style.display = 'block'; // show selectors section

            // Show selectors for only selected checkboxes
            let select = document.querySelector(`#filter-select .col[data-filter="${checkbox.value.replace('cb-', '')}"]`);
            if (select) {
                select.style.display = checkbox.checked ? 'block' : 'none';
                if (checkbox.checked) {
                    selectedFilters[checkbox.value] = select.value;
                } else {
                    let keyToRemove = checkbox.value;
                    delete selectedFilters[keyToRemove];
                    resetField(document.getElementById(checkbox.value.replace('cb-', '')));
                }
            }


            console.log("Selected Options:", selectedFilters);

            disableButton(Object.keys(selectedFilters).length === 0);
        });
    });

    document.getElementById('hospital').addEventListener('change', event => {
        selectedHospital = event.target.value;
    });

    document.getElementById('clinic').addEventListener('change', event => {
        selectedClinic = event.target.value;
    });

    document.getElementById('status').addEventListener('change', event => {
        selectedStatus = event.target.value;
    });

    btnSearch.addEventListener('click', () => {
        patientNic = document.getElementById('patient').value.trim();
        userEmail = document.getElementById('user').value.trim();

        appointmentDate = document.getElementById('appointment-date').value.trim();
        reservecDate = document.getElementById('reserved-date').value.trim();

        console.log(selectedHospital);
        console.log(selectedClinic);
        console.log(selectedStatus);
        console.log(patientNic);
        console.log(userEmail);
        console.log(appointmentDate);
        console.log(reservecDate);

        const keyMappings = {
            'cb-hospital': selectedHospital,
            'cb-clinic': selectedClinic,
            'cb-patient': patientNic,
            'cb-user': userEmail,
            'cb-appointment-date': appointmentDate,
            'cb-reserved-date': reservecDate,
            'cb-status': selectedStatus
        };
        
        Object.keys(selectedFilters).forEach(key => {
            selectedFilters[key] = capitalizeFirstLetter(keyMappings[key] || '');
        });

        console.log('object: ', selectedFilters);

        if(validateObject(selectedFilters)){
            getAppointments();
        }else{
            showErrors(); //Todo
        }
        
    });

    function validateObject(obj) {
        let isValid = true;
    
        Object.keys(obj).forEach(key => {
            if (obj[key] === undefined || obj[key] === null || obj[key] === '') { 
                invalidFields.push(key);
                isValid = false;
            }
        });
    
        console.log('invalidFields:',invalidFields);
        return isValid;
    }

    function showErrors(){
        console.log(invalidFields);
    }
    

    btnReset.addEventListener('click', () => resetFilters());

    function resetFilters() {
        // unchecked all filters
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        Object.keys(selectedFilters).forEach(key => delete selectedFilters[key]); //remove all filters

        //reset all fields
        allSearchFields.forEach(field => {
            resetField(field);

        });
        //TODO : reset selection also
        allSearchFieldCols.forEach(selector => selector.style.display = 'none'); // Hide all selectors 

        disableButton(true);

    }

    function disableButton(isDisable) {
        const btns = document.querySelectorAll('#button-wrapper>button').forEach(btn => btn.disabled = isDisable);
    }

    function getFilterSelectData() {
        provinceName = provinceName.replace('Province', '').trim();
        $.ajax({
            type: 'GET',
            url: `/national-e-clinic-portal/includes/admin-fetch-appointment.inc.php?province=${provinceName}`,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    console.log(response.data);
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
            type: 'POST', // Change to POST
            url: `/national-e-clinic-portal/includes/admin-fetch-appointment.inc.php?province=${provinceName}`,
            dataType: "json",
            contentType: "application/json", // Specify JSON format
            data: JSON.stringify(selectedFilters),
            success: function (response) {
                if (response.status === "success") {
                    console.log(response.data);
                } else if (response.status === "error") {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Error fetching appointments: ' + error);
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
            const defaultText = "Select " + capitalizeFirstLetter(field.id);
            console.log(defaultText);
            // Find the option with the default placeholder text and make it selected
            const defaultOption = Array.from(field.options).find(option => option.text === defaultText);

            if (defaultOption) {
                defaultOption.selected = true;
            }
        } else if (field instanceof HTMLInputElement) { // Check for <input> elements
            field.value = ''; // Clear the input field value
        }

    }

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

});