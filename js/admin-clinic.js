document.addEventListener('DOMContentLoaded', () => {
    
    getAllClinicCategories();

});

function getAllClinicCategories(){
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/clinic/clinic-search.inc.php',
        contentType: "application/json",
        success: function (response) {
          if (response.status === "success") {
            console.log(response.data);
            populateClinics(response.data);
          } else if (response.status === "error") {
            alert(response.message);
          }
        },
        error: function (xhr, status, error) {
          alert('Error fetching clinics: ' + error);
        }
      });
}

function populateClinics(clinics) {
    let count = clinics.length;
    let itemPerColumn = Math.ceil(count / 3);

    const clinicCols = [
        document.querySelector('#clinic-categories-content #col1 ul'),
        document.querySelector('#clinic-categories-content #col2 ul'),
        document.querySelector('#clinic-categories-content #col3 ul')
    ];

    clinics.forEach((clinic, index) => {
        const EleLi = document.createElement("li");
        EleLi.value = clinic.id;
        EleLi.innerText = clinic.clinic_name;
        clinicCols[Math.floor(index / itemPerColumn)].appendChild(EleLi);
    });
}
