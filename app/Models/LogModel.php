<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user',
        'aktivitas',
        'aksi',
        'created_at'
    ];

    // AUTO TIMESTAMP
    protected $useTimestamps = false;

    // =======================
    // TAMBAH LOG
    // =======================
    public function tambahLog($user, $aktivitas, $aksi)
    {
        return $this->insert([
            'user'      => $user,
            'aktivitas' => $aktivitas,
            'aksi'      => $aksi,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}