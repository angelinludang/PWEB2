<!-- 
Nama Anggota Kelompok:
- Aldy Rianto (230401010130)
- Angelin Ludang (230401010049)
- Daniel Onggo (230401010177)
- Winda Meyliana Muzdalifatul Ulya (230401011002)

Kelas: IF 403
Mata Kuliah: Pemrograman Web II
-->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - EDUCONNECT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @media (max-width: 576px) {
            .card-img-top {
                height: 150px !important;
            }
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
            .btn-sm {
                font-size: 0.8rem;
            }
        }

        .text-truncate-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 shadow-sm">
    <a class="navbar-brand fw-bold text-primary" href="#">EDUCONNECT</a>
    <div class="ms-auto d-flex align-items-center">
        <a href="<?= base_url('materi/upload') ?>" class="btn btn-success me-2">
            <i class="bi bi-upload"></i> Upload Materi
        </a>
        <a href="<?= base_url('profil') ?>" class="btn btn-outline-secondary me-2">
            <i class="bi bi-person"></i> Profil
        </a>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>

<header class="bg-primary text-white text-center py-5 mb-4">
    <div class="container">
        <h1 class="display-6 fw-bold">Halo, <?= session('username') ?>!!</h1>
        <p class="lead">Selamat datang kembali di platform edukasi.</p>
    </div>
</header>

<section class="container">
    <h3 class="text-center mb-4">News</h3>
    <div class="row">
        <?php if ($materi): ?>
            <?php foreach ($materi as $item): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php
                            $thumbnailPath = '';
                            if (!empty($item['thumbnail']) && file_exists(FCPATH . $item['thumbnail'])) {
                                $thumbnailPath = base_url($item['thumbnail']);
                            } elseif (strpos($item['jenis'], 'image') === 0) {
                                $thumbnailPath = base_url($item['file_path']);
                            } else {
                                $thumbnailPath = base_url('assets/default-thumbnail.png');
                            }
                        ?>
                        <img src="<?= $thumbnailPath ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="Materi">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['judul']) ?></h5>
                            <p class="card-text text-truncate-2"><?= esc($item['deskripsi']) ?></p>
                            <span class="badge bg-secondary"><?= esc($item['jenis']) ?></span>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between">
                            <a href="<?= base_url('materi/detail/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary w-100">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada materi yang tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<footer class="bg-light text-center text-muted py-3 mt-5 border-top">
    <small>&copy; <?= date('Y') ?> EDUCONNECT. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
