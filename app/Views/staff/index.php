<?= $this->extend('template/index'); ?>
<?= $this->section('links'); ?>

<title><?= $title ?></title>
<!-- DataTable -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')  ?>">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
<?= $this->endSection('links'); ?>

<!-- Main Content -->
<?= $this->section('content'); ?>

<!-- DataTable -->
<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Staff List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Tombol Add Users -->
                <div class="btn-addKarywan">
                    <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Staff
                    </a>
                </div>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No telp</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-primary bg-gradient text-white rounded-top-4">
                <h5 class="modal-title d-flex align-items-center gap-2" id="mTitle">
                    <i class="bi bi-person-fill-add"></i>
                    Tambah / Edit Karyawan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 px-5" id="modal-addK">
                <form name="formKaryawan" id="quickForm" class="needs-validation" novalidate>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="staff_id" id="staff_id" value="">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Masukkan Nomor Telepon">
                        </div>
                        <div class="col-md-6">
                            <label for="government_id" class="form-label">Nomor KTP</label>
                            <input type="text" name="government_id" id="government_id" class="form-control" placeholder="Masukkan Nomor KTP">
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" disabled>
                                <button type="button" class="btn btn-outline-primary" id="togglePassword">Ubah Password</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="company_role" class="form-label">Jabatan</label>
                            <input type="text" name="company_role" id="company_role" class="form-control" placeholder="Masukkan Jabatan">
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" id="btnModal" name="update" class="btn btn-success px-4 shadow-sm">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'processing': true,
            'serverSide': false,
            'serverMethod': 'post',
            "ajax": "<?= site_url('staffdtb') ?>",
            "columns": [{
                "data": "nama"
            }, {
                "data": "email"
            }, {
                "data": "phone_number"
            }, {
                "data": "government_id"
            }, {
                "data": "company_role"
            }, {
                "data": "action"
            }]
        });
    });
</script>

<!-- Jquery -->
<script>
    let originalStaffForm = "";

    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone_number: {
                    required: true
                },
                government_id: {
                    required: true,
                },
                password: {
                    required: function() {

                        return $('#btnModal').attr('name') === 'add';
                    },
                    minlength: 8
                },
                company_role: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "nama tidak boleh kosong",
                },
                email: {
                    required: "email tidak boleh kosong",
                    email: "Mohon diisi dengan email yang valid"
                },
                phone_number: {
                    required: "nomor telepon tidak boleh kosong",
                },
                government_id: {
                    required: "nomor KTP tidak boleh kosong",
                },

                password: {
                    required: "password tidak boleh kosong",
                },
                company_role: {
                    required: "Jabatan tidak boleh kosong",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.parent('.input-group').length) {
                    element.parent().after(error);
                } else {
                    element.after(error);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#quickForm').trigger('reset');
            $('#quickForm :input').removeClass('is-invalid');
            $('#quickForm').removeClass('error invalid-feedback');
            $('#btnModal').attr('name', 'add').text('Add Staff');
            $('#quickForm')[0].reset();
        });
        $('#btnAdd').click(function() {
            $('#quickForm')[0].reset();
            $('#staff_id').val('');
            $('#mTitle').text('Tambah Staff');
            $('#btnModal').text('Add Staff').attr('name', 'add');
            $('#password').prop('disabled', false).val('');
            $('#togglePassword').hide();
            $('#exampleModal').modal('show');
        })
        $('#btnModal').on('click', function() {
            if ($('#quickForm').valid()) {
                const action = $(this).attr('name');

                let url = '';
                if (action === 'update') {
                    url = "<?= site_url('staff/edit') ?>";
                } else {
                    url = "<?= site_url('staff/add') ?>";
                }
                const currentForm = $('#quickForm').serialize();

                if (action === 'update' && currentForm === originalStaffForm) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada perubahan',
                        text: 'Data staff tidak berubah dari sebelumnya.'
                    });
                    return;
                }

                $.ajax({
                    url: url,
                    method: "POST",
                    data: currentForm,
                    success: function(response) {
                        if (response.success) {
                            $('#exampleModal').modal('hide');
                            $('#example').DataTable().ajax.reload(null, false);
                            Swal.fire('Success', response.message, 'success');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });


    });
</script>

<!-- Script untuk Edit -->
<script>
    $(document).on('click', '.edit-btn', function() {
        const staffId = $(this).data('id');

        $.ajax({
            url: "<?= site_url('staff/get') ?>",
            method: "POST",
            data: {
                staff_id: staffId
            },
            success: function(response) {
                if (response.success) {
                    const staff = response.data;
                    $('#staff_id').val(staff.staff_id);
                    $('#name').val(staff.name);
                    $('#email').val(staff.email);
                    $('#phone_number').val(staff.phone_number);
                    $('#government_id').val(staff.government_id);
                    $('#company_role').val(staff.company_role);
                    $('#password').val('').prop('disabled', true);
                    t
                    $('#togglePassword').show();
                    $('#mTitle').text('Edit Staff');
                    $('#btnModal').text('Update Staff').attr('name', 'update');
                    $('#exampleModal').modal('show');
                    setTimeout(() => {
                        originalStaffForm = $('#quickForm').serialize();
                    }, 100);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });
</script>

<!-- Optional: Re-enable password when typing -->
<script>
    $(document).ready(function() {
        let passwordEnabled = false;

        $('#togglePassword').on('click', function() {
            passwordEnabled = !passwordEnabled;

            if (passwordEnabled) {
                $('#password').prop('disabled', false).focus();
                $(this).text('Batalkan');
            } else {
                $('#password').prop('disabled', true).val('');
                $(this).text('Ubah Password');
            }
        });

        // Reset password field on modal close
        $('#exampleModal').on('hidden.bs.modal', function() {
            passwordEnabled = false;
            $('#password').prop('disabled', true).val('');
            $('#togglePassword').text('Ubah Password');
        });
    });
</script>


<!-- Script untuk Delete -->
<script>
    $(document).on('click', '.delete-btn', function() {
        let staffId = $(this).data('id');
        swal.fire({
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
                $.ajax({
                    url: "<?= site_url('staff/delete') ?>",
                    method: "POST",
                    data: {
                        staff_id: staffId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#example').DataTable().ajax.reload(null, false);
                            Swal.fire('Success', response.message, 'success');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });
</script>




<?= $this->endSection('scripts'); ?>