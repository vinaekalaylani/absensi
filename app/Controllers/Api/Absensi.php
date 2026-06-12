<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;

class Absensi extends BaseController
{
    // ================= TAMPIL DATA ABSENSI =================
    public function index()
    {
        $model = new AbsensiModel();

        $data = $model
            ->select('absensi.*, karyawan.nama')
            ->join('karyawan', 'karyawan.id = absensi.id_karyawan')
            ->orderBy('absensi.id', 'DESC')
            ->findAll();

        return $this->response->setJSON($data);
    }

    // ================= ABSEN MASUK =================
    public function masuk()
    {
        $model = new AbsensiModel();

        $id_karyawan = $this->request->getPost('id_karyawan');

        if (!$id_karyawan) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'ID Karyawan wajib diisi'
            ]);
        }

        // cek apakah sudah absen hari ini
        $cek = $model->where('id_karyawan', $id_karyawan)
                     ->where('tanggal', date('Y-m-d'))
                     ->first();

        if ($cek) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Anda sudah absen hari ini'
            ]);
        }

        $data = [
            'id_karyawan' => $id_karyawan,
            'tanggal'     => date('Y-m-d'),
            'jam_masuk'   => date('H:i:s'),
            'status'      => 'HADIR'
        ];

        $model->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Absen masuk berhasil'
        ]);
    }

    // ================= ABSEN PULANG =================
    public function keluar()
    {
        try {

            $model = new AbsensiModel();

            $id_karyawan = $this->request->getPost('id_karyawan');

            $absen = $model->where('id_karyawan', $id_karyawan)
                           ->where('tanggal', date('Y-m-d'))
                           ->first();

            if (!$absen) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Data absensi tidak ditemukan'
                ]);
            }

            if (!empty($absen['jam_pulang'])) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Anda sudah absen pulang'
                ]);
            }

            $model->update($absen['id'], [
                'jam_pulang' => date('H:i:s'),
                'status'     => 'PULANG'
            ]);

            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => 'Absen pulang berhasil',
                'jam_pulang' => date('H:i:s')
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= HAPUS DATA =================
    public function delete()
{
    $model = new AbsensiModel();

    $id = $this->request->getPost('id');

    if (!$id) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'ID kosong'
        ]);
    }

    $data = $model->find($id);

    if (!$data) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    $model->delete($id);

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Berhasil dihapus'
    ]);
}
}