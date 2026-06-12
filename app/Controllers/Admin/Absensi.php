<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\LogModel;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new AbsensiModel();

        $data['absensi'] = $model
            ->select('absensi.*, karyawan.nama as nama_karyawan')
            ->join('karyawan', 'karyawan.id = absensi.id_karyawan')
            ->orderBy('absensi.tanggal', 'DESC')
            ->findAll();

        return view('admin/absensi', $data);
    }

    public function edit($id)
    {
        $model = new AbsensiModel();

        $data['absensi'] = $model->find($id);

        if (!$data['absensi']) {
            return redirect()->to('/admin/absensi')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/absensi_edit', $data);
    }

    public function update($id)
    {
        $model = new AbsensiModel();

        $model->update($id, [
            'tanggal'    => $this->request->getPost('tanggal'),
            'jam_masuk'  => $this->request->getPost('jam_masuk'),
            'jam_pulang' => $this->request->getPost('jam_pulang'),
            'status'     => $this->request->getPost('status'),
        ]);

        $log = new LogModel();

        $log->tambahLog(
            session()->get('username'),
            'Update absensi ID ' . $id,
            'UPDATE'
        );

        return redirect()->to('/admin/absensi')
            ->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new AbsensiModel();
        $log   = new LogModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->to('/admin/absensi')
                ->with('error', 'Data tidak ditemukan');
        }

        $model->delete($id);

        $log->tambahLog(
            session()->get('username'),
            'Delete absensi ID ' . $id,
            'DELETE'
        );

        return redirect()->to('/admin/absensi')
            ->with('success', 'Data berhasil dihapus');
    }
}