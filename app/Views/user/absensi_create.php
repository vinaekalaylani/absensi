<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern mt-3">
            <div class="card-body p-4 p-md-5">
                <h3 class="font-weight-bold text-dark mb-4 text-center">Absen Sekarang</h3>

                <form action="<?= base_url('absensi/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Nama Karyawan</label>
                        <input type="text" class="form-control form-control-modern"
                               value="<?= session()->get('username') ?>" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Tanggal</label>
                        <input type="date" class="form-control form-control-modern"
                               value="<?= date('Y-m-d') ?>" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Status Kehadiran</label>
                        <select name="status" class="form-control form-control-modern" required>
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="<?= base_url('absensi') ?>" class="btn btn-modern btn-light text-muted px-4">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-modern btn-primary-gradient px-5">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Absen
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>