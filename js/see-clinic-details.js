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
    const searchFormHeading = document.querySelector("#search-heading-and-form h1");
    const btnClear = document.getElementById('btn-clear');

    let isDistrictDropdownDisable = true;
    let ishospitalCategoryDropdownDisable = true;

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

            // Fetch districts for the selected province
            try {
                const response = await fetch('search-clinic.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ province: provinceTitle.replace("Province", "").trim() })
                });

                if (response.ok) {
                    const districts = await response.json();
                    populateDistricts(districts.data);
                } else {
                    console.error("Error fetching districts:", response.statusText);
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });
    });

    districtDropdown.addEventListener("change", async event => {

        if (ishospitalCategoryDropdownDisable) {
            hospitalCategoryDropdown.disabled = false;
            ishospitalCategoryDropdownDisable = false;
        }

        const selectedDistrict = event.target.value;
        console.log(selectedDistrict.trim());

        // Fetch hospital categories for the selected district
        try {
            const response = await fetch('search-clinic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ district: selectedDistrict.trim() })
            });

            if (response.ok) {
                const hospitalCategory = await response.json();
                console.log("hospitalCategory:", hospitalCategory); 
                populateHospitalCategory(hospitalCategory.data);
            } else {
                console.error("Error fetching districts:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    });


    btnClear.addEventListener("click", (event) => {
        removeAllSelection(provinces);
        searchFormHeading.textContent = 'Find Clinic Details';
        disableForm(); 
    });

    function disableForm(){
        const elements = searchForm.querySelectorAll("select, button");
        elements.forEach((element) => {
            element.disabled = true;
        });
        isDistrictDropdownDisable = true;
    ishospitalCategoryDropdownDisable = true;
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

    function populateHospitalCategory(hospitalCategory){
        hospitalCategoryDropdown.innerHTML = '<option value="" selected hidden>Select Hospital</option>';
        hospitalCategory.forEach(category => {
            const option = document.createElement('option');
            option.value = category.institute_type;
            option.textContent = category.institute_type;
            hospitalCategoryDropdown.appendChild(option);
        });
    }

});



// window.location.href = "/national-e-clinic-portal/search-clinic.php?province=" + encodeURIComponent(valueOfQueryString);