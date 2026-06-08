<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #ffffff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 480px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-weight: 700;
        }
        .btn-primary {
            width: 100%;
        }
        .form-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center text-primary"><i class="fa fa-key me-2"></i>Ganti Password</h2>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="oldpassword" class="form-label">Password Lama</label>
            <input type="password" class="form-control" name="oldpassword" id="oldpassword" required>
        </div>
        <div class="mb-3">
            <label for="newpassword" class="form-label">Password Baru</label>
            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
        </div>
        <input type="submit" name="change" class="btn btn-primary" value="Ganti Password">
    </form>

    <div class="mt-3 text-center">
        <a href="<?= base_url() ?>" class="text-decoration-none">
            <i class="fa fa-home"></i> Kembali ke Home
        </a>
    </div>
</div>

</body>
</html>
