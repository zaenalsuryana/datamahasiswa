<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Users</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
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
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="bi bi-people-fill"></i> Data Users</h4>
      <a href="<?= site_url('users/add') ?>" class="btn btn-success btn-sm">
        <i class="bi bi-person-plus-fill"></i> Tambah User
      </a>
    </div>

    <div class="card-body">

      <div class="mb-3">
        <a href="<?= base_url() ?>" class="btn btn-secondary btn-sm">
          <i class="bi bi-house-fill"></i> Home
        </a>
      </div>

      <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-primary text-center">
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Role</th>
              <th>Fullname</th>
              <th>Created At</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($users)): ?>
              <?php foreach($users as $u): ?>
              <tr>
                <td class="text-center"><?= $i++ ?></td>
                <td><?= htmlspecialchars($u->username) ?></td>
                <td class="text-center">
                  <span class="badge bg-<?= $u->role == 'admin' ? 'danger' : ($u->role == 'dosen' ? 'primary' : 'secondary') ?>">
                    <?= ucfirst($u->role) ?>
                  </span>
                </td>
                <td><?= htmlspecialchars($u->fullname) ?></td>
                <td><?= $u->created_at ?></td>
                <td class="text-center">
                  <a href="<?= site_url('users/edit/'.$u->user_id) ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <a href="<?= site_url('users/delete/'.$u->user_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">
                    <i class="bi bi-trash-fill"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-muted">Tidak ada data user</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        <?= $this->pagination->create_links(); ?>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
