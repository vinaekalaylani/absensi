<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern mt-3">
            <div class="card-body p-4 p-md-5">

                <h3 class="text-center mb-4">Edit Karyawan</h3>

                <?php if (!isset($karyawan) || !$karyawan): ?>
                    <div class="alert alert-danger">
                        Data karyawan tidak ditemukan
                    </div>
                <?php else: ?>

                <form method="post" action="<?= base_url('karyawan/update/'.$karyawan['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $karyawan['nama'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" value="<?= $karyawan['jabatan'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Telp</label>
                        <input type="text" name="telp" value="<?= $karyawan['telp'] ?>" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        Update
                    </button>

                </form>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>