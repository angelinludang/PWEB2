<?php

namespace App\Controllers;

use App\Models\MateriModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/home/dashboard');
        }

        $materiModel = new MateriModel();
        $materi = $materiModel
            ->where('status', 'approved')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('home_guest', ['materi' => $materi]);
    }

    public function dashboard()
    {

        $materiModel = new MateriModel();
        $materi = $materiModel
            ->where('status', 'approved')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('home_user', ['materi' => $materi]);
    }
}
