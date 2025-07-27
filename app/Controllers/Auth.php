<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();

            $data = [
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'     => 'user'
            ];

            $userModel->insert($data);
            return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login!');
        }

        return view('auth/register');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => true
                ]);


                return redirect()->to($user['role'] === 'admin' ? '/admin' : '/home');
            }

            return redirect()->back()->with('error', 'Login gagal, periksa email atau password.');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
