<h2>Pengingat Pembayaran Piutang dari <?= esc($company_name) ?></h2>

<p>Halo <?= esc($debt['customer_name']) ?>,</p>

<p>
    Ini adalah pengingat bahwa Anda masih memiliki sisa hutang sebesar
    <strong>Rp<?= number_format($debt['total_amount'], 0, ',', '.') ?></strong> yang jatuh tempo pada
    <strong><?= date('d-m-Y', strtotime($debt['due_date'])) ?></strong>.
</p>

<?php if (!empty($items)): ?>
    <p>Berikut adalah barang yang Anda beli:</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Produk</th>
                <th>Harga satuan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <?php
                $name = $item['custom_product_name'] ?? 'Produk Tidak Dikenal';
                $price = $item['custom_product_price'] ?? 0;
                $amount = $item['order_amount'];
                $subtotal = $price * $amount;
                ?>
                <tr>
                    <td><?= esc($name) ?></td>
                    <td>Rp<?= number_format($price, 0, ',', '.') ?></td>
                    <td><?= esc($amount) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p>Mohon untuk segera melakukan pembayaran. Terima kasih!</p>

<p>Hormat kami,<br>
    <strong><?= esc($company_name) ?></strong>
</p>