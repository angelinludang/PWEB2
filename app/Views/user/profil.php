<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - EDUCONNECT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
    <a class="navbar-brand fw-bold" href="#">EDUCONNECT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarUser">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-2">
                <a href="/home" class="btn btn-outline-light"><i class="bi bi-house-door"></i> Beranda</a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="btn btn-light"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<section class="container my-5">
    <h2 class="mb-4 text-center">Profil Saya</h2>

    <!-- Alert Success/Error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <?php
                        $fotoProfil = !empty($user['foto']) && file_exists(FCPATH . $user['foto']) 
                            ? base_url($user['foto']) 
                            : base_url('assets/default-user.png');
                    ?>
                    <img src="<?= $fotoProfil ?>" class="profile-img mb-3" alt="Foto Profil">
                    
                    <form action="<?= base_url('profil/upload_foto') ?>" method="post" enctype="multipart/form-data" class="mb-3">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-upload"></i> Ganti Foto
                            </button>
                        </div>
                    </form>
                    
                    <h5 class="card-title mt-3"><?= esc($user['username']) ?></h5>
                    <p class="text-muted mb-1"><?= esc($user['email']) ?></p>
                    <span class="badge bg-success"><?= esc(ucfirst($user['role'])) ?></span>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-4 text-center">Materi Saya</h4>
    <div class="row">
        <?php if ($materi): ?>
            <?php foreach ($materi as $item): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php
                            $thumbnailPath = '';
                            if (!empty($item['thumbnail']) && file_exists(FCPATH . $item['thumbnail'])) {
                                $thumbnailPath = base_url($item['thumbnail']);
                            } elseif ($item['jenis'] === 'image') {
                                $thumbnailPath = base_url($item['file_path']);
                            } else {
                                $thumbnailPath = base_url('assets/default-thumbnail.png');
                            }
                        ?>
                        <img src="<?= $thumbnailPath ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Thumbnail Materi">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['judul']) ?></h5>
                            <p class="card-text"><?= esc(strlen($item['deskripsi']) > 100 ? substr($item['deskripsi'], 0, 100) . '...' : $item['deskripsi']) ?></p>
                            <span class="badge bg-secondary"><?= esc($item['jenis']) ?></span>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="<?= base_url('materi/detail/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary w-100">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada materi yang Anda unggah.</p>
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
