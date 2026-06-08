<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Foto - Aplikasi Data Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e2e6ea);
            font-family: 'Segoe UI', sans-serif;
        }

        .preview-img {
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body class="d-flex align-items-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <i class="bi bi-camera-fill me-2 text-primary"></i>Ganti Foto
                        </h3>

                        <?php if($this->session->flashdata('msg')): ?>
                            <div class="alert alert-info"><?= $this->session->flashdata('msg') ?></div>
                        <?php endif; ?>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 text-center">
                                <label class="form-label">Foto Sekarang</label><br>
                                <img src="<?= base_url('uploads/users/' . $this->session->userdata('photo')) ?>" width="128" height="128" class="preview-img">
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Pilih Foto Baru</label>
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/*" required>
                            </div>

                            <div class="mb-3 text-center" id="preview-container" style="display:none;">
                                <label class="form-label">Preview Foto Baru</label><br>
                                <img id="preview-image" class="preview-img" src="#" alt="Preview Foto">
                            </div>

                            <input type="submit" name="upload" value="Upload Foto" class="btn btn-primary w-100">

                        <div class="mt-3 text-center">
                            <a href="<?= base_url() ?>" class="text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init(); // aktifkan animasi AOS

        // Preview image script
        const photoInput = document.getElementById('photo');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');

        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
</body>
</html>
