document.addEventListener("DOMContentLoaded", () => {

  const accountLink = document.getElementById('account-link');
  const contactLink = document.getElementById('contact-link');

  const urlParams = new URLSearchParams(window.location.search); // Get the current page URL
  let activeNavItem = urlParams.get('page') || 'home'; // Get the value of query parameter

  const navItems = document.querySelectorAll('.nav-item');

  if (activeNavItem && activeNavItem !== '') {

    navItems.forEach(nav => nav.classList.remove('active'));
    if (activeNavItem === 'support' || activeNavItem === 'faq') {
      activeNavItem = 'contact'
    }
    const link = document.getElementById(`${activeNavItem}-link`);
    link?.classList.add('active');

  }

  // Toggle account dropdown on click
  accountLink.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default anchor tag behavior
    const dropdown = accountLink.parentElement;
    dropdown.classList.toggle('show');
  });

  // Close the  account dropdown when clicking outside
  document.addEventListener('click', (event) => {
    if (!event.target.closest('#dropdown-account')) {
      document.querySelectorAll('#dropdown-account.show').forEach((dropdown) => {
        dropdown.classList.remove('show');
      });
    }
  });


  // Toggle contact dropdown on click
  contactLink.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default anchor tag behavior
    const dropdown = contactLink.parentElement;
    dropdown.classList.toggle('show');
  });

  // Close the  contact dropdown when clicking outside
  document.addEventListener('click', (event) => {
    if (!event.target.closest('#dropdown-contact')) {
      document.querySelectorAll('#dropdown-contact.show').forEach((dropdown) => {
        dropdown.classList.remove('show');
      });
    }
  });

  //alert to confirm logout
  function confirmLogout() {
    return confirm("Are you sure you want to logout?");
  }

});