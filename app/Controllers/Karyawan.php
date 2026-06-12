<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\M_user;

class Karyawan extends BaseController
{
    // =========================
    // LIST KARYAWAN
    // =========================
    public function index()
    {
        $model = new KaryawanModel();

        return view('karyawan/index', [
            'karyawan' => $model->findAll()
        ]);
    }

    // =========================
    // TAMPIL FORM CREATE
    // =========================
    public function create()
    {
        return view('karyawan/create');
    }

    // =========================
    // SIMPAN DATA (USER + KARYAWAN)
    // =========================
    public function store()
    {
        $userModel = new M_user();
        $karyawanModel = new KaryawanModel();
        $db = \Config\Database::connect();

        $db->transStart();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama     = $this->request->getPost('nama');
        $jabatan  = $this->request->getPost('jabatan');
        $telp     = $this->request->getPost('telp');

        // VALIDASI
        if (!$username || !$password || !$nama || !$jabatan || !$telp) {
            return redirect()->back()->with('error', 'Semua field wajib diisi');
        }

        // INSERT USER
        $id_user = $userModel->insert([
            'username' => $username,
            'password' => $password,
            'role'     => 'user'
        ], true);

        if (!$id_user) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal membuat user');
        }

        // INSERT KARYAWAN
        $karyawanModel->insert([
            'id_user' => $id_user,
            'nama'    => $nama,
            'jabatan' => $jabatan,
            'telp'    => $telp
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal simpan karyawan');
        }

        return redirect()->to('/karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $model = new KaryawanModel();
        $userModel = new M_user();

        $karyawan = $model->find($id);

        if (!$karyawan) {
            return redirect()->to('/karyawan')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('karyawan/edit', [
            'karyawan' => $karyawan,
            'users'    => $userModel->findAll()
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $model = new KaryawanModel();

        $model->update($id, [
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telp'    => $this->request->getPost('telp'),
        ]);

        return redirect()->to('/karyawan')
            ->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
{
    $karyawanModel = new KaryawanModel();
    $absensiModel  = new \App\Models\AbsensiModel();
    $userModel     = new \App\Models\M_user();
    $db = \Config\Database::connect();

    $db->transStart();

    $karyawan = $karyawanModel->find($id);

    if (!$karyawan) {
        return redirect()->to('/karyawan')->with('error', 'Data tidak ditemukan');
    }

    // 1. hapus absensi dulu
    $absensiModel->where('id_karyawan', $id)->delete();

    // 2. hapus karyawan
    $karyawanModel->delete($id);

    // 3. hapus user
    $userModel->delete($karyawan['id_user']);

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->to('/karyawan')->with('error', 'Gagal hapus data');
    }

    return redirect()->to('/karyawan')->with('success', 'Data berhasil dihapus');
}}