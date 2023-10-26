<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak Data Nilai Siswa | SMPN 4 Patokbeusi</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/logo_sekolah.ico'); ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
    .kop{
        padding-right:150px;
    }
</style>

<body>

<div class="container-fluid">
<div class="card-body">
<div class="card-body">
        <div class="row" style="border-bottom: 3px solid black;">
            <div class="col-2 text-center">
                <img src="<?= base_url('assets/img/logo_sekolah.png'); ?>" alt="" width="150">
            </div>
            <div class="col-10 kop">
                     <legend>
                        <b>
                            <div class="text-center fs-5 fw-bolder">PEMERINTAH DAERAH KABUPATEN SUBANG</div>
                            <div class="text-center fs-5 fw-bolder">DINAS PENDIDIKAN DAN KEBUDAYAAN</div>
                            <div class="text-center fs-6 fw-bolder">SMPN 4 PATOKBEUSI</div>
                        </b>
                    </legend>
                    <div class="text-center fs-6 fw-bolder">Jl. Desa Tanjungrasa Rt.19 Rw.06 Kecamatan Patokbeusi Kabupaten Subang 41263</div>
                    <div class="text-center" style="font-size:18px;">e-mail : <u>smpn4patokbeusi@gmail.com</u></div>
<br>
            </div>
        </div>
    <br>
    <br>
    <center>
        <legend class="mt-3"><strong>Data Siswa</strong></legend>
        <table>
            <tr>
                <td><strong>NIS</strong></td>
                <td>&nbsp;: <?= $nis; ?></td>
            </tr>
            <tr>
                <td><strong>Nama Murid</strong></td>
                <td>&nbsp;: <?= $nama_murid; ?></td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td>&nbsp;: <?= $nama_kelas; ?></td>
            </tr>
            <tr>
                <td><strong>Tahun Ajaran (Semester)</strong></td>
                <td>&nbsp;: <?= $tahun_ajaran. '&nbsp;('.$semester.')'; ?></td>
            </tr>
        </table>
    </center>
    <br>
    <br>
<table class="table table-bordered table-hover table-striped" id="dataTable1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Matapelajaran</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Total Nilai</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $no = 1;
    foreach($nilai_data as $nilai) : ?>
    
    <tr>
        <td width="20px"><?php echo $no++ ?></td>
        <td><?php echo $nilai->nama_mapel; ?></td>
        <td>
            <?php echo $nilai->nilai_tugas; ?>
        </td>
        <td>
            <?php echo $nilai->nilai_uts; ?>
        </td>
        <td>
            <?php echo $nilai->nilai_uas; ?>
        </td>
        <td>
            <?php echo $nilai->total_nilai; ?>
        </td>            
    </tr>
    
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
</div>

<script>
        // window.open()
        window.print()
</script>

    </body>
</html>