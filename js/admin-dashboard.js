document.addEventListener("DOMContentLoaded", function () {
    let menus = document.querySelectorAll('.menu'); // Select all menu items

    menus.forEach(menu => menu.classList.remove('active')); // Remove 'active' from all menu items
    document.getElementById('mnu1').classList.add('active');
    menus.forEach(menu => {
        menu.addEventListener('click', event => {
            event.stopPropagation();
            menus.forEach(m => m.classList.remove('active')); // Remove 'active' from all menu items

            // Find the top-level `.menu` item and add 'active'
            let targetMenu = event.target.closest('.menu');
            if (targetMenu) {
                targetMenu.classList.add('active');
            }
        });
    });


    // Mock data simulation 
    document.getElementById("totalPatients").innerText = 150 + Math.floor(Math.random() * 10); // Random patients
    document.getElementById("totalAppointments").innerText = 200 + Math.floor(Math.random() * 5); // Random appointments
    document.getElementById("doctorsAvailable").innerText = 12 + Math.floor(Math.random() * 3); // Random doctors

});

