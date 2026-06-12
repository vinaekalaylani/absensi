<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CutiModel;
use App\Models\KaryawanModel;

class Cuti extends BaseController
{
    protected $cutiModel;

    public function __construct()
    {
        $this->cutiModel = new CutiModel();
    }

    public function index()
    {
        $id_karyawan = session()->get('id_karyawan');

        if (!$id_karyawan) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'cuti' => $this->cutiModel
                ->where('id_karyawan', $id_karyawan)
                ->orderBy('id', 'DESC')
                ->findAll()
        ];

        return view('user/cuti', $data);
    }

    public function create()
    {
        return view('user/cuti_create');
    }

    public function store()
    {
        $id_karyawan = session()->get('id_karyawan');

        if (!$id_karyawan) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // VALIDASI FK (ANTI ERROR)
        $karyawanModel = new KaryawanModel();

        if (!$karyawanModel->find($id_karyawan)) {
            return redirect()->back()
                ->with('error', 'Data karyawan tidak valid');
        }

        $this->cutiModel->insert([
            'id_karyawan'     => $id_karyawan,
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'status'          => 'pending'
        ]);

        return redirect()->to('/cuti')
            ->with('success', 'Cuti berhasil diajukan');
    }
}