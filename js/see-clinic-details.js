document.addEventListener("DOMContentLoaded", () => {

    const provinces = document.querySelectorAll('svg path');

    const searchForm = document.getElementById("search-form");
    const districtDropdown = document.getElementById("district-dropdown");
    const hospitalCategoryDropdown = document.getElementById("hospital-category-dropdown");
    const hospitalDropdown = document.getElementById("hospital-dropdown");
    const clinicCategoryDropdown = document.getElementById("clinic-category-dropdown");

    const searchFormHeading = document.querySelector("#search-heading-and-form h1");
    const btnClear = document.getElementById('btn-clear');
    const btnSearch = document.getElementById('btn-search');

    let isDistrictDropdownDisable = true;
    let isHospitalCategoryDropdownDisable = true;
    let isHospitalDropdownDisable = true;
    let isClinicCategoryDropdownDisable = true;

    let selectedProvince = "";
    let selectedDistrict = "";
    let selectedHospitalCategory = "";
    let selectedHospital = "";
    let selectedClinicCategory = "";

    let clinicCategoryArray = [];

    fetchAllClinicCategories();

    provinces.forEach(province => {
        province.addEventListener("click", async (event) => {
            const provinceTitle = province.getAttribute("title");
            searchFormHeading.textContent = `Find ${provinceTitle} Clinic Details`;
            removeAllSelection(provinces);

            selectedDistrict = "";
            resetHospitalCategoryDropdown();
            resetHospitalDropdown();
            resetClinicCategoryDropdown();

            disableForm();


            event.target.classList.add("selected");

            if (isDistrictDropdownDisable) {
                districtDropdown.disabled = false;
                isDistrictDropdownDisable = false;
            }

            selectedProvince = provinceTitle.replace("Province", "").trim();


            // Fetch districts for the selected province
            try {
                const response = await fetch('/national-e-clinic-portal/includes/search-clinic.inc.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ province: selectedProvince })
                });

                if (response.ok) {
                    const districts = await response.json();
                    if (districts.status === 'success') {
                        populateDropdown(districtDropdown, districts.data, "district_name", "district_name", "Select Your District");
                        enableButtons();
                    }

                } else {
                    console.error("Error fetching districts:", response.statusText);
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });
    });

    districtDropdown.addEventListener("change", async event => {

        if (isHospitalCategoryDropdownDisable) {
            hospitalCategoryDropdown.disabled = false;
            isHospitalCategoryDropdownDisable = false;
        }

        selectedHospitalCategory = "";
        disableButtons();

        selectedDistrict = event.target.value.trim();
        resetHospitalDropdown();
        resetClinicCategoryDropdown();

        // Fetch hospital categories for the selected district
        try {
            const response = await fetch('/national-e-clinic-portal/includes/search-clinic.inc.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ district: selectedDistrict })
            });

            if (response.ok) {
                const hospitalCategory = await response.json();
                if (hospitalCategory.status === 'success') {
                    populateDropdown(hospitalCategoryDropdown, hospitalCategory.data, "institute_type", "institute_type", "Select Hospital Category");
                    enableButtons();
                }

            } else {
                console.error("Error fetching hospital categories:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    });

    hospitalCategoryDropdown.addEventListener("change", async event => {

        if (isHospitalDropdownDisable) {
            hospitalDropdown.disabled = false;
            isHospitalDropdownDisable = false;
        }

        selectedHospital = "";
        disableButtons();

        selectedHospitalCategory = event.target.value.trim();
        resetClinicCategoryDropdown();

        // Fetch hospitals for the selected hospital category
        try {
            const response = await fetch('/national-e-clinic-portal/includes/search-clinic.inc.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    province: selectedProvince,
                    district: selectedDistrict,
                    hospital_category: selectedHospitalCategory
                })
            });

            if (response.ok) {
                const hospitals = await response.json();
                if (hospitals.status === 'success') {
                    populateDropdown(hospitalDropdown, hospitals.data, "hospital_name", "hospital_name", "Select Hospital");
                    enableButtons();
                }

            } else {
                console.error("Error fetching hospitals:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    });

    hospitalDropdown.addEventListener("change", async event => {


        if (isClinicCategoryDropdownDisable) {
            clinicCategoryDropdown.disabled = false;
            isClinicCategoryDropdownDisable = false;
        } else {

            if (selectedClinicCategory !== "") {
                populateDropdown(clinicCategoryDropdown, clinicCategoryArray, "clinic_name", "clinic_name", "Select Clinic Category");
                selectedClinicCategory = "";
            }
        }

        disableButtons();

        selectedHospital = event.target.value.trim();
        enableButtons();

    });

    clinicCategoryDropdown.addEventListener("change", event => {
        selectedClinicCategory = event.target.value.trim();
        enableButtons();
    });


    btnClear.addEventListener("click", (event) => {
        removeAllSelection(provinces);

        searchFormHeading.textContent = 'Find Clinic Details';

        disableForm();

        document.getElementById('table-container').style.display = 'none';
        document.getElementById('selection-criteria').style.display = 'none';
        document.getElementById('not-selected-msg').style.display = 'block';
    });


    btnSearch.addEventListener("click", async event => {
        event.preventDefault(); // Prevent form submission and page reload

        try {
            const response = await fetch('/national-e-clinic-portal/includes/search-clinic.inc.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    province: selectedProvince,
                    hospital: selectedHospital,
                    clinic_category: selectedClinicCategory
                })
            });

            if (response.ok) {
                const clinic = await response.json();
                if (clinic.status === 'success') {
                    displayClinicDetails(clinic.data);
                } else if (clinic.status === 'error') {
                    displayClinicDetails(null);
                }
                scrollToClinicInfoSection();
            } else {
                console.error("Error fetching clinic details:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    });


    async function fetchAllClinicCategories() {
        try {
            const response = await fetch('/national-e-clinic-portal/includes/search-clinic.inc.php', {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            });

            if (response.ok) {
                const clinicCategory = await response.json();
                if (clinicCategory.status === 'success') {
                    clinicCategoryArray = clinicCategory.data;
                    populateDropdown(clinicCategoryDropdown, clinicCategory.data, "clinic_name", "clinic_name", "Select Clinic Category");
                }
            } else {
                console.error("Error fetching clinic categories:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }

    }

    function disableForm() {
        const elements = searchForm.querySelectorAll("select, button");
        elements.forEach((element) => {
            element.disabled = true;
        });
        isDistrictDropdownDisable = true;
        isHospitalCategoryDropdownDisable = true;
        isHospitalDropdownDisable = true;
    }


    // Remove the 'selected' class from all provinces
    function removeAllSelection(provinces) {
        provinces.forEach((p) => p.classList.remove("selected"));
    }

    // Show in dropdown
    function populateDropdown(dropdown, data, valueKey, textKey, defaultText) {
        dropdown.innerHTML = `<option value="" selected hidden>${defaultText}</option>`; // Reset and add the default option

        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item[valueKey];
            option.textContent = item[textKey];
            dropdown.appendChild(option);
        });
    }


    function resetHospitalCategoryDropdown() {
        if (!isHospitalCategoryDropdownDisable) {
            if (selectedHospitalCategory !== "") {
                populateDropdown(hospitalCategoryDropdown, [], "institute_type", "institute_type", "Select Hospital Category");
                selectedHospitalCategory = "";
            }
            hospitalCategoryDropdown.disabled = true;
            isHospitalCategoryDropdownDisable = true;
        }
    }

    function resetHospitalDropdown() {
        if (!isHospitalDropdownDisable) {
            if (selectedHospital !== "") {
                populateDropdown(hospitalDropdown, [], "hospital_name", "hospital_name", "Select Hospital");
                selectedHospital = "";
            }
            hospitalDropdown.disabled = true;
            isHospitalDropdownDisable = true;
        }
    }

    function resetClinicCategoryDropdown() {
        if (!isClinicCategoryDropdownDisable) {
            if (selectedClinicCategory !== "") {
                populateDropdown(clinicCategoryDropdown, clinicCategoryArray, "clinic_name", "clinic_name", "Select Clinic Category");
                selectedClinicCategory = "";
            }
            clinicCategoryDropdown.disabled = true;
            isClinicCategoryDropdownDisable = true;
        }
    }

    function enableButtons() {

        if (selectedProvince !== "" &&
            selectedDistrict !== "" &&
            selectedHospitalCategory !== "" &&
            selectedHospital !== "" &&
            selectedClinicCategory !== "") {
            btnClear.disabled = false;
            btnSearch.disabled = false;
        }


    }

    function disableButtons() {
        btnClear.disabled = true;
        btnSearch.disabled = true;
    }

    function displayClinicDetails(clinicInfo = null) {

        const tableContainer = document.getElementById('table-container');
        const selectionCriteria = document.getElementById('selection-criteria');
        const noSelectionMsg = document.getElementById('not-selected-msg');

        const table = document.getElementById('clinicTable');
        const tableBody = document.querySelector("#clinicTable tbody");
        const tableFooter = document.querySelector("#clinicTable tfoot");


        tableBody.innerHTML = "";

        selectionCriteria.style.display = 'flex';
        tableContainer.style.display = 'block';
        noSelectionMsg.style.display = 'none';

        if (tableFooter) table.removeChild(tableFooter);

        document.querySelector('#selection-criteria > #province').innerHTML = `Province: ${selectedProvince}`;
        document.querySelector('#selection-criteria > #district').innerHTML = `District: ${selectedDistrict}`;
        document.querySelector('#selection-criteria > #hospital').innerHTML = `Hospital: ${selectedHospital} ${selectedHospitalCategory}`;
        document.querySelector('#selection-criteria > #clinic-category').innerHTML = `Clinic: ${selectedClinicCategory}`;

        if (clinicInfo && clinicInfo.length > 0) {

            clinicInfo.forEach(clinic => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${clinic.clinic_place}</td>
                    <td>${clinic.clinic_date}</td>
                    <td>${clinic.clinic_time}</td>
                `;
                tableBody.appendChild(row);
            });

        } else {

            let tableFooter = document.createElement("tfoot");
            tableFooter.innerHTML = `
                <tr>
                    <td colspan="3" style="text-align: center;">No clinic found</td>
                </tr>
            `;
            table.appendChild(tableFooter);
        }
    }

    function scrollToClinicInfoSection() {
        const clinicInfoSection = document.getElementById("selected-clinic-info");
        const sectionHeight = clinicInfoSection.offsetHeight;
        const viewportHeight = window.innerHeight;

        if (sectionHeight < viewportHeight) {
            // If section is smaller than viewport, align it to the bottom
            window.scrollTo({
                /*
                * clinicInfoSection.getBoundingClientRect().top --> distance from the top of the viewport to the top of the element
                * window.scrollY --> current scroll position of the page from the top of the document (how far down the page has already been scrolled)
                * (viewportHeight - sectionHeight) --> space remaining at the bottom of the viewport after the section is fully displayed
                */
                top: clinicInfoSection.getBoundingClientRect().top + window.scrollY - (viewportHeight - sectionHeight),
                behavior: "smooth"
            });
        } else {
            // If section is larger, align it to the top
            target.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    }


});



