<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\M_user;

class Auth extends BaseController
{
    public function login()
    {
        $model = new M_user();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Username tidak ditemukan'
            ]);
        }

        if ($password != $user['password']) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Password salah'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]
        ]);
    }
}