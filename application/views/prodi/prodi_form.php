<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Program Studi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animasi CSS -->
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow fade-in">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-mortarboard-fill"></i> Form Data Program Studi</h4>
        </div>
        <div class="card-body">

            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
            <?php endif; ?>

            <?php 
            $kode_prodi = $nama_prodi = $jenjang = $akreditasi = $fakultas_id = '';

            if (isset($prodi)) {
                $kode_prodi = $prodi->kode_prodi ?? '';
                $nama_prodi = $prodi->nama_prodi ?? '';
                $jenjang = $prodi->jenjang ?? '';
                $fakultas_id = $prodi->fakultas_id ?? '';
                $akreditasi = $prodi->akreditasi ?? '';
            }
            ?>

            <form action="<?= site_url('prodi/' . (isset($prodi) ? 'edit/' . $prodi->prodi_id : 'add')) ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Kode Prodi</label>
                    <input type="text" name="kode_prodi" class="form-control" value="<?= $kode_prodi ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control" value="<?= $nama_prodi ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenjang</label>
                    <select name="jenjang" class="form-select" required>
                        <option value="">Pilih Jenjang</option>
                        <?php foreach (['D1','D2','D3','D4','S1','S2','S3'] as $j): ?>
                            <option value="<?= $j ?>" <?= ($jenjang == $j) ? 'selected' : '' ?>><?= $j ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <select name="fakultas_id" class="form-select" required>
                        <option value="">Pilih Fakultas</option>
                        <?php foreach ($fakultas as $f): ?>
                            <option value="<?= $f->fakultas_id ?>" <?= ($fakultas_id == $f->fakultas_id) ? 'selected' : '' ?>><?= $f->nama_fakultas ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Akreditasi</label>
                    <select name="akreditasi" class="form-select" required>
                        <option value="">Pilih Akreditasi</option>
                        <?php foreach (['A','B','C','Tidak Terakreditasi'] as $a): ?>
                            <option value="<?= $a ?>" <?= ($akreditasi == $a) ? 'selected' : '' ?>><?= $a ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <input type="submit" class="btn btn-success" value="✔ Simpan">
                    <a href="<?= site_url('prodi') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
