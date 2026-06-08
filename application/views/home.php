<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Aplikasi Data Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e6ecf0, #f7f9fb);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .card-menu {
            border: none;
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            padding: 24px 12px;
        }
        .card-menu:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-menu i {
            color: #0d6efd;
        }
        .card-menu h6 {
            font-size: 0.95rem;
            margin-top: 8px;
        }
        .profile-img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        footer {
            font-size: 0.9rem;
            background-color: #f1f3f5;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-graduation-cap me-2"></i>Data Mahasiswa
        </a>
        <div class="d-flex align-items-center">
            <img src="<?= base_url('uploads/users/' . ($this->session->userdata('photo') ?: 'default.png')) ?>" class="profile-img me-2" alt="Foto Profil">
            <a href="<?= site_url('profile') ?>" class="text-white text-decoration-none me-3 fw-semibold">
                Hai, <?= $this->session->userdata('fullname') ?>
            </a>
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-sm btn-light" onclick="return confirm('Yakin ingin logout?')">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Login sebagai <strong><?= $this->session->userdata('usertype') ?></strong></p>
    </div>

    <div class="row g-4 justify-content-center">
        <?php
        $usertype = $this->session->userdata('usertype');
        $menu = [];

        if ($usertype == 'admin') {
            $menu = [
                ['link' => 'dosen', 'icon' => 'chalkboard-teacher', 'text' => 'Manage Dosen'],
                ['link' => 'prodi', 'icon' => 'layer-group', 'text' => 'Manage Prodi'],
                ['link' => 'matakuliah', 'icon' => 'book', 'text' => 'Manage Matakuliah'],
                ['link' => 'pengampu', 'icon' => 'users-cog', 'text' => 'Manage Pengampu'],
                ['link' => 'penjadwalan', 'icon' => 'calendar-alt', 'text' => 'Manage Jadwal'],
                ['link' => 'mahasiswa', 'icon' => 'user-graduate', 'text' => 'Manage Mahasiswa'],
                ['link' => 'krs', 'icon' => 'clipboard-list', 'text' => 'KRS Mahasiswa'],
                ['link' => 'nilai', 'icon' => 'file-alt', 'text' => 'Nilai'],
                ['link' => 'pengumuman', 'icon' => 'bullhorn', 'text' => 'Pengumuman'],
                ['link' => 'users', 'icon' => 'user-cog', 'text' => 'Manage Users'],
                ['link' => 'fakultas', 'icon' => 'building', 'text' => 'Manage Fakultas'],
            ];
        } elseif ($usertype == 'mahasiswa') {
            $menu = [
                ['link' => 'krs', 'icon' => 'clipboard-list', 'text' => 'KRS'],
                ['link' => 'nilai', 'icon' => 'file-alt', 'text' => 'Lihat Nilai'],
                ['link' => 'pengumuman', 'icon' => 'bullhorn', 'text' => 'Pengumuman'],
            ];
        } elseif ($usertype == 'dosen') {
            $menu = [
                ['link' => 'krs', 'icon' => 'check-circle', 'text' => 'Persetujuan KRS'],
                ['link' => 'nilai', 'icon' => 'file-signature', 'text' => 'Input Nilai'],
                ['link' => 'pengumuman', 'icon' => 'bullhorn', 'text' => 'Pengumuman'],
            ];
        }

        foreach ($menu as $item): ?>
            <div class="col-6 col-sm-4 col-lg-3">
                <a href="<?= site_url($item['link']) ?>" class="text-decoration-none">
                    <div class="card card-menu text-center shadow-sm">
                        <i class="fa fa-<?= $item['icon'] ?> fa-2x mb-3"></i>
                        <h6 class="fw-semibold text-dark"><?= $item['text'] ?></h6>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Tombol tambahan -->
    <div class="text-center mt-5">
        <a href="<?= site_url('profile') ?>" class="btn btn-outline-primary btn-sm me-2">
            <i class="fa fa-user"></i> Profil Saya
        </a>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 text-muted">
    &copy; <?= date('Y') ?> Aplikasi Data Mahasiswa - All rights reserved.
</footer>

</body>
</html>
