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


<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Debt List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Tombol Add Users -->
                <div class="btn-addKarywan">
                    <!-- <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Staff
                    </a> -->
                    <button id="trigger-reminder" class="btn btn-success">Kirim Semua Reminder</button>
                </div>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor Invoice</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Kontak Pelanggan</th>
                            <th scope="col">Email Pelanggan</th>
                            <th scope="col">Sisa hutang</th>
                            <th scope="col">Total Dibayar</th>
                            <th scope="col">Tenggat Waktu</th>
                            <th scope="col">Frekuensi Pengingat</th>
                            <th scope="col">Status</th>
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

<!-- Modal for editing reminder frequency -->
<div class="modal fade" id="editReminderModal" tabindex="-1" aria-labelledby="editReminderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editReminderForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Reminder Frequency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="debt_id" id="edit_debt_id">

                    <label for="reminder_frequency" class="form-label">Frekuensi Pengingat (dalam hari)</label>
                    <input type="number" class="form-control" id="edit_reminder_frequency" name="reminder_frequency" min="1" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Bayar Sebagian -->
<div class="modal fade" id="partialPayModal" tabindex="-1" aria-labelledby="partialPayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="partialPayForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar Sebagian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="debt_id" id="pay_debt_id">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="payment_amount" name="payment_amount" min="1" required>
                    </div>
                    <div class="mt-2">
                        <small id="current_debt_info" class="text-muted">Sisa hutang: </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                </div>
            </div>
        </form>
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
            "ajax": "<?= site_url('debtdtb') ?>",
            "columns": [{
                "data": "invoice_id"
            }, {
                "data": "customer_name"
            }, {
                "data": "customer_contact"
            }, {
                "data": "customer_email"
            }, {
                "data": "total_amount"
            }, {
                "data": "paid_amount"
            }, {
                "data": "due_date"
            }, {
                "data": "reminder_frequency"
            }, {
                "data": "status"
            }, {
                "data": "action"
            }]
        });
    });
</script>
<!-- Script untuk kirim reminder manual -->
<script>
    $('#example').on('click', '.btn-reminder', function() {
        const debtId = $(this).data('id');

        Swal.fire({
            title: 'Kirim Pengingat?',
            text: "Pesan pengingat akan dikirim ke pelanggan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mengirim...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading(); // menampilkan loading spinner
                    }
                });
                $.ajax({
                    url: "<?= site_url('debt/sendReminder') ?>",
                    type: "POST",
                    data: {
                        debt_id: debtId
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terkirim!',
                            text: response.message || 'Reminder berhasil dikirim.',
                            timer: 2000
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengirim reminder.',
                            showCancelButton: true,
                            confirmButtonText: 'Coba Lagi',
                            cancelButtonText: 'Tutup'
                        }).then((retry) => {
                            if (retry.isConfirmed) {
                                $('.btn-reminder[data-id="' + debtId + '"]').click(); // trigger ulang
                            }
                        });
                    }
                });
            }
        });
    });
</script>
<!-- Script untuk kirim reminder otomatis -->
<script>
    $('#trigger-reminder').click(function() {
        Swal.fire({
            title: 'Yakin?',
            text: 'Semua pengingat otomatis akan dikirim sekarang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mengirim...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "<?= site_url('debt/triggerAutoReminder') ?>",
                    method: 'POST',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `${response.count} pengingat telah dikirim.`,
                            timer: 3000
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengirim pengingat.'
                        });
                    }
                });
            }
        });
    });
</script>
<!-- Script untuk edit reminder frequency -->
<script>
    // Handle edit button click
    $('#example').on('click', '.edit-btn', function() {
        const debtId = $(this).data('id');

        // Fetch current frequency from backend
        $.post("<?= site_url('debt/getReminderFrequency') ?>", {
            debt_id: debtId
        }, function(response) {
            $('#edit_debt_id').val(debtId);
            $('#edit_reminder_frequency').val(response.reminder_frequency);
            $('#editReminderModal').modal('show');
        }, 'json');
    });

    // Handle form submission
    $('#editReminderForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('debt/updateReminderFrequency') ?>",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#editReminderModal').modal('hide');
                Swal.fire('Berhasil!', response.message, 'success');
                $('#example').DataTable().ajax.reload(); // reload DataTable
            },
            error: function() {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');
            }
        });
    });
</script>

<!-- Script untuk partial payment -->
<script>
    const formatter = new Intl.NumberFormat('id-ID');

    // Format input as user types (Rp style)
    $('#payment_amount').on('input', function() {
        let value = $(this).val().replace(/[^0-9]/g, '');
        value = parseInt(value || 0);
        $(this).val(formatter.format(value));
    });

    // Handle "Bayar Sebagian" button click
    $('#example').on('click', '.partial-pay-btn', function() {
        const debtId = $(this).data('id');

        $.post("<?= site_url('debt/getDebtAmount') ?>", {
            debt_id: debtId
        }, function(response) {
            $('#pay_debt_id').val(debtId);
            $('#payment_amount').val('');
            $('#current_debt_info').text(`Sisa hutang: Rp ${formatter.format(response.total_amount)} | Sudah dibayar: Rp ${formatter.format(response.paid_amount)}`);
            $('#partialPayModal').modal('show');
        }, 'json');
    });

    // Submit partial payment
    $('#partialPayForm').submit(function(e) {
        e.preventDefault();

        // Normalize amount before sending (remove dots, convert to plain number)
        let rawAmount = $('#payment_amount').val();
        let cleanedAmount = rawAmount.replace(/\./g, '').replace(/[^0-9]/g, '');

        $.ajax({
            url: "<?= site_url('debt/submitPartialPayment') ?>",
            type: "POST",
            data: {
                debt_id: $('#pay_debt_id').val(),
                payment_amount: cleanedAmount
            },
            success: function(response) {
                $('#partialPayModal').modal('hide');

                // ✅ Show different Swal alert depending on whether debt is fully paid
                Swal.fire({
                    title: response.is_fully_paid ? 'Lunas!' : 'Berhasil!',
                    text: response.message,
                    icon: response.is_fully_paid ? 'success' : 'info',
                });

                $('#example').DataTable().ajax.reload();
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.error || 'Terjadi kesalahan';
                Swal.fire('Gagal!', err, 'error');
            }
        });
    });

    // Mark debt as paid
    $(document).on('click', '.mark-paid-btn', function() {
        let debtId = $(this).data('id');

        Swal.fire({
            title: 'Tandai sebagai lunas?',
            text: "Tindakan ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, tandai lunas!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= site_url('debt/markDebtAsPaid') ?>", {
                    debt_id: debtId
                }, function(response) {
                    Swal.fire('Berhasil!', response.message, 'success');
                    $('#example').DataTable().ajax.reload();
                }).fail(function(xhr) {
                    let err = xhr.responseJSON?.error || 'Terjadi kesalahan';
                    Swal.fire('Gagal!', err, 'error');
                });
            }
        });
    });
</script>


<?= $this->endSection('scripts'); ?>