$(document).ready(function () {

    // fetch current logged user name
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/view-appointment.inc.php?data=name',
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                console.log(response.data);
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
        url: '/national-e-clinic-portal/includes/view-appointment.inc.php?data=province',
        dataType: "json",
        success: function (response) {
            if (response.status === "success" && Array.isArray(response.data)) {
                const provinces = response.data.map(element => element.province);
                console.log(provinces);
                console.log(Array.isArray(provinces));
                console.log(provinces.length);
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
        console.log("Provinces received:", provinces);
        if (!Array.isArray(provinces) || provinces.length === 0) {
            alert("No provinces found!");
            return;
        }

        appointments = [];
        pendingRequests = provinces.length;
    
        provinces.forEach(patientProvince => {
            console.log("Fetching appointments for:", patientProvince);
            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/view-appointment.inc.php',
                dataType: "json", 
                data: { province: patientProvince },
                success: function (response) {
                    if (response.status === "success") {
                        console.log(response.data);
                         appointments = [...appointments, ...response.data];
                        console.log(appointments);
                    } else {
                        alert(response.message);
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
        console.log(appointments);
        fetch("/national-e-clinic-portal/includes/fetch-appointment.inc.php", {
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