<section id="admin-dashboard-container">
    <div class="sidebar" id="sidebar">

        <a href="#">
            <div id="mnu1" class="menu">
                <h3>Dashboard</h3>

                <span><i class="fa-light fa-objects-column"></i></span>

            </div>
        </a>

        <a href="#">
            <div id="mnu2" class="menu">
                <h3>Patients</h3>
                <span><i class="fa-sharp fa-regular fa-bed-pulse"></i></span>
            </div>
        </a>

        <a href="#">
            <div id="mnu3" class="menu">
                <h3>Appointments</h3>
                <span><i class="fa-regular fa-calendar-check"></i></span>
            </div>
        </a>

        <a href="#">
            <div id="mnu4" class="menu">
                <h3>Clinics</h3>
                <span><i class="fa-regular fa-hospital"></i></span>
            </div>
        </a>

        <a href="#">
            <div id="mnu5" class="menu">
                <h3>Request</h3>
                <span><i class="fa-regular fa-comment-medical"></i></span>
            </div>
        </a>
    </div>

    <div id="overview-wrapper">
        <div class="overview" id="overview1">
            <div id="overview-header">
                <h3>DASHBOARD</h3>
                <h6>Welcome to National E-Clinic Portal Admin Panel</h6>
            </div>
            <div id="overview-content">
                <div class="dashboard-card" id="patients">
                    <h6>Today's Patients</h6>
                    <div class="qty">
                        <div class="count">
                            <i class="fa-regular fa-arrow-up up"></i>
                            <p id="num-patients">753,209</p>
                        </div>

                        <i class="fa-solid fa-wheelchair"></i>
                    </div>
                    <div class="change">
                        <p>compare to last week</p>
                        <p>20%</p>
                    </div>
                </div>
                <div class="dashboard-card" id="appointments">
                    <h6>Today's Appointments</h6>
                    <div class="qty">
                        <div class="count">
                            <i class="fa-regular fa-arrow-down down"></i>
                            <p id="num-appointments">788,135</p>
                        </div>

                        <i class="fa-solid fa-calendar-clock"></i>
                    </div>
                    <div class="change">
                        <p>compare to last week</p>
                        <p>16%</p>
                    </div>

                </div>
                <div class="dashboard-card" id="clinics">
                    <h6>Today's Clinics</h6>
                    <div class="qty">
                        <div class="count">
                            <i class="fa-regular fa-arrow-up up"></i>
                            <p id="num-clinics">855</p>
                        </div>

                        <i class="fa-solid fa-house-medical"></i>
                    </div>
                    <div class="change">
                        <p>compare to last week</p>
                        <p>10%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="overview" id="overview2">

            <div id="bar-graph">
                <h6>Analytics of patients, clinics and cancelled appointments</h6>
                <div id="selection">
                    <select id="province" name="province">
                        <option value="Central" selected>Central</option>
                        <option value="Eastern">Eastern</option>
                        <option value="North Central">North Central</option>
                        <option value="North Western">North Western</option>
                        <option value="Northern">Northern</option>
                        <option value="Sabaragamuwa">Sabaragamuwa</option>
                        <option value="Southern">Southern</option>
                        <option value="Uva">Uva</option>
                        <option value="Western">Western</option>
                    </select>
                    <div id="btn-container">
                        <button id="year">Year</button>
                        <button id="month">Month</button>
                        <button id="day">Day</button>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="stackedBarChart"></canvas>
                </div>
            </div>
            <div id="province-info"></div>

        </div>
    </div>
</section>