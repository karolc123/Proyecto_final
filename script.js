document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    

    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    
    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden');
        return;
    }

    
    
});
