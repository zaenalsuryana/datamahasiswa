<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Pengampu</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Form Data Pengampu</h1>
    <hr>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <form action="<?= site_url('pengampu/add') ?>" method="post" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" id="prodi_id" class="form-select" required>
                <option value="">Pilih Program Studi</option>
                <?php foreach ($prodi as $row): ?>
                    <option value="<?= $row->prodi_id ?>"><?= $row->nama_prodi ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen Pengampu</label>
            <select name="dosen_id" id="dosen_id" class="form-select" required>
                <option value="">Pilih Dosen</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mk_id" class="form-label">Mata Kuliah</label>
            <select name="mk_id" id="mk_id" class="form-select" required>
                <option value="">Pilih Mata Kuliah</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran" class="form-select" required>
                <option value="">Pilih Tahun Ajaran</option>
                <?php 
                $tahun = date('Y');
                for ($i = 0; $i < 5; $i++):
                    $ta = ($tahun - $i) . '/' . ($tahun - $i + 1);
                ?>
                    <option value="<?= $ta ?>"><?= $ta ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="">Pilih Semester</option>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <input type="submit" name="submit" class="btn btn-primary" value="💾 Simpan">
            <a href="<?= site_url('pengampu') ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>

    </form>
</div>

<script>
$('#prodi_id').change(function(){
    var prodi_id = $(this).val();

    if(prodi_id){
        $.ajax({
            url: '<?= site_url('pengampu/get_matkul_dosen') ?>',
            type: 'POST',
            data: {prodi_id: prodi_id},
            dataType: 'json',
            success: function(response){
                // Populate Mata Kuliah
                $('#mk_id').html('<option value="">-- Pilih Mata Kuliah --</option>');
                $.each(response.matakuliah, function(i, mk){
                    $('#mk_id').append('<option value="'+mk.mk_id+'">'+mk.nama_mk+'</option>');
                });

                // Populate Dosen
                $('#dosen_id').html('<option value="">-- Pilih Dosen --</option>');
                $.each(response.dosen, function(i, d){
                    $('#dosen_id').append('<option value="'+d.dosen_id+'">'+d.nama+'</option>');
                });
            }
        });
    } else {
        $('#mk_id').html('<option value="">-- Pilih Mata Kuliah --</option>');
        $('#dosen_id').html('<option value="">-- Pilih Dosen --</option>');
    }
});
</script>

</body>
</html>
