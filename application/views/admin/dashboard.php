<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
        .card {
            border-radius: 15px;
        }
        .card .card-title {
            font-weight: 600;
        }
        .card .card-text {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-graduation-cap me-2"></i>Sistem Informasi Mahasiswa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?= $this->session->userdata('fullname') ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('auth/change_password') ?>">Ganti Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <div class="row g-4">
        <!-- Mahasiswa Card -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Mahasiswa</h5>
                    <p class="card-text"><?= $total_mahasiswa ?></p>
                    <a href="<?= site_url('admin/mahasiswa') ?>" class="text-white">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Dosen Card -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dosen</h5>
                    <p class="card-text"><?= $total_dosen ?></p>
                    <a href="<?= site_url('admin/dosen') ?>" class="text-white">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Matakuliah Card -->
        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Matakuliah</h5>
                    <p class="card-text"><?= $total_matakuliah ?></p>
                    <a href="<?= site_url('admin/matakuliah') ?>" class="text-white">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengumuman -->
    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark fw-semibold">
                    <i class="fa fa-bullhorn me-2"></i>Pengumuman Terbaru
                </div>
                <div class="card-body">
                    <?php if (!empty($pengumuman)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($pengumuman as $p): ?>
                            <li class="list-group-item">
                                <h6 class="mb-1"><?= $p->judul ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($p->tanggal)) ?></small>
                                <p class="mb-0"><?= substr(strip_tags($p->isi), 0, 100) ?>...</p>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Belum ada pengumuman terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
