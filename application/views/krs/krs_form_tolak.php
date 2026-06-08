<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penolakan KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0"><i class="fas fa-ban"></i> Form Penolakan KRS Mahasiswa</h4>
        </div>
        <div class="card-body">
            <!-- Kembali -->
            <div class="mb-3">
                <a href="<?= site_url('krs') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <!-- Informasi KRS -->
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Nama Mahasiswa:</strong> <?= htmlspecialchars($krs->nama_mhs) ?></li>
                <li class="list-group-item"><strong>Mata Kuliah:</strong> <?= htmlspecialchars($krs->nama_mk) ?></li>
                <li class="list-group-item"><strong>Dosen Pengampu:</strong> <?= htmlspecialchars($krs->nama_dosen) ?></li>
                <li class="list-group-item"><strong>Semester:</strong> <?= htmlspecialchars($krs->semester) ?></li>
                <li class="list-group-item"><strong>Tahun Ajaran:</strong> <?= htmlspecialchars($krs->tahun_ajaran) ?></li>
            </ul>

            <!-- Flash Message -->
            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('msg') ?></div>
            <?php endif; ?>

            <!-- Form Penolakan -->
            <form action="<?= site_url('krs/reject/' . $krs->krs_id) ?>" method="post">
                <div class="mb-3">
                    <label for="alasan_penolakan" class="form-label">Alasan Penolakan:</label>
                    <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control" rows="4" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle"></i> Tolak KRS
                    </button>
                    <a href="<?= site_url('krs') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-undo"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
