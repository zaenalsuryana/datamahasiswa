<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>List Data Fakultas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (optional for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Fakultas</h3>
        <a href="<?= base_url() ?>" class="btn btn-secondary"><i class="fa fa-home"></i> Home</a>
    </div>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('msg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= site_url('fakultas/add') ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Fakultas
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Fakultas</th>
                    <th scope="col">Singkatan</th>
                    <th scope="col">Created At</th>
                    <th scope="col" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fakultas as $f): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $f->nama_fakultas ?></td>
                    <td><?= $f->singkatan ?></td>
                    <td><?= $f->created_at ?></td>
                    <td>
                        <a href="<?= site_url('fakultas/edit/'.$f->fakultas_id) ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= site_url('fakultas/delete/'.$f->fakultas_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
