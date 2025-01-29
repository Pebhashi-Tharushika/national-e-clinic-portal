// const provinceMap = {
//     'Eastern Province': 'eastern',
//     'Northern Province': 'northern',
//     'North Western Province': 'north-western',
//     'Western Province': 'western',
//     'Southern Province': 'southern',
//     'Sabaragamuwa Province': 'sabaragamuwa',
//     'Uva Province': 'uva',
//     'Central Province': 'central',
//     'North Central Province': 'north-central'
// };

document.addEventListener("DOMContentLoaded", () => {

    const provinces = document.querySelectorAll('svg path');

    const searchForm = document.getElementById("search-form");
    const districtDropdown = document.getElementById("district-dropdown");
    const hospitalCategoryDropdown = document.getElementById("hospital-category-dropdown");
    const hospitalDropdown = document.getElementById("hospital-dropdown");
    const clinicCategoryDropdown = document.getElementById("clinic-category-dropdown");

    const searchFormHeading = document.querySelector("#search-heading-and-form h1");
    const btnClear = document.getElementById('btn-clear');

    let isDistrictDropdownDisable = true;
    let isHospitalCategoryDropdownDisable = true;
    let isHospitalDropdownDisable = true;
    let isClinicCategoryDropdownDisable = true;

    let selectedProvince = "";
    let selectedDistrict = "";
    let selectedHospitalCategory = "";
    let selectedHospital = "";
    let selectedClinicCategory = "";

    provinces.forEach(province => {
        province.addEventListener("click", async (event) => {
            const provinceTitle = province.getAttribute("title");
            searchFormHeading.textContent = `Find ${provinceTitle} Clinic Details`;
            removeAllSelection(provinces);
            disableForm();
            event.target.classList.add("selected");

            if (isDistrictDropdownDisable) {
                districtDropdown.disabled = false;
                isDistrictDropdownDisable = false;
            }

            selectedProvince = provinceTitle.replace("Province", "").trim();

            // Fetch districts for the selected province
            try {
                const response = await fetch('search-clinic.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ province: selectedProvince })
                });

                if (response.ok) {
                    const districts = await response.json();
                    if(districts.status === 'success') {
                        populateDistricts(districts.data);
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

        selectedDistrict = event.target.value.trim();
        resethospitalDropdown();
        resetClinicCategoryDropdown();

        // Fetch hospital categories for the selected district
        try {
            const response = await fetch('search-clinic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ district: selectedDistrict })
            });

            if (response.ok) {
                const hospitalCategory = await response.json();
                if(hospitalCategory.status === 'success') {
                    populateHospitalCategory(hospitalCategory.data);
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

        selectedHospitalCategory = event.target.value.trim();
        resetClinicCategoryDropdown();

        // Fetch hospitals for the selected hospital category
        try {
            const response = await fetch('search-clinic.php', {
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
                if(hospitals.status === 'success') {
                    populateHospital(hospitals.data);
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
        }

        selectedHospital = event.target.value.trim();

        try {
            const response = await fetch('search-clinic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 
                    hospital: selectedHospital,
                    province: selectedProvince
                 })
            });

            if (response.ok) {
                const clinicCategory = await response.json();
                if(clinicCategory.status === 'success') {
                    populateClinicCategory(clinicCategory.data);
                }
            } else {
                console.error("Error fetching clinic categories:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    });

    clinicCategoryDropdown.addEventListener("change", event => {

        selectedClinicCategory = event.target.value.trim();
    });


    btnClear.addEventListener("click", (event) => {
        removeAllSelection(provinces);
        searchFormHeading.textContent = 'Find Clinic Details';
        disableForm();
    });

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

    // Show districs in dropdown
    function populateDistricts(districts) {
        districtDropdown.innerHTML = '<option value="" selected hidden>Select Your District</option>'; // Reset and add the default option

        districts.forEach(district => {
            const option = document.createElement("option");
            option.value = district.district_name;
            option.textContent = district.district_name;
            districtDropdown.appendChild(option);
        });
    }

    function populateHospitalCategory(hospitalCategory) {
        hospitalCategoryDropdown.innerHTML = '<option value="" selected hidden>Select Hospital Category</option>';

        hospitalCategory.forEach(category => {
            const option = document.createElement('option');
            option.value = category.institute_type;
            option.textContent = category.institute_type;
            hospitalCategoryDropdown.appendChild(option);
        });
    }

    function populateHospital(hospitals) {
        hospitalDropdown.innerHTML = '<option value="" selected hidden>Select Hospital</option>';
        hospitals.forEach(hospital => {
            const option = document.createElement('option');
            option.value = hospital.hospital_name;
            option.textContent = hospital.hospital_name;
            hospitalDropdown.appendChild(option);
        });
    }

    function populateClinicCategory(clinicCategory){
        clinicCategoryDropdown.innerHTML = '<option value="" selected hidden>Select Clinic Category</option>';

        clinicCategory.forEach(category => {
            const option = document.createElement('option');
            option.value = category.clinic_name;
            option.textContent = category.clinic_name;
            clinicCategoryDropdown.appendChild(option);
        });
    }

    function resethospitalDropdown(){
        if(!isHospitalDropdownDisable){
            if(selectedHospital !== "") {
                populateHospital([]);
            }
            hospitalDropdown.disabled = true;
            isHospitalDropdownDisable = true;
        }
    }

    function resetClinicCategoryDropdown(){
        if(!isClinicCategoryDropdownDisable){
            if(selectedClinicCategory !== ""){
                populateClinicCategory([]);
            }
            clinicCategoryDropdown.disabled = true;
            isClinicCategoryDropdownDisable = true;
        }
    }


});



// window.location.href = "/national-e-clinic-portal/search-clinic.php?province=" + encodeURIComponent(valueOfQueryString);