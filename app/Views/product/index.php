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


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Tombol Add Users -->
                <div class="btn-addKarywan">
                    <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Produk
                    </a>
                </div>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Deskripsi Produk</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col">Harga Produk</th>
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

<!-- Modal add dan edit Inventory (Modal dari Bootstrap)-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-addK">
                <form name="formInventory" id="quickForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Masukkan Nama Produk">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                            <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Masukkan Deskripsi Produk">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="KTP" class="form-label">Jumlah Produk</label>
                            <input type="number" name="product_stock" id="product_stock" class="form-control" min="0" placeholder="Masukkan Jumlah Produk">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Harga Produk</label>
                            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Masukkan Harga Produk">
                        </div>
                    </div>
                    <button type="button" id="btnModal" name="update" class="btn btn-primary"></button>
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
            "ajax": "<?= site_url('productdtb') ?>",
            "columns": [{
                "data": "product_name"
            }, {
                "data": "product_description"
            }, {
                "data": "product_stock"
            }, {
                data: 'product_price',
                render: function(data, type, row) {
                    return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                }
            }, {
                "data": "action"
            }]
        });
    });
</script>

<!-- Jquery -->
<script>
    let originalProductForm = "";

    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                product_name: {
                    required: true,
                },
                product_description: {
                    required: true,
                },
                product_price: {
                    required: true,
                },
                product_stock: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                product_name: {
                    required: "nama produk tidak boleh kosong",
                },
                product_description: {
                    required: "keterangan produk tidak boleh kosong",
                },
                product_price: {
                    required: "harga produk tidak boleh kosong",
                },
                product_stock: {
                    required: "kuantitas produk tidak boleh kosong",
                    digits: "Stok harus berupa angka bulat"

                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
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
            $('#btnModal').attr('name', 'add').text('Tambah Produk');
            $('#quickForm')[0].reset();
        });
        $('#btnAdd').click(function() {
            $('#quickForm')[0].reset();
            $('#product_id').val('');
            $('#mTitle').text('Tambah Produk');
            $('#btnModal').text('Tambah Produk').attr('name', 'add');
            $('#exampleModal').modal('show');
        })
        $('#btnModal').on('click', function() {
            if ($('#quickForm').valid()) {
                const action = $(this).attr('name');
                let url = (action === 'update') ?
                    "<?= site_url('product/edit') ?>" :
                    "<?= site_url('product/add') ?>";

                // Convert formatted price to raw number
                let rawPrice = $('#product_price').val().replace(/[^\d]/g, '');
                $('#product_price').val(rawPrice);

                const currentForm = $('#quickForm').serialize();

                // Check if form is unchanged during update
                if (action === 'update' && currentForm === originalProductForm) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada perubahan',
                        text: 'Data produk tidak berubah dari sebelumnya.'
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
        const productId = $(this).data('id');

        $.ajax({
            url: "<?= site_url('product/get') ?>",
            method: "POST",
            data: {
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    const product = response.data;
                    $('#product_id').val(product.product_id);
                    $('#product_name').val(product.product_name);
                    $('#product_description').val(product.product_description);
                    // Clean float to integer, then format properly
                    let cleanPrice = parseInt(product.product_price);
                    $('#product_price').val(formatRupiah(cleanPrice.toString()));
                    $('#product_stock').val(product.product_stock);
                    $('#mTitle').text('Edit Produk');
                    $('#btnModal').text('Update Produk').attr('name', 'update');
                    $('#exampleModal').modal('show');

                    // Capture original form state after inputs are set
                    setTimeout(() => {
                        $('#product_price').val(cleanPrice); // unformatted before serialize
                        originalProductForm = $('#quickForm').serialize();
                        $('#product_price').val(formatRupiah(cleanPrice.toString())); // reapply formatting for user
                    }, 100);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });
</script>


<!-- Script untuk Delete -->
<script>
    $(document).on('click', '.delete-btn', function() {
        let productId = $(this).data('id');
        swal.fire({
            title: 'Yakin ingin menghapus produk?',
            text: "Tindakan ini tidak bisa dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus produk',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('product/delete') ?>",
                    method: "POST",
                    data: {
                        product_id: productId
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

<!-- Script untuk Format Rupiah -->
<script>
    function formatRupiah(angka, prefix = 'Rp ') {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    $(document).ready(function() {
        $('#product_price').on('keyup', function() {
            let inputVal = $(this).val();
            $(this).val(formatRupiah(inputVal));
        });
    });
</script>


<?= $this->endSection('scripts'); ?>