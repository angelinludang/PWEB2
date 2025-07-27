<?php

namespace App\Controllers;

use App\Models\MateriModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $materiModel;

    public function __construct()
    {

        $this->materiModel = new MateriModel();
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function materi()
    {
        $materi = $this->materiModel
            ->select('materi.*, users.username')
            ->join('users', 'users.id = materi.user_id')
            ->orderBy('materi.created_at', 'DESC')
            ->findAll();

        return view('admin/materi_list', ['materi' => $materi]);
    }

    public function approve($id)
    {
        $materi = $this->materiModel->find($id);

        if (!$materi) {
            return redirect()->to('/admin/materi')->with('error', 'Materi tidak ditemukan.');
        }

        $this->materiModel->update($id, ['status' => 'approved']);

        return redirect()->to('/admin/materi')->with('success', 'Materi berhasil disetujui.');
    }

    public function delete($id)
    {
        $materi = $this->materiModel->find($id);

        if (!$materi) {
            return redirect()->to('/admin/materi')->with('error', 'Materi tidak ditemukan.');
        }

        $this->materiModel->delete($id);

        return redirect()->to('/admin/materi')->with('success', 'Materi berhasil dihapus.');
    }
}
