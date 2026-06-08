<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-3">📝 Input Nilai Mahasiswa</h2>

    <div class="mb-3">
        <p><strong>Mata Kuliah:</strong> <?= htmlspecialchars($jadwal->nama_mk) ?></p>
        <p><strong>Hari:</strong> <?= htmlspecialchars($jadwal->hari) ?> |
           <strong>Jam:</strong> <?= htmlspecialchars($jadwal->jam_mulai) ?> - <?= htmlspecialchars($jadwal->jam_selesai) ?></p>
    </div>

    <form method="post" action="<?= site_url('nilai/simpan') ?>">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($krs as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->nama) ?></td>
                        <td><?= htmlspecialchars($row->npm) ?></td>
                        <td>
                            <input type="number" name="nilai[<?= $row->krs_id ?>]" class="form-control" min="0" max="100" value="<?= htmlspecialchars($row->nilai) ?>" required>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <input type="submit" class="btn btn-success" value="💾 Simpan Nilai">
            <a href="<?= site_url('nilai') ?>" class="btn btn-secondary">⬅ Kembali</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
