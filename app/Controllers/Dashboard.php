<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\LogModel;
use App\Models\KaryawanModel;
use App\Models\AbsensiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        $cutiModel     = new CutiModel();
        $logModel      = new LogModel();
        $karyawanModel = new KaryawanModel();
        $absenModel    = new AbsensiModel();

        // =====================================================
        // 🔴 ADMIN DASHBOARD
        // =====================================================
        if ($role === 'admin') {

            $data['total_cuti'] = $cutiModel->countAll();
            $data['pending']    = $cutiModel->where('status', 'pending')->countAllResults();
            $data['disetujui']  = $cutiModel->where('status', 'disetujui')->countAllResults();
            $data['ditolak']    = $cutiModel->where('status', 'ditolak')->countAllResults();

            $data['total_karyawan'] = $karyawanModel->countAll();

            $today = date('Y-m-d');

            $data['hadir'] = $absenModel
                ->where('tanggal', $today)
                ->where('status', 'hadir')
                ->countAllResults();

            $data['tidak_hadir'] = $absenModel
                ->where('tanggal', $today)
                ->where('status', 'tidak_hadir')
                ->countAllResults();

            // Grafik cuti per bulan
            $bulan  = [];
            $jumlah = [];

            for ($i = 1; $i <= 12; $i++) {

                $bulan[] = date('M', mktime(0, 0, 0, $i, 1));

                $jumlah[] = (new CutiModel())
                    ->where('MONTH(tanggal_mulai)', $i)
                    ->countAllResults();
            }

            $data['bulan']  = json_encode($bulan);
            $data['jumlah'] = json_encode($jumlah);

            $data['log'] = $logModel
                ->orderBy('id', 'DESC')
                ->findAll(5);

            return view('admin/dashboard', $data);
        }

        // =====================================================
        // 🟢 USER DASHBOARD (FIXED FULL)
        // =====================================================

        $id_karyawan = session()->get('id_karyawan');

        if (!$id_karyawan) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // ================= CUTI =================
        $data['total_cuti'] = $cutiModel
            ->where('id_karyawan', $id_karyawan)
            ->countAllResults();

        $data['pending'] = $cutiModel
            ->where('id_karyawan', $id_karyawan)
            ->where('status', 'pending')
            ->countAllResults();

        $data['disetujui'] = $cutiModel
            ->where('id_karyawan', $id_karyawan)
            ->where('status', 'disetujui')
            ->countAllResults();

        $data['ditolak'] = $cutiModel
            ->where('id_karyawan', $id_karyawan)
            ->where('status', 'ditolak')
            ->countAllResults();

        // ================= ABSENSI =================
        $today = date('Y-m-d');

        $data['hadir'] = $absenModel
            ->where('id_karyawan', $id_karyawan)
            ->where('tanggal', $today)
            ->where('status', 'hadir')
            ->countAllResults();

        $data['tidak_hadir'] = $absenModel
            ->where('id_karyawan', $id_karyawan)
            ->where('tanggal', $today)
            ->where('status', 'tidak_hadir')
            ->countAllResults();

        return view('user/dashboard', $data);
    }
}