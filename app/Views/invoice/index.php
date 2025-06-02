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


<!-- Invoice Create View -->
<div class="container mt-5 pt-5 pb-5">
    <h2>Buat Invoice</h2>
    <form id="invoice-form">
        <!-- Tanggal Pembelian -->
        <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal Pembelian</label>
            <input type="date" class="form-control" id="transaction_date" name="transaction_time" value="<?= date('Y-m-d') ?>">
        </div>

        <!-- Informasi Pembeli -->
        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name">
        </div>
        <div class="mb-3">
            <label for="customer_contact" class="form-label">Nomor Telepon Pembeli</label>
            <input type="text" class="form-control" name="customer_contact" id="customer_contact">
        </div>
        <div class="mb-3">
            <label for="customer_email" class="form-label">Email Pembeli</label>
            <input type="email" class="form-control" name="customer_email" id="customer_email">
        </div>

        <!-- Dilayani Oleh -->
        <div class="mb-3">
            <label class="form-label">Dilayani Oleh</label>
            <input type="text" class="form-control" value="<?= $name; ?>" readonly>
        </div>

        <!-- Produk Dibeli -->
        <div class="mb-3">
            <label class="form-label">Produk Dibeli</label>
            <button type="button" class="btn btn-sm btn-primary mb-2" id="add-product-btn">Tambah Produk</button>
            <table class="table table-bordered" id="cart-table">
                <thead>
                    <tr>
                        <th>ProductID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows go here -->
                </tbody>
            </table>
        </div>

        <!-- Total Harga -->
        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="text" class="form-control" id="total_price" name="total_price" readonly>
        </div>

        <!-- Payment -->
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <input type="text" class="form-control" name="payment_method" id="payment_method">
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah yang Dibayar</label>
            <input type="number" class="form-control" name="payment_amount" id="payment_amount">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-success">Kirim Invoice</button>
    </form>
</div>

<!-- Modal Form untuk menambahkan produk -->
<!-- Modal: Pilih Produk -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Pilih Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered" id="product-list-table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Nama Produk</th>
                            <th>Stock Produk</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['product_id'] ?></td>
                                <td><?= $product['product_name'] ?></td>
                                <td><?= $product['product_stock'] ?></td>
                                <td><?= $product['product_price'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-product"
                                        data-id="<?= $product['product_id'] ?>"
                                        data-name="<?= $product['product_name'] ?>"
                                        data-stock="<?= $product['product_stock'] ?>"
                                        data-price="<?= $product['product_price'] ?>">Pilih</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <hr>
                <h6>Atau Tambah Produk Kustom:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="custom_product_name" class="form-control mb-2" placeholder="Nama Produk">
                    </div>
                    <div class="col-md-4">
                        <input type="number" id="custom_product_price" class="form-control mb-2" placeholder="Harga">
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="add-custom-product" class="btn btn-warning">Tambah</button>
                    </div>
                </div>
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

<script>
    let cartIndex = 0;

    // Show modal on button click
    $('#add-product-btn').on('click', function() {
        $('#productModal').modal('show');
    });

    // Add selected product to cart table
    $(document).on('click', '.select-product', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let stock = parseInt($(this).data('stock'));
        let price = parseFloat($(this).data('price'));
        addToCart({
            id,
            name,
            price,
            stock,
            isCustom: false
        });
        $('#productModal').modal('hide');
    });

    // Add custom product
    $('#add-custom-product').on('click', function() {
        let name = $('#custom_product_name').val();
        let price = parseFloat($('#custom_product_price').val());

        if (!name || isNaN(price)) return alert("Isi nama dan harga dengan benar.");

        addToCart({
            id: 'custom-' + cartIndex,
            name,
            price,
            isCustom: true
        });
        $('#custom_product_name').val('');
        $('#custom_product_price').val('');
        $('#productModal').modal('hide');
    });

    // Add row to cart table
    function addToCart(product) {
        cartIndex++;
        let maxStockAttr = product.isCustom ? '' : `max="${product.stock}"`;
        let stockInfo = product.isCustom ? '' : `data-stock="${product.stock}"`;

        let row = `
<tr data-index="${cartIndex}">
  <td><input type="hidden" name="products[${cartIndex}][product_id]" value="${product.id}">${product.id}</td>
  <td><input type="hidden" name="products[${cartIndex}][product_name]" value="${product.name}">${product.name}</td>
  <td><input type="hidden" name="products[${cartIndex}][product_price]" value="${product.price}">${product.price.toLocaleString()}</td>
  <td>
    <input type="number" class="form-control quantity-input" 
           name="products[${cartIndex}][quantity]" 
           data-price="${product.price}" 
           ${stockInfo} ${maxStockAttr} 
           value="1" min="1">
  </td>
  <td class="subtotal">Rp ${product.price.toLocaleString()}</td>
  <td><button type="button" class="btn btn-sm btn-danger remove-product">Hapus</button></td>
</tr>`;
        $('#cart-table tbody').append(row);
        calculateTotal();
    }

    // Quantity change updates subtotal
    $(document).on('input', '.quantity-input', function() {
        let input = $(this);
        let row = input.closest('tr');
        let productId = row.find('input[name*="product_id"]').val();
        let qty = parseInt(input.val());
        let price = parseFloat(input.data('price'));

        // Skip custom products
        if (productId.startsWith('custom-')) {
            updateSubtotal(input, qty, price);
            return;
        }

        $.ajax({
            url: '<?= base_url('/invoice/check-stock') ?>',
            method: 'POST',
            data: {
                product_id: productId
            },
            success: function(response) {
                if (response.stock !== undefined) {
                    let stock = parseInt(response.stock);
                    if (qty > stock) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stok tidak cukup',
                            text: `Stok tersedia hanya ${stock}. Jumlah otomatis dikurangi.`,
                        });
                        input.val(stock);
                        qty = stock;
                    }
                    updateSubtotal(input, qty, price);
                } else {
                    Swal.fire('Error', 'Gagal memeriksa stok produk.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Tidak dapat terhubung ke server.', 'error');
            }
        });
    });

    function updateSubtotal(input, qty, price) {
        let subtotal = qty * price;
        input.closest('tr').find('.subtotal').text('Rp ' + subtotal.toLocaleString());
        calculateTotal();
    }


    // Remove row
    $(document).on('click', '.remove-product', function() {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    // Calculate total
    function calculateTotal() {
        let total = 0;
        $('#cart-table tbody tr').each(function() {
            let qty = parseInt($(this).find('.quantity-input').val());
            let price = parseFloat($(this).find('.quantity-input').data('price'));
            total += qty * price;
        });
        $('#total_price').val(total.toLocaleString());
    }
</script>



<?= $this->endSection('scripts'); ?>