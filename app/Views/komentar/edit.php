<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Komentar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Untuk responsif -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Komentar</h5>
                </div>
                <div class="card-body">

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="/komentar/update/<?= $komentar['id'] ?>" method="post">
                        <div class="mb-3">
                            <label for="isi" class="form-label">Komentar</label>
                            <textarea id="isi" name="isi" class="form-control" required minlength="3" rows="4"><?= esc($komentar['isi']) ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/materi/detail/<?= $komentar['materi_id'] ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
