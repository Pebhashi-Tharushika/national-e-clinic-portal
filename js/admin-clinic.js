document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.querySelector('#new-clinic-category-container #btnSubmit');
    const inputClinicCategory = document.querySelector('#new-clinic-category-container input');
    const errorClinicCategory = document.querySelector('#new-clinic-category-container .error-field');

    const collapseClinics = document.querySelector('#collapse-clinics');

    const dropdownClinicCategories = document.getElementById('drpdwnCategory');

    let currentClinicCategories = []; // Fixed variable name typo

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
                            `<div class="edit-clinic" data-bs-toggle="modal" data-bs-target="#edit-clinic-modal">
                    <i class="fas fa-edit edit-icon" data-bs-toggle="tooltip" data-bs-placement="right" 
                    data-bs-title="Edit" data-bs-custom-class="custom-tooltip" data-bs-offset="0,15"></i>
                </div>`
                        ]);
                    });

                    tablePatientClinic[index].draw(); // Ensure UI updates
                    initializeTooltips();
                    disableScroll(province);
                    toggleActiveStatus(province);
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
                        url: '/national-e-clinic-portal/includes/admin-clinic/admin-clinic-inactive.inc.php',
                        data: JSON.stringify({ 
                            id:clinicId,
                            province:province,
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

    



});



