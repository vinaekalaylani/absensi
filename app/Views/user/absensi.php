<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>
<?php
/** @var array<int, array{
 *     id: int,
 *     nama_karyawan: string,
 *     tanggal: string,
 *     jam_masuk: string,
 *     jam_pulang: string|null,
 *     status: string
 * }> $absensi */
?>

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
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($absensi)): ?>
                        <?php $no=1; foreach($absensi as $a): ?>
                        <tr>
                            <td class="text-muted"><?= $no++ ?></td>
                            <td class="font-weight-medium text-dark"><?= date('d M Y', strtotime($a['tanggal'])) ?></td>
                            <td>
                                <?php if(strtolower($a['status']) == 'hadir'): ?>
                                    <span class="badge badge-modern badge-success-soft px-3 py-2">Hadir</span>
                                <?php elseif(strtolower($a['status']) == 'izin'): ?>
                                    <span class="badge badge-modern badge-warning-soft px-3 py-2">Izin</span>
                                <?php elseif(strtolower($a['status']) == 'sakit'): ?>
                                    <span class="badge badge-modern badge-primary-soft px-3 py-2">Sakit</span>
                                <?php else: ?>
                                    <span class="badge badge-modern badge-secondary px-3 py-2"><?= ucfirst($a['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($a['jam_masuk']): ?>
                                    <span class="badge badge-light border"><i class="fas fa-sign-in-alt text-success mr-1"></i> <?= date('H:i', strtotime($a['jam_masuk'])) ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($a['jam_pulang']): ?>
                                    <span class="badge badge-light border"><i class="fas fa-sign-out-alt text-danger mr-1"></i> <?= date('H:i', strtotime($a['jam_pulang'])) ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if(!$a['jam_pulang'] && strtolower($a['status']) == 'hadir'): ?>
                                    <a href="<?= base_url('absensi/pulang/'.$a['id']) ?>"
                                       class="btn btn-sm btn-outline-danger btn-modern py-1 px-3">
                                       <i class="fas fa-sign-out-alt"></i> Pulang
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small"><i class="fas fa-check-circle text-success mr-1"></i> Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p>Belum ada data absensi</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>