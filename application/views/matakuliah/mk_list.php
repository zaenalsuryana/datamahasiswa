<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Matakuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3>Data Matakuliah</h3>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url() ?>" class="btn btn-outline-secondary">🏠 Home</a>
        <a href="<?= site_url('matakuliah/add') ?>" class="btn btn-primary">➕ Tambah Matakuliah</a>
    </div>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <!-- Filter -->
    <form method="get" action="<?= site_url('matakuliah') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="prodi_id" class="form-label">Filter Program Studi</label>
            <select name="prodi_id" id="prodi_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Prodi</option>
                <?php foreach ($prodi as $p): ?>
                    <option value="<?= $p->prodi_id ?>" <?= ($selected_prodi == $p->prodi_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p->nama_prodi) ?> (<?= htmlspecialchars($p->nama_fakultas) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="semester" class="form-label">Filter Semester</label>
            <select name="semester" id="semester" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Semester</option>
                <?php for ($s = 1; $s <= 8; $s++): ?>
                    <option value="<?= $s ?>" <?= ($selected_semester == $s) ? 'selected' : '' ?>>
                        Semester <?= $s ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
    </form>

    <!-- Tabel Matakuliah -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($matakuliah) > 0): $i = 1; foreach ($matakuliah as $mk): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($mk->kode_mk) ?></td>
                    <td><?= htmlspecialchars($mk->nama_mk) ?></td>
                    <td><?= $mk->sks ?></td>
                    <td><?= $mk->semester ?></td>
                    <td><?= isset($mk->nama_prodi) ? htmlspecialchars($mk->nama_prodi) : '-' ?></td>
                    <td><?= isset($mk->nama_fakultas) ? htmlspecialchars($mk->nama_fakultas) : '-' ?></td>
                    <td>
                        <a href="<?= site_url('matakuliah/edit/'.$mk->mk_id) ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <a href="<?= site_url('matakuliah/delete/'.$mk->mk_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">🗑️ Hapus</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="8" class="text-center text-danger">Data tidak tersedia.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
