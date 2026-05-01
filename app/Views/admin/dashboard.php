<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Dashboard</h3>
<p>Selamat datang, <b><?= session()->get('username') ?? 'User'; ?></b></p>

<div class="row mb-4">
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-primary">
                    <i class="fas fa-users fa-3x opacity-75"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= number_format($total_karyawan ?? 0) ?></h3>
                    <p class="text-muted mb-0 font-weight-medium">Total Karyawan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-info">
                    <i class="fas fa-calendar fa-3x opacity-75"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= number_format($total_cuti ?? 0) ?></h3>
                    <p class="text-muted mb-0 font-weight-medium">Total Cuti</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-success">
                    <i class="fas fa-user-check fa-3x opacity-75"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= number_format($hadir ?? 0) ?></h3>
                    <p class="text-muted mb-0 font-weight-medium">Hadir Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-danger">
                    <i class="fas fa-user-times fa-3x opacity-75"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= number_format($tidak_hadir ?? 0) ?></h3>
                    <p class="text-muted mb-0 font-weight-medium">Tidak Hadir</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GRAFIK BULANAN -->
<div class="card card-modern mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="font-weight-bold text-dark mb-0"><i class="fas fa-chart-line text-primary mr-2"></i> Grafik Cuti Bulanan</h5>
    </div>
    <div class="card-body p-4">
        <canvas id="chartBulanan"></canvas>
    </div>
</div>

<!-- LOG -->
<div class="card card-modern">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="font-weight-bold text-dark mb-0"><i class="fas fa-history text-info mr-2"></i> Log Aktivitas Terbaru</h5>
    </div>
    <div class="card-body p-4">
        <div class="list-group list-group-flush">
            <?php if(!empty($log)): ?>
                <?php foreach($log as $l): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 mr-3 text-secondary">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <span class="text-dark font-weight-medium"><?= $l['aktivitas'] ?></span>
                        </div>
                        <span class="badge badge-light text-muted border px-2 py-1">
                            <i class="far fa-clock mr-1"></i> <?= date('d M Y, H:i', strtotime($l['created_at'])) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted py-4">
                    <i class="fas fa-folder-open fa-2x opacity-25 mb-2"></i>
                    <p class="mb-0">Tidak ada aktivitas</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chartBulanan'), {
    type: 'line',
    data: {
        labels: <?= $bulan ?? '[]' ?>,
        datasets: [{
            label: 'Cuti per Bulan',
            data: <?= $jumlah ?? '[]' ?>,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>

<?= $this->endSection(); ?>