<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Materi - Admin | EDUCONNECT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="/admin">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMateri" aria-controls="navbarMateri" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMateri">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="/logout" class="btn btn-outline-light">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Materi</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Uploader</th>
                    <th>Waktu Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($materi): ?>
                    <?php foreach ($materi as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($item['judul']) ?></td>
                            <td><?= esc($item['jenis']) ?></td>
                            <td>
                                <?php if ($item['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Approved</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['username']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($item['created_at'])) ?></td>
                            <td class="d-flex flex-wrap gap-1">
                                <?php if ($item['status'] === 'pending'): ?>
                                    <a href="/admin/approve/<?= $item['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                                <?php endif; ?>
                                <a href="<?= base_url($item['file_path']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="<?= base_url('admin/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus materi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">Belum ada materi tersedia.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
