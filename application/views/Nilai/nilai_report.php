<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table th {
            background-color: #e9ecef;
        }

        h2 {
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary, .btn-success {
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #004080;
        }

        .form-control, .form-select {
            border-radius: 8px;
        }

        .form-section {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .alert-info {
            border-radius: 8px;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4 text-center">📋 Laporan Nilai Mahasiswa</h2>

    <?= $this->session->flashdata('msg') ? '<div class="alert alert-info">'.$this->session->flashdata('msg').'</div>' : '' ?>

    <!-- Form Filter -->
    <form method="GET" class="form-section">
        <div class="row gy-3 gx-3 align-items-center">
            <?php if ($this->session->userdata('usertype') == 'admin'): ?>
                <div class="col-md-3">
                    <input type="text" name="nama_mhs" class="form-control" placeholder="Cari Nama Mahasiswa" value="<?= html_escape($selected_nama_mhs) ?>">
                </div>
            <?php endif; ?>

            <?php if (in_array($this->session->userdata('usertype'), ['admin', 'dosen'])): ?>
                <div class="col-md-3">
                    <input type="text" name="mata_kuliah" class="form-control" placeholder="Cari Mata Kuliah" value="<?= html_escape($selected_mata_kuliah) ?>">
                </div>
            <?php endif; ?>

            <div class="col-md-2">
                <select name="semester" class="form-select">
                    <option value="">Semua Semester</option>
                    <?php foreach ($semester_list as $s): ?>
                        <option value="<?= $s->semester ?>" <?= ($selected_semester == $s->semester) ? 'selected' : '' ?>>
                            Semester <?= $s->semester ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <select name="tahun_ajaran" class="form-select">
                    <option value="">Tahun Ajaran</option>
                    <?php foreach ($tahun_ajaran_list as $ta): ?>
                        <option value="<?= $ta->tahun_ajaran ?>" <?= ($selected_tahun_ajaran == $ta->tahun_ajaran) ? 'selected' : '' ?>>
                            <?= $ta->tahun_ajaran ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    🔍 Filter
                </button>
            </div>
        </div>
    </form>

    <!-- Tabel Nilai -->
    <div class="card p-3">
        <form method="post" action="<?= site_url('nilai/simpan') ?>">
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($nilai)): ?>
                            <?php foreach ($nilai as $n): ?>
                                <tr>
                                    <td><?= html_escape($n->nama_mhs) ?></td>
                                    <td><?= html_escape($n->npm) ?></td>
                                    <td><?= html_escape($n->nama_mk) ?></td>
                                    <td class="text-center"><?= html_escape($n->semester) ?></td>
                                    <td class="text-center"><?= html_escape($n->tahun_ajaran) ?></td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('usertype') == 'mahasiswa'): ?>
                                            <?= html_escape($n->nilai) ?>
                                        <?php else: ?>
                                            <input type="text" name="nilai[<?= $n->krs_id ?>]" value="<?= html_escape($n->nilai) ?>" class="form-control text-center" pattern="[0-9]{1,3}" title="Isi angka 0-100">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger">Tidak ada data nilai.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($this->session->userdata('usertype') == 'dosen' && !empty($nilai)): ?>
                <div class="mt-3 text-end">
                    <input type="submit" class="btn btn-success" value="💾 Simpan Semua Nilai">
                </div>
            <?php endif; ?>
        </form>
    </div>

    <div class="mt-4 text-center">
        <a href="<?= base_url() ?>" class="btn btn-secondary">🏠 Kembali ke Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
