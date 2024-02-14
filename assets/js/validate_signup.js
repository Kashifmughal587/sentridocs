document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('signupForm');

    form.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        const username = form.querySelector('#username').value;
        const password = form.querySelector('#password').value;

        if (username.trim() === '' || password.trim() === '') {
            alert('Please fill out all fields.');
            return false;
        }

        return true;
    }
});
