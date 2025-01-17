document.addEventListener("DOMContentLoaded", () => {
  const registerLink = document.querySelector(".register-link");
  const loginLink = document.querySelector(".login-link");
  const container = document.querySelector(".login-container");

  // Function to update the URL query parameter
  const updateQueryParam = (key, value) => {
      const url = new URL(window.location);
      url.searchParams.set(key, value);
      window.history.pushState({}, '', url); // Update URL without reloading
  };

  registerLink.addEventListener("click", (e) => {
      e.preventDefault();
      container.classList.add("active");
      updateQueryParam('action', 'register');  // Set action=register
  });

  loginLink.addEventListener("click", (e) => {
      e.preventDefault();
      container.classList.remove("active");
      updateQueryParam('action', 'login');  // Set action=login
  });
});
