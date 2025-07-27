<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($materi['judul']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .comment { margin-bottom: 1rem; }
        .reply { margin-left: 1.5rem; }
        .comment-box {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="mb-4">
        <a href="/home" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-body">
            <h3 class="card-title"><?= esc($materi['judul']) ?></h3>
            <p class="card-text"><?= esc($materi['deskripsi']) ?></p>
            <p><strong>Jenis:</strong> <?= esc($materi['jenis']) ?></p>
            <p><strong>Diunggah oleh:</strong> <?= esc($materi['username']) ?></p>
            <a href="<?= base_url($materi['file_path']) ?>" class="btn btn-primary" target="_blank">📄 Unduh / Lihat Materi</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">💬 Komentar</h5>

            <!-- Form Komentar Utama -->
            <?php if (session()->get('logged_in')): ?>
                <form action="/komentar/add" method="post" class="mb-3">
                    <input type="hidden" name="materi_id" value="<?= esc($materi['id']) ?>">
                    <input type="hidden" name="parent_id" value="">
                    <div class="mb-2">
                        <textarea name="isi" class="form-control" placeholder="Tulis komentar minimal 3 karakter..." required minlength="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">💬 Kirim Komentar</button>
                </form>
            <?php else: ?>
                <p><a href="/login">Login</a> untuk memberikan komentar.</p>
            <?php endif; ?>

            <?php
            function renderKomentarBertingkat($komentar)
            {
                foreach ($komentar as $komen) {
                    echo '<div class="comment' . (!is_null($komen['parent_id']) ? ' reply' : '') . '">';
                    echo '<div class="comment-box">';

                    $isAdmin = strtolower($komen['username']) === 'admin';
                    $isOwner = session()->get('user_id') == $komen['user_id'];

                    echo '<strong>' . esc($komen['username']);
                    if ($isAdmin) echo ' <span class="badge bg-danger">Admin</span>';
                    if ($isOwner && !$isAdmin) echo ' <span class="badge bg-secondary">Anda</span>';
                    echo ':</strong>';

                    echo '<p>' . esc($komen['isi']) . '</p>';
                    echo '<small class="text-muted">' . esc($komen['created_at']) . '</small>';

                    if ($isOwner) {
                        echo '<div class="mt-2">';
                        echo '<a href="/komentar/edit/' . $komen['id'] . '" class="btn btn-sm btn-warning me-1">✏️ Edit</a>';
                        echo '<form action="/komentar/delete/' . $komen['id'] . '" method="post" style="display:inline;" onsubmit="return confirm(\'Yakin ingin menghapus komentar ini?\')">';
                        echo csrf_field();
                        echo '<button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>';
                        echo '</form>';
                        echo '</div>';
                    }

                    echo '</div>';

                    if (session()->get('logged_in')) {
                        echo '<form action="/komentar/add" method="post" class="mt-2">';
                        echo '<input type="hidden" name="materi_id" value="' . esc($komen['materi_id']) . '">';
                        echo '<input type="hidden" name="parent_id" value="' . esc($komen['id']) . '">';
                        echo '<textarea name="isi" class="form-control mb-2" placeholder="Balas komentar minimal 3 karakter..." required minlength="3"></textarea>';
                        echo '<button type="submit" class="btn btn-sm btn-outline-primary">↪ Balas</button>';
                        echo '</form>';
                    }

                    if (!empty($komen['children'])) {
                        renderKomentarBertingkat($komen['children']);
                    }

                    echo '</div>';
                }
            }
            ?>

            <div class="mt-4">
                <?php renderKomentarBertingkat($komentar); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
