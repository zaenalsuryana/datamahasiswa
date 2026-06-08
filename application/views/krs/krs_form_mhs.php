<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Form Kartu Rencana Studi (KRS)</h4>
        </div>
        <div class="card-body">

            <!-- Info Mahasiswa -->
            <div class="mb-3">
                <p><strong>Nama Mahasiswa:</strong> <?= htmlspecialchars($mahasiswa->nama) ?></p>
                <p><strong>NPM:</strong> <?= htmlspecialchars($mahasiswa->npm) ?></p>
                <p><strong>Semester Aktif:</strong> <?= htmlspecialchars($semester) ?></p>
                <p><strong>Tahun Akademik:</strong> <?= htmlspecialchars($tahun_ajaran) ?></p>
            </div>

            <!-- Flash Message -->
            <?php if ($this->session->flashdata('msg')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('msg') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('krs/add/' . $mahasiswa->mhs_id) ?>" method="post">
                <input type="hidden" name="semester" value="<?= htmlspecialchars($semester) ?>">
                <input type="hidden" name="tahun_ajaran" value="<?= htmlspecialchars($tahun_ajaran) ?>">

                <!-- Pilih Mata Kuliah -->
                <h5><i class="fas fa-book-open"></i> Pilih Jadwal Kuliah:</h5>
                <hr>

                <?php if (!empty($matakuliah)): ?>
                    <?php
                    $kelompok = [];
                    foreach ($matakuliah as $mk) {
                        $kelompok[$mk->semester][] = $mk;
                    }

                    ksort($kelompok);
                    foreach ($kelompok as $sem => $daftar_mk):
                    ?>
                        <h6 class="text-primary mb-2">Semester <?= htmlspecialchars($sem) ?></h6>
                        <ul class="list-group mb-4">
                            <?php foreach ($daftar_mk as $j):
                                $selected = (!empty($krs_terpilih) && in_array($j->jadwal_id, array_column($krs_terpilih, 'jadwal_id'))) ? 'checked' : '';
                                $label = ($j->semester != $semester) ? "<span class='badge bg-danger'>Luar Semester</span>" : '';
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jadwal_id[]" value="<?= htmlspecialchars($j->jadwal_id) ?>" <?= $selected ?>>
                                    <label class="form-check-label">
                                        <?= htmlspecialchars($j->kode_mk) ?> - <?= htmlspecialchars($j->nama_mk) ?> (<?= $j->sks ?> SKS)<br>
                                        <?= htmlspecialchars($j->nama_dosen) ?> | <?= $j->hari ?>, <?= $j->jam_mulai ?> - <?= $j->jam_selesai ?>
                                    </label>
                                </div>
                                <?= $label ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning">Tidak ada jadwal kuliah yang tersedia untuk periode ini.</div>
                <?php endif; ?>

                <!-- Tombol -->
                <div class="mt-4">
                    <input type="submit" name="submit" class="btn btn-success" value="Simpan KRS" <?= empty($matakuliah) ? 'disabled' : '' ?>>
                    <a href="<?= site_url('krs') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
