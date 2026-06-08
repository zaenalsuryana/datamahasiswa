<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data KRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-file-alt me-2"></i>Data KRS Mahasiswa</h3>
        <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-home"></i> Home
        </a>
    </div>

    <?php if (isset($mahasiswa_detail)): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Informasi Mahasiswa</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> <?= htmlspecialchars($mahasiswa_detail->nama ?? '-') ?></li>
                <li class="list-group-item"><strong>NPM:</strong> <?= htmlspecialchars($mahasiswa_detail->npm ?? '-') ?></li>
                <li class="list-group-item"><strong>Fakultas:</strong> <?= htmlspecialchars($mahasiswa_detail->fakultas ?? '-') ?></li>
                <li class="list-group-item"><strong>Prodi:</strong> <?= htmlspecialchars($mahasiswa_detail->prodi ?? '-') ?></li>
                <li class="list-group-item"><strong>Semester:</strong> <?= htmlspecialchars($mahasiswa_detail->semester ?? '-') ?></li>
                <li class="list-group-item"><strong>Angkatan:</strong> <?= htmlspecialchars($mahasiswa_detail->angkatan ?? '-') ?></li>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <?php
    $tahun_ajaran = $krs[0]->tahun_ajaran ?? '';
    $semester = $krs[0]->semester ?? '';
    $mhs_id = $krs[0]->mhs_id ?? '';
    ?>

    <?php if ($mhs_id && $tahun_ajaran && $semester): ?>
    <div class="mb-4 d-flex flex-wrap align-items-center gap-3">
        <!-- Setujui Semua -->
        <form action="<?= site_url('krs/approve_all') ?>" method="post" class="d-flex align-items-center gap-2">
            <input type="hidden" name="mhs_id" value="<?= $mhs_id ?>">
            <input type="hidden" name="tahun_ajaran" value="<?= $tahun_ajaran ?>">
            <input type="hidden" name="semester" value="<?= $semester ?>">
            <button type="submit" class="btn btn-success" onclick="return confirm('Setujui semua KRS?')">
                <i class="fas fa-check-circle"></i> Setujui Semua
            </button>
        </form>

        <!-- Tolak Semua -->
        <form action="<?= site_url('krs/reject_all') ?>" method="post" class="d-flex align-items-center gap-2">
            <input type="hidden" name="mhs_id" value="<?= $mhs_id ?>">
            <input type="hidden" name="tahun_ajaran" value="<?= $tahun_ajaran ?>">
            <input type="hidden" name="semester" value="<?= $semester ?>">
            <input type="text" name="alasan_penolakan" class="form-control form-control-sm" placeholder="Alasan penolakan" required style="width: 250px;">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak semua KRS?')">
                <i class="fas fa-times-circle"></i> Tolak Semua
            </button>
        </form>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('msg')): ?>
    <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <!-- Tabel KRS -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($krs)): ?>
                    <?php $i = 1; foreach ($krs as $row): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row->nama_mk ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->nama_dosen ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->semester ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->tahun_ajaran ?? '-') ?></td>
                        <td>
                            <?php
                                if ($row->status == 'diajukan') {
                                    echo '<span class="badge bg-warning text-dark">Diajukan</span>';
                                } elseif ($row->status == 'disetujui') {
                                    echo '<span class="badge bg-success">Disetujui</span>';
                                } elseif ($row->status == 'ditolak') {
                                    echo '<span class="badge bg-danger">Ditolak</span>';
                                } else {
                                    echo '<span class="text-muted">-</span>';
                                }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-danger">Belum ada data KRS</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="<?= site_url('krs') ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
