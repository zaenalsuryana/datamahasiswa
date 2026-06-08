<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar KRS Mahasiswa - Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table-wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .form-inline input {
            width: 60px;
        }

        .status-badge {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="mb-4">Daftar KRS Mahasiswa</h2>

        <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($this->session->flashdata('msg')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($krs)): ?>
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>NPM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Status</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($krs as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row->npm) ?></td>
                                    <td><?= htmlspecialchars($row->nama_mhs) ?></td>
                                    <td><?= htmlspecialchars($row->nama_mk) ?></td>
                                    <td><?= htmlspecialchars($row->hari) ?></td>
                                    <td><?= htmlspecialchars($row->jam_mulai . ' - ' . $row->jam_selesai) ?></td>
                                    <td><?= htmlspecialchars($row->ruang) ?></td>
                                    <td>
                                        <?php
                                            $badgeClass = 'secondary';
                                            if ($row->status === 'disetujui') $badgeClass = 'success';
                                            elseif ($row->status === 'ditolak') $badgeClass = 'danger';
                                            elseif ($row->status === 'diajukan') $badgeClass = 'warning';
                                        ?>
                                        <span class="badge bg-<?= $badgeClass ?> status-badge">
                                            <?= ucfirst(htmlspecialchars($row->status)) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($row->status === 'disetujui'): ?>
                                            <?php if (is_null($row->nilai)): ?>
                                                <form method="post" action="<?= site_url('krs/input_nilai/' . $row->krs_id) ?>" class="d-flex form-inline gap-2">
                                                    <input type="text" name="nilai" class="form-control form-control-sm" required pattern="[0-9]{1,2}" title="Isi nilai 0-100">
                                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                                </form>
                                            <?php else: ?>
                                                <strong><?= htmlspecialchars($row->nilai) ?></strong>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                Tidak ada pengajuan KRS untuk Anda saat ini.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
