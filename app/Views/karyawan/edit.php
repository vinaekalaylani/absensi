<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern mt-3">
            <div class="card-body p-4 p-md-5">
                <h3 class="font-weight-bold text-dark mb-4 text-center">Edit Karyawan</h3>

                <form method="post" action="<?= base_url('karyawan/update/'.$karyawan['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= $karyawan['nama'] ?>" class="form-control form-control-modern" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Jabatan</label>
                        <input type="text" name="jabatan" value="<?= $karyawan['jabatan'] ?>" class="form-control form-control-modern" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">No. Telp / WhatsApp</label>
                        <input type="text" name="telp" value="<?= $karyawan['telp'] ?>" class="form-control form-control-modern" required>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="<?= base_url('karyawan') ?>" class="btn btn-modern btn-light text-muted px-4">
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