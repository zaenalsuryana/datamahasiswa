<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data KRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        h3 {
            font-weight: bold;
            color: #343a40;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
            background-color: #fff;
        }

        .form-select, .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 8px;
        }

        .table th {
            background-color: #f1f3f5;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fe;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
        }

        .alert {
            border-radius: 10px;
        }

        .btn-outline-danger:hover {
            color: white;
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h3 class="mb-4 text-center"><i class="bi bi-journal-bookmark-fill me-2"></i>Data Kartu Rencana Studi (KRS)</h3>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <!-- Filter -->
    <div class="card p-4 mb-4">
        <form method="get" action="<?= site_url('krs') ?>" class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Semester</label>
                <select name="filter_semester" class="form-select">
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?= $i ?>" <?= ($semester == $i) ? 'selected' : '' ?>>Semester <?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Tahun Ajaran</label>
                <select name="filter_tahun" class="form-select">
                    <?php
                        $tahun_ini = date('Y');
                        for ($i = $tahun_ini - 1; $i <= $tahun_ini + 1; $i++):
                            $ta = $i . '/' . ($i + 1);
                    ?>
                        <option value="<?= $ta ?>" <?= ($tahun_ajaran == $ta) ? 'selected' : '' ?>><?= $ta ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 align-self-end d-grid">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i> Tampilkan</button>
            </div>
        </form>
    </div>

    <!-- Tombol Tambah -->
    <?php if ($this->session->userdata('usertype') == 'mahasiswa' && empty($krs_disetujui)): ?>
        <div class="mb-3 text-end">
            <a href="<?= site_url('krs/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Tambah / Edit KRS
            </a>
        </div>
    <?php endif; ?>

    <!-- Tabel KRS -->
    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Nilai (Skor)</th>
                        <th>Nilai (Huruf)</th>
                        <?php if ($this->session->userdata('usertype') == 'mahasiswa' && empty($krs_disetujui)): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($krs)): ?>
                        <?php $i = 1; foreach ($krs as $row): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td class="text-start"><?= htmlspecialchars($row->nama_mk) ?></td>
                                <td class="text-start"><?= htmlspecialchars($row->nama_dosen) ?></td>
                                <td><?= htmlspecialchars($row->semester) ?></td>
                                <td><?= htmlspecialchars($row->tahun_ajaran) ?></td>
                                <td>
                                    <?php if ($row->status === 'disetujui'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php elseif ($row->status === 'ditolak'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                        <?php if (!empty($row->alasan_penolakan)): ?>
                                            <br><small class="text-danger">(<?= htmlspecialchars($row->alasan_penolakan) ?>)</small>
                                        <?php endif; ?>
                                    <?php elseif ($row->status === 'diajukan'): ?>
                                        <span class="badge bg-warning text-dark">Diajukan</span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= ($row->status === 'disetujui' && $row->nilai !== null) ? htmlspecialchars($row->nilai) : '-' ?></td>
                                <td>
                                    <?php
                                        if ($row->status === 'disetujui' && $row->nilai !== null) {
                                            $nilai = (float)$row->nilai;
                                            if ($nilai >= 85) $huruf = 'A';
                                            elseif ($nilai >= 75) $huruf = 'B';
                                            elseif ($nilai >= 65) $huruf = 'C';
                                            elseif ($nilai >= 55) $huruf = 'D';
                                            else $huruf = 'E';
                                            echo $huruf;
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <?php if ($this->session->userdata('usertype') == 'mahasiswa' && empty($krs_disetujui)): ?>
                                    <td>
                                        <a href="<?= site_url('krs/delete/' . $row->krs_id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus matakuliah ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= ($this->session->userdata('usertype') == 'mahasiswa' && empty($krs_disetujui)) ? 9 : 8 ?>" class="text-center text-danger">
                                Belum ada data KRS untuk semester <?= htmlspecialchars($semester) ?> tahun ajaran <?= htmlspecialchars($tahun_ajaran) ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Home -->
    <div class="mt-4 text-center">
        <a href="<?= base_url() ?>" class="btn btn-secondary">
            <i class="bi bi-house-door-fill me-1"></i> Home
        </a>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
