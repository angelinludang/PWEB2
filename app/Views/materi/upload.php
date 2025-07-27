<!DOCTYPE html>
<html>
<head>
    <title>Upload Materi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Upload Materi Edukasi</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="/materi/save" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Materi</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="PDF">PDF</option>
                                <option value="Video">Video</option>
                                <option value="Audio">Audio</option>
                                <option value="Gambar">Gambar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File (PDF, gambar, audio, video)</label>
                            <input type="file" name="file" id="file" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Gambar (opsional)</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="form-control">
                            <small class="text-muted">Gunakan gambar ukuran kecil atau rasio 16:9 untuk hasil terbaik.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
