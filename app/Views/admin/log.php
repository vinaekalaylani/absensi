<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-0">Log Aktivitas Sistem</h3>
</div>

<div class="card card-modern">
    <div class="card-body p-0">
        <div class="table-responsive p-4">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Aksi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if(!empty($log)): ?>
                        <?php foreach($log as $l): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td class="font-weight-medium text-dark">
                                    <i class="fas fa-user-circle text-secondary mr-2"></i><?= esc($l['user'] ?? '-') ?>
                                </td>
                                <td><?= esc($l['aktivitas'] ?? '-') ?></td>
                                <td>
                                    <span class="badge badge-light border px-2 py-1"><?= esc($l['aksi'] ?? '-') ?></span>
                                </td>
                                <td class="text-muted">
                                    <?= !empty($l['created_at']) 
                                        ? date('d M Y, H:i', strtotime($l['created_at'])) 
                                        : '-' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-history fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Tidak ada log aktivitas</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>