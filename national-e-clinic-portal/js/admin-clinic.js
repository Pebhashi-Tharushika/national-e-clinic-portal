document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.querySelector('#new-clinic-category-container #btnSubmit');
    const inputClinicCategory = document.querySelector('#new-clinic-category-container input');
    const errorClinicCategory = document.querySelector('#new-clinic-category-container .error-field');

    const collapseClinics = document.querySelector('#collapse-clinics');

    const dropdownClinicCategories = document.getElementById('drpdwnCategory');

    const btnAddClinic = document.getElementById("btnAddClinic");

    const modalDropdownClinic = document.getElementById('clinic-category');
    const modalDropdownProvince = document.getElementById('province');
    const modalDropdownDistrict = document.getElementById('district');
    const modalDropdownHospital = document.getElementById('hospital');
    const modalClinicPlace = document.getElementById('clinic-place');
    const modalDropdownClinicDay = document.getElementById('clinic-date');
    const modalStartTime = document.getElementById('start-time');
    const modalEndTime = document.getElementById('end-time');

    const modalBtnClear = document.getElementById("btnClear");

    let currentClinicCategories = [];

    let selectedClinic = '';

    const provinces = ["Central", "Eastern", "North Central", "Northern", "North Western", "Sabaragamuwa", "Southern", "Uva", "Western"];

    const tablePatientClinic = [];

    const tabsContainer = document.getElementById("clinicTabs");
    const tabContentContainer = document.getElementById("tabContent");

    getAllClinicCategories(); // Fetch existing categories on page load

    createClinicInfoTable();

    btnSubmit?.addEventListener('click', () => {
        let newClinicCategory = inputClinicCategory.value.trim();

        if (!newClinicCategory) {
            errorClinicCategory.style.display = 'block';
            inputClinicCategory.select();
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-add.inc.php?add=category',
            data: JSON.stringify({ clinic_category: newClinicCategory }),
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
                if (response.status === 'success') {
                    currentClinicCategories.push({ id: response.id, clinic_name: newClinicCategory }); // add new clinic category
                    populateClinics(currentClinicCategories);// Re-render the clinic list
                    populateClinicCategoryDropDown(currentClinicCategories);
                }
                inputClinicCategory.value = ''; // Clear input field   
                alert(response.message);
            },
            error: function (xhr, status, error) {
                alert('Error adding new clinic category: ' + error);
            }
        });
    });

    inputClinicCategory?.addEventListener('input', () => {
        errorClinicCategory.style.display = 'none';
    });

    // Listen for the Bootstrap collapse event when the card is hidden
    collapseClinics?.addEventListener('hidden.bs.collapse', () => {
        inputClinicCategory.value = ''; // Clear the input field
        errorClinicCategory.style.display = 'none';
    });


    function getAllClinicCategories() {
        $.ajax({
            type: 'GET',
            url: '/national-e-clinic-portal/includes/clinic/clinic-search.inc.php',
            contentType: "application/json",
            success: function (response) {
                if (response.status === "success") {
                    currentClinicCategories = response.data; // Assign fetched categories
                    populateClinics(currentClinicCategories);
                    populateClinicCategoryDropDown(currentClinicCategories);
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Error fetching clinics: ' + error);
            }
        });
    }


    function populateClinics(clinics) {
        const clinicCols = [
            document.querySelector('#clinic-categories-content #col1 ul'),
            document.querySelector('#clinic-categories-content #col2 ul'),
            document.querySelector('#clinic-categories-content #col3 ul')
        ];


        clinicCols.forEach(col => {
            if (col) {
                col.innerHTML = '';
            }
        }); // Clear previous content before repopulating

        let count = clinics.length;
        let itemPerColumn = Math.ceil(count / 3);

        clinics.forEach((clinic, index) => {
            const eleLi = document.createElement("li");
            eleLi.value = clinic.id;
            eleLi.innerText = clinic.clinic_name;
            clinicCols[Math.floor(index / itemPerColumn)]?.appendChild(eleLi);
        });
    }

    function populateClinicCategoryDropDown(clinics) {

        if (dropdownClinicCategories) {
            dropdownClinicCategories.innerHTML = '';

            clinics.forEach((clinic, index) => {
                const eleOption = document.createElement("option");
                eleOption.value = clinic.clinic_name;
                eleOption.innerText = clinic.clinic_name;
                dropdownClinicCategories.appendChild(eleOption);

                // Select the first option
                if (index === 0) {
                    eleOption.selected = true;
                }
            });

            selectedClinic = dropdownClinicCategories.options[dropdownClinicCategories.selectedIndex].value;

            if (selectedClinic) {
                populateClinicInfoTable();
            }
        }

        populateModalClinicCategoryDropdown(clinics);
    }

    dropdownClinicCategories?.addEventListener('change', event => {
        selectedClinic = event.target.value;
        populateClinicInfoTable();
    });



    /* --------------------------------------- tab container ------------------------------------ */

    function getAllClinicInfo(province) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-fetch.inc.php?province=${province}&clinic=${selectedClinic}`,
                success: function (response) {
                    if (response.status === "success") {
                        resolve(response.data);
                    } else if (response.status === "error" && response.message !== 'No clinic found.') {
                        reject(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    reject('Error fetching data: ' + error);
                }
            });
        });
    }


    function populateClinicInfoTable() {
        provinces.forEach((province, index) => {
            const provinceId = province.toLowerCase().replace(/\s+/g, '-');

            const tableSelector = `#table-clinic-${provinceId}`;

            if (!$.fn.DataTable.isDataTable(tableSelector)) {
                tablePatientClinic[index] = $(tableSelector).DataTable({
                    lengthMenu: [10, 25, 50, 100],
                    scrollX: true, // Enables horizontal scrolling
                    drawCallback: function () {
                        initializeTooltips();
                    }
                });
            } else {
                tablePatientClinic[index].clear().draw();
            }

            getAllClinicInfo(province)
                .then(clinics => {

                    clinics.forEach(clinic => {
                        tablePatientClinic[index].row.add([
                            `${clinic.hospital_name} ${clinic.institute_type}`,
                            clinic.clinic_place,
                            clinic.clinic_date,
                            clinic.clinic_time,
                            `<div class="form-check form-switch active-inactive">
                    <input class="form-check-input check-input-${provinceId}" type="checkbox" ${clinic.active === 1 ? 'checked' : ''}
                    data-clinic-id="${clinic.id}">
                </div>`,
                            `<div class="edit-clinic" data-clinic-id="${clinic.id}" data-district="${clinic.district_name}">
                    <i class="fas fa-edit edit-icon" data-bs-toggle="tooltip" data-bs-placement="right" 
                    data-bs-title="Edit" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
                </div>`
                        ]);
                    });

                    tablePatientClinic[index].draw(); // Ensure UI updates
                    initializeTooltips();
                    toggleActiveStatus(province);
                    setListenerToEditClinicInfo(province, tablePatientClinic[index]);
                })
                .catch(error => console.error(error));

        });

    }


    function createClinicInfoTable() {
        provinces.forEach((province, index) => {
            const tabId = province.toLowerCase().replace(/\s+/g, '-');

            // Create Tab Buttons
            const tabButton = document.createElement("li");
            tabButton.classList.add("nav-item");
            tabButton.innerHTML = `
                <a class="nav-link ${index === 0 ? 'active' : ''}" data-bs-toggle="tab" href="#${tabId}">
                    ${province}
                </a>
            `;
            tabsContainer?.appendChild(tabButton);

            // Create Tab Content (Table)
            const tabPane = document.createElement("div");
            tabPane.classList.add("tab-pane", "fade");

            if (index === 0) {
                tabPane.classList.add("show", "active");
            }

            tabPane.id = tabId;
            tabPane.innerHTML = `
                <div id="table-clinic-wrapper-${tabId}">
                    <table id="table-clinic-${tabId}" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Hospital</th>
                                <th>Clinic Venue</th>
                                <th>Clinic Date</th>
                                <th>Clinic Time</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="${tabId}-tbody"></tbody>
                    </table>
                </div>
            `;
            tabContentContainer?.appendChild(tabPane);

        });

    }

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        let targetTableId = $(e.target).attr("href"); // Get the active tab's table ID
        let dataTable = $(targetTableId).find("table").DataTable();

        if (dataTable) {
            dataTable.columns.adjust().draw(); // Adjust column sizes when tab is shown
        }
    });

    // Function to initialize tooltips
    function initializeTooltips() {
        $('[data-bs-toggle="tooltip"]').tooltip('dispose'); // Dispose of existing tooltips to prevent duplication
        $('[data-bs-toggle="tooltip"]').tooltip(); // Reinitialize tooltips
    }

    function disableScroll(province) {
        const editClinicButtons = document.querySelectorAll("#tabContent table .edit-clinic");
        const tabId = province.toLowerCase().replace(/\s+/g, '-');
        let tblWrapper = document.querySelector(`#tabContent #table-clinic-wrapper-${tabId}`);

        if (editClinicButtons.length > 0) {
            editClinicButtons.forEach(btn => {
                btn.addEventListener("mouseover", function (event) {
                    if (tblWrapper) {
                        tblWrapper.classList.add("disable-scroll");
                    }
                });

                btn.addEventListener("mouseout", function () {
                    if (tblWrapper) {
                        tblWrapper.classList.remove("disable-scroll");
                    }
                });
            });
        }

    }

    function toggleActiveStatus(province) {
        const provinceId = province.toLowerCase().replace(/\s+/g, '-');
        const checkboxes = document.querySelectorAll(`.check-input-${provinceId}`);

        checkboxes.forEach(checkbox => {

            checkbox.addEventListener("mousedown", function (event) {
                event.preventDefault(); // Prevent the checkbox from toggling automatically

                let isChecked = event.target.checked;
                let message = isChecked ? "Are you sure you want to deactivate?"
                    : "Are you sure you want to activate?";

                let confirmed = confirm(message); // Show confirmation dialog
                if (confirmed) {
                    let activestatus = !checkbox.checked
                    let clinicId = checkbox.dataset.clinicId;

                    $.ajax({
                        type: 'POST',
                        url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-update.inc.php?change=active',
                        data: JSON.stringify({
                            id: clinicId,
                            province: province,
                            status: activestatus
                        }),
                        dataType: "json",
                        contentType: "application/json",
                        success: function (response) {
                            if (response.status === 'success') {
                                checkbox.checked = !isChecked;
                            }

                            alert(response.message);
                        },
                        error: function (xhr, status, error) {
                            alert(`Error ${activestatus ? 'deactivating' : 'activating'} clinic: ${error}`);
                        }
                    });
                }
            });
        });
    }

    /* ------------------------------------ add or edit clinic modal ---------------------------- */

    modalBtnClear?.addEventListener("click", function () {
        document.getElementById("addNewClinicOrEditClinicForm")?.reset();

        modalDropdownDistrict.innerHTML = `<option value="" disabled selected>Select District</option>`;
        modalDropdownHospital.innerHTML = `<option value="" disabled selected>Select Hospital</option>`;

        modalDropdownDistrict.disabled = true;
        modalDropdownHospital.disabled = true;
    });

    btnAddClinic?.addEventListener('click', event => {

        let modal = new bootstrap.Modal(document.getElementById("add-edit-clinic-modal"));
        document.querySelector("#add-edit-clinic-modal .modal-title").textContent = "Add New Clinic";
        document.querySelector("#add-edit-clinic-modal .modal-footer #btnAddOrEdit").textContent = "Save";
        modal.show();

        removeAllErrorMessages(); //remove all error messages

        modalBtnClear.click();

        setListenerToProvinceChange();
        setListenerToDistrictChange();

        $("#btnAddOrEdit").off('click').on('click', function () {
            removeErrorMessageWhenStartTyping(); // Remove error message when user starts typing

            if (!validateForm()) {
                return;
            }

            const clinicData = {
                category: modalDropdownClinic.value,
                province: modalDropdownProvince.value,
                district: modalDropdownDistrict.value,
                hospital: modalDropdownHospital.value,
                place: modalClinicPlace.value.trim(),
                day: modalDropdownClinicDay.value,
                startTime: modalStartTime.value,
                endTime: modalEndTime.value
            };

            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-add.inc.php?add=clinic',
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(clinicData),
                success: function (response) {
                    if (response.status === "success") {
                        modalBtnClear.click(); // Clear fields
                        bootstrap.Modal.getInstance(document.getElementById("add-edit-clinic-modal")).hide(); // Close modal
                        populateClinicInfoTable();
                    }
                    alert(response.message);
                },
                error: function (xhr, status, error) {
                    alert('Error updating patient: ' + error);
                }
            });
        });

    });


    function populateModalClinicCategoryDropdown(clinics) {

        if (modalDropdownClinic) {

            modalDropdownClinic.innerHTML = `<option value="" disabled selected>Select Clinic Category</option>`

            clinics.forEach(clinic => {
                const eleOption = document.createElement("option");
                eleOption.value = clinic.clinic_name;
                eleOption.innerText = clinic.clinic_name;
                modalDropdownClinic.appendChild(eleOption);
            });

        }
    }


    function setListenerToEditClinicInfo(province, tblClinic) {

        const tabId = province.toLowerCase().replace(/\s+/g, '-');

        $(`#${tabId}-tbody`).off('click').on('click', function (event) {

            let target = event.target.closest('.edit-clinic');

            if (!target) return;

            let row = target.closest('tr');
            let rowIndex = tblClinic.row(row).index();

            let time = row.cells[3].textContent;
            let timeArray = time.split('-');

            let activeStatusCell = row.cells[4];
            const checkbox = activeStatusCell.querySelector('input[type="checkbox"]');
            let activeStatus = checkbox.checked;

            let district = target.dataset.district;

            const clinicInfo = {
                category: selectedClinic,
                province: province,
                district: district,
                hospital: row.cells[0].textContent,
                place: row.cells[1].textContent,
                day: row.cells[2].textContent,
                startTime: timeArray[0].trim(),
                endTime: timeArray[1].trim()
            };

            removeAllErrorMessages(); //remove all error messages

            openEditClinicModal(clinicInfo);
            setListenerToProvinceChange();
            setListenerToDistrictChange();

            let clinicId = target.dataset.clinicId;

            $("#btnAddOrEdit").off('click').on('click', function () {

                removeErrorMessageWhenStartTyping(); // Remove error message when user starts typing

                if (!validateForm()) {
                    return;
                }

                let selectedHospitalOption = Array.from(modalDropdownHospital.options).find(option => option.selected === true);
                let selectedHospitalOptionInnerText = selectedHospitalOption?.innerText;

                const updatedData = {
                    clinicId: clinicId,
                    category: modalDropdownClinic.value,
                    province: modalDropdownProvince.value,
                    previousProvince: clinicInfo.province,
                    district: modalDropdownDistrict.value,
                    hospital: modalDropdownHospital.value,
                    place: modalClinicPlace.value.trim(),
                    day: modalDropdownClinicDay.value,
                    startTime: modalStartTime.value,
                    endTime: modalEndTime.value
                };

                let isUpdatedProvince = clinicInfo.province !== updatedData.province;
                let isUpdatedCategory = clinicInfo.category !== updatedData.category;

                $.ajax({
                    type: 'POST',
                    url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-update.inc.php`,
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify(updatedData),
                    success: function (response) {
                        if (response.status === "success") {
                            modalBtnClear.click(); // Clear fields
                            bootstrap.Modal.getInstance(document.getElementById("add-edit-clinic-modal")).hide(); // Close modal
                            if (isUpdatedCategory || isUpdatedProvince) {
                                populateClinicInfoTable();
                            } else {
                                updatedData.hospital = selectedHospitalOptionInnerText;
                                updatePatientClinicTableRow(rowIndex, updatedData, tabId, tblClinic, response.data, activeStatus); // Update DataTables row
                            }
                        }
                        alert(response.message);
                    },
                    error: function (xhr, status, error) {
                        alert('Error updating patient: ' + error);
                    }
                });
            });

        });
    }

    function removeErrorMessageWhenStartTyping() {
        $("input, select").on("input change", function () {
            $(this).removeClass("is-invalid");
            $(this).next(".invalid-feedback").remove();
        });
    }

    function updatePatientClinicTableRow(rowIndex, updatedData, provinceId, tblClinic, timeSlot, activeStatus) {

        tblClinic.row(rowIndex).data([
            updatedData.hospital,
            updatedData.place,
            updatedData.day,
            timeSlot,
            `<div class="form-check form-switch active-inactive">
                    <input class="form-check-input check-input-${provinceId}" type="checkbox" ${activeStatus ? 'checked' : ''}
                    data-clinic-id="${updatedData.clinicId}">
                </div>`,
            `<div class="edit-clinic" data-clinic-id="${updatedData.clinicId}" data-district="${updatedData.district}">
                    <i class="fas fa-edit edit-icon" data-bs-toggle="tooltip" data-bs-placement="right" 
                    data-bs-title="Edit" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
                </div>`
        ]).draw(false);
    }


    function validateRequiredField(field) {

        let value = field.value.trim();

        if (!value || value === "") {
            if (!field.nextElementSibling || !field.nextElementSibling.classList.contains("invalid-feedback")) {
                let errorDiv = document.createElement("div");
                errorDiv.className = "invalid-feedback";
                errorDiv.style.color = "red";
                errorDiv.textContent = 'required*';
                field.insertAdjacentElement("afterend", errorDiv);
            }
            field.classList.add("is-invalid");
            return false;
        }

        field.classList.remove("is-invalid");
        if (field.nextElementSibling && field.nextElementSibling.classList.contains("invalid-feedback")) {
            field.nextElementSibling.remove();
        }
        return true;
    }

    function validateDate() {
        if (modalStartTime && modalEndTime) {
            let startTime = modalStartTime.value;
            let endTime = modalEndTime.value;

            let startDate = new Date(`1970-01-01T${startTime}:00`);
            let endDate = new Date(`1970-01-01T${endTime}:00`);

            if (endDate <= startDate) {
                if (!endDate.nextElementSibling || !endDate.nextElementSibling.classList.contains("invalid-feedback")) {
                    let errorDiv = document.createElement("div");
                    errorDiv.className = "invalid-feedback";
                    errorDiv.textContent = "Invalid Date";
                    modalEndTime.insertAdjacentElement("afterend", errorDiv);
                }
                modalEndTime.classList.add("is-invalid");
                return false;
            } else {
                modalEndTime.classList.remove("is-invalid");
                if (modalEndTime.nextElementSibling && modalEndTime.nextElementSibling.classList.contains("invalid-feedback")) {
                    modalEndTime.nextElementSibling.remove();
                }
                return true;
            }

        }
    }

    function validateForm() {
        let isValid = true;

        isValid &= validateRequiredField(modalDropdownClinic);
        isValid &= validateRequiredField(modalDropdownProvince);
        isValid &= validateRequiredField(modalDropdownDistrict);
        isValid &= validateRequiredField(modalDropdownHospital);
        isValid &= validateRequiredField(modalClinicPlace);
        isValid &= validateRequiredField(modalDropdownClinicDay);
        isValid &= validateRequiredField(modalStartTime);
        isValid &= validateRequiredField(modalEndTime);

        isValid = Boolean(isValid);

        if (isValid) {
            isValid = validateDate();
        }

        return isValid;
    }


    function openEditClinicModal(clinic) {

        getDistrictsAndHospitals(clinic.province, clinic.district)
            .then(response => {
                let data = response.data;
                let status = response.status;

                let districts = data[0];
                let hospitals = data[1];

                modalDropdownDistrict.disabled = false;
                modalDropdownHospital.disabled = false;

                modalDropdownDistrict.innerHTML = `<option value="" disabled selected>Select District</option>`;
                modalDropdownHospital.innerHTML = `<option value="" disabled selected>Select Hospital</option>`;

                if (status === 'success' || status === 'd-success') {
                    districts.data.forEach(d => {
                        const eleOption = document.createElement("option");
                        eleOption.value = d.district_name;
                        eleOption.innerText = d.district_name;
                        if (eleOption.value === clinic.district) {
                            eleOption.selected = true;  // Set selected option for district dropdown
                        }
                        modalDropdownDistrict.appendChild(eleOption);
                    });
                }

                if (status === 'success' || response.status === 'h-success') {
                    hospitals.data.forEach(h => {
                        const eleOption = document.createElement("option");
                        eleOption.value = h.hospital_name;
                        eleOption.innerText = `${h.hospital_name} ${h.institute_type}`;
                        if (eleOption.innerText === clinic.hospital) {
                            eleOption.selected = true; // Set selected option for hospital dropdown
                        }
                        modalDropdownHospital.appendChild(eleOption);
                    });
                }

                modalDropdownClinic.value = clinic.category;
                modalDropdownProvince.value = clinic.province;
                modalClinicPlace.value = clinic.place;
                modalDropdownClinicDay.value = clinic.day;
                modalStartTime.value = convertTo24Hour(clinic.startTime);
                modalEndTime.value = convertTo24Hour(clinic.endTime);

                let modal = new bootstrap.Modal(document.getElementById("add-edit-clinic-modal"));
                document.querySelector("#add-edit-clinic-modal .modal-title").textContent = "Update Clinic Details";
                document.querySelector("#add-edit-clinic-modal .modal-footer #btnAddOrEdit").textContent = "Save Changes";
                modal.show();

            })
            .catch(error => console.error(error));


    }


    function getDistrictsAndHospitals(province, district) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-fetch.inc.php?province=${province}&district=${district}`,
                success: function (response) {
                    if (response.status.includes("success")) {
                        resolve(response);
                    } else if (response.status === "error") {
                        reject(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    reject('Error fetching data: ' + error);
                }
            });
        });
    }

    function convertTo24Hour(timeStr) {

        timeStr = timeStr.replace('.', ':');

        let match = timeStr.match(/(\d{1,2}):(\d{1,2})\s?(AM|PM)/i); // i flag makes the matching case-insensitive.
        if (!match) return "";

        let hours = parseInt(match[1]);
        let minutes = parseInt(match[2]);
        let meridian = match[3].toUpperCase();

        if (meridian === "PM" && hours !== 12) {
            hours += 12;
        } else if (meridian === "AM" && hours === 12) {
            hours = 0;
        }

        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    }

    function setListenerToProvinceChange() {

        $(modalDropdownProvince).off('change').on('change', event => {
            let selectedProvince = event.target.value;
            modalDropdownDistrict.disabled = false;
            modalDropdownHospital.disabled = true;
            modalDropdownDistrict.innerHTML = `<option value="" disabled selected>Select District</option>`;
            modalDropdownHospital.innerHTML = `<option value="" disabled selected>Select Hospital</option>`;

            $.ajax({
                type: 'GET',
                url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-fetch.inc.php?p=${selectedProvince}`,
                contentType: "application/json",
                success: function (response) {
                    if (response.status === "success") {

                        response.data.forEach(d => {
                            const eleOption = document.createElement("option");
                            eleOption.value = d.district_name;
                            eleOption.innerText = d.district_name;
                            modalDropdownDistrict.appendChild(eleOption);
                        });

                    }
                    else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error updating patient: ' + error);
                }
            });
        });
    }

    function setListenerToDistrictChange() {

        $(modalDropdownDistrict).off('change').on('change', event => {
            let selectedDistrict = event.target.value;
            let selectedProvince = modalDropdownProvince.value;

            modalDropdownHospital.disabled = false;
            modalDropdownHospital.innerHTML = `<option value="" disabled selected>Select Hospital</option>`;

            $.ajax({
                type: 'GET',
                url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-fetch.inc.php?p=${selectedProvince}&d=${selectedDistrict}`,
                contentType: "application/json",
                success: function (response) {
                    if (response.status === "success") {

                        response.data.forEach(h => {
                            const eleOption = document.createElement("option");
                            eleOption.value = h.hospital_name;
                            eleOption.innerText = `${h.hospital_name} ${h.institute_type}`;
                            modalDropdownHospital.appendChild(eleOption);
                        });

                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error updating patient: ' + error);
                }
            });
        });

    }

    function removeAllErrorMessages() {
        $("#addNewClinicOrEditClinicForm input, #addNewClinicOrEditClinicForm select").removeClass("is-invalid");
        $("#addNewClinicOrEditClinicForm input, #addNewClinicOrEditClinicForm select").next(".invalid-feedback").remove();
    }

});



