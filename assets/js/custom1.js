function validateForm() {
    document.querySelectorAll('.is-invalid').forEach(element => {
        element.classList.remove('is-invalid');
    });

    const firstname = document.getElementById('firstname').value.trim();
    const lastname = document.getElementById('lastname').value.trim();
    const email = document.getElementById('email').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmpassword').value.trim();

    let isValid = true;

    if (firstname === '') {
        document.getElementById('firstname').classList.add('is-invalid');
        document.getElementById('firstnameerror').innerText = 'Please enter your firstname!';
        isValid = false;
    }

    if (lastname === '') {
        document.getElementById('lastname').classList.add('is-invalid');
        document.getElementById('lastnameerror').innerText = 'Please enter your lastname!';
        isValid = false;
    }

    if (email === '') {
        document.getElementById('email').classList.add('is-invalid');
        document.getElementById('emailerror').innerText = 'Please enter a valid email address!';
        isValid = false;
    }

    if (username === '') {
        document.getElementById('username').classList.add('is-invalid');
        document.getElementById('usernameerror').innerText = 'Please choose a username.';
        isValid = false;
    }

    if (password === '') {
        document.getElementById('password').classList.add('is-invalid');
        document.getElementById('passworderror').innerText = 'Please enter your password!';
        isValid = false;
    }

    if (confirmPassword === '') {
        document.getElementById('confirmpassword').classList.add('is-invalid');
        document.getElementById('confirmpassworderror').innerText = 'Please confirm your password!';
        isValid = false;
    }

    if (password !== confirmPassword) {
        document.getElementById('password').classList.add('is-invalid');
        document.getElementById('confirmpassword').classList.add('is-invalid');
        document.getElementById('confirmpassworderror').innerText = 'Passwords do not match!';
        isValid = false;
    }

    return isValid;
}
