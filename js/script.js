if (document.getElementById('otpbtn')) {
    document.getElementById('otpbtn').addEventListener('click',()=>{
        const email = document.getElementById("email").value;
        if (email === '' || email.indexOf('@')===-1) {
            alert('Please enter a valid email.')
        }
        else {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById('resText').innerHTML = this.responseText;
                console.log('OTP sent successfully');
            }
           xhttp.open("POST", "db/forgot.php?email="+email, true);
           xhttp.send(email);
           document.getElementById('otp-block').style.display='block';
        }
    });
}

if(document.querySelector('#view-password')) {
    document.querySelector('#view-password').addEventListener('click', () => {
        let p = document.querySelector('#login-eye');
        let pass = document.querySelector('#lgnpassword');
        if(pass.type==='password') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-fill.svg');
            pass.type='text';
        }
        else if(pass.type==='text') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-slash-fill.svg');
            pass.type='password';
        }
    });
}

if(document.querySelector('#view-password-reg')) {
    document.querySelector('#view-password-reg').addEventListener('click', () => {
        let p = document.querySelector('#login-eye-pass');
        let pass = document.querySelector('#regpassword');
        if(pass.type==='password') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-fill.svg');
            pass.type='text';
        }
        else if(pass.type==='text') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-slash-fill.svg');
            pass.type='password';
        }
    });
}

if(document.querySelector('#view-cpassword-reg')) {
    document.querySelector('#view-cpassword-reg').addEventListener('click', () => {
        let p = document.querySelector('#login-eye-cpass');
        let pass = document.querySelector('#confpassword');
        if(pass.type==='password') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-fill.svg');
            pass.type='text';
        }
        else if(pass.type==='text') {
            p.removeAttribute('src');
            p.setAttribute('src','imgs/icons/eye-slash-fill.svg');
            pass.type='password';
        }
    });
}
