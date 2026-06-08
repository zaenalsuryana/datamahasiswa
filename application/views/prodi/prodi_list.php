<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Program Studi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fade-in Animation -->
    <style>
        .fade-in {
            animation: fadeIn ease 0.8s;
        }
        @keyframes fadeIn {
            0% {opacity:0; transform: translateY(10px);}
            100% {opacity:1; transform: translateY(0);}
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow fade-in">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-journal-text"></i> Data Program Studi</h4>
        </div>
        <div class="card-body">

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h5 class="text-muted">List Prodi</h5>
                <div>
                    <a href="<?= base_url() ?>" class="btn btn-secondary btn-sm me-2">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>
                    <a href="<?= site_url('prodi/add') ?>" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Prodi
                    </a>
                </div>
            </div>

            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Prodi</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang</th>
                            <th>Fakultas</th>
                            <th>Akreditasi</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($prodi)) : ?>
                            <?php foreach ($prodi as $p): ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td><?= $p->kode_prodi ?></td>
                                <td><?= $p->nama_prodi ?></td>
                                <td class="text-center"><?= $p->jenjang ?></td>
                                <td><?= $p->nama_fakultas ?? '-' ?></td>
                                <td class="text-center"><?= $p->akreditasi ?></td>
                                <td><?= $p->created_at ?></td>
                                <td><?= $p->updated_at ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('prodi/edit/'.$p->prodi_id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= site_url('prodi/delete/'.$p->prodi_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">Data tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?= $this->pagination->create_links(); ?>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
