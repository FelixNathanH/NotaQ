<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/logStaff.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome-animation.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/dist/css/adminlte.min.css') ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">

</head>

<body class="main">

    <!-- Container -->
    <div class="container" id="container">
        <!-- Sign-up -->
        <div class="form-container sign-up-container" id="signUpPanel">
            <div class="card-header text-center">
                <a class="h1"><b>Nota</b>Queue</a>
            </div>
        </div>
        <!-- Sign-in -->
        <div class="form-container sign-in-container" id="signInPanel">
            <div class="card-header text-center">
                <a class="h1"><b>Nota</b>Queue</a>
            </div>
            <div class="card-body">
                <form name="login" id="quickForm">
                    <?= csrf_field(); ?>
                    <span>Silahkan masukan email dan password untuk menggunakan platform</span>
                    <!-- Email -->
                    <div class="form-group">
                        <div class="inputGroup">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <div class="inputGroup">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <!-- Google Recaptcha -->
                    <!-- <div class="g-recaptcha" data-sitekey="6LeyX-IpAAAAAIbQtozzPDj7JmSMz3s6zRzopA_J"></div> -->
                    <button class="button-sign-in" type="button" name="btnModal" id="btnModal">Sign In</button>
                    <a class="forgot-password" href="<?= base_url('/login') ?>">login untuk pemilik bisnis</a>
                </form>
            </div>
        </div>
        <!-- Overlay Container -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Staff Login</h1>
                    <p>Ini merupakan page untuk login staff, tolong masukan email dan password</p>
                    <i class="fa-solid fa-clipboard-user"></i>
                    <!-- <p>Tolong masukan email dan password untuk login</p> -->
                </div>
            </div>
        </div>
    </div>


    <!-- Popup -->
    <div class="popup-overlay" id="popup" style="display: none;">
        <div class="box">
            <div class="wave -one"></div>
            <div class="wave -two"></div>
            <div class="wave -three"></div>
            <div class="title" id="popup-title">Loading!</div>
            <p class="popup-message" id="popup-message">Checking registration status</p>
        </div>
        <!-- <button class="button-pop-up">Switch</button> -->
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Local JS -->
    <script src="<?= base_url('asset/js/main.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jquery-validation -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <!-- Google Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Jquery logics -->
    <script>
        $(document).ready(function() {
            // Form Validation (Login)
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: "'email' tidak boleh kosong",
                        email: "Tolong masukan alamat email yang valid",
                    },
                    password: {
                        required: "'password' tidak boleh kosong",
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).css('font-size', '14px'); // Reset font size when valid
                }
            })
        })
        // Button sign in/login
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
                console.log(formData);
                // Show the loading screen inside a Swal
                $('#popup').show();
                // $('#container').hide();
                // AJAX request
                $.ajax({
                    method: 'POST',
                    dataType: 'json', // Use dataType instead of type
                    url: '<?= base_url("/staff/auth") ?>',
                    data: formData,
                    success: function(response) {
                        console.log('AJAX request successful!');
                        console.log('Response:', response);

                        // Check if authentication was successful
                        if (response.success) {
                            // Redirect to dashboard or another page
                            window.location.href = '/invoice';
                        } else {
                            // Display error message if authentication failed
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                            setTimeout(function() {
                                window.location.href = '/staff/login';
                            }, 3000);
                            grecaptcha.reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed!');
                        console.log('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again later.',
                        });
                        grecaptcha.reset();
                    }
                });
            } else {
                console.log('Data is empty or has not been filled');
                // Optionally, you can show the required message for empty fields here
            }
        });
        $('.button-pop-up').click(function() {
            if ($('#popup-title').text() === "Success!") {
                $('#popup-title').fadeOut(300, function() {
                    $(this).text('Error!').fadeIn(300);
                });
                $('.wave').css('background', 'red'); // Change wave color to error state
                $('.box').animate({
                    width: '400px',
                }, 1000); // Slowly expand the box
                $('.wave').animate({
                    width: '800px',
                    height: '800px',
                }, 1000); // Slowly expand the wave

                $('#popup-message').fadeOut(300, function() {
                    $(this).text('User already exist!, please contact your supervisor').fadeIn(300);
                });
            } else {
                $('#popup-title').fadeOut(300, function() {
                    $(this).text('Success!').fadeIn(300);
                });
                $('.wave').css({
                    'background': 'green', // Update background color
                });
                $('.box').animate({
                    width: '400px',
                }, 1000);
                $('.wave').animate({
                    width: '800px',
                    height: '800px',
                }, 1000); // Slowly expand the wave
                $('#popup-message').fadeOut(300, function() {
                    $(this).text('Thank you, a verification link has been sent to your email').fadeIn(300);
                });
            }
        });
    </script>
    <!-- Flashdata -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for flashdata messages
            <?php if (session()->getFlashdata('success')): ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            <?php elseif (session()->getFlashdata('error')): ?>
                Swal.fire({
                    title: 'Error!',
                    text: '<?= session()->getFlashdata('error') ?>',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>