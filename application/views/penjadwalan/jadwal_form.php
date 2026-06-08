<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Penjadwalan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Form Data Penjadwalan</h1>
    <hr>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <form action="<?= isset($jadwal) ? site_url('penjadwalan/edit/' . $jadwal->jadwal_id) : site_url('penjadwalan/add') ?>" method="post" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" id="prodi_id" class="form-select" required>
                <option value="">-- Pilih Program Studi --</option>
                <?php foreach ($prodi as $p): ?>
                    <option value="<?= $p->prodi_id ?>" <?= isset($jadwal) && $jadwal->prodi_id == $p->prodi_id ? 'selected' : '' ?>>
                        <?= $p->nama_prodi ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran" id="tahun_ajaran" class="form-select" required>
                <option value="">-- Pilih Tahun Ajaran --</option>
                <?php
                $tahun = date('Y');
                for ($i = 0; $i < 5; $i++):
                    $ta = ($tahun - $i) . '/' . ($tahun - $i + 1);
                ?>
                    <option value="<?= $ta ?>" <?= isset($jadwal) && $jadwal->tahun_ajaran == $ta ? 'selected' : '' ?>>
                        <?= $ta ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" id="semester" class="form-select" required>
                <option value="">-- Pilih Semester --</option>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <option value="<?= $i ?>" <?= isset($jadwal) && $jadwal->semester == $i ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="pengampu_id" class="form-label">Mata Kuliah - Dosen</label>
            <select name="pengampu_id" id="pengampu_id" class="form-select" required>
                <option value="">-- Pilih Mata Kuliah & Dosen --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="dosen_nama" class="form-label">Dosen Pengampu</label>
            <input type="text" class="form-control" id="dosen_nama" name="dosen_nama" readonly value="<?= isset($jadwal) ? $jadwal->nama_dosen : '' ?>">
        </div>

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select name="hari" id="hari" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                <?php
                $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                foreach ($hariList as $h):
                ?>
                    <option value="<?= $h ?>" <?= isset($jadwal) && $jadwal->hari == $h ? 'selected' : '' ?>>
                        <?= $h ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <select name="jam_mulai" id="jam_mulai" class="form-select" required></select>
        </div>

        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <select name="jam_selesai" id="jam_selesai" class="form-select" required></select>
        </div>

        <div class="mb-3">
            <label for="ruang" class="form-label">Ruangan</label>
            <input type="text" name="ruang" id="ruang" class="form-control" required value="<?= isset($jadwal) ? $jadwal->ruang : '' ?>">
        </div>

        <div class="d-flex gap-2">
            <input type="submit" class="btn btn-primary" value="💾 Simpan">
            <a href="<?= site_url('penjadwalan') ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function () {
    function loadPengampu() {
        var prodi_id = $('#prodi_id').val();
        var tahun_ajaran = $('#tahun_ajaran').val();
        var semester = $('#semester').val();

        if (prodi_id && tahun_ajaran && semester) {
            $.ajax({
                url: "<?= site_url('penjadwalan/get_pengampu') ?>",
                method: "POST",
                data: {
                    prodi_id: prodi_id,
                    tahun_ajaran: tahun_ajaran,
                    semester: semester
                },
                dataType: "json",
                success: function (data) {
                    let options = '<option value="">-- Pilih Mata Kuliah & Dosen --</option>';
                    $.each(data, function (index, item) {
                        options += '<option value="' + item.pengampu_id + '">' + item.nama_mk + ' - ' + item.nama_dosen + '</option>';
                    });
                    $('#pengampu_id').html(options);

                    <?php if (isset($jadwal)): ?>
                        $('#pengampu_id').val("<?= $jadwal->pengampu_id ?>").trigger('change');
                    <?php endif; ?>
                },
                error: function () {
                    alert('Gagal mengambil data pengampu.');
                }
            });
        }
    }

    $('#prodi_id, #tahun_ajaran, #semester').on('change', loadPengampu);

    $('#pengampu_id').on('change', function () {
        const selectedOption = $(this).find('option:selected').text();
        const dosenName = selectedOption.split(' - ')[1] || '';
        $('#dosen_nama').val(dosenName);
    });

    // Generate jam mulai & selesai (interval 30 menit)
    function generateJamDropdown(selector, selected) {
        const startHour = 7;
        const endHour = 21;
        const dropdown = $(selector);
        dropdown.empty().append('<option value="">-- Pilih Jam --</option>');

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let min = 0; min < 60; min += 30) {
                const jam = `${String(hour).padStart(2, '0')}:${String(min).padStart(2, '0')}`;
                dropdown.append(`<option value="${jam}" ${selected === jam ? 'selected' : ''}>${jam}</option>`);
            }
        }
    }

    // Inisialisasi jam saat halaman dimuat
    <?php if (isset($jadwal)): ?>
        generateJamDropdown('#jam_mulai', '<?= $jadwal->jam_mulai ?>');
        generateJamDropdown('#jam_selesai', '<?= $jadwal->jam_selesai ?>');
    <?php else: ?>
        generateJamDropdown('#jam_mulai');
        generateJamDropdown('#jam_selesai');
    <?php endif; ?>

    // Load pengampu awal jika form edit
    loadPengampu();
});
</script>

</body>
</html>
