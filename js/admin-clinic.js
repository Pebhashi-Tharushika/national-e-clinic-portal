document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.querySelector('#new-clinic-category-container #btnSubmit');
    const inputClinicCategory = document.querySelector('#new-clinic-category-container input');
    const errorClinicCategory = document.querySelector('#new-clinic-category-container .error-field');

    const collapseClinics = document.querySelector('#collapse-clinics');

    const dropdownClinicCategories = document.getElementById('drpdwnCategory');

    let currentClinicCategories = []; // Fixed variable name typo

    let selectedClinic = '';

    const provinces = ["Central", "Eastern", "North Central", "Northern", "North Western", "Sabaragamuwa", "Southern", "Uva", "Western"];

    const tabsContainer = document.getElementById("clinicTabs");
    const tabContentContainer = document.getElementById("tabContent");

    getAllClinicCategories(); // Fetch existing categories on page load

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

    inputClinicCategory.addEventListener('input', () => {
        errorClinicCategory.style.display = 'none';
    });

    // Listen for the Bootstrap collapse event when the card is hidden
    collapseClinics.addEventListener('hidden.bs.collapse', () => {
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

        clinicCols.forEach(col => col.innerHTML = ''); // Clear previous content before repopulating

        let count = clinics.length;
        let itemPerColumn = Math.ceil(count / 3);

        clinics.forEach((clinic, index) => {
            const eleLi = document.createElement("li");
            eleLi.value = clinic.id;
            eleLi.innerText = clinic.clinic_name;
            clinicCols[Math.floor(index / itemPerColumn)].appendChild(eleLi);
        });
    }

    function populateClinicCategoryDropDown(clinics) {

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
            insertInfoClinicTable();
        }

    }

    dropdownClinicCategories.addEventListener('change', event => {
        selectedClinic = event.target.value;

        let tabs = document.querySelectorAll('.nav-link');

        console.log(tabs);
        provinces.forEach((province,index) => {
            console.log(index);
            let tabId = tabs[index].getAttribute('href');
            tabId = tabId.replace('#','');
            console.log(tabId);
        
            populateTable(tabId, province);
        });



    });


    /* --------------------------------------- tab container ------------------------------------ */

    function getAllClinicInfo(province) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: `/national-e-clinic-portal/includes/admin-clinic/admin-clinic-fetch.inc.php?province=${province}&clinic=${selectedClinic}`,
                success: function (response) {
                    if (response.status === "success") {
                        console.log(response.data);
                        resolve(response.data);
                    } else {
                        reject(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    reject('Error fetching data: ' + error);
                }
            });
        });
    }

    function populateTable(provinceId, province) {
        getAllClinicInfo(province)
            .then(clinics => {
                const tableBody = document.getElementById(`${provinceId}-tbody`);
                if (!tableBody) return;

                tableBody.innerHTML = ""; // Clear old data before adding new

                clinics.forEach(clinic => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${clinic.hospital_name} ${clinic.institute_type}</td>
                        <td>${clinic.clinic_place}</td>
                        <td>${clinic.clinic_date}</td>
                        <td>${clinic.clinic_time}</td>
                        <td>
                            <div class="form-check form-switch" id="btn-toggle-wrapper">
                                <input class="form-check-input" type="checkbox" role="switch" id="btn-toggle" ${clinic.active === 1 ? 'checked' : ''}>
                            </div>
                        </td>
                        <td><i class="fas fa-edit edit-icon"></i></td>
                    `;
                    tableBody.appendChild(row);
                });

                // Initialize DataTable (if not already initialized)
                // if (!$.fn.DataTable.isDataTable(`#table-clinic-${provinceId}`)) {
                //     $(`#table-clinic-${provinceId}`).DataTable({
                //         lengthMenu: [10, 25, 50, 100],
                //         drawCallback: function () {
                //             initializeTooltips(); // Ensure tooltips work after pagination
                //         }
                //     });
                // }
            })
            .catch(error => {
                console.error(error);
            });
    }

    function insertInfoClinicTable() {
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
            tabsContainer.appendChild(tabButton);

            // Create Tab Content (Table)
            const tabPane = document.createElement("div");
            tabPane.classList.add("tab-pane", "fade");

            if (index === 0) {
                tabPane.classList.add("show", "active");
            }

            tabPane.id = tabId;
            tabPane.innerHTML = `
                <div class="table-responsive">
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
            tabContentContainer.appendChild(tabPane);

            populateTable(tabId, province);

        });
    }



});



