const wrapper = document.querySelector('.login-container');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');

registerLink.addEventListener('click',()=>{
    console.log('active');
    wrapper.classList.add('active');
});

loginLink.addEventListener('click',()=>{
    console.log('remove');
    wrapper.classList.remove('active');
});