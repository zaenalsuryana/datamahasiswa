<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">📅 Daftar Jadwal yang Diampu</h2>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($jadwal as $j): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($j->nama_mk) ?></td>
                    <td><?= htmlspecialchars($j->hari) ?></td>
                    <td><?= htmlspecialchars($j->jam_mulai) ?> - <?= htmlspecialchars($j->jam_selesai) ?></td>
                    <td><?= htmlspecialchars($j->semester) ?></td>
                    <td><?= htmlspecialchars($j->tahun_ajaran) ?></td>
                    <td>
                        <a href="<?= site_url('nilai/input/'.$j->jadwal_id) ?>" class="btn btn-sm btn-primary">✍ Input Nilai</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($jadwal)): ?>
                <tr>
                    <td colspan="7" class="text-center text-danger">Belum ada jadwal yang diampu.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
