function validateForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMsg = document.getElementById('error-msg');

    if (username.length < 3) {
        errorMsg.innerHTML = 'Username must be at least 3 characters long.';
        return false;
    }

    if (password.length < 6) {
        errorMsg.innerHTML = 'Password must be at least 6 characters long.';
        return false;
    }

    errorMsg.innerHTML = '';
    alert('Login successful!');
    window.location.assign("main.html");
    return false;
}
