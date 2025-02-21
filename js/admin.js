document.addEventListener("DOMContentLoaded", function () {
    let menus = document.querySelectorAll('.menu'); // Select all menu items

    // Get active menu from URL
    const urlParams = new URLSearchParams(window.location.search);
    const activePage = urlParams.get('content') || 'mnu1'; 

    console.log(activePage);

    menus.forEach(menu => menu.classList.remove('active')); // Remove 'active' from all menu items

    document.getElementById(activePage)?.classList.add('active'); // Set active class
    
    // document.getElementById('mnu1').classList.add('active');
    // menus.forEach(menu => {
    //     menu.addEventListener('click', event => {
    //         event.stopPropagation();
    //         menus.forEach(m => m.classList.remove('active')); // Remove 'active' from all menu items

    //         // Find the top-level `.menu` item and add 'active'
    //         let targetMenu = event.target.closest('.menu');
    //         if (targetMenu) {
    //             targetMenu.classList.add('active');
    //         }
    //     });
    // });
});

