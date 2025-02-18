const accountLink = document.getElementById('account-link');
const contactLink = document.getElementById('contact-link');
const dropdownMenu = document.getElementById('dropdown-menu');
let isOpenDropdownAccount = false;
let isOpenDropdownContact = false;


// Toggle account dropdown on click
accountLink.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent default anchor tag behavior
  const dropdown = accountLink.parentElement;
  dropdown.classList.toggle('show');
  if (!isOpenDropdownAccount) {
    accountLink.classList.add('active');
    isOpenDropdownAccount = true;
  } else {
    accountLink.classList.remove('active');
    isOpenDropdownAccount = false
  }
});

// Close the  account dropdown when clicking outside
document.addEventListener('click', (event) => {
  if (!event.target.closest('#dropdown-account')) {
    document.querySelectorAll('#dropdown-account.show').forEach((dropdown) => {
      dropdown.classList.remove('show');
    });
    accountLink.classList.remove('active');
    isOpenDropdownAccount = false
  }
});


// Toggle contact dropdown on click
contactLink.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent default anchor tag behavior
  const dropdown = contactLink.parentElement;
  dropdown.classList.toggle('show');
  if (!isOpenDropdownContact) {
    contactLink.classList.add('active');
    isOpenDropdownContact = true;
  } else {
    contactLink.classList.remove('active');
    isOpenDropdownContact = false
  }
});

// Close the  contact dropdown when clicking outside
document.addEventListener('click', (event) => {
  if (!event.target.closest('#dropdown-contact')) {
    document.querySelectorAll('#dropdown-contact.show').forEach((dropdown) => {
      dropdown.classList.remove('show');
    });
    contactLink.classList.remove('active');
    isOpenDropdownContact = false
  }
});

//alert to confirm logout
function confirmLogout() {
  return confirm("Are you sure you want to logout?");
}
