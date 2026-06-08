<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data KRS Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 40px;
        }
        h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header dan Tombol Home -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mahasiswa</h3>
        <a href="<?= base_url() ?>" class="btn btn-outline-primary">
            <i class="fas fa-home"></i> Home
        </a>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('msg') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tabel Data Mahasiswa -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Fakultas</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mahasiswa)): ?>
                            <?php $i = 1; foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td><?= $mhs->npm ?></td>
                                <td><?= $mhs->nama ?></td>
                                <td><?= $mhs->prodi ?></td>
                                <td><?= $mhs->fakultas ?></td>
                                <td class="text-center"><?= $mhs->semester ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('krs?mhs_id=' . $mhs->mhs_id) ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="<?= site_url('krs/add/' . $mhs->mhs_id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-danger">Tidak ada data mahasiswa.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
