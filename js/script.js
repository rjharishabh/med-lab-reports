const regBtn=document.querySelector("[data-bs-target='#register']");
const lgnBtn=document.querySelector("[data-bs-target='#login']");
const login=document.getElementById('login');
const register=document.getElementById('register');

regBtn.addEventListener('click',()=>{
    login.classList.remove('show');
    regBtn.classList.remove('btn-info');
    regBtn.classList.add('btn-secondary');
    regBtn.setAttribute('disabled',true);
    lgnBtn.removeAttribute('disabled');
    lgnBtn.classList.remove('btn-secondary');
    lgnBtn.classList.add('btn-info');
});

lgnBtn.addEventListener('click',()=>{
    register.classList.remove('show');
    lgnBtn.classList.remove('btn-info');
    lgnBtn.classList.add('btn-secondary');
    lgnBtn.setAttribute('disabled',true);
    regBtn.removeAttribute('disabled');
    regBtn.classList.remove('btn-secondary');
    regBtn.classList.add('btn-info');
});
