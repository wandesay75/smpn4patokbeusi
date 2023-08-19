<div class="container-fluid">


<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
<div class="card-body">
    <center>
        <legend class="mt-3"><strong>Nilai Siswa</strong></legend>
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
<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Matapelajaran</th>
            <th>Nama Matapelajaran</th>
            <th>Nilai</th>
            <th>Action</th>
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
            <?php echo $nilai->nilai; ?>
        </td>
        <td width="20px"><?= anchor('Manager/Nilai/CariNilai/ubah/' .$nilai->id_nilai, '<div class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></div>') ?>
            </td>
            <td width="20px"><?= anchor('Manager/Nilai/CariNilai/hapus/' .$nilai->id_nilai, '<div class="btn btn-sm btn-danger" onclick="return confirm(`Apakah Anda Yakin Ingin Menghapusnya ?`)"><i class="fas fa-trash"></i></div>') ?>
            </td>
    </tr>
    
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
</div>
