<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MateriModel;

class User extends BaseController
{
    public function profil()
    {
        $userId = session('user_id');

        $userModel = new UserModel();
        $materiModel = new MateriModel();

        $user = $userModel->find($userId);
        $materiSaya = $materiModel->where('user_id', $userId)->findAll();

        return view('user/profil', [
            'user' => $user,
            'materi' => $materiSaya
        ]);
    }

    public function upload_foto()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaBaru = $file->getRandomName();
            $file->move('uploads/foto/', $namaBaru);

            $data = ['foto' => 'uploads/foto/' . $namaBaru];


            if (!empty($data)) {
                $userModel->update($userId, $data);
                return redirect()->to('/profil')->with('success', 'Foto profil berhasil diperbarui.');
            } else {
                return redirect()->to('/profil')->with('error', 'Tidak ada data yang diubah.');
            }
        }

        return redirect()->to('/profil')->with('error', 'Upload gagal. Pastikan file valid.');
    }

}
