<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\AbsensiModel;

class User extends BaseController
{
    public function dashboard()
    {
        $id_karyawan = session()->get('id_karyawan');

        if (!$id_karyawan) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $cuti = new CutiModel();
        $absen = new AbsensiModel();

        // ===== DATA CUTI USER =====
        $data['total_cuti'] = $cuti->where('id_karyawan', $id_karyawan)->countAllResults();

        $data['pending'] = $cuti->where('id_karyawan', $id_karyawan)
                                ->where('status','pending')
                                ->countAllResults();

        $data['disetujui'] = $cuti->where('id_karyawan', $id_karyawan)
                                  ->where('status','disetujui')
                                  ->countAllResults();

        $data['ditolak'] = $cuti->where('id_karyawan', $id_karyawan)
                                ->where('status','ditolak')
                                ->countAllResults();

        // ===== ABSENSI HARI INI =====
        $today = date('Y-m-d');

        $data['hadir'] = $absen->where('id_karyawan', $id_karyawan)
                               ->where('tanggal', $today)
                               ->where('status','hadir')
                               ->countAllResults();

        $data['tidak_hadir'] = $absen->where('id_karyawan', $id_karyawan)
                                    ->where('tanggal', $today)
                                    ->where('status','tidak_hadir')
                                    ->countAllResults();

        return view('user/dashboard', $data);
    }
}