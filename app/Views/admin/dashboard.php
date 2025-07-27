<!-- app/Views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - EDUCONNECT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Untuk responsif -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item me-2">
                <a href="/home" class="btn btn-outline-light">🏠 Kembali ke Home</a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="btn btn-outline-light">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Halo, <?= ucfirst(session('username')) ?></h2>
    <p class="lead">Selamat datang di Dashboard Admin EDUCONNECT</p>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <a href="/admin/materi" class="btn btn-primary w-100">Kelola Materi</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="/materi/upload" class="btn btn-success w-100">Upload Materi Baru</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
