Chart.register(ChartDataLabels);
document.addEventListener("DOMContentLoaded", function () {
    console.log(document.documentElement.clientHeight);
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
    document.getElementById("num-appointments").innerText = '735'; // hardcode appointments
    document.getElementById("num-clinics").innerText = '1,386'; // hardcode clinics


    /* --------------------------------- line chart and pie chart -----------------------------------*/

    const stackedCtx = document.getElementById('stacked-bar-chart').getContext('2d');
    const pieCtx = document.getElementById('pie-chart').getContext('2d');

    // Destroy existing chart instances if they exist
    if (Chart.getChart(stackedCtx)) {
        Chart.getChart(stackedCtx).destroy();
    }
    if (Chart.getChart(pieCtx)) {
        Chart.getChart(pieCtx).destroy();
    }

    // Create the stacked bar chart
    new Chart(stackedCtx, {
        type: 'bar', // Bar chart
        data: {
            labels: ['2035 Jan', '2035 Feb', '2035 Mar', '2035 Apr', '2035 May', '2035 Jun', '2035 Jul', '2035 Aug'], // X-axis labels
            datasets: [
                {
                    label: 'Patients',
                    data: [250, 360, 472, 461, 597, 623, 690, 674],
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
                    data: [22, 34, 20, 38, 42, 40, 44, 29],
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
                datalabels: {
                    display: false // Hide actual values in the bar chart
                }
            },
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    min: 0,   // Minimum value
                    max: 800,
                    ticks: {
                        count: 8,
                        beginAtZero: true,
                        autoSkip: false,
                        stepSize: 100,
                    },
                    grid: {
                        drawBorder: false
                    }
                }
            }

        }
    });

    

    // Create the pie chart
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Gastroenterology', 'Rheumatology', 'Urology and Renal', 'Cardiology', 'Pulmonology', 'Oncology'],
            datasets: [{
                data: [ 51971, 73061, 94151, 119007, 152148, 262870],
                backgroundColor: ['#002244', '#00008B', '#0000FF',  '#1da1f2','#00CCFF', '#A4DDED'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 15 // Set font size
                        },
                        boxWidth: 10, // Size of color boxes
                        boxHeight: 10,
                        padding: 10, // Spacing around legend items
                    },
                    align: 'center'
                },
                datalabels: {
                    color: '#fff', // Label text color
                    font: {
                        size: 14, // Font size
                        weight: 'bold'
                    },
                    anchor: 'center', // Positions the label
                    align: 'center', // Centers text within the segment
                    formatter: (value, context) => {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = ((value / total) * 100).toFixed(1) + '%';
                        return percentage; // Show percentage instead of actual value
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

    /* ------------------ map --------------------*/

    const provinces = document.querySelectorAll("svg path");
    const selectedProvince = document.getElementById("selected-province");

    provinces.forEach(province => {
        province.addEventListener("click", async (event) => {
            const provinceTitle = province.getAttribute("title");
            selectedProvince.textContent = `${provinceTitle}`;

            provinces.forEach(p => p.classList.remove("selected"));

            event.target.classList.add("selected");

        });
    });

    // Automatically select Central Province on page load

    const centralProvince = provinces[7];
    if (centralProvince) {
        centralProvince.classList.add("selected");
    }


});

