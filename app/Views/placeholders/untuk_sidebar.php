<!-- Invoice Count -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?= $totalInvoices ?></h3>
            <p>Total Invoices</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="<?= base_url('/invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- Total Debts -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?= $totalDebts ?></h3>
            <p>Total Debts</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?= base_url('/debts') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- Active Staff -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?= $activeStaff ?></h3>
            <p>Active Staff</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="<?= base_url('/staff') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- Add more as needed -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $company ?? '' ?></h3>
            <p>Company Name</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer disabled">Overview</a>
    </div>
</div>

<!-- debt chart -->
<div class="row mt-4">
    <div class="col-md-6">
        <canvas id="debtChart"></canvas>
    </div>
</div>