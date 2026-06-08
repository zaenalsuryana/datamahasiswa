<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($dosen) ? 'Edit' : 'Tambah' ?> Dosen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Animasi Fade -->
    <style>
        body {
            background: #f8f9fa;
        }
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-label {
            font-weight: 500;
        }
        .btn-custom {
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 fade-in">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-user-tie me-2"></i><?= isset($dosen) ? 'Edit' : 'Tambah' ?> Dosen</h5>
                </div>

                <div class="card-body">

                
                    <?php if ($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('msg') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('dosen/' . (isset($dosen) ? 'edit/' . $dosen->dosen_id : 'add')) ?>" method="post">

                        <div class="mb-3">
                            <label class="form-label">Pilih User Login Dosen</label>
                            <select name="user_id" class="form-select" required>
                                <option value="">Pilih User</option>
                                <?php foreach ($users as $user): ?>
                                    <?php if ($user->role == 'dosen'): ?>
                                        <option value="<?= $user->user_id ?>" <?= (isset($dosen) && $dosen->user_id == $user->user_id) ? 'selected' : '' ?>>
                                            <?= $user->fullname ?> (<?= $user->username ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= isset($dosen) ? $dosen->nama : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prodi</label>
                            <select name="prodi_id" class="form-select" required>
                                <option value="">Pilih Prodi</option>
                                <?php foreach ($prodi as $p): ?>
                                    <option value="<?= $p->prodi_id ?>" <?= (isset($dosen) && $dosen->prodi_id == $p->prodi_id) ? 'selected' : '' ?>>
                                        <?= $p->nama_prodi ?> (<?= $p->nama_fakultas ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= isset($dosen) ? $dosen->email : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?= isset($dosen) ? $dosen->nip : '' ?>" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <input type="submit" name="submit" class="btn btn-success btn-custom" value="Simpan">
                            <a href="<?= site_url('dosen') ?>" class="btn btn-secondary btn-custom">
                                <i class="fa-solid fa-arrow-left me-1"></i> Batal
                            </a>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
