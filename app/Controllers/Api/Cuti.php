<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CutiModel;

class Cuti extends BaseController
{
    // ================= AJUKAN CUTI =================
    public function ajukan()
    {
        try {

            $model = new CutiModel();

            $data = [
                'nama_karyawan'   => $this->request->getPost('nama_karyawan'),
                'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'keterangan'      => $this->request->getPost('keterangan'),
                'status'          => 'Pending'
            ];

            $model->insert($data);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Pengajuan cuti berhasil'
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= RIWAYAT CUTI =================
    public function riwayat()
    {
        try {

            $model = new CutiModel();

            $data = $model
                ->orderBy('id', 'DESC')
                ->findAll();

            return $this->response->setJSON([
                'status' => 'success',
                'data'   => $data
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= DETAIL CUTI =================
    public function detail($id = null)
    {
        try {

            $model = new CutiModel();

            $cuti = $model->find($id);

            if (!$cuti) {

                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Data cuti tidak ditemukan'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'data'   => $cuti
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= UPDATE STATUS CUTI =================
    public function updateStatus($id = null)
    {
        try {

            $model = new CutiModel();

            $status = $this->request->getPost('status');

            $update = $model->update($id, [
                'status' => $status
            ]);

            return $this->response->setJSON([
                'status'  => $update ? 'success' : 'error',
                'message' => $update
                    ? 'Status berhasil diupdate'
                    : 'Gagal update status'
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}