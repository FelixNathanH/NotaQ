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
    <form name="formInvoice" id="quickForm">
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
            <input type="hidden" name="staff_name" value="<?= $name; ?>">

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
        <div class="input-group mb-3">
            <span class="input-group-text">Rp</span>
            <input type="text" class="form-control rupiah-input" id="payment_amount" name="payment_amount" required>
        </div>
        <div class="mb-3">
            <label for="change_amount" class="form-label">Kembalian</label>
            <input type="text" id="change_amount" class="form-control" readonly>
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
                                <td><?= format_rupiah($product['product_price']) ?></td>
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

<!-- Modal untuk debt -->
<div class="modal fade" id="debtModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="debtForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Piutang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Pelanggan:</strong> <span id="debt_customer_name"></span></p>
                <p><strong>Kontak:</strong> <span id="debt_customer_contact"></span></p>
                <p><strong>Email:</strong> <span id="debt_customer_email"></span></p>
                <p><strong>Total Harga:</strong> <span id="debt_total_price"></span></p>
                <p><strong>Jumlah Dibayar:</strong> <span id="debt_payment_amount"></span></p>
                <p><strong>Sisa Hutang:</strong> <span id="debt_amount_due"></span></p>
                <hr>
                <h6>Daftar Produk:</h6>
                <div id="debt_items"></div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Batas Waktu Pembayaran</label>
                    <input type="date" id="due_date" name="due_date" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Piutang</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

