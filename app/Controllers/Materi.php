<?php

namespace App\Controllers;

use App\Models\MateriModel;
use App\Models\KomentarModel;
use App\Models\UserModel;

class Materi extends BaseController
{
    public function upload()
    {
        return view('materi/upload');
    }

    public function save()
    {
        $file = $this->request->getFile('file');
        $thumbnail = $this->request->getFile('thumbnail');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $newName = $file->getRandomName();
        $file->move('uploads', $newName);

        $mimeType = $file->getClientMimeType();
        $jenis = explode('/', $mimeType)[0];

        $thumbnailName = null;
        if ($thumbnail && $thumbnail->isValid()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move('thumbnails', $thumbnailName);
        }

        $status = (session('role') === 'admin') ? 'approved' : 'pending';

        $materiModel = new MateriModel();
        $materiModel->insert([
            'judul'      => $this->request->getPost('judul'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'jenis'      => $jenis,
            'file_path'  => 'uploads/' . $newName,
            'thumbnail'  => $thumbnailName ? 'thumbnails/' . $thumbnailName : null,
            'status'     => $status,
            'user_id'    => session('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/home')->with('success', 'Materi berhasil diunggah' . 
            ($status === 'pending' ? ' dan menunggu persetujuan admin.' : '.'));
    }

    public function detail($id)
    {
        $materiModel = new MateriModel();
        $komentarModel = new KomentarModel();
        $userModel = new UserModel();

        $materi = $materiModel
                    ->select('materi.*, users.username')
                    ->join('users', 'users.id = materi.user_id')
                    ->where('materi.id', $id)
                    ->first();

        $komentar = $komentarModel->getKomentarBertingkat($id);

        return view('materi/detail', [
            'materi' => $materi,
            'komentar' => $komentar
        ]);
    }
}
