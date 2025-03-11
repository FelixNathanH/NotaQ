// Toggle password function for Password Field
$('#togglePassword').on('click', function() {
    // Get the password input field
    var passwordField = $('#password');
    var passwordFieldType = passwordField.attr('type');

    // Toggle the password field type
    if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        $(this).html('<span class="fas fa-eye-slash"></span>'); // Change icon to eye-slash
    } else {
        passwordField.attr('type', 'password');
        $(this).html('<span class="fas fa-eye"></span>'); // Change icon to eye
    }
});



// Toggle swtiching between sign-in and sign-up
const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });