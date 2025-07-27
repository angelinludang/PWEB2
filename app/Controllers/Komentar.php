<?php

namespace App\Controllers;

use App\Models\KomentarModel;

class Komentar extends BaseController
{
    protected $komentarModel;

    public function __construct()
    {
        $this->komentarModel = new KomentarModel();
    }

    public function kirimKomentar()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $isi = trim($this->request->getPost('isi'));

        if (strlen($isi) < 3) {
            return redirect()->back()->withInput()->with('error', 'Komentar minimal 3 karakter.');
        }

        $parentId = $this->request->getPost('parent_id');
        $parentId = ($parentId === '' || $parentId === null) ? null : (int)$parentId;

        $this->komentarModel->insert([
            'materi_id' => $this->request->getPost('materi_id'),
            'user_id'   => session()->get('user_id'),
            'parent_id' => $parentId,
            'isi'       => $isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function edit($id)
    {
        $komentar = $this->komentarModel->find($id);

        if (!$komentar || $komentar['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        return view('komentar/edit', ['komentar' => $komentar]);
    }

    public function update($id)
    {
        $komentar = $this->komentarModel->find($id);

        if (!$komentar || $komentar['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $isi = trim($this->request->getPost('isi'));

        if (strlen($isi) < 3) {
            return redirect()->back()->withInput()->with('error', 'Komentar minimal 3 karakter.');
        }

        $this->komentarModel->update($id, ['isi' => $isi]);

        return redirect()->to('/materi/detail/' . $komentar['materi_id'])->with('success', 'Komentar berhasil diperbarui.');
    }

    public function delete($id)
    {
        $komentar = $this->komentarModel->find($id);

        if (!$komentar || $komentar['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $this->komentarModel->where('id', $id)
                            ->orWhere('parent_id', $id)
                            ->delete();

        return redirect()->to('/materi/detail/' . $komentar['materi_id'])->with('success', 'Komentar berhasil dihapus.');
    }
}
