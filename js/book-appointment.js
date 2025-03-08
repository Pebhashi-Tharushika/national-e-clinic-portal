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
    var selectedClinicDate;
    var selectedClinicTime;
    var selectedClinicTimePeriod;

    // fetch profiles
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php?request=profile',
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
            alert('Error fetching profiles: ' + error);
        }
    });

    // fetch cinics
    $.ajax({
        type: 'GET',
        url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php?request=clinic',
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
            alert('Error fetching clinics: ' + error);
        }
    });

    // fetch selected patient profile
    $('#profile_name').change(function () {
        selectedPatientId = $(this).val().trim();

        if (selectedPatientId) {
            $('#clinic_name').val(''); // Reset clinic name
            $('#hospital_name').val('');  // Reset hospital name
            $('#appointment_date').val('');  // Reset appointment date
            $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>'); // Reset appointment time - Clear & add default option

            enableField('clinic_name');

            patientProvince = patients.find(p => p.id == selectedPatientId)?.province.trim() || null;
        } else {
            $('#profile_name').html('<option value="" hidden>Select Profile</option>');
        }


    });

    // When clinic is selected, fetch available hospitals 
    $('#clinic_name').change(function () {
        selectedClinicId = $(this).val().trim();

        if (selectedClinicId) {
            $('#hospital_name').val('');
            $('#appointment_date').val('');
            $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>');
            $('#btn-submit').prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php',
                data: {
                    province: patientProvince,
                    clinic_id: selectedClinicId
                },
                success: function (response) {
                    if (response.status === "success") {
                        enableField('hospital_name');
                        populateDropdown("hospital_name", response.data, "id", "hospital_name", "institute_type", "Select Hospital");
                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error fetching hospitals: ' + error);
                }
            });
        } else {
            $('#clinic_name').html('<option value="" hidden>Select Clinic</option>');
        }
    });


    // When hospital is selected, fetch available clinic days
    $('#hospital_name').change(function () {
        selectedHospitalId = $(this).val().trim();

        if (selectedHospitalId) {
            $('#appointment_date').val('');
            $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>');
            $('#btn-submit').prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php',
                data: {
                    province: patientProvince,
                    clinic_id: selectedClinicId,
                    hospital_id: selectedHospitalId
                },
                success: function (response) {

                    if (response.status === "success") {
                        selectedClinicDate = response.data[0].clinic_date.trim();
                        selectedClinicTime = response.data[0].clinic_time.trim();

                        customizeDatePicker(getDayNumber(selectedClinicDate));
                        enableField('appointment_date');
                        enableField('appointment_time')
                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error fetching available days: ' + error);
                }
            });
        } else {
            $('#clinic_name').html('<option value="" hidden>Select Hospital</option>');
        }
    });


    // Fetch booked times when an appointment date is selected
    $('#appointment_date').change(function () {
        selectedClinicDate = $(this).val().trim();

        if (selectedClinicDate) {
            $('#appointment_time').empty().append('<option value="" hidden>Select Time</option>'); // Reset appointment time 
            $('#btn-submit').prop("disabled", true);

            populateTimeSlots();

        } else {
            $('#appointment_time').html('<option value="" hidden>Select Time</option>');
        }
    });

    $('#appointment_time').change(function () {
        selectedClinicTimePeriod = $(this).val().trim();
        $('#btn-submit').prop("disabled", false);
    });

    $('#btn-submit').click(function () {
        saveProfile();
    });

    function saveProfile() {
        if (selectedPatientId, selectedClinicId, selectedHospitalId, selectedClinicDate, selectedClinicTimePeriod, patientProvince) {
            $.ajax({
                type: 'POST',
                url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php',
                data: {
                    province: patientProvince,
                    patient_id: selectedPatientId,
                    clinic_id: selectedClinicId,
                    hospital_id: selectedHospitalId,
                    clinic_date: selectedClinicDate,
                    clinic_time_period: selectedClinicTimePeriod
                },
                success: function (response) {

                    if (response.status === "success") {
                        alert(response.message);
                        window.location.href = "/national-e-clinic-portal/index.php?page=home";
                    } else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error saving the appointment: ' + error);
                }
            });

        }

    }


    function parseTime(timeStr) {
        let parts = timeStr.trim().split(/(\d+)/);
        let hour = parseInt(parts[1]);
        let minute = parseInt(parts[3]);
        let isPM = parts[4].trim() === 'PM';

        // Convert 12-hour format to 24-hour format
        hour = hour === 12 ? (isPM ? 12 : 0) : hour + (isPM ? 12 : 0);

        let time = new Date();
        time.setHours(hour, minute, 0, 0);
        return time;
    }


    function getReservedAppointments() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/national-e-clinic-portal/includes/appointment/appointment-book.inc.php',
                type: 'POST',
                data: {
                    province: patientProvince,
                    hospital_id: selectedHospitalId,
                    clinic_id: selectedClinicId,
                    appointment_date: selectedClinicDate
                },
                success: function (response) {
                    resolve(response.data); // Return the data on success
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching time slots:', error);
                    reject(error); // Reject the promise if there's an error
                }
            });
        });
    }


    async function populateTimeSlots() {
        try {
            let reservedTimeSlots = await getReservedAppointments();

            if (selectedClinicTime) {

                var timearray = selectedClinicTime.split("-");

                let startTime = parseTime(timearray[0]);
                let endTime = parseTime(timearray[1]);

                // Create time slots from start to end time with 20-minute intervals
                while (startTime < endTime) {
                    var startTimeString = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h12' }); // Format as HH:MM AM/PM

                    var startTimeClone = new Date(startTime.getTime());
                    startTimeClone.setMinutes(startTimeClone.getMinutes() + 20);
                    var endTimeString = startTimeClone.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h12' });

                    // Create the time period string (e.g., "08:00 AM - 08:20 AM")
                    var timePeriod = startTimeString + ' - ' + endTimeString;

                    var status = '';
                    // Check the status of the booked time slot
                    if (reservedTimeSlots)
                        status = reservedTimeSlots.find(appointment => appointment.time_period === timePeriod)?.status;

                    // Create option element
                    var option = null;

                    // Change color based on status
                    if (status === 'APPROVED') {
                        option = $('<option></option>').attr('value', timePeriod).text(`${timePeriod} \u00A0\u00A0\u00A0 RESERVED \u00A0\u00A0\u00A0 ${status}`);
                        option.css('color', 'green'); // Approved - green
                        option.prop('disabled', true); // Disable time slots
                    } else if (status === 'PENDING') {
                        option = $('<option></option>').attr('value', timePeriod).text(`${timePeriod} \u00A0\u00A0\u00A0 RESERVED \u00A0\u00A0\u00A0 ${status}`);
                        option.css('color', 'orange'); // Pending - orange
                        option.prop('disabled', true); // Disable time slots
                    } else {
                        option = $('<option></option>').attr('value', timePeriod).text(timePeriod);
                    }

                    $('#appointment_time').append(option);

                    startTime.setMinutes(startTime.getMinutes() + 20); // Increment by 20 minutes


                }


            }
        } catch (error) {
            console.log("Failed to fetch time slots:", error);
        }
    }

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

    function customizeDatePicker(day) {
        let today = new Date();

        // Get next available weekday
        let startDate = new Date();
        startDate.setDate(today.getDate() + ((7 + day - today.getDay()) % 7 || 7)); // restrict dates to available clinic days
        let firstAllowedDay = startDate.toISOString().split('T')[0];

        // update the date input
        let $dateInput = $("#appointment_date");
        $dateInput.attr("min", firstAllowedDay)
            .val(firstAllowedDay)
            .attr("step", 7)  // Allow only weekly selection
            .trigger("change"); // Trigger change event manually
    }


    function getDayNumber(dayName) {
        const days = { "Sunday": 0, "Monday": 1, "Tuesday": 2, "Wednesday": 3, "Thursday": 4, "Friday": 5, "Saturday": 6 };
        return days[dayName] ?? -1; // Return -1 if the input is invalid
    }

});