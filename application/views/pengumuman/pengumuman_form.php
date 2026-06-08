<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengumuman</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (opsional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Form Pengumuman</h1>
    <hr>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <?php 
    $judul = $isi = $tanggal = '';
    if (isset($pengumuman)) {
        $judul = $pengumuman->judul ?? '';
        $isi = $pengumuman->isi ?? '';
        $tanggal = $pengumuman->tanggal ?? '';
    }
    ?>

    <form action="<?= site_url('pengumuman/' . (isset($pengumuman) ? 'edit/' . $pengumuman->pengumuman_id : 'add')) ?>" method="post" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($judul) ?>" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea name="isi" id="isi" class="form-control" rows="5" required><?= htmlspecialchars($isi) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $tanggal ?>" required>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <div class="position-relative">
                <i class="bi bi-save position-absolute top-50 start-0 translate-middle-y ms-3 text-white"></i>
                <input type="submit" name="submit" value="Simpan" class="btn btn-success ps-5">
            </div>
            
            <a href="<?= site_url('pengumuman') ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>

    </form>
</div>

</body>
</html>
