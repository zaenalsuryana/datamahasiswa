<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            border-radius: 16px;
            background: white;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dee2e6;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Profil Saya</h2>
        <p class="text-muted">Informasi akun pengguna</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="profile-card text-center">
                <img src="<?= base_url('uploads/users/' . ($this->session->userdata('photo') ?: 'default.png')) ?>" class="profile-img mb-3" alt="Foto Profil">
                <h4 class="fw-semibold"><?= htmlspecialchars($profil->fullname) ?></h4>
                <p class="mb-1"><strong>Username:</strong> <?= htmlspecialchars($profil->username) ?></p>
                <p class="mb-1"><strong>Role:</strong> <?= ucfirst($this->session->userdata('usertype')) ?></p>

                <div class="d-grid gap-2 col-8 mx-auto mt-4">
                    <a href="<?= site_url('auth/changephoto') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-image"></i> Ganti Foto
                    </a>
                    <a href="<?= site_url('auth/changepass') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-key-fill"></i> Ganti Password
                    </a>
                    <a href="<?= base_url() ?>" class="btn btn-secondary">
                        <i class="bi bi-house-fill"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
