$(document).ready(function () {

    // fetch current logged user name
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/appointment/view-appointment.inc.php?data=name',
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var userDetails = document.getElementById('user-details');
                var nameElement = document.createElement('h3');
                nameElement.innerHTML = '<span class="username-label">Username:</span> <span class="username-value">' + response.data + '</span>';
                userDetails.appendChild(nameElement);
            } else if (response.status === "error") {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            alert('Error fetching provinces: ' + error);
        }
    });


    //fetch Provinces
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/appointment/view-appointment.inc.php?data=province',
        dataType: "json",
        success: function (response) {
            if (response.status === "success" && Array.isArray(response.data)) {
                const provinces = response.data.map(element => element.province);
                fetchAppointments(provinces);
            } else if (response.status === "error") {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            alert('Error fetching provinces: ' + error);
        }
    });



     // fetch Appointments
     function fetchAppointments(provinces) {
        if (!Array.isArray(provinces) || provinces.length === 0) {
            alert("No provinces found!");
            return;
        }

        appointments = [];
        pendingRequests = provinces.length;
    
        provinces.forEach(patientProvince => {
            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/appointment/view-appointment.inc.php',
                dataType: "json", 
                data: { province: patientProvince },
                success: function (response) {
                    if (response.status === "success") {
                         appointments = [...appointments, ...response.data];
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching appointments:', error);
                },
                complete: function () {
                    pendingRequests--;
                    if (pendingRequests === 0) {
                        sendDataToPHP(appointments); // Send data when all AJAX calls are complete
                    }
                }
            });
        });
    }
    
    function sendDataToPHP(appointments) {
        fetch("/national-e-clinic-portal/includes/appointment/fetch-appointment.inc.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(appointments)
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector("#table-appointments tbody").innerHTML = html;
        })
        .catch(error => console.error("Error:", error));
    }
    
   
    
    

});