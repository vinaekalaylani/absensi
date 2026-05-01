<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new AbsensiModel();

        $data['absensi'] = $model
            ->where('nama_karyawan', session()->get('username'))
            ->findAll();

        return view('user/absensi', $data);
    }

    // =====================
    // ABSEN FORM (CREATE)
    // =====================
    public function create()
    {
        return view('user/absensi_create');
    }

    // =====================
    // STORE ABSEN
    // =====================
    public function store()
    {
        $model = new AbsensiModel();

        $status = $this->request->getPost('status');
        if (!$status) {
            $status = 'hadir';
        }

        $model->insert([
            'nama_karyawan' => session()->get('username'),
            'tanggal'       => date('Y-m-d'),
            'jam_masuk'     => date('H:i:s'),
            'status'        => $status
        ]);

        return redirect()->to('/absensi')
            ->with('success', 'Berhasil Mengisi Absensi');
    }

    // =====================
    // ABSEN PULANG
    // =====================
    public function pulang($id)
    {
        $model = new AbsensiModel();

        $model->update($id, [
            'jam_pulang' => date('H:i:s')
        ]);

        return redirect()->to('/absensi')
            ->with('success', 'Berhasil Absen Pulang');
    }
}