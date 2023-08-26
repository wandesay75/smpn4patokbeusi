<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak Data | SMPN 4 Patokbeusi</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/logo_sekolah.ico'); ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-body">
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

<table class="table table-bordered table-hover table-striped" id="dataTable1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama Matapelajaran</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $no = 1;
    foreach($nilai_data as $nilai) : ?>
    
    <tr>
        <td width="20px"><?php echo $no++ ?></td>
        <td><?php echo $nilai->kd_mapel; ?></td>
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