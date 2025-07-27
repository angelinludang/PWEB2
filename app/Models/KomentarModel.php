<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'komentar';
    protected $allowedFields = ['materi_id', 'user_id', 'parent_id', 'isi'];
    protected $useTimestamps = true;

    public function getKomentarBertingkat($materiId)
    {
        $komentarFlat = $this->select('komentar.*, users.username')
                             ->join('users', 'users.id = komentar.user_id')
                             ->where('materi_id', $materiId)
                             ->orderBy('created_at', 'ASC')
                             ->findAll();

        $komentarTerstruktur = [];
        $map = [];

        foreach ($komentarFlat as $k) {
            $k['children'] = [];
            $map[$k['id']] = $k;
        }

        foreach ($map as $id => &$komentar) {
            if (!is_null($komentar['parent_id']) && isset($map[$komentar['parent_id']])) {
                $map[$komentar['parent_id']]['children'][] = &$komentar;
            } else {
                $komentarTerstruktur[] = &$komentar;
            }
        }

        return $komentarTerstruktur;
    }
}
