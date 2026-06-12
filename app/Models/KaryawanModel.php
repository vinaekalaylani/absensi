<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user',
        'nama',
        'jabatan',
        'telp'
    ];
}