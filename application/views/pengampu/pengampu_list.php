<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengampu</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap JS + Popper (optional, for components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-3">Data Pengampu</h1>

    <a href="<?= base_url() ?>" class="btn btn-secondary mb-3">
        <i class="bi bi-house"></i> Home
    </a>

    <?= $this->session->flashdata('msg') ?>

    <a href="<?= site_url('pengampu/add') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Pengampu
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach($pengampu as $p): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $p->nama_dosen ?></td>
                    <td><?= $p->nama_mk ?></td>
                    <td><?= $p->tahun_ajaran ?></td>
                    <td><?= $p->semester ?></td>
                    <td>
                        <a href="<?= site_url('pengampu/delete/'.$p->pengampu_id) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
