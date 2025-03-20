document.addEventListener("DOMContentLoaded", function () {
    let menus = document.querySelectorAll('.menu'); // Select all menu items

    // Get active menu from URL
    const urlParams = new URLSearchParams(window.location.search);
    const activePage = urlParams.get('content') || 'mnu1';

    menus.forEach(menu => menu.classList.remove('active')); // Remove 'active' from all menu items

    document.getElementById(activePage)?.classList.add('active'); // Set active class
});

