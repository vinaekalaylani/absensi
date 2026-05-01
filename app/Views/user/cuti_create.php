<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern mt-3">
            <div class="card-body p-4 p-md-5">
                <h3 class="font-weight-bold text-dark mb-4 text-center">Ajukan Cuti</h3>

                <form action="<?= base_url('cuti/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="font-weight-semibold text-secondary">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control form-control-modern" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="font-weight-semibold text-secondary">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control form-control-modern" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-semibold text-secondary">Keterangan / Alasan</label>
                        <textarea name="keterangan" class="form-control form-control-modern" rows="4" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="<?= base_url('cuti') ?>" class="btn btn-modern btn-light text-muted px-4">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-modern btn-warning-gradient px-5">
                            <i class="fas fa-paper-plane mr-2"></i> Ajukan Cuti
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>