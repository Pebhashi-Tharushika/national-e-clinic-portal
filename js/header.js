const accountLink = document.getElementById('account-link');
const dropdownMenu = document.getElementById('dropdown-menu');
let isOpenDropdown = false;


// Toggle dropdown on click
accountLink.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent default anchor tag behavior
  const dropdown = accountLink.parentElement;
  dropdown.classList.toggle('show');
  if(!isOpenDropdown){
    accountLink.classList.add('active');
    isOpenDropdown = true;
  }else{
    accountLink.classList.remove('active');
    isOpenDropdown = false
  }
});

// Close the dropdown when clicking outside
document.addEventListener('click', (event) => {
  if (!event.target.closest('.dropdown')) {
    document.querySelectorAll('.dropdown.show').forEach((dropdown) => {
      dropdown.classList.remove('show');
    });
    accountLink.classList.remove('active');
    isOpenDropdown = false
  }
});

