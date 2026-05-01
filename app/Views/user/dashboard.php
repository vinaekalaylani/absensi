<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<h3>Dashboard Karyawan</h3>
<p>Selamat datang, <b><?= session()->get('username'); ?></b></p>

<!-- QUICK ACTION -->
<div class="row mb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <a href="<?= base_url('absensi/create') ?>" class="btn btn-modern btn-primary-gradient btn-block text-left d-flex align-items-center justify-content-between p-4">
            <div>
                <h5 class="mb-1 text-white">Absen Sekarang</h5>
                <small class="text-white-50">Catat kehadiran Anda hari ini</small>
            </div>
            <i class="fas fa-clock fa-2x opacity-50"></i>
        </a>
    </div>

    <div class="col-md-6">
        <?php if(session()->get('role') == 'user'): ?>
        <a href="<?= base_url('cuti/create') ?>" class="btn btn-modern btn-warning-gradient btn-block text-left d-flex align-items-center justify-content-between p-4">
            <div>
                <h5 class="mb-1 text-white">Ajukan Cuti</h5>
                <small class="text-white-50">Permohonan cuti atau izin</small>
            </div>
            <i class="fas fa-calendar-plus fa-2x opacity-50"></i>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-primary">
                    <i class="fas fa-calendar-check fa-3x"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= $total_cuti ?? 0 ?></h3>
                    <p class="text-muted mb-0">Total Cuti Saya</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-warning">
                    <i class="fas fa-hourglass-half fa-3x"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= $pending ?? 0 ?></h3>
                    <p class="text-muted mb-0">Cuti Pending</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3 text-success">
                    <i class="fas fa-user-check fa-3x"></i>
                </div>
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><?= $hadir ?? 0 ?></h3>
                    <p class="text-muted mb-0">Hadir Hari Ini</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- INFO -->
<div class="card card-modern">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="font-weight-bold text-dark mb-0"><i class="fas fa-info-circle text-primary mr-2"></i> Informasi Penting</h5>
    </div>
    <div class="card-body">
        <ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Lakukan absensi setiap hari sebelum jam kerja dimulai.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Ajukan cuti jauh hari sebelum pelaksanaan jika diperlukan.</li>
            <li><i class="fas fa-check-circle text-success mr-2"></i> Pastikan data kehadiran selalu lengkap dan benar.</li>
        </ul>
    </div>
</div>

<?= $this->endSection(); ?>