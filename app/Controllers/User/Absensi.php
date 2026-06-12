<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;

class Absensi extends BaseController
{
    // ================= LIST ABSENSI =================
    public function index()
    {
        $idUser = session()->get('id_user');

        if (!$idUser) {
            return redirect()->to('/login');
        }

        $karyawanModel = new KaryawanModel();
        $absenModel    = new AbsensiModel();

        // ambil data karyawan dari user login
        $karyawan = $karyawanModel
            ->where('id_user', $idUser)
            ->first();

        if (!$karyawan) {
            return redirect()->to('/dashboard')
                ->with('error', 'Karyawan belum terhubung dengan user');
        }

        $data['absensi'] = $absenModel
            ->where('id_karyawan', $karyawan['id'])
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('user/absensi', $data);
    }

    // ================= FORM ABSEN =================
    public function create()
    {
        $idUser = session()->get('id_user');

        if (!$idUser) {
            return redirect()->to('/login');
        }

        $karyawanModel = new KaryawanModel();

        $karyawan = $karyawanModel
            ->where('id_user', $idUser)
            ->first();

        if (!$karyawan) {
            return redirect()->to('/absensi')
                ->with('error', 'Karyawan belum terhubung');
        }

        return view('user/absensi_create', [
            'karyawan' => $karyawan
        ]);
    }

    // ================= STORE ABSENSI (TEST MODE) =================
    public function store()
    {
        $idUser = session()->get('id_user');

        if (!$idUser) {
            return redirect()->to('/login');
        }

        $karyawanModel = new KaryawanModel();
        $absenModel    = new AbsensiModel();

        $karyawan = $karyawanModel
            ->where('id_user', $idUser)
            ->first();

        if (!$karyawan) {
            return redirect()->to('/absensi')
                ->with('error', 'Karyawan tidak ditemukan');
        }

        $idKaryawan = $karyawan['id'];

        // ================= TEST MODE: TIDAK ADA PEMBATASAN =================
        // langsung insert tanpa cek absen sebelumnya

        $absenModel->insert([
            'id_karyawan' => $idKaryawan,
            'tanggal'     => date('Y-m-d'),
            'jam_masuk'   => date('H:i:s'),
            'jam_keluar'  => null,
            'status'      => 'hadir'
        ]);

        return redirect()->to('/absensi')
            ->with('success', 'Absen berhasil (TEST MODE)');
    }

    // ================= PULANG =================
    public function pulang($id)
    {
        $absenModel = new AbsensiModel();

        $absenModel->update($id, [
            'jam_keluar' => date('H:i:s')
        ]);

        return redirect()->to('/absensi')
            ->with('success', 'Absen pulang berhasil');
    }
}