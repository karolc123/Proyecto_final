document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción de envío del formulario por defecto

    // Obtener la cédula ingresada por el usuario
    var cedula = document.getElementById('username').value;

    // Generar una contraseña aleatoria (por ejemplo, de 6 caracteres alfanuméricos)
    var password = generateRandomPassword(6);

    // Simular un proceso de inicio de sesión exitoso
    // Aquí puedes enviar la cédula y la contraseña al servidor para su validación
    // En este ejemplo, solo mostramos la información en la consola del navegador
    console.log('Cédula: ' + cedula);
    console.log('Contraseña generada: ' + password);

    // Mostrar mensaje de éxito
    document.getElementById('loginMessage').textContent = 'Login successful!';
    document.getElementById('loginMessage').style.color = 'green';

    // Puedes redirigir a otra página después del inicio de sesión exitoso
    // window.location.href = 'dashboard.html'; // Ejemplo de redirección a página de dashboard
});

// Función para generar una contraseña aleatoria
function generateRandomPassword(length) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    var password = '';
    for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * chars.length);
        password += chars[randomIndex];
    }
    return password;
}
