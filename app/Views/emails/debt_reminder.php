<h2>Pengingat Pembayaran Piutang</h2>
<p>Halo <?= esc($debt['customer_name']) ?>,</p>
<p>Ini adalah pengingat bahwa Anda masih memiliki sisa hutang sebesar <strong>Rp<?= number_format($debt['total_amount'], 0, ',', '.') ?></strong> yang jatuh tempo pada <strong><?= date('d-m-Y', strtotime($debt['due_date'])) ?></strong>.</p>
<p>Mohon untuk segera melakukan pembayaran. Terima kasih!</p>