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

    const searchForm = document.getElementById("search-form");
    disableForm(searchForm, true);

    const provinces = document.querySelectorAll('svg path');
    const searchFormHeading = document.querySelector("#search-heading-and-form h1");
    const btnClear = document.getElementById('btn-clear');

    provinces.forEach(province => {
        province.addEventListener("click", async (event) => {
            const provinceTitle = province.getAttribute("title");
            searchFormHeading.textContent = `Find ${provinceTitle} Clinic Details`;
            disableForm(searchForm, false);
            removeAllSelection(provinces)
            event.target.classList.add("selected");

            // Fetch districts for the selected province
            try {
                const response = await fetch('province.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ province: provinceTitle.replace("Province", "").trim() })
                });

                if (response.ok) {
                    const districts = await response.json();
                    console.log("Districts:", districts); // Handle the districts
                    populateDistricts(districts.data);
                } else {
                    console.error("Error fetching districts:", response.statusText);
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });
    });

    


    btnClear.addEventListener("click", (event) => {
        removeAllSelection(provinces);
        searchFormHeading.textContent = 'Find Clinic Details';
        disableForm(searchForm, true);
    });

    function disableForm(form, isDisable) {
        const elements = form.querySelectorAll("select, button");
        elements.forEach((element) => {
            element.disabled = isDisable;
        });
    }


    // Remove the 'selected' class from all provinces
    function removeAllSelection(provinces) {
        provinces.forEach((p) => p.classList.remove("selected"));
    }

    // Show districs in dropdown
    function populateDistricts(districts) {
        const districtDropdown = document.getElementById("district-dropdown");
        districtDropdown.innerHTML = '<option value="" selected hidden>Select Your District</option>'; // Reset and add the default option
    
        districts.forEach(district => {
            const option = document.createElement("option");
            option.value = district.district_name;
            option.textContent = district.district_name; 
            districtDropdown.appendChild(option);
        });
    }
    
});



// window.location.href = "/national-e-clinic-portal/province.php?province=" + encodeURIComponent(valueOfQueryString);