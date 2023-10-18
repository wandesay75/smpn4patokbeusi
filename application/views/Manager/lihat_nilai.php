<div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
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
                <td><strong>Nama Siswa</strong></td>
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
    <a href="<?php echo base_url('Manager/Nilai'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
    </a> <br>
    <a href="<?php echo base_url('Manager/Nilai/tambahDataNilai/'.$nis.'/'.$id_tahun); ?>" class="btn btn-secondary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text">Tambah Data Nilai</span>
    </a>
    <a href="<?php echo base_url('Manager/Nilai/cetakNilai/'.$nis.'/'.$id_tahun); ?>" target="_blank" class="btn btn-success btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-print"></i>
                                            </span>
                                            <span class="text">Cetak</span>
    </a>
    <?= $this->session->flashdata('pesan'); ?>
<table class="table table-bordered table-hover table-striped" id="dataTable1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama Matapelajaran</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Total Nilai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center">
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
        <td><a href="<?php echo base_url('Manager/Nilai/update/'.$nilai->id_nilai) ?>"><div class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></div></a>
        <?= anchor('Manager/Nilai/hapus/' .$nilai->id_nilai, '<div class="btn btn-sm btn-danger" onclick="return confirm(`Apakah Anda Yakin Ingin Menghapusnya ?`)"><i class="fas fa-trash"></i></div>') ?>
            </td>
            
    </tr>
    
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
</div>
