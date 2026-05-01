<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern mt-3">
            <div class="card-body p-4 p-md-5">
                <h3 class="font-weight-bold text-dark mb-4 text-center">Edit Absensi</h3>

                <form action="<?= base_url('admin/absensi/update/'.($absensi['id'] ?? 0)) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan"
                               value="<?= $absensi['nama_karyawan'] ?? '' ?>"
                               class="form-control form-control-modern" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Tanggal</label>
                        <input type="date" name="tanggal"
                               value="<?= $absensi['tanggal'] ?? '' ?>"
                               class="form-control form-control-modern" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Status</label>
                        <select name="status" class="form-control form-control-modern">
                            <option value="hadir" <?= ($absensi['status'] ?? '') == 'hadir' ? 'selected' : '' ?>>Hadir</option>
                            <option value="tidak_hadir" <?= ($absensi['status'] ?? '') == 'tidak_hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                            <option value="cuti" <?= ($absensi['status'] ?? '') == 'cuti' ? 'selected' : '' ?>>Cuti</option>
                            <option value="sakit" <?= ($absensi['status'] ?? '') == 'sakit' ? 'selected' : '' ?>>Sakit</option>
                            <option value="izin" <?= ($absensi['status'] ?? '') == 'izin' ? 'selected' : '' ?>>Izin</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="<?= base_url('admin/absensi') ?>" class="btn btn-modern btn-light text-muted px-4">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-modern btn-primary-gradient px-5">
                            <i class="fas fa-save mr-2"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>