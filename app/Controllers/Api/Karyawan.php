<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    // =====================
    // GET ALL DATA
    // =====================
    public function index()
    {
        $model = new KaryawanModel();
        $data = $model->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }

    // =====================
    // TAMBAH DATA
    // =====================
    public function store()
    {
        $model = new KaryawanModel();

        $data = [
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telp'    => $this->request->getPost('telp'),
        ];

        $insert = $model->insert($data);

        if ($insert) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Berhasil tambah karyawan'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal tambah karyawan'
            ]);
        }
    }
    public function update($id)
{
    $model = new KaryawanModel();

    $data = [
        'nama'    => $this->request->getPost('nama'),
        'jabatan' => $this->request->getPost('jabatan'),
        'telp'    => $this->request->getPost('telp'),
    ];
    $update = $model->update($id, $data);

    return $this->response->setJSON([
        'status' => $update ? true : false,
        'message' => $update ? 'Berhasil update' : 'Gagal update'
    ]);
}

    // =====================
    // DELETE DATA
    // =====================
    public function delete($id)
    {
        $model = new KaryawanModel();

        $delete = $model->delete($id);

        return $this->response->setJSON([
            'status' => $delete ? true : false,
            'message' => $delete ? 'Berhasil hapus' : 'Gagal hapus'
        ]);
    }
}