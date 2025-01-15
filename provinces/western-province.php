<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../view style.css"> <!-- Linking the CSS file -->
  <link rel="shortcut icon" href="../Logo.JPG" >

  <title>Clinic Details</title>
</head>
<body>
<h1 class="heading"> Clinic Details of Western Provincial General Hospital</h1>
  <!-- Conditionally add button to add new clinics -->
  <a href="add_clinic.php?province=western_province" 
    style="<?php echo isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true ? 'display: inline-block; padding: 10px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px;' : 'display: none;'; ?>">ADD CLINIC</a>
  
  <?php
  require_once 'functions.inc.php';  

  $province = 'western_province';
  $clinicDetails = getClinicDetails($province);

  if ($clinicDetails !== false && count($clinicDetails) > 0) {
    echo "<table id='details'>";
    echo "<tr>";
        echo "<th>Clinic Name</th>";
        echo "<th>Place</th>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        // Conditionally add another column if the user is an admin 
        echo isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true ? '<th>Actions</th>' : '';
    echo "</tr>";


      // Loop through the clinic details and populate the table
      foreach ($clinicDetails as $clinic) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Name']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Place']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Date']) . "</td>";
        echo "<td>" . htmlspecialchars($clinic['Clinic_Time']) . "</td>";
        
        // Check if the user is an admin, if so, display the DELETE button

      if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
          echo '<td><button class="btnDelete" data-id="' . htmlspecialchars($clinic['Clinic_Id']) . '" data-province="western_province">DELETE</button></td>';
      }


      
    
        echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "Empty Table";
  }
  mysqli_close($conn);
  ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle the click event on the delete button
    $('.btnDelete').on('click', function() {
        // Get the clinic ID and province from the button's data attributes
        var clinicId = $(this).data('id');
        var province = $(this).data('province');
        var row = $(this).closest('tr'); // Get the row that contains the clicked button
        
        // Show a confirmation pop-up
        if (confirm('Are you sure you want to delete this clinic?')) {
            // If the user confirms, send an AJAX request to delete the record
            $.ajax({
                url: 'delete_clinic.php', 
                type: 'POST',
                data: {
                    id: clinicId,
                    province: province
                },
                success: function(response) {
                    // On success, remove the row from the table
                    if ($.trim(response) === 'success') {
                        row.remove();
                    } else {
                        alert('Error deleting the clinic.');
                    }
                },
                error: function() {
                    alert('Error with the AJAX request.');
                }
            });
        }
    });
});
</script>

</body>
</html>