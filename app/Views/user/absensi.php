<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-0">Riwayat Absensi</h3>

    <a href="<?= base_url('absensi/create') ?>" class="btn btn-modern btn-primary-gradient shadow-sm">
        <i class="fas fa-plus mr-1"></i> Isi Form Absensi
    </a>
</div>

<div class="card card-modern">
    <div class="card-body p-0">
        <div class="table-responsive p-4">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($absensi)): ?>
                    <?php $no = 1; foreach ($absensi as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= date('d M Y', strtotime($a['tanggal'])) ?></td>

                            <td><?= ucfirst($a['status']) ?></td>

                            <td>
                                <?= $a['jam_masuk'] ?? '-' ?>
                            </td>

                            <td>
                                <?= $a['jam_keluar'] ?? '-' ?>
                            </td>

                            <td class="text-center">
                                <?php if (!empty($a['id']) && empty($a['jam_keluar']) && $a['status'] == 'hadir'): ?>
                                    <a href="<?= base_url('absensi/pulang/'.$a['id']) ?>"
                                       class="btn btn-sm btn-danger">
                                        Pulang
                                    </a>
                                <?php else: ?>
                                    <span class="text-success">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data absensi</td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>