<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Jadwal Kuliah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (opsional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-3">Data Jadwal Kuliah</h1>
    <h5 class="text-muted">List Jadwal</h5>

    <div class="mb-3">
        <a href="<?= base_url() ?>" class="btn btn-secondary me-2">
            <i class="bi bi-house-door-fill"></i> Home
        </a>
        <a href="<?= site_url('penjadwalan/add') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill"></i> Tambah Jadwal
        </a>
    </div>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Ruang</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = isset($i) ? $i : 1; ?>
                <?php if (!empty($jadwal)): ?>
                    <?php foreach ($jadwal as $j): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($j->nama_mk) ?></td>
                        <td><?= htmlspecialchars($j->nama_dosen) ?></td>
                        <td><?= htmlspecialchars($j->hari) ?></td>
                        <td><?= htmlspecialchars($j->jam_mulai) ?></td>
                        <td><?= htmlspecialchars($j->jam_selesai) ?></td>
                        <td><?= htmlspecialchars($j->ruang) ?></td>
                        <td><?= htmlspecialchars($j->semester) ?></td>
                        <td><?= htmlspecialchars($j->tahun_ajaran) ?></td>
                        <td>
                            <a href="<?= site_url('penjadwalan/edit/'.$j->jadwal_id) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="<?= site_url('penjadwalan/delete/'.$j->jadwal_id) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus data ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">Data belum tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

</body>
</html>
