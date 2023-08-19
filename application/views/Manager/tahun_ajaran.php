 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

<div class="card shadow mb-4">
<div class="card-body">
<?= $this->session->flashdata('pesan'); ?>

<?php echo anchor('Manager/TahunAjaran/tambahTahunAjaran',  '<button class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-university"></i>
                                        </span>
                                        <span class="text">Tambah Tahun Ajaran</span> </button>'); ?> 

<table class="table table-hover table-bordered table-striped">
    <tr>
        <th>No.</th>
        <th>Tahun Ajaran</th>
        <th>Semester</th>
        <th>Status</th>
        <th colspan="2">Aksi</th>
    </tr>
    <?php 
    $no = 1;
    foreach($tahun_ajaran as $ajar) : ?>
    
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $ajar->tahun_ajaran; ?></td>
        <td><?php echo $ajar->semester; ?></td>
        <td><?php echo $ajar->status; ?></td>
        <td width="20px"><?= anchor('Manager/TahunAjaran/ubah/' .$ajar->id_tahun, '<div class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></div>') ?>
        </td>
        <td width="20px"><?= anchor('Manager/TahunAjaran/hapus/' .$ajar->id_tahun, '<div class="btn btn-sm btn-danger" onclick="return confirm(`Apakah Anda Yakin Ingin Menghapusnya ?`)"><i class="fas fa-trash"></i></div>') ?>
        </td>
    </tr>

    <?php endforeach; ?>
</table>
</div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->