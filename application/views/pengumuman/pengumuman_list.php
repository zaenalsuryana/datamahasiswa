<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengumuman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

 
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', sans-serif;
        }

        .section-title {
            border-bottom: 3px solid #0d6efd;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .card-hover {
            border-radius: 16px;
            transition: 0.3s ease-in-out;
        }

        .card-hover:hover {
            transform: scale(1.01);
            box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .fade-in-up {
            animation: fadeInUp 0.7s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-sm i {
            margin-right: 4px;
        }

        .badge-date {
            background-color: #dee2e6;
            color: #495057;
            font-size: 0.85em;
        }

        .no-data {
            font-style: italic;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container py-5 fade-in-up">
    <div class="card shadow-sm border-0 card-hover">
        <div class="card-body">
       
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title"><i class="bi bi-megaphone-fill text-primary"></i> Data Pengumuman</h2>
                    <p class="text-muted mb-0">Berikut adalah daftar pengumuman terbaru</p>
                </div>
                <div class="text-end">
                    <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="bi bi-house-fill"></i> Home
                    </a>
                    <?php if ($this->session->userdata('usertype') === 'admin'): ?>
                        <a href="<?= site_url('pengumuman/add') ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle-fill"></i> Tambah
                        </a>
                    <?php endif; ?>
                </div>
            </div>

          
            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($this->session->flashdata('msg')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

         
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Isi</th>
                            <th scope="col">Tanggal</th>
                            <?php if ($this->session->userdata('usertype') === 'admin'): ?>
                                <th scope="col" style="width: 170px;">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pengumuman)): ?>
                            <?php $i = 1; foreach ($pengumuman as $p): ?>
                                <tr>
                                    <td class="text-center"><?= $i++ ?></td>
                                    <td><strong><?= htmlspecialchars($p->judul) ?></strong></td>
                                    <td><?= nl2br(htmlspecialchars($p->isi)) ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-date"><?= htmlspecialchars($p->tanggal) ?></span>
                                    </td>
                                    <?php if ($this->session->userdata('usertype') === 'admin'): ?>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="<?= site_url('pengumuman/edit/' . $p->pengumuman_id) ?>" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a href="<?= site_url('pengumuman/delete/' . $p->pengumuman_id) ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= $this->session->userdata('usertype') === 'admin' ? '5' : '4' ?>" class="text-center no-data">
                                    <i class="bi bi-info-circle me-1"></i> Belum ada data pengumuman.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

         
            <div class="d-flex justify-content-center mt-4">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
