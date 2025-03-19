document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.querySelector('#new-clinic-category-container #btnSubmit');
    const inputClinicCategory = document.querySelector('#new-clinic-category-container input');
    const errorClinicCategory = document.querySelector('#new-clinic-category-container .error-field');

    const collapseClinics = document.querySelector('#collapse-clinics');

    const dropdownClinicCategories = document.getElementById('drpdwnCategory');

    const modalDropdownClinic = document.getElementById('clinic-category');
    const modalDropdownProvince = document.getElementById('province');
    const modalDropdownDistrict = document.getElementById('district');
    const modalDropdownHospital = document.getElementById('hospital');
    const modalClinicPlace = document.getElementById('clinic-place');
    const modalDropdownClinicDay = document.getElementById('clinic-date');
    const modalStartTime = document.getElementById('start-time');
    const modalEndTime = document.getElementById('end-time');

    const modalBtnAddOrEdit = document.getElementById("btnAddOrEdit");
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
            url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-add.inc.php',
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


            if (!$.fn.DataTable.isDataTable(`#table-clinic-${provinceId}`)) {
                let tbl = $(`#table-clinic-${provinceId}`).DataTable({
                    lengthMenu: [10, 25, 50, 100],
                    drawCallback: function () {
                        initializeTooltips();
                    }
                });
                tablePatientClinic.push(tbl);
            }

            tablePatientClinic[index].clear().draw();


            getAllClinicInfo(province)
                .then(clinics => {

                    clinics.forEach(clinic => {
                        tablePatientClinic[index].row.add([
                            clinic.hospital_name,
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
                    disableScroll(province);
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
                <div class="table-responsive" id="table-clinic-wrapper-${tabId}">
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

    // Function to initialize tooltips
    function initializeTooltips() {
        // Dispose of existing tooltips to prevent duplication
        $('[data-bs-toggle="tooltip"]').tooltip('dispose');

        // Reinitialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
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
                        url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-update.inc.php',
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

    // const btnAddOrEdit = document.getElementById("btnAddOrEdit");
    // const btnAddNewClinic = document.getElementById("btnAddClinic");
    // const modalAddOrEditClinic = document.getElementById("add-edit-clinic-modal");

    // let isNewClinic = false;
    // btnAddNewClinic?.addEventListener('click', () => isNewClinic = true);
    // modalAddOrEditClinic?.addEventListener('hidden.bs.modal', () => isNewClinic = false);

    // function validateForm() {
    //     let isValid = true;

    //     // Array of required fields
    //     let requiredFields = [
    //         modalDropdownClinic,
    //         modalDropdownProvince,
    //         modalDropdownDistrict,
    //         modalDropdownHospital,
    //         modalDropdownClinicPlace,
    //         modalDropdownClinicDay,
    //         modalDropdownStartTime,
    //         modalDropdownEndTime
    //     ];

    //     // Loop through each field and validate
    //     requiredFields.forEach(field => {
    //         console.log(field.value.trim());
    //         if (!field.value.trim()) {
    //             isValid = false;
    //             field.classList.add('error'); 
    //         } else {
    //             field.classList.remove('error'); 
    //         }
    //     });

    //     return isValid;
    // }


    // btnAddOrEdit?.addEventListener('click', event => {
    //     let selectedClinicCategory = modalDropdownClinic.options[modalDropdownClinic.selectedIndex].value;
    //     let selectedProvince = modalDropdownProvince.options[modalDropdownProvince.selectedIndex].value;
    //     let selectedDistrict = modalDropdownDistrict.options[modalDropdownDistrict.selectedIndex].value;
    //     let selectedHospital = modalDropdownHospital.options[modalDropdownHospital.selectedIndex].value;
    //     let clinicPlace = modalDropdownClinicPlace.value;
    //     let selectedDay = modalDropdownClinicDay.options[modalDropdownClinicDay.selectedIndex].value;
    //     let startTime = modalDropdownStartTime.value;
    //     let endTime = modalDropdownEndTime.value;


    //     if (isNewClinic) {

    //         let isValid = validateForm();

    //         if (isValid) {
    //             collectedData = {
    //                 clinicCategory: selectedClinicCategory,
    //                 province: selectedProvince,
    //                 district: selectedDistrict,
    //                 hospital: selectedHospital,
    //                 place: clinicPlace,
    //                 day: selectedDay,
    //                 time: startTime + "-" + endTime
    //             }
    //             console.log(collectedData);
    //         }

    //     }

    //     // let isValid = validateForm();

    //     // if(isValid){
    //     //     let selectedClinicCategory = modalDropdownClinic.options[modalDropdownClinic.selectedIndex].value;
    //     //     let selectedProvince = modalDropdownProvince.options[modalDropdownProvince.selectedIndex].value;
    //     //     let selectedDistrict = modalDropdownDistrict.options[modalDropdownDistrict.selectedIndex].value;
    //     //     let selectedHospital = modalDropdownHospital.options[modalDropdownHospital.selectedIndex].value;
    //     //     let clinicPlace = modalDropdownClinicPlace.value;
    //     //     let selectedDay = modalDropdownClinicDay.options[modalDropdownClinicDay.selectedIndex].value;
    //     //     let startTime = modalDropdownStartTime.value;
    //     //     let endTime = modalDropdownEndTime.value;
    //     //     collectedData = {
    //     //         clinicCategory: selectedClinicCategory,
    //     //         province: selectedProvince,
    //     //         district: selectedDistrict,
    //     //         hospital: selectedHospital,
    //     //         place: clinicPlace,
    //     //         day: selectedDay,
    //     //         time: startTime+ " " + endTime
    //     //     }
    //     //     console.log(collectedData);
    //     // }

    // });

    // function validateForm() {
    //     return true;
    // }

    function setListenerToEditClinicInfo(province, tblClinic) {
        console.log('setListenerToEditClinicInfo');

        const tabId = province.toLowerCase().replace(/\s+/g, '-');

        document.querySelector(`#${tabId}-tbody`).addEventListener('click', function (event) {
            let target = event.target.closest('.edit-clinic');

            if (!target) return;

            let row = target.closest('tr');
            let rowIndex = tblClinic.row(row).index();
            console.log('rowIndex: ', rowIndex);

            let time = row.cells[3].textContent;
            let timeArray = time.split('-');

            let activeStatusCell = row.cells[4];
            const checkbox = activeStatusCell.querySelector('input[type="checkbox"]');
            let activeStatus = checkbox.checked;
            console.log("activeStatus: ", activeStatus);

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
            console.log(clinicInfo);

            //remove all error messages
            $("#addNewClinicOrEditClinicForm input, #addNewClinicOrEditClinicForm select").removeClass("is-invalid");
            $("#addNewClinicOrEditClinicForm input, #addNewClinicOrEditClinicForm select").next(".invalid-feedback").remove();

            openEditClinicModal(clinicInfo);

            let clinicId = target.dataset.clinicId;
            console.log(clinicId);

            $("#btnAddOrEdit").off('click').on('click', function () {
                // Remove error message when user starts typing
                $("input, select").on("input change", function () {
                    $(this).removeClass("is-invalid");
                    $(this).next(".invalid-feedback").remove();
                });

                if (!validateForm()) {
                    return;
                }

                const updatedData = {
                    clinicId: clinicId,
                    category: modalDropdownClinic.value,
                    province: modalDropdownProvince.value,
                    district: modalDropdownDistrict.value,
                    hospital: modalDropdownHospital.value,
                    place: modalClinicPlace.value.trim(),
                    day: modalDropdownClinicDay.value,
                    startTime: modalStartTime.value,
                    endTime: modalEndTime.value
                };

                console.log('updatedData: ', updatedData);

                let isUpdatedProvince = (clinicInfo.province !== updatedData.province);

                $.ajax({
                    type: 'POST',
                    url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-update.inc.php?change=${isUpdatedProvince}`,
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify(updatedData),
                    success: function (response) {
                        console.log(response);
                        if (response.status === "success") {
                            modalBtnClear.click(); // Clear fields
                            bootstrap.Modal.getInstance(document.getElementById("add-edit-clinic-modal")).hide(); // Close modal
                            updatePatientClinicTableRow(rowIndex, updatedData, tabId, tblClinic, response.data, activeStatus); // Update DataTables row
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Error updating patient: ' + error);
                    }
                });
            });

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
                        modalDropdownDistrict.appendChild(eleOption);
                    });
                }
                if (status === 'success' || response.status === 'h-success') {
                    hospitals.data.forEach(h => {
                        const eleOption = document.createElement("option");
                        eleOption.value = h.hospital_name;
                        eleOption.innerText = `${h.hospital_name} ${h.institute_type}`;
                        modalDropdownHospital.appendChild(eleOption);
                    });
                }

                // Set selected option for district dropdown
                let districtOption = Array.from(modalDropdownDistrict.options).find(option => option.value.trim() === clinic.district.trim());
                if (districtOption) {
                    districtOption.selected = true;
                }

                // Set selected option for hospital dropdown
                let hospitalOption = Array.from(modalDropdownHospital.options).find(option => option.value === clinic.hospital);
                if (hospitalOption) {
                    hospitalOption.selected = true;
                }

                modalDropdownClinic.value = clinic.category;
                modalDropdownProvince.value = clinic.province;
                modalClinicPlace.value = clinic.place;
                modalDropdownClinicDay.value = clinic.day;
                modalStartTime.value = convertTo24Hour(clinic.startTime);
                modalEndTime.value = convertTo24Hour(clinic.endTime);

                let modal = new bootstrap.Modal(document.getElementById("add-edit-clinic-modal"));
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


});



