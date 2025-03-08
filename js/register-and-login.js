document.addEventListener("DOMContentLoaded", () => {
    const registerLink = document.querySelector(".register-link");
    const loginLink = document.querySelector(".login-link");
    const container = document.querySelector(".login-container");
    const scrollbar = document.getElementById("scroll-container");

    // Function to update the URL query parameter
    const updateQueryParam = (key, value) => {
        const url = new URL(window.location);
        url.searchParams.set(key, value);
        window.history.pushState({}, '', url); // Update URL without reloading
    };

    registerLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearAllErrorMessage();
        clearForm();
        
        container.classList.add("active");
        setTimeout(() => scrollbar.classList.remove("invisible-scrollbar"), 2500); //show scroll bar in signup form
        updateQueryParam('action', 'register');  // Set action=register
    });

    loginLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearAllErrorMessage();
        clearForm();

        container.classList.remove("active");
        scrollbar.classList.add("invisible-scrollbar"); //remove scroll bar in signup form
        updateQueryParam('action', 'login');  // Set action=login
    });


    /* ---------------------------------- signup form - client side form validation ------------------------------------ */

    document.getElementById("signupForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        // Clear previous error messages
        clearAllErrorMessage();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirmPassword").value.trim();
        const role = document.getElementById("role").value;
        const adminCode = document.getElementById("adminCode").value.trim();


        const formData = { name, email, password, confirmPassword, role, adminCode };

        try {
            // Send data to server for validation
            const response = await fetch('/national-e-clinic-portal/includes/register-login-logout/register.inc.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.status === 'error') {

                if (result.errors && Object.keys(result.errors).length > 0) {

                    // Display validation errors
                    Object.keys(result.errors).forEach((field) => {
                        const errorElement = document.getElementById(`${field}Error`);
                        console.log(result.errors[field]);
                        errorElement.textContent = result.errors[field];
                        errorElement.style.display = "block";
                    });
                } else {
                    alert(result.message);
                }

            } else if (result.status === 'success') {
                alert(result.message);
                window.location.href = "/national-e-clinic-portal/register-and-login.php?action=login"; // Redirect to the login page
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });


    document.querySelectorAll('.input-box input').forEach((element) => {
        element.addEventListener('input',event =>{
            hideErrorMessage(event.target); // error message disappears when the user starts typing
        });
    });
    

    document.querySelector('.input-box select').addEventListener('change', function (event) {
        hideErrorMessage(event.target); // error message disappears on select change

        const adminCodeDiv = document.getElementById('adminCodeDiv');
    if (this.value === 'admin') {
        adminCodeDiv.style.display = 'block'; // Show Admin Code input
    } else {
        adminCodeDiv.style.display = 'none'; // Hide Admin Code input
    }

    });


    // Function to hide error message of a specific field
    function hideErrorMessage(field) {
        const errorElement = field.closest('.input-box').querySelector('.error-message');
        if (errorElement) {
            errorElement.style.display = "none"; // Hide error message
        }
    }

    function clearAllErrorMessage() {
        document.querySelectorAll(".error-message").forEach((error) => {
            error.style.display = "none";
        });
    }

    function clearForm() {
        document.getElementById("signupForm").reset();
    }


    /* ---------------------------------- login form - client side form validation ------------------------------------ */

    document.getElementById("loginForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        // Clear previous error messages
        clearAllErrorMessage();

        const username = document.getElementById("username").value.trim();
        const pwd = document.getElementById("pwd").value.trim();


        const formData = { username, pwd};

        try {
            // Send data to server for validation
            const response = await fetch('/national-e-clinic-portal/includes/register-login-logout/login.inc.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData),
            });

            const result = await response.json();

            if (result.status === 'error') {

                if (result.errors && Object.keys(result.errors).length > 0) {

                    // Display validation errors
                    Object.keys(result.errors).forEach((field) => {
                        const errorElement = document.getElementById(`${field}Error`);
                        console.log(result.errors[field]);
                        errorElement.textContent = result.errors[field];
                        errorElement.style.display = "block";
                    });
                }

            } else if (result.status === 'success') {
                alert(result.message);
                window.location.href = "/national-e-clinic-portal/index.php?page=home"; // Redirect to the Home page
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });


});

