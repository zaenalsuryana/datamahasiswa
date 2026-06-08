<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai - <?= htmlspecialchars($pengampu->nama_mk) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3 class="mb-4">Input Nilai: <?= htmlspecialchars($pengampu->nama_mk) ?></h3>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Nilai Angka</th>
                        <th>Huruf</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($mahasiswa as $m): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($m->npm) ?></td>
                        <td><?= htmlspecialchars($m->nama) ?></td>
                        <td>
                            <input type="number" step="0.01" class="form-control" name="nilai[<?= $m->mhs_id ?>][angka]" value="<?= htmlspecialchars($m->nilai_angka) ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nilai[<?= $m->mhs_id ?>][huruf]" value="<?= htmlspecialchars($m->nilai_huruf) ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nilai[<?= $m->mhs_id ?>][grade]" value="<?= htmlspecialchars($m->grade) ?>">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester:</label>
            <input type="text" id="semester" name="semester" value="Ganjil" class="form-control" required>
        </div>

        <input type="submit" name="submit" class="btn btn-success" value="💾 Simpan">
        <a href="<?= site_url('matakuliah') ?>" class="btn btn-secondary">⬅ Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
