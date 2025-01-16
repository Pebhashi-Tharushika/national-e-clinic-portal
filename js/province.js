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
                url: '/national-e-clinic-portal/includes/clinic-function.inc.php',
                type: 'POST',
                data: {
                    action: 'deleteClinic',  // Action to trigger the delete
                    id: clinicId,
                    province: province
                },
                success: function(response) {
                    if ($.trim(response) === 'success') {
                        row.fadeOut(500, function() { $(this).remove(); });// On success, remove the row from the table
                    } else {
                        alert('Error deleting the clinic.');
                    }
                },
                error: function() {
                    alert('AJAX request failed.');
                }
            });
        }
    });
});