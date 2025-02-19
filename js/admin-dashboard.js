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
    document.getElementById("num-patients").innerText = '753,209'; // hardcode patients
    document.getElementById("num-appointments").innerText = '788,135'; // hardcode appointments
    document.getElementById("num-clinics").innerText = '855'; // hardcode doctors


    /* --------------------------------- line chart -----------------------------------*/

    const ctx = document.getElementById('stackedBarChart').getContext('2d');

    // Create a stacked bar chart
    const stackedBarChart = new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: ['2035 Jan', '2035 Feb', '2035 Mar', '2035 Apr', '2035 May', '2035 Jun', '2035 Jul', '2035 Aug'], // X-axis labels
            datasets: [
                {
                    label: 'Patients',
                    data: [250, 360, 472, 461, 597, 653, 790, 784],
                    backgroundColor: 'rgba(0, 73, 178, 0.8)',
                    barThickness: 30
                },
                {
                    label: 'Clinics',
                    data: [30, 35, 42, 50, 52, 57, 60, 63],
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    barThickness: 30
                },
                {
                    label: 'Cancelled Appointments',
                    data: [32, 24, 10, 28, 32, 40, 4, 19],
                    backgroundColor: 'rgba(0, 0, 128, 0.8)',
                    barThickness: 30
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            tooltips: {
                displayColors: true,
                callbacks: {
                    mode: 'x',
                },
            },
            plugins: {
                legend: { position: 'bottom' },
            },
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    min: 0,   // Minimum value
                    max: 850,
                    ticks: {
                        count: 17,
                        beginAtZero: true,
                        autoSkip: false,
                        stepSize: 50,
                    },
                    grid: {
                        drawBorder: false
                    }
                }
            }

        }
    });

    /* ------------------  button ------------------*/

    let btns = document.querySelectorAll('#btn-container button');

    btns.forEach(btn => {
        btn.addEventListener('click', event => {
            btns.forEach(btn => btn.classList.remove("clicked"));
            event.target.classList.add('clicked');
        });
    });

    const btnMonth = document.getElementById("month");
    if (btnMonth) {
        btnMonth.click(); // Click the button after DOM is fully loaded
    }


});

