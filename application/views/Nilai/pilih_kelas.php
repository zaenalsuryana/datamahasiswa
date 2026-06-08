<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mata Kuliah yang Anda Ampu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">

    <h3 class="mb-4">📚 Daftar Mata Kuliah yang Anda Ampu</h3>

    <?php if (empty($pengampu)): ?>
        <div class="alert alert-warning">Tidak ada data mata kuliah yang diampu.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($pengampu as $p): ?>
                <a href="<?= site_url('nilai/input/'.$p->pengampu_id) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= htmlspecialchars($p->nama_mk) ?></strong><br>
                        <small><?= htmlspecialchars($p->tahun_ajaran) ?> - Periode: <?= htmlspecialchars($p->periode) ?></small>
                    </div>
                    <span class="badge bg-primary">Input Nilai</span>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?= base_url() ?>" class="btn btn-secondary">🏠 Kembali ke Home</a>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
