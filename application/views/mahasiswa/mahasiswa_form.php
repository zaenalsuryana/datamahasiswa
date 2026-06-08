<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($mhs) ? 'Edit' : 'Tambah' ?> Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3 class="mb-4"><?= isset($mhs) ? 'Edit' : 'Tambah' ?> Mahasiswa</h3>

    <form action="<?= site_url('mahasiswa/' . (isset($mhs) ? 'edit/' . $mhs->mhs_id : 'add')) ?>" method="post" class="row g-3">

        <!-- Pilih user hanya saat tambah -->
        <?php if (!isset($mhs)): ?>
        <div class="col-md-6">
            <label class="form-label">User Login</label>
            <select name="user_id" class="form-select" required>
                <option value="">Pilih User</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user->user_id ?>"><?= $user->username ?> - <?= $user->fullname ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= isset($mhs) ? $mhs->nama : '' ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">NPM</label>
            <input type="text" name="npm" class="form-control" value="<?= isset($mhs) ? $mhs->npm : '' ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="<?= isset($mhs) ? $mhs->kelas : '' ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Semester</label>
            <input type="number" name="semester" class="form-control" min="1" max="14" value="<?= isset($mhs) ? $mhs->semester : '' ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control" min="2000" max="<?= date('Y') ?>" value="<?= isset($mhs) ? $mhs->angkatan : '' ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select" required>
                <option value="">--Pilih Prodi--</option>
                <?php foreach($prodi as $row): ?>
                    <option value="<?= $row->prodi_id ?>" <?= (isset($mhs) && $mhs->prodi_id == $row->prodi_id) ? 'selected' : '' ?>>
                        <?= $row->nama_prodi ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= isset($mhs) ? $mhs->alamat : '' ?></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= isset($mhs) ? $mhs->email : '' ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= isset($mhs) ? $mhs->telepon : '' ?>" required>
        </div>

        <?php if (isset($mhs)) : ?>
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif" <?= $mhs->status == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="cuti" <?= $mhs->status == 'cuti' ? 'selected' : '' ?>>Cuti</option>
                <option value="non-aktif" <?= $mhs->status == 'non-aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                <option value="lulus" <?= $mhs->status == 'lulus' ? 'selected' : '' ?>>Lulus</option>
            </select>
        </div>
        <?php else : ?>
            <input type="hidden" name="status" value="aktif">
        <?php endif; ?>

        <div class="col-12 mt-3">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="<?= site_url('mahasiswa') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
