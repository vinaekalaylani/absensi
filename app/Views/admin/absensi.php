<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>


<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-0">Data Absensi Karyawan</h3>
</div>

<div class="card card-modern">
    <div class="card-body p-0">
        <div class="table-responsive p-4">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                <?php if(isset($absensi) && is_array($absensi) && count($absensi) > 0): ?>
                    <?php foreach($absensi as $a): ?>
                        <tr>
                            <td class="text-muted"><?= $no++ ?></td>
                            <td class="font-weight-medium text-dark">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 mr-2 text-primary">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <?= ($a['nama_karyawan'] ?? '-') ?>
                                </div>
                            </td>
                            <td class="text-muted"><?= $a['tanggal'] ? date('d M Y', strtotime($a['tanggal'])) : '-' ?></td>
                            <td>
                                <?php if(!empty($a['jam_masuk']) && $a['jam_masuk'] != '-'): ?>
                                    <span class="badge badge-light border"><i class="fas fa-sign-in-alt text-success mr-1"></i> <?= date('H:i', strtotime($a['jam_masuk'])) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(!empty($a['jam_pulang']) && $a['jam_pulang'] != '-'): ?>
                                    <span class="badge badge-light border"><i class="fas fa-sign-out-alt text-danger mr-1"></i> <?= date('H:i', strtotime($a['jam_pulang'])) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $status = strtolower($a['status'] ?? '-');
                                if($status == 'hadir'): ?>
                                    <span class="badge badge-modern badge-success-soft px-3 py-2">Hadir</span>
                                <?php elseif($status == 'izin'): ?>
                                    <span class="badge badge-modern badge-warning-soft px-3 py-2">Izin</span>
                                <?php elseif($status == 'sakit'): ?>
                                    <span class="badge badge-modern badge-primary-soft px-3 py-2">Sakit</span>
                                <?php elseif($status == 'tidak hadir' || $status == 'tidak_hadir'): ?>
                                    <span class="badge badge-modern badge-danger-soft px-3 py-2">Tidak Hadir</span>
                                <?php elseif($status == 'cuti'): ?>
                                    <span class="badge badge-modern badge-info-soft px-3 py-2">Cuti</span>
                                <?php else: ?>
                                    <span class="badge badge-modern badge-secondary px-3 py-2"><?= ucfirst($status) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('admin/absensi/edit/'.$a['id']) ?>" class="btn btn-sm btn-outline-primary btn-modern py-1 px-2 mx-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/absensi/delete/'.$a['id']) ?>" class="btn btn-sm btn-outline-danger btn-modern py-1 px-2 mx-1"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                       <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">Tidak ada data absensi</p>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>