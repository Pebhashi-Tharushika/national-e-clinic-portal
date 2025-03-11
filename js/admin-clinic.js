document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.querySelector('#new-clinic-category-container #btnSubmit');
    const inputClinicCategory = document.querySelector('#new-clinic-category-container input');
    const errorClinicCategory = document.querySelector('#new-clinic-category-container .error-field');
    
    const collapseClinics = document.querySelector('#collapse-clinics');

    const dropdownClinicCategories = document.getElementById('drpdwnCategory');

    let currentClinicCategories = []; // Fixed variable name typo

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
            url: '/national-e-clinic-portal/includes/clinic/clinic-add.inc.php',
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

    function populateClinicCategoryDropDown(clinics){

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
    }
});



