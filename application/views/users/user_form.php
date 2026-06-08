<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Users</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS Animasi -->
  <style>
    .fade-in {
      animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow fade-in">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0"><i class="bi bi-person-plus-fill"></i> Form Data Users</h4>
    </div>
    <div class="card-body">

      <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
      <?php endif; ?>

      <?php 
        $username = $role = $fullname = '';
        if (isset($user)) {
            $username = $user->username ?? '';
            $role = $user->role ?? '';
            $fullname = $user->fullname ?? '';
        }
      ?>

      <form action="<?= site_url('users/' . (isset($user) ? 'edit/' . $user->user_id : 'add')) ?>" method="post">

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= $username ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" <?= isset($user) ? '' : 'required' ?>>
          <?php if (isset($user)): ?>
            <div class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-select" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin" <?= ($role == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="mahasiswa" <?= ($role == 'mahasiswa') ? 'selected' : '' ?>>Mahasiswa</option>
            <option value="dosen" <?= ($role == 'dosen') ? 'selected' : '' ?>>Dosen</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label">Fullname</label>
          <input type="text" name="fullname" class="form-control" value="<?= $fullname ?>" required>
        </div>
        <div class="d-flex justify-content-between">
        <input type="submit" name="submit" class="btn btn-success" value="✔ Simpan">
        <a href="<?= site_url('users') ?>" class="btn btn-secondary">
            <i class="bi bi-x-circle-fill"></i> Batal
        </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
