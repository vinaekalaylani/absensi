<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-0">Manajemen Karyawan</h3>
    <a href="<?= base_url('karyawan/create') ?>" class="btn btn-modern btn-primary-gradient shadow-sm">
        <i class="fas fa-user-plus mr-1"></i> Tambah Karyawan
    </a>
</div>

<div class="card card-modern">
    <div class="card-body p-0">
        <div class="table-responsive p-4">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No. Telp</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($karyawan as $k): ?>
                    <tr>
                        <td class="text-muted"><?= $no++ ?></td>
                        <td class="font-weight-medium text-dark">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 mr-2 text-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <?= $k['nama'] ?>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-light border px-2 py-1"><?= $k['jabatan'] ?></span>
                        </td>
                        <td class="text-muted"><?= $k['telp'] ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= base_url('karyawan/edit/'.$k['id']) ?>" class="btn btn-sm btn-outline-primary btn-modern py-1 px-2 mx-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('karyawan/delete/'.$k['id']) ?>" class="btn btn-sm btn-outline-danger btn-modern py-1 px-2 mx-1" 
                                   onclick="return confirm('Yakin ingin menghapus karyawan ini?')" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($karyawan)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">Belum ada data karyawan</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>