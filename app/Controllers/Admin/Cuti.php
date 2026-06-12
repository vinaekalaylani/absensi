<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CutiModel;

class Cuti extends BaseController
{
    public function index()
    {
        $model = new CutiModel();

        $data['cuti'] = $model
            ->select('cuti.*, karyawan.nama as nama_karyawan')
            ->join('karyawan', 'karyawan.id = cuti.id_karyawan')
            ->findAll();

        return view('admin/cuti', $data);
    }

    public function approve($id)
    {
        $model = new CutiModel();

        $model->update($id, [
            'status' => 'disetujui'
        ]);

        return redirect()->to('/admin/cuti')
            ->with('success', 'Cuti disetujui');
    }

    public function reject($id)
    {
        $model = new CutiModel();

        $model->update($id, [
            'status' => 'ditolak'
        ]);

        return redirect()->to('/admin/cuti')
            ->with('success', 'Cuti ditolak');
    }
}