<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($fakultas) ? 'Edit Fakultas' : 'Tambah Fakultas' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= isset($fakultas) ? 'Edit Data Fakultas' : 'Tambah Data Fakultas' ?></h4>
        </div>

        <div class="card-body">
            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('msg'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <?php 
                $nama_fakultas = $singkatan = '';
                if (isset($fakultas)) {
                    $nama_fakultas = $fakultas->nama_fakultas ?? '';
                    $singkatan = $fakultas->singkatan ?? '';
                }
            ?>

            <form action="<?= site_url('fakultas/' . (isset($fakultas) ? 'edit/' . $fakultas->fakultas_id : 'add')) ?>" method="post">
                <div class="mb-3">
                    <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                    <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" value="<?= $nama_fakultas ?>" required>
                </div>
                <div class="mb-3">
                    <label for="singkatan" class="form-label">Singkatan</label>
                    <input type="text" class="form-control" id="singkatan" name="singkatan" value="<?= $singkatan ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <input type="submit" name="submit" class="btn btn-success" value="Simpan">
                    <a href="<?= site_url('fakultas') ?>" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Batal
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
