<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Matakuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3><?= isset($mk) ? 'Edit' : 'Tambah' ?> Matakuliah</h3>
    <hr>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <?php 
    $kode_mk      = $mk->kode_mk ?? '';
    $nama_mk      = $mk->nama_mk ?? '';
    $sks          = $mk->sks ?? '';
    $semester     = $mk->semester ?? '';
    $prodi_id     = $mk->prodi_id ?? '';
    $fakultas_id  = '';

    if (!empty($prodi) && !empty($prodi_id)) {
        foreach ($prodi as $p) {
            if ($p->prodi_id == $prodi_id) {
                $fakultas_id = $p->fakultas_id;
                break;
            }
        }
    }
    ?>

    <form action="<?= site_url('matakuliah/' . (isset($mk) ? 'edit/' . $mk->mk_id : 'add')) ?>" method="post" class="mt-4">

        <div class="mb-3">
            <label for="fakultas_id" class="form-label">Fakultas</label>
            <select id="fakultas_id" class="form-select" required>
                <option value="">Pilih Fakultas</option>
                <?php foreach ($fakultas as $f): ?>
                    <option value="<?= $f->fakultas_id ?>" <?= ($f->fakultas_id == $fakultas_id) ? 'selected' : '' ?>>
                        <?= $f->nama_fakultas ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" id="prodi_id" class="form-select" required>
                <option value="">Pilih Prodi</option>
                <?php foreach ($prodi as $p): ?>
                    <option value="<?= $p->prodi_id ?>" data-fakultas="<?= $p->fakultas_id ?>"
                        <?= ($p->prodi_id == $prodi_id) ? 'selected' : '' ?>>
                        <?= $p->nama_prodi ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode MK</label>
            <input type="text" class="form-control" name="kode_mk" id="kode_mk" value="<?= htmlspecialchars($kode_mk) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_mk" class="form-label">Nama MK</label>
            <input type="text" class="form-control" name="nama_mk" id="nama_mk" value="<?= htmlspecialchars($nama_mk) ?>" required>
        </div>

        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control" name="sks" id="sks" value="<?= htmlspecialchars($sks) ?>" min="1" max="6" required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" class="form-control" name="semester" id="semester" value="<?= htmlspecialchars($semester) ?>" min="1" max="14" required>
        </div>

        <div class="d-flex gap-2">
            <input type="submit" class="btn btn-success" value="💾 Simpan">
            <a href="<?= site_url('matakuliah') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    const fakultasSelect = document.getElementById('fakultas_id');
    const prodiSelect = document.getElementById('prodi_id');

    function filterProdi() {
        const selectedFakultas = fakultasSelect.value;

        for (let option of prodiSelect.options) {
            if (option.value === "") {
                option.style.display = ""; 
            } else {
                const fakultasId = option.getAttribute('data-fakultas');
                option.style.display = (fakultasId === selectedFakultas) ? "" : "none";
            }
        }

        // Reset pilihan prodi
        if (selectedFakultas !== "") {
            const selectedProdi = prodiSelect.querySelector(`option[data-fakultas="${selectedFakultas}"][selected]`);
            if (!selectedProdi) {
                prodiSelect.value = "";
            }
        } else {
            prodiSelect.value = "";
        }
    }

    fakultasSelect.addEventListener('change', filterProdi);
    filterProdi(); // jalankan saat halaman dimuat
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
