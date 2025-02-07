<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National E Clinic Portal</title>

    <!-- favicon -->
    <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

    <!-- to add icons from boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/national-e-clinic-portal/style/back-to-home.css">
    <link rel="stylesheet" href="/national-e-clinic-portal/style/book-appointment.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="/national-e-clinic-portal/js/book-appointment.js"></script>
</head>

<body>

    <?php
    include_once 'back-to-home.php';
    ?>

    <section id="book-appointment">
        <div id="form-wrapper">
            <div id="image-container"></div>
            <div id="form-container">
                <h1>Book an Appointment</h1>
                <form id="appointmentForm" action="save_appointment.php" method="POST" novalidate>
                    <!-- Select Profile -->
                    <label for="profile_name">Select Profile:</label>
                    <select id="profile_name" name="profile_name" required>
                        <option value="" hidden>Select Profile</option>
                    </select>

                    <!-- Select Clinic -->
                    <label for="clinic_name">Select Clinic:</label>
                    <select id="clinic_name" name="clinic_name" required>
                        <option value="" hidden>Select Clinic</option>
                    </select>

                    <!-- Select Hospital (Dynamically Populated) -->
                    <label for="hospital_name">Select Hospital:</label>
                    <select id="hospital_name" name="hospital_name" required>
                        <option value="" hidden>Select Hospital</option>
                    </select>

                    <!-- Display available clinic days here -->
                    <!-- <div>
                        <h2 id="available_days" style="color: #0bccda;">Available Days: </h2> 
                    </div> -->

                    <!-- Appointment Date -->
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" required>

                    <!-- Appointment Time -->
                    <label for="appointment_time">Appointment Time:</label>
                    <select id="appointment_time" name="appointment_time" required>
                        <option value="" hidden>Select Time</option>
                        <!-- Time slots will be dynamically populated -->
                    </select>

                    <!-- Submit Button -->
                    <button id="btn-submit" type="button">Book Appointment</button>
                </form>

                <p id="error_message" style="color: red; display: none;"></p>
            </div>
        </div>

    </section>


    <!-- <script>
    $(document).ready(function() {
        // When hospital is selected, fetch related clinics

        $('#hospital_name').change(function() {
            var hospitalId = $(this).val();

            var hospitalId = $('#hospital_name').val();
            
                // Reset clinic name
                document.getElementById('clinic_name').value = '';

                // Reset available days display
                document.getElementById('available_days').textContent = 'Available Days: ';

                // Reset appointment date
                document.getElementById('appointment_date').value = '';

                // Reset appointment time
                var timeSelect = $('#appointment_time');
                    timeSelect.empty(); // Clear previous options
                    timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
                    timeSelect.val('');
            

            if (hospitalId) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_clinics.php',
                    data: { hospital_Id: hospitalId },
                    success: function(response) {
                        
                        $('#clinic_name').html(response); // Populate the clinics dropdown
                    },
                    error: function(xhr, status, error) {
                        $('#error_message').text('Error fetching clinics: ' + error).show();
                    }
                });
            } else {
                $('#clinic_name').html('<option value="">Select Clinic</option>');
            }
        });


        // When clinic is selected, fetch available days
        $('#clinic_name').change(function() {
            var clinicId = $(this).val();
            var hospitalId = $('#hospital_name').val();

            
            // Reset available days display
            document.getElementById('available_days').textContent = 'Available Days: ';

            // Reset appointment date
            document.getElementById('appointment_date').value = '';

            // Reset appointment time
            var timeSelect = $('#appointment_time');
                    timeSelect.empty(); // Clear previous options
                    timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
                    timeSelect.val('');
        

            if (clinicId) {
                
                // Fetch available days
                $.ajax({
                    type: 'POST',
                    url: 'fetch_clinic_days.php',
                    data: { clinic_id: clinicId, hospital_Id: hospitalId },
                    success: function(response) {
                        $('#available_days').text("Available Days: " + response);
                        restrictDatePickerToTodayAndAfter(response);
                    },
                    error: function(xhr, status, error) {
                        $('#error_message').text('Error fetching available days: ' + error).show();
                    }
                });
            }
        });


         // Fetch booked times when an appointment date is selected
         $('#appointment_date').change(function() {
                    var appointmentDate = $(this).val();
                    var clinicId = $('#clinic_name').val();
                    var hospitalId = $('#hospital_name').val();

                    // Reset appointment time
                    var timeSelect = $('#appointment_time');
                    timeSelect.empty(); // Clear previous options
                    timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
                    timeSelect.val('');

                    if(!hospitalId){
                        alert("Please choose hospital.");
                        document.getElementById('appointment_date').value = '';
                        return;
                    }

                    if(!clinicId){
                        alert("Please choose clinic.");
                        document.getElementById('appointment_date').value = '';
                        return;
                    }

                    if(appointmentDate){
                        
                        $.ajax({
                            type: 'POST',
                            url: 'fetch_clinic_days.php',
                            data: { clinic_id: clinicId, hospital_Id: hospitalId },
                            success: function(response) {
                                var selectedDay = new Date(appointmentDate).toLocaleString('en-US', { weekday: 'long' });

                                if (!isValidDay(response, selectedDay)) {
                                    alert("Selected date is not available for this clinic. Please choose another date.");
                                    // If the date is not valid, reset the appointment date
                                    timeSelect.empty(); // Clear time
                                    timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
                                }else{
                                    populateTimeSlots(response, appointmentDate, clinicId, hospitalId);
                                }
                                
                            },
                            error: function(xhr, status, error) {
                                $('#error_message').text('Error fetching booked times: ' + error).show();
                            }
                        });
                    }
                });

        // Function to restrict date picker to available days
        function restrictDatePickerToTodayAndAfter(){
            var today = new Date();
            $('#appointment_date').attr('min', today.toISOString().split('T')[0]);
        }

        function isValidDay(response, selectedDay) {
            
            var availableDays = response.split(",")[0];
            
                var availableDaysArray = availableDays.split("and").map(function(day) {
                    return day.trim(); 
                });
                
                return availableDaysArray.includes(selectedDay);
        }

        // Function to populate available time slots

        function populateTimeSlots(response, appointmentDate, clinicId, hospitalId) {
            console.log(response);
            var availabletime = response.split(",")[1]; 

            console.log(availabletime);
            var availabletimeArray = availabletime.split("and").map(function(time) {
                return time.trim().replace(/;$/, ''); 
            });

            $.ajax({
                url: 'fetch_appointments.php', 
                type: 'POST',
                data: {
                    hospital_id: hospitalId,
                    clinic_id: clinicId, 
                    appointment_date: appointmentDate
                },
                success: function(reserved_appointments) {
                    
                    console.log(reserved_appointments); 

                    var timeSelect = $('#appointment_time');
                    timeSelect.empty(); // Clear previous options
                    timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))

                    availabletimeArray.forEach(function(timeSlot) {
                        console.log(timeSlot);

                        var timearray = timeSlot.split("-");
                        console.log(timearray);

                            var startParts = timearray[0].trim().split(/(\d+)/);
                            if(startParts[1]=== '12'){
                                var startHour = parseInt(startParts[4].trim() === 'PM' ? 12 : 0);
                            }else{
                                var startHour = parseInt(startParts[1]) + (startParts[4].trim() === 'PM' ? 12 : 0);
                            }
                            var startMinute = parseInt(startParts[3]); 
                            var startTime = new Date(); // Create a new Date object
                            startTime.setHours(startHour, startMinute, 0, 0); // Set the hour, minute, second, and millisecond to 0

                            var endParts = timearray[1].trim().split(/(\d+)/);
                            if(endParts[1]=== '12'){
                                var endHour = parseInt(endParts[4].trim() === 'PM' ? 12 : 0);
                            }else{
                                var endHour = parseInt(endParts[1]) + (endParts[4].trim() === 'PM' ? 12 : 0);
                            }
                            var endMinute = parseInt(endParts[3]); 
                            var endTime = new Date(); // Create a new Date object
                            endTime.setHours(endHour, endMinute, 0, 0);       // Set the hour, minute, second, and millisecond to 0

                            console.log(startParts);
                            console.log(endParts)
                            console.log(startTime);
                            console.log(endTime)

                            // Create time slots from start to end time with 20-minute intervals
                            while (startTime < endTime) {
                                var startTimeString = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h12' }); // Format as HH:MM AM/PM
                                console.log(startTimeString);

                                var startTimeClone = new Date(startTime.getTime());
                                startTimeClone.setMinutes(startTimeClone.getMinutes() + 20); 
                                var endTimeString = startTimeClone.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h12' });

                                // Create the time period string (e.g., "8:00 AM - 8:20 AM")
                                var timePeriod = startTimeString + ' - ' + endTimeString; 
                                console.log(timePeriod);

                                // Check the status of the booked time slot
                                var status = reserved_appointments.find(app => app.time_period === timePeriod)?.status; // Get the status from reserved_appointments
                                
                                // Create option element
                                var option = null;

                                // Change color based on status
                                if (status === 'APPROVED') {
                                    option = $('<option></option>').attr('value', timePeriod).text(`${timePeriod} \u00A0\u00A0\u00A0 BOOKED \u00A0\u00A0\u00A0 ${status}`);
                                    option.css('color', 'green'); // Approved - green
                                    option.prop('disabled', true); // Disable time slots
                                } else if (status === 'PENDING') {
                                    option = $('<option></option>').attr('value', timePeriod).text(`${timePeriod} \u00A0\u00A0\u00A0 BOOKED \u00A0\u00A0\u00A0 ${status}`);
                                    option.css('color', 'orange'); // Pending - orange
                                    option.prop('disabled', true); // Disable time slots
                                }else{
                                    option = $('<option></option>').attr('value', timePeriod).text(timePeriod);

                                }

                                // Append the option to the select element
                                timeSelect.append(option);

                                startTime.setMinutes(startTime.getMinutes() + 20); // Increment by 20 minutes
                            
                            
                            }
                    
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching appointments:', error);
                }
            });

        }       

   
    });
    </script> -->
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>