<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mahasiswa</h3>
        <a href="<?= site_url('mahasiswa/add') ?>" class="btn btn-primary">➕ Tambah Mahasiswa</a>
    </div>

    <a href="<?= base_url() ?>" class="btn btn-outline-secondary mb-3">🏠 Home</a>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Angkatan</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mahasiswa)): ?>
                    <?php $i = 1; foreach ($mahasiswa as $row): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row->nama) ?></td>
                        <td><?= htmlspecialchars($row->npm) ?></td>
                        <td><?= htmlspecialchars($row->kelas) ?></td>
                        <td><?= htmlspecialchars($row->semester) ?></td>
                        <td><?= htmlspecialchars($row->angkatan) ?></td>
                        <td><?= htmlspecialchars($row->prodi) ?></td>
                        <td><?= htmlspecialchars($row->fakultas) ?></td>
                        <td><?= htmlspecialchars($row->alamat) ?></td>
                        <td><?= htmlspecialchars($row->email) ?></td>
                        <td><?= htmlspecialchars($row->telepon) ?></td>
                        <td>
                            <span class="badge bg-<?= 
                                $row->status == 'aktif' ? 'success' : 
                                ($row->status == 'cuti' ? 'warning' : 
                                ($row->status == 'non-aktif' ? 'secondary' : 
                                ($row->status == 'lulus' ? 'primary' : 'dark'))) 
                            ?>">
                                <?= ucfirst($row->status) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($row->username) ?></td>
                        <td>
                            <a href="<?= site_url('mahasiswa/edit/' . $row->mhs_id) ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                            <a href="<?= site_url('mahasiswa/delete/' . $row->mhs_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center text-danger">Belum ada data mahasiswa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
