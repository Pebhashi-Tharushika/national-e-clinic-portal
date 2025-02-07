$(document).ready(function () {

    disableForm(); //disable all fields except profile field at start

    isDisableClinic;
    isDisableHospital;
    isDisableDate;
    isDisableTime;

    patients = [];
    var patientProvince;
    var selectedPatientId;
    var selectedClinicId;
    var selectedHospitalId;

    // fetch profiles
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/book-appointment.inc.php?request=profile',
        dataType: "json", // Ensure response is JSON
        success: function (response) {
            if (response.status === "success") {
                patients = response.data;
                populateDropdown("profile_name", response.data, "id", "first_name", "last_name", "Select Profile");
            } else if (response.status === "error") {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            $('#error_message').text('Error fetching profiles: ' + error).show();
        }
    });

    // fetch cinics
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/book-appointment.inc.php?request=clinic',
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                populateDropdown("clinic_name", response.data, "id", "clinic_name", null, "Select Clinic");
            }
            else if (response.status === "error") {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            $('#error_message').text('Error fetching clinics: ' + error).show();
        }
    });

    // fetch selected patient profile
    $('#profile_name').change(function () {
        selectedPatientId = $(this).val().trim();

        $('#clinic_name').val(''); // Reset clinic name
        $('#hospital_name').val('');  // Reset hospital name
        // document.getElementById('available_days').textContent = 'Available Days: '; // Reset available days display
        $('#appointment_date').val('');  // Reset appointment date
        $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>'); // Reset appointment time - Clear & add default option

        enableField('clinic_name');

        patientProvince = patients.find(p => p.id == selectedPatientId)?.province.trim() || null;
    });

    // When clinic is selected, fetch available hospitals 
    $('#clinic_name').change(function () {
        selectedClinicId = $(this).val().trim();

        $('#hospital_name').val('');  // Reset hospital name
        // document.getElementById('available_days').textContent = 'Available Days: '; // Reset available days display
        $('#appointment_date').val('');  // Reset appointment date
        $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>'); // Reset appointment time - Clear & add default option


        if (selectedClinicId) {
            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/book-appointment.inc.php',
                data: {
                    province: patientProvince,
                    clinic_id: selectedClinicId
                },
                success: function (response) {
                    console.log(response);
                    if (response.status === "success") {
                        enableField('hospital_name');
                        populateDropdown("hospital_name", response.data, "id", "hospital_name", "institute_type", "Select Hospital");
                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    $('#error_message').text('Error fetching hospitals: ' + error).show();
                }
            });
        } else {
            $('#clinic_name').html('<option value="" hidden>Select Clinic</option>');
        }
    });


    // When hospital is selected, fetch available clinic days
    $('#hospital_name').change(function () {
        selectedHospitalId = $(this).val().trim();

        // document.getElementById('available_days').textContent = 'Available Days: '; // Reset available days display
        $('#appointment_date').val('');  // Reset appointment date
        $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>'); // Reset appointment time - Clear & add default option


        if (selectedHospitalId) {
            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/book-appointment.inc.php',
                data: {
                    province: patientProvince,
                    clinic_id: selectedClinicId,
                    hospital_id: selectedHospitalId
                },
                success: function (response) {
                    console.log(response);
                    console.log(response.data[0].clinic_date);
                    
                    if (response.status === "success") {
                        var num = getDayNumber(response.data[0].clinic_date);
                        customizeDatePicker(num);
                        enableField('appointment_date');
                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                    // $('#available_days').text("Available Days: " + response);
                    // restrictDatePickerToTodayAndAfter(response);
                },
                error: function (xhr, status, error) {
                    $('#error_message').text('Error fetching available days: ' + error).show();
                }
            });
        } else {
            $('#appointment_date').val('');

        }
    });


    // Fetch booked times when an appointment date is selected
    // $('#appointment_date').change(function () {
    //     var appointmentDate = $(this).val();
    //     var selectedClinicId = $('#clinic_name').val();
    //     var selectedHospitalId = $('#hospital_name').val();

    //     // Reset appointment time
    //     var timeSelect = $('#appointment_time');
    //     timeSelect.empty(); // Clear previous options
    //     timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
    //     timeSelect.val('');

    //     if (!selectedHospitalId) {
    //         alert("Please choose hospital.");
    //         document.getElementById('appointment_date').value = '';
    //         return;
    //     }

    //     if (!selectedClinicId) {
    //         alert("Please choose clinic.");
    //         document.getElementById('appointment_date').value = '';
    //         return;
    //     }

    //     if (appointmentDate) {

    //         $.ajax({
    //             type: 'POST',
    //             url: 'fetch_clinic_days.php',
    //             data: { clinic_id: selectedClinicId, hospital_Id: selectedHospitalId },
    //             success: function (response) {
    //                 var selectedDay = new Date(appointmentDate).toLocaleString('en-US', { weekday: 'long' });

    //                 if (!isValidDay(response, selectedDay)) {
    //                     alert("Selected date is not available for this clinic. Please choose another date.");
    //                     // If the date is not valid, reset the appointment date
    //                     timeSelect.empty(); // Clear time
    //                     timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))
    //                 } else {
    //                     populateTimeSlots(response, appointmentDate, selectedClinicId, selectedHospitalId);
    //                 }

    //             },
    //             error: function (xhr, status, error) {
    //                 $('#error_message').text('Error fetching booked times: ' + error).show();
    //             }
    //         });
    //     }
    // });

    // Function to restrict date picker to available days
    function restrictDatePickerToTodayAndAfter() {
        var today = new Date();
        $('#appointment_date').attr('min', today.toISOString().split('T')[0]);
    }

    function isValidDay(response, selectedDay) {

        var availableDays = response.split(",")[0];

        var availableDaysArray = availableDays.split("and").map(function (day) {
            return day.trim();
        });

        return availableDaysArray.includes(selectedDay);
    }

    // Function to populate available time slots

    function populateTimeSlots(response, appointmentDate, clinicId, hospitalId) {
        console.log(response);
        var availabletime = response.split(",")[1];

        console.log(availabletime);
        var availabletimeArray = availabletime.split("and").map(function (time) {
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
            success: function (reserved_appointments) {

                console.log(reserved_appointments);

                var timeSelect = $('#appointment_time');
                timeSelect.empty(); // Clear previous options
                timeSelect.append($('<option></option>').attr('value', '').text('Select Time'))

                availabletimeArray.forEach(function (timeSlot) {
                    console.log(timeSlot);

                    var timearray = timeSlot.split("-");
                    console.log(timearray);

                    var startParts = timearray[0].trim().split(/(\d+)/);
                    if (startParts[1] === '12') {
                        var startHour = parseInt(startParts[4].trim() === 'PM' ? 12 : 0);
                    } else {
                        var startHour = parseInt(startParts[1]) + (startParts[4].trim() === 'PM' ? 12 : 0);
                    }
                    var startMinute = parseInt(startParts[3]);
                    var startTime = new Date(); // Create a new Date object
                    startTime.setHours(startHour, startMinute, 0, 0); // Set the hour, minute, second, and millisecond to 0

                    var endParts = timearray[1].trim().split(/(\d+)/);
                    if (endParts[1] === '12') {
                        var endHour = parseInt(endParts[4].trim() === 'PM' ? 12 : 0);
                    } else {
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
                        } else {
                            option = $('<option></option>').attr('value', timePeriod).text(timePeriod);

                        }

                        // Append the option to the select element
                        timeSelect.append(option);

                        startTime.setMinutes(startTime.getMinutes() + 20); // Increment by 20 minutes


                    }

                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching appointments:', error);
            }
        });

    }


    // show options in dropdown
    function populateDropdown(dropdownId, data, valueKey, textKey1, textKey2, defaultText) {
        let dropdown = $("#" + dropdownId);
        dropdown.empty().append(`<option value="" hidden>${defaultText}</option>`); // Clear & add default option

        $.each(data, function (index, item) {
            let text = item[textKey1];
            if (textKey2 && item[textKey2]) {
                text += " " + item[textKey2];
            }

            dropdown.append($('<option></option>')
                .attr("value", item[valueKey])
                .text(text));
        });
    }

    function disableForm() {
        // Disable all select, input, and button elements inside the form
        $(appointmentForm).find("select, input, button").prop("disabled", true);

        // Re-enable the element with id "profile_name"
        $("#profile_name").prop("disabled", false);

        // Add 'disabled-label' class to labels of all disabled inputs and selects
        $(appointmentForm).find("select:disabled, input:disabled").each(function () {
            $('label[for="' + this.id + '"]').addClass('disabled-label');
        });

        isDisableClinic = true;
        isDisableHospital = true;
        isDisableDate = true;
        isDisableTime = true;
    }

    function enableField(fieldId) {
        $("#" + fieldId).prop("disabled", false);
        $('label[for="' + fieldId + '"]').removeClass('disabled-label');
    }

    function customizeDatePicker(day){
        let today = new Date();
        console.log(today);

        // get next weekday from today
        let startDate = new Date();
        startDate.setDate(today.getDate() + ((7 + day - today.getDay()) % 7 || 7)); 
        let firstAllowedDay = startDate.toISOString().split('T')[0];
        
        let dateInput = document.getElementById("appointment_date");
        dateInput.min = firstAllowedDay;
        dateInput.value = firstAllowedDay;
        dateInput.step = 7; // Allow only weekly selection
    }

    function getDayNumber(dayName) {
        const days = { "Sunday": 0, "Monday": 1, "Tuesday": 2, "Wednesday": 3, "Thursday": 4, "Friday": 5, "Saturday": 6 };
        return days[dayName] ?? -1; // Return -1 if the input is invalid
    }

});