document.addEventListener("DOMContentLoaded", () => {
    const registerLink = document.querySelector(".register-link");
    const loginLink = document.querySelector(".login-link");
    const container = document.querySelector(".login-container");
  
    registerLink.addEventListener("click", (e) => {
      e.preventDefault();
      container.classList.add("active");
    });
  
    loginLink.addEventListener("click", (e) => {
      e.preventDefault();
      container.classList.remove("active");
    });
  });
  