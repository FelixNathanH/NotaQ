<?= $this->extend('template/index'); ?>
<?= $this->section('links'); ?>

<title><?= $title ?></title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
<?= $this->endSection('links'); ?>

<!-- Main Content -->
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="container mt-5 pt-5 pb-5">
            <h2>Edit Profile</h2>
            <form name="formProfile" id="quickForm">
                <?= csrf_field(); ?>
                <input type="hidden" name="userId" id="id" value="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= esc($user['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= esc($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="company_name">Company name:</label>
                    <input type="text" class="form-control" name="company" id="company" value="<?= esc($user['company']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone number:</label>
                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?= esc($user['phone_number']) ?>" required>
                </div>

                <button type="button" id="btnUpdate" class="btn btn-primary mt-2">Update Profile</button>
                <button type="button" id="btnDelete" class="btn btn-danger mt-2 float-end" id="deleteAccount">Delete Account</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
<!-- Merupakan extensi dari scripts yang ada pada view template -->
<?= $this->section('scripts'); ?>
<!-- jquery-validation -->
<script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<!-- Script Data Table -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('asset/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('asset/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Script untuk menampilkan DataTable Server Side menggunakan AJAX -->

<!-- Jquery -->
<script>
    $(document).ready(function() {
        let originalForm = $('#quickForm').serialize();
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                company: {
                    required: true,
                },
                phone_number: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Field ini tidak boleh kosong, mohon isi nama anda",
                },
                email: {
                    required: "Field ini tidak boleh kosong, mohon isi email anda",
                    email: "Mohon diisi dengan email yang valid",
                },
                company: {
                    required: "Field ini tidak boleh kosong, mohon isi nama perusahaan anda",
                },
                phone_number: {
                    required: "Field ini tidak boleh kosong, mohon isi nomor telepon anda",
                },
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
        // Button Update
        $('#btnUpdate').click(function(e) {
            e.preventDefault();

            if ($('#quickForm').valid()) {
                let currentForm = $('#quickForm').serialize();

                // Check if the form has changed
                if (currentForm === originalForm) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada perubahan',
                        text: 'Data yang Anda masukkan sama seperti sebelumnya.'
                    });
                    return;
                }

                // Proceed with AJAX request
                $.ajax({
                    url: "<?= site_url('updateProfile') ?>",
                    type: "POST",
                    data: currentForm,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                            // Update the original form snapshot
                            originalForm = currentForm;
                        } else if (response.status === 'error') {
                            let errorMessages = '';
                            if (typeof response.errors === 'object') {
                                errorMessages = Object.values(response.errors).join('\n');
                            } else if (typeof response.message === 'string') {
                                // If it's a custom error like email already in use
                                errorMessages = response.message;
                            } else {
                                errorMessages = 'Terjadi kesalahan yang tidak diketahui.';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: errorMessages
                            });
                        }
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat memperbarui profil.'
                        });
                    }
                });
            }
        });
        // Button Delete
        $('#btnDelete').click(function() {
            Swal.fire({
                title: 'Yakin ingin menghapus akun?',
                text: "Tindakan ini tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus akun',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX to delete
                    $.ajax({
                        url: "<?= site_url('deleteAccount') ?>",
                        type: "POST",
                        data: {
                            user_id: "<?= session()->get('user_id') ?>"
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Akun dihapus',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Redirect after success
                                    window.location.href = "<?= site_url('/login') ?>";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan',
                                text: 'Gagal menghapus akun.'
                            });
                        }
                    });
                }
            });
        });
    })
</script>

<?= $this->endSection('scripts'); ?>