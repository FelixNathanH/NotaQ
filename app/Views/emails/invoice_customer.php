<h2>Invoice dari <?= esc($company_name) ?></h2>
<p>Halo <?= esc($customer_name) ?>,</p>

<p>Terima kasih atas pembelian Anda. Berikut adalah rincian invoice Anda:</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= esc($item['product_name']) ?></td>
                <td>Rp<?= number_format($item['order_price'], 0, ',', '.') ?></td>
                <td><?= esc($item['order_amount']) ?></td>
                <td>Rp<?= number_format($item['order_price'] * $item['order_amount'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<p><strong>Total:</strong> Rp<?= number_format($total_price, 0, ',', '.') ?></p>
<p><strong>Tanggal Transaksi:</strong> <?= date('d-m-Y', strtotime($transaction_time)) ?></p>

<p>Silakan hubungi kami jika ada pertanyaan.</p>
<p>Salam, <br><strong><?= esc($company_name) ?></strong></p>