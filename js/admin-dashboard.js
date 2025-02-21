Chart.register(ChartDataLabels);
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
    document.getElementById("num-appointments").innerText = '735'; // hardcode appointments
    document.getElementById("num-clinics").innerText = '2,386'; // hardcode clinics
    document.getElementById("num-hospitals").innerText = '425'; // hardcode hospitals


    /* --------------------------------- line chart, pie chart and area chart -----------------------------------*/

    const stackedCtx = document.getElementById('stacked-bar-chart').getContext('2d');
    const pieCtx = document.getElementById('pie-chart').getContext('2d');
    const stackedAreaCtx = document.getElementById('stacked-area-chart').getContext('2d');
    const areaCtx = document.getElementById('area-chart').getContext('2d');

    // Destroy existing chart instances if they exist
    if (Chart.getChart(stackedCtx)) {
        Chart.getChart(stackedCtx).destroy();
    }
    if (Chart.getChart(pieCtx)) {
        Chart.getChart(pieCtx).destroy();
    }
    if (Chart.getChart(stackedAreaCtx)) {
        Chart.getChart(stackedAreaCtx).destroy();
    }
    if (Chart.getChart(areaCtx)) {
        Chart.getChart(areaCtx).destroy();
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
                data: [51971, 73061, 94151, 119007, 152148, 262870],
                backgroundColor: ['#002244', '#00008B', '#0000FF', '#1da1f2', '#00CCFF', '#A4DDED'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14 // Set font size
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

    // Create the stacked area chart
    new Chart(stackedAreaCtx, {
        type: 'line',
        data: {
            labels: ['2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035'],
            datasets: [
                {
                    label: 'Clinic',
                    data: [1809, 1760, 1894, 2217, 2199, 2438, 2622, 3006],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1.5,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }, {
                    label: 'Hospital',
                    data: [287, 261, 293, 307, 330, 378, 409, 434],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1.5,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }

            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                datalabels: {
                    display: false // Hide actual values in the bar chart
                }
            },
            elements: {
                line: {
                    // tension: 0.4  // Smooth curve
                }
            },
            scales: {
                x: {
                    stacked: true  // Stack X-axis values
                },
                y: {
                    stacked: true, // Stack Y-axis values
                    min: 1700,
                    max: 3500,
                    ticks: {
                        count: 6,
                        beginAtZero: false,
                        autoSkip: false,
                        stepSize: 300,
                    }
                }
            }
        }
    });

    // Create the area chart
    new Chart(areaCtx, {
        type: 'line',
        data: {
            labels: ['2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035'],
            datasets: [
                {
                    label: 'Patient',
                    data: [729163, 726511, 734141, 747474, 740967, 749925, 751991, 758442],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1.5,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }

            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                datalabels: {
                    display: false // Hide actual values in the bar chart
                }
            },
            scales: {
                x: {
                    stacked: true  // Stack X-axis values
                },
                y: {
                    stacked: true, // Stack Y-axis values
                    min: 725000,
                    max: 760000,
                    ticks: {
                        count: 7,
                        beginAtZero: false,
                        autoSkip: false,
                        stepSize: 5000,
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