<!-- Script untuk form -->
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
        let rawPrice = $('#custom_product_price').val().replace(/\./g, '').replace(/[^\d]/g, '');
        let price = parseInt(rawPrice);

        if (!name || isNaN(price)) {
            Swal.fire({
                icon: 'warning',
                title: 'Input tidak valid',
                text: 'Isi nama dan harga dengan benar.'
            });
            return;
        }

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

        const disabledQty = product.stock === 0 && !product.isCustom ? 'readonly style="background-color:#eee;"' : '';
        const initialQty = product.stock === 0 && !product.isCustom ? 0 : 1;
        const warning = product.stock === 0 && !product.isCustom ? '<span class="text-danger small">Stok Habis</span>' : '';

        let row = `
    <tr data-index="${cartIndex}" data-is-custom="${product.isCustom}">
        <td>
            <input type="hidden" name="products[${cartIndex}][product_id]" value="${product.id}">
            ${product.id ?? '-'}
        </td>
        <td>
            <input type="hidden" name="products[${cartIndex}][product_name]" value="${product.name}">
            ${product.name} ${warning}
        </td>
        <td>
            <input type="hidden" name="products[${cartIndex}][product_price]" value="${product.price}">
            Rp ${product.price.toLocaleString()}
        </td>
        <td>
            <input type="number" class="form-control quantity-input" 
                name="products[${cartIndex}][quantity]" 
                data-price="${product.price}" 
                data-stock="${product.stock || 0}" 
                value="${initialQty}" 
                min="0" ${disabledQty}>
        </td>
        <td class="subtotal">Rp ${(initialQty * product.price).toLocaleString()}</td>
        <td>
            <button type="button" class="btn btn-sm btn-danger remove-product">Hapus</button>
        </td>
        <!-- Extra hidden fields if custom -->
        ${product.isCustom ? `
            <input type="hidden" name="products[${cartIndex}][is_custom]" value="1">
            <input type="hidden" name="products[${cartIndex}][custom_name]" value="${product.name}">
            <input type="hidden" name="products[${cartIndex}][custom_price]" value="${product.price}">
        ` : ''}
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

    // Update subtotal
    function updateSubtotal(input, qty, price) {
        let subtotal = qty * price;
        input.closest('tr').find('.subtotal').text('Rp ' + subtotal.toLocaleString());
        calculateTotal();
    }

    // Remove product dari cart
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
        $('#total_price').val('Rp ' + total.toLocaleString('id-ID'));
    }

    // Calculate change
    function calculateChange() {
        let total = parseInt($('#total_price').val().replace(/[^\d]/g, '')) || 0;
        let paid = parseInt($('#payment_amount').val().replace(/[^\d]/g, '')) || 0;

        let change = paid - total;
        $('#change_amount').val(change > 0 ? 'Rp ' + change.toLocaleString('id-ID') : 'Rp 0');
    }

    // Untuk menunjukan hasil pada field payment_amount
    $('#payment_amount').on('input', function() {
        calculateChange();
    });
</script>


<!-- Form Validation -->
<script>
    $('#quickForm').validate({
        rules: {
            transaction_time: {
                required: true
            },
            customer_name: {
                required: true
            },
            customer_contact: {
                required: true
            },
            customer_email: {
                required: true,
                email: true
            },
            payment_method: {
                required: true
            },
            payment_amount: {
                required: true,
            }
        },
        messages: {
            transaction_time: {
                required: "Tanggal transaksi wajib diisi"
            },
            customer_name: {
                required: "Nama pembeli wajib diisi"
            },
            customer_contact: {
                required: "Nomor telepon wajib diisi"
            },
            customer_email: {
                required: "Email wajib diisi",
                email: "Gunakan format email yang valid"
            },
            payment_method: {
                required: "Metode pembayaran wajib diisi"
            },
            payment_amount: {
                required: "Jumlah pembayaran wajib diisi",
                number: "Masukkan angka yang valid",
                min: "Jumlah tidak boleh negatif"
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-3').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#quickForm').on('submit', function(e) {
        e.preventDefault();

        if (!$(this).valid()) return;

        // Collect product data from the table
        let products = [];
        $('#cart-table tbody tr').each(function() {
            const product_id = $(this).find('input[name*="[product_id]"]').val();
            const name = $(this).find('input[name*="[product_name]"]').val();
            const price = parseFloat($(this).find('input[name*="[product_price]"]').val());
            const quantity = parseInt($(this).find('input[name*="[quantity]"]').val());
            const is_custom = $(this).find('input[name*="[is_custom]"]').val() === '1';

            let product = {
                product_id: is_custom ? null : product_id,
                name,
                price,
                quantity,
                is_custom
            };

            if (is_custom) {
                product.custom_name = $(this).find('input[name*="[custom_name]"]').val();
                product.custom_price = parseFloat($(this).find('input[name*="[custom_price]"]').val());
            }

            if (quantity > 0) {
                products.push(product);
            }
        });


        if (products.length === 0) {
            Swal.fire('Oops!', 'Mohon tambahkan setidaknya satu produk.', 'warning');
            return;
        }

        const formData = new FormData();
        formData.append('transaction_time', $('#transaction_date').val());
        formData.append('customer_name', $('#customer_name').val());
        formData.append('customer_contact', $('#customer_contact').val());
        formData.append('customer_email', $('#customer_email').val());
        formData.append('payment_method', $('#payment_method').val());
        const rawPayment = $('#payment_amount').val().replace(/[^\d]/g, '');
        formData.append('payment_amount', parseInt(rawPayment));
        formData.append('total_price', parseInt($('#total_price').val().replace(/[^\d]/g, '')));
        formData.append('items', JSON.stringify(products)); // KEY LINE

        let total = parseInt($('#total_price').val().replace(/[^\d]/g, '')) || 0;
        let paid = parseInt($('#payment_amount').val().replace(/[^\d]/g, '')) || 0;

        if (paid < total) {
            Swal.fire({
                title: 'Pelanggan berhutang?',
                text: 'Jumlah yang dibayar lebih kecil dari total. Izinkan pelanggan berhutang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Izinkan Hutang',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#debtModal').modal('show');
                    const customerName = $('#customer_name').val();
                    const customerContact = $('#customer_contact').val();
                    const customerEmail = $('#customer_email').val();
                    const totalPrice = parseInt($('#total_price').val().replace(/[^\d]/g, ''));
                    const paymentAmount = parseInt($('#payment_amount').val().replace(/[^\d]/g, ''));
                    const amountDue = totalPrice - paymentAmount;

                    $('#debt_customer_name').text(customerName);
                    $('#debt_customer_contact').text(customerContact);
                    $('#debt_customer_email').text(customerEmail);
                    $('#debt_total_price').text(formatRupiah(totalPrice.toString()));
                    $('#debt_payment_amount').text(formatRupiah(paymentAmount.toString()));
                    $('#debt_items').html(buildDebtItemList(products)); // products assumed to be your global
                    $('#debt_amount_due').text(formatRupiah(amountDue.toString()));
                }
            });
        } else {
            Swal.fire({
                title: 'Kirim Invoice?',
                text: "Pastikan semua data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitInvoice(formData);
                }
            });
        }

    });
</script>

<!-- Functions -->
<script>
    function submitInvoice(formData) {
        $.ajax({
            url: '<?= base_url("invoice/submit"); ?>',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Sedang diproses...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(res) {
                Swal.fire('Berhasil!', 'Invoice berhasil dikirim.', 'success');
                $('#quickForm')[0].reset();
                $('#cart-table tbody').empty();
                $('#total_price').val('');
                $('#change_amount').val('');
            },
            error: function(xhr) {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat mengirim invoice.', 'error');
                console.log(xhr.responseText);
            }
        });
    }

    function buildDebtItemList(items) {
        return items.map(item => `
        <li class="list-group-item d-flex justify-content-between align-items-center">
            ${item.name}
            <span class="badge bg-primary rounded-pill">${item.quantity} x Rp${item.price.toLocaleString('id-ID')}</span>
        </li>
    `).join('');
    }

    function collectProducts() {
        let products = [];
        $('#cart-table tbody tr').each(function() {
            const product_id = $(this).find('input[name*="[product_id]"]').val();
            const name = $(this).find('input[name*="[product_name]"]').val();
            const price = parseFloat($(this).find('input[name*="[product_price]"]').val());
            const quantity = parseInt($(this).find('input[name*="[quantity]"]').val());
            const is_custom = $(this).find('input[name*="[is_custom]"]').val() === '1';

            let product = {
                product_id: is_custom ? null : product_id,
                name,
                price,
                quantity,
                is_custom
            };

            if (is_custom) {
                product.custom_name = $(this).find('input[name*="[custom_name]"]').val();
                product.custom_price = parseFloat($(this).find('input[name*="[custom_price]"]').val());
            }

            if (quantity > 0) {
                products.push(product);
            }
        });
        return products;
    }

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
</script>

<!-- Debt Submit -->
<script>
    $('#debtForm').on('submit', function(e) {
        e.preventDefault();

        const batasWaktu = $('#due_date').val();
        if (!batasWaktu) {
            return Swal.fire('Oops!', 'Silakan tentukan batas waktu pembayaran.', 'warning');
        }

        // Recollect all necessary data
        const formData = new FormData();
        formData.append('transaction_time', $('#transaction_date').val());
        formData.append('customer_name', $('#customer_name').val());
        formData.append('customer_contact', $('#customer_contact').val());
        formData.append('customer_email', $('#customer_email').val());
        formData.append('payment_method', $('#payment_method').val());

        const totalPrice = parseInt($('#total_price').val().replace(/[^\d]/g, ''));
        const paymentAmount = parseInt($('#payment_amount').val().replace(/[^\d]/g, ''));
        const amountDue = totalPrice - paymentAmount;

        formData.append('payment_amount', paymentAmount);
        formData.append('total_price', totalPrice);
        formData.append('amount_due', amountDue);
        formData.append('due_date', batasWaktu);

        const products = collectProducts(); // reuse the product collection logic
        formData.append('items', JSON.stringify(products));

        // Submit debt via AJAX
        $.ajax({
            url: '<?= base_url("debt/submit") ?>',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Menyimpan Piutang...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(res) {
                Swal.fire('Berhasil!', 'Data piutang telah disimpan.', 'success');
                $('#quickForm')[0].reset();
                $('#cart-table tbody').empty();
                $('#total_price').val('');
                $('#debtModal').modal('hide');
            },
            error: function(xhr) {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data piutang.', 'error');
                console.log(xhr.responseText);
            }
        });
    });
</script>

<!-- Script rupiah formatting -->
<script>
    function formatRupiahInput(angka, prefix = 'Rp ') {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            rupiah += (sisa ? '.' : '') + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    $(document).on('input', '.rupiah-input', function() {
        this.value = formatRupiahInput(this.value, 'Rp ');
    });
</script>



<?= $this->endSection('scripts'); ?>