<?php
// Start session and include database connection
session_start();
require_once '/national-e-clinic-portal/includes/dbh.inc.php';
require_once '/national-e-clinic-portal/includes/clinic-functions.inc.php';

$province = $_GET['province'] ?? null;

$clinicName = $clinicPlace = $clinicDate = $clinicTime = "";
$clinicDaysError = $clinicNameError = $clinicPlaceError = $timeSlotError = "";
$selectedDays = isset($_POST['clinic_days']) ? $_POST['clinic_days'] : []; // Store selected days
$clinicTimeSlots = isset($_POST['clinic_time_slots']) ? $_POST['clinic_time_slots'] : []; // Store added time slots

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        $clinicDate = isset($_POST['clinic_days']) ? $_POST['clinic_days'] : '';
        $isValid = true;

        // Validation for clinic name
        if (empty($_POST['clinic_name'])) {
            $clinicNameError = "Clinic name is required.";
            $isValid = false;
        } else {
            $clinicName = $_POST['clinic_name'];
        }

        // Validation for clinic place
        if (empty($_POST['clinic_place'])) {
            $clinicPlaceError = "Clinic place is required.";
            $isValid = false;
        } else {
            $clinicPlace = $_POST['clinic_place'];
        }

        // Validation for clinic days
        if (empty($_POST['clinic_days'])) {
            $clinicDaysError = "At least one clinic day must be selected.";
            $isValid = false;
        } else {
            $clinicDate = implode(" and ", $_POST['clinic_days']);
        }

        // Validation for time slots
        if (empty($clinicTimeSlots)) {
            $timeSlotError = "At least one time slot must be selected.";
            $isValid = false;
        } else {
            $clinicTimes = [];
            foreach ($clinicTimeSlots as $timeSlot) {
                list($startTime, $endTime) = explode('-', $timeSlot);
                $startTime12Hour = convertTo12HourFormat(trim($startTime));
                $endTime12Hour = convertTo12HourFormat(trim($endTime));
                $clinicTimes[] = $startTime12Hour . '-' . $endTime12Hour;
            }
            $clinicTime = implode(" and ", $clinicTimes);
        }

        if ($isValid) {
            if (addClinic($province, $clinicName, $clinicPlace, $clinicDate, $clinicTime)) {
                header("Location: {$province}.php");
                exit();
            }
        }
    } elseif (isset($_POST['cancel'])) {
        header("Location: {$province}.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National E Clinic Portal</title>
    <link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">
    <link rel="stylesheet" href="/national-e-clinic-portal/style/add-clinic.css">
    <script>
        function addTimeSlot() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (!startTime || !endTime) {
                alert("Please fill in both start and end time.");
                return;
            }

            const startDate = new Date(`1970-01-01T${startTime}:00`);
            const endDate = new Date(`1970-01-01T${endTime}:00`);

            if (endDate <= startDate) {
                alert("End time must be greater than start time.");
                return;
            }

            const timeSlot = `${startTime}-${endTime}`;

            const timeSlotContainer = document.createElement("div");
            timeSlotContainer.classList.add("time-slot-item");

            const timeSlotText = document.createTextNode(timeSlot);
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "clinic_time_slots[]";
            hiddenInput.value = timeSlot;

            const removeButton = document.createElement("button");
            removeButton.classList.add("remove-button");
            removeButton.innerHTML = "&times;";
            removeButton.onclick = function () {
                timeSlotContainer.remove();
            };

            timeSlotContainer.appendChild(timeSlotText);
            timeSlotContainer.appendChild(hiddenInput);
            timeSlotContainer.appendChild(removeButton);
            document.getElementById("time-slots-container").appendChild(timeSlotContainer);

            document.getElementById('start_time').value = '';
            document.getElementById('end_time').value = '';
        }
    </script>
</head>
<body>
    <h1>Add Clinic</h1>
    <form action="add_clinic.php?province=<?php echo htmlspecialchars($_GET['province']); ?>" method="post" novalidate>
        <!-- Clinic Name and Place -->
        <label for="clinic_name">Clinic Name:</label>
        <input type="text" id="clinic_name" name="clinic_name" value="<?php echo htmlspecialchars($clinicName); ?>">
        <p class='error'><?php echo $clinicNameError; ?></p>

        <label for="clinic_place">Clinic Place:</label>
        <input type="text" id="clinic_place" name="clinic_place" value="<?php echo htmlspecialchars($clinicPlace); ?>">
        <p class='error'><?php echo $clinicPlaceError; ?></p>

        <!-- Select Days -->
        <label for="clinic_date">Clinic Days:</label>
        <div class="checkbox-container">
            <?php
            $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            foreach ($daysOfWeek as $day) {
                $isChecked = in_array($day, $selectedDays) ? "checked" : "";
                echo "<label class='checkbox-item'><input type='checkbox' name='clinic_days[]' value='$day' $isChecked> $day</label>";
            }
            ?>
        </div>
        <p class='error'><?php echo $clinicDaysError; ?></p>

        <!-- Time slots -->
        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time">
        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time">
        <button type="button" onclick="addTimeSlot()">Add Time Slot</button>

        <label for="time_slots">Time Slots Added:</label>
        <div id="time-slots-container">
    <?php
    foreach ($clinicTimeSlots as $timeSlot) {
        echo "<div class='time-slot-item'>
                $timeSlot
                <input type='hidden' name='clinic_time_slots[]' value='$timeSlot'>
                <button class='remove-button' onclick='this.parentElement.remove();'>&times;</button>
              </div>";
    }
    ?>
</div>
        <p class='error'><?php echo $timeSlotError; ?></p>

        <!-- Save and Cancel buttons -->
        <button type="submit" name="save">Save</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
