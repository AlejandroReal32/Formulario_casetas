// login/script.js
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.querySelector('.toggle-btn');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleBtn.textContent = 'Hide';
    } else {
        passwordInput.type = 'password';
        toggleBtn.textContent = 'Show';
    }
}


document.addEventListener('DOMContentLoaded', function() {
    setupRealTimeValidation();
    handleFormSubmission();
    setupRememberMe();
    setupKeyboardShortcuts();
    

    document.getElementById('username').focus();
    
    // Animaciones de entrada
    const loginContainer = document.querySelector('.login-container');
    loginContainer.style.opacity = '0';
    loginContainer.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        loginContainer.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        loginContainer.style.opacity = '1';
        loginContainer.style.transform = 'translateY(0)';
    }, 100);
});