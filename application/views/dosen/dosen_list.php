<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>List Data Dosen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (Opsional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f8f9fa;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .action-btns a {
            margin-right: 6px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary"><i class="fa fa-users me-2"></i>List Data Dosen</h3>
        <a href="<?= base_url() ?>" class="btn btn-secondary">
            <i class="fa fa-home"></i> Beranda
        </a>
    </div>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('msg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= site_url('dosen/add') ?>" class="btn btn-success">
            <i class="fa fa-plus-circle"></i> Tambah Dosen
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>User ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dosen) > 0): ?>
                    <?php foreach ($dosen as $d): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $d->user_id ?></td>
                        <td><?= $d->nama ?></td>
                        <td><?= $d->email ?></td>
                        <td><?= $d->nip ?></td>
                        <td><?= $d->nama_prodi ?></td>
                        <td><?= $d->nama_fakultas ?></td>
                        <td class="action-btns">
                            <a href="<?= site_url('dosen/edit/'.$d->dosen_id) ?>" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="<?= site_url('dosen/delete/'.$d->dosen_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada data dosen.</td>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
