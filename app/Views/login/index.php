<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/logReg.css') ?>">
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
            <form name="register" id="quickFormReg">
                <?= csrf_field(); ?>
                <span>Please input your credential to continue</span>
                <!-- Username -->
                <div class="form-group">
                    <div class="inputGroup">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
                    </div>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <div class="inputGroup">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <!-- Company -->
                <div class="form-group">
                    <div class="inputGroup">
                        <input type="text" name="company" id="company" class="form-control" placeholder="Company">
                    </div>
                </div>
                <!-- Phone number -->
                <div class="form-group">
                    <div class="inputGroup">
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone number" inputmode="numeric">
                    </div>
                </div>
                <!-- Password -->
                <div class="form-group">
                    <div class="inputGroup">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <button type="button" id="togglePassword" class="btn btn-outline-secondary position-absolute">
                            <span class="fas fa-eye"></span>
                        </button>
                    </div>
                </div>
                <!-- Google Recaptcha -->
                <button class="button-sign-up" type="button" name="btnModalReg" id="btnModalReg">Sign Up</button>
            </form>
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
                    <button class="button-sign-in" type="button" name="btnModal" id="btnModal">Sign In</button>
                    <a class="forgot-password" href="<?= base_url('/forgetPassword') ?>">Lupa password</a>
                    <a class="forgot-password" href="<?= base_url('/staff/login') ?>">Login untuk staff</a>
                </form>
            </div>
        </div>
        <!-- Overlay Container -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 id="overlay-left-header">Welcome Back!</h1>
                    <p id="overlay-left-p">To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Tidak memiliki akun ?</h1>
                    <p>Silahkan memasukan data diri setelah menekan sign up</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Container -->
    <div class="container2" id="container2" style="display: none;">
        <div class="box">
            <h1>Success!!</h1>
            <p> Thank you! Your verification link will come shortly, please check your inbox.</p>
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
                        required: "'email' cannot be empty",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "'password' cannot be empty",
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).css('font-size', '14px');
                }
            })
            // Form Validation (Register)
            $('#quickFormReg').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                    company: {
                        required: true,
                    },
                    phone_number: {
                        required: true,
                        digits: true,
                    },
                },
                messages: {
                    name: {
                        required: "'Name' cannot be empty",
                    },
                    email: {
                        required: "'email' cannot be empty",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "'password' cannot be empty",
                    },
                    company: {
                        required: "'company' cannot be empty",
                    },
                    phone_number: {
                        required: "'phone' cannot be empty",
                        digits: "Please enter a valid phone number"
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).css('font-size', '14px');
                }
            })
        })
        // Button sign in/login
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
                console.log(formData);
                $('#popup').show();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?= base_url("/loginAuth") ?>',
                    data: formData,
                    success: function(response) {
                        console.log('AJAX request successful!');
                        console.log('Response:', response);
                        if (response.success) {

                            window.location.href = '/';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                            setTimeout(function() {
                                window.location.href = '/login';
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
            }
        });
        // Button sign up/register
        $('#btnModalReg').click(function() {
            if ($('#quickFormReg').valid()) {
                var formData = $('#quickFormReg').serialize();
                console.log(formData);
                $('#popup').show();
                $('#container').hide();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?= base_url("/registerAuth") ?>',
                    data: formData,
                    success: function(response) {
                        console.log('AJAX request successful!');
                        console.log('Response:', response);
                        if (response.success) {
                            $('#popup-title').fadeOut(300, function() {
                                $(this).text('Success!').fadeIn(300);
                            });
                            $('.wave').css({
                                'background': 'green',
                            });
                            $('.box').animate({
                                width: '400px',
                            }, 1000);
                            $('.wave').animate({
                                width: '800px',
                                height: '800px',
                            }, 1000);
                            $('#popup-message').fadeOut(300, function() {
                                $(this).text('Thank you, a verification link has been sent to your email').fadeIn(300);
                            });

                        } else if (response.error) {
                            $('#popup-title').fadeOut(300, function() {
                                $(this).text('Error!').fadeIn(300);
                            });
                            $('.wave').css('background', 'red');
                            $('.box').animate({
                                width: '400px',
                            }, 1000);
                            $('.wave').animate({
                                width: '800px',
                                height: '800px',
                            }, 1000);

                            $('#popup-message').fadeOut(300, function() {
                                $(this).text('User already exist!, please contact your supervisor').fadeIn(300);
                            });
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Your Credintials are Invalid, Please try again!!!',
                                text: response.message,
                            });
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

            }
        });
        $('.button-pop-up').click(function() {
            if ($('#popup-title').text() === "Success!") {
                $('#popup-title').fadeOut(300, function() {
                    $(this).text('Error!').fadeIn(300);
                });
                $('.wave').css('background', 'red');
                $('.box').animate({
                    width: '400px',
                }, 1000);
                $('.wave').animate({
                    width: '800px',
                    height: '800px',
                }, 1000);

                $('#popup-message').fadeOut(300, function() {
                    $(this).text('User already exist!, please contact your supervisor').fadeIn(300);
                });
            } else {
                $('#popup-title').fadeOut(300, function() {
                    $(this).text('Success!').fadeIn(300);
                });
                $('.wave').css({
                    'background': 'green',
                });
                $('.box').animate({
                    width: '400px',
                }, 1000);
                $('.wave').animate({
                    width: '800px',
                    height: '800px',
                }, 1000);
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