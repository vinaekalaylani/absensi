<?php

namespace App\Controllers;

use App\Models\M_user;
use App\Models\KaryawanModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $model = new M_user();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        if ($password != $user['password']) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // ================= SESSION DASAR =================
        session()->set([
            'login'    => true,
            'id_user'  => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role']
        ]);

        // ================= ROLE CHECK =================
        if ($user['role'] == 'admin') {

            // ADMIN TIDAK PAKAI KARYAWAN
            return redirect()->to(site_url('admin/dashboard'));

        } else {

            // USER HARUS PUNYA KARYAWAN
            $karyawanModel = new KaryawanModel();

            $karyawan = $karyawanModel
                ->where('id_user', $user['id'])
                ->first();

            if (!$karyawan) {
                return redirect()->back()
                    ->with('error', 'Data karyawan belum terhubung');
            }

            session()->set('id_karyawan', $karyawan['id']);

            return redirect()->to(site_url('dashboard'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}