<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-0">Data Cuti Karyawan</h3>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px;">
    <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
<?php endif; ?>

<div class="card card-modern">
    <div class="card-body p-0">
        <div class="table-responsive p-4">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Karyawan</th>
                        <th>Periode Tanggal</th>
                        <th>Keterangan / Alasan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($cuti)): ?>
                        <?php $no=1; foreach($cuti as $c): ?>
                        <tr>
                            <td class="text-muted"><?= $no++ ?></td>
                            <td class="font-weight-medium text-dark">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 mr-2 text-primary">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <?= $c['nama_karyawan'] ?>
                                </div>
                            </td>
                            <td class="text-muted">
                                <?= date('d M Y', strtotime($c['tanggal_mulai'])) ?> <span class="text-muted mx-1"><i class="fas fa-arrow-right text-xs"></i></span> <?= date('d M Y', strtotime($c['tanggal_selesai'])) ?>
                            </td>
                            <td class="text-muted"><?= $c['keterangan'] ?></td>
                            <td class="text-center">
                                <?php if($c['status']=='pending'): ?>
                                    <span class="badge badge-modern badge-warning-soft px-3 py-2">Pending</span>
                                <?php elseif($c['status']=='disetujui'): ?>
                                    <span class="badge badge-modern badge-success-soft px-3 py-2">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge badge-modern badge-danger-soft px-3 py-2">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($c['status']=='pending'): ?>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('admin/cuti/approve/'.$c['id']) ?>" class="btn btn-sm btn-outline-success btn-modern py-1 px-2 mx-1" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="<?= base_url('admin/cuti/reject/'.$c['id']) ?>" class="btn btn-sm btn-outline-danger btn-modern py-1 px-2 mx-1" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
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
                                <p class="mb-0">Tidak ada data cuti</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>