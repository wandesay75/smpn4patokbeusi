 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

<div class="card shadow mb-4">
<div class="card-body">
<?= $this->session->flashdata('pesan'); ?>

<form action="<?php echo base_url('Manager/Nilai/CariNilai'); ?>" method="post">

<div class="form-group">
<label for="nis">Nomor Induk Siswa</label>
<input type="text" name="nis" placeholder="Masukkan Nomor Induk Siswa" class="form-control w-25">
<?= form_error('nis', '<div class="text-danger small ml-2">', '</div'); ?>
</div>

<div class="form-group">
<label>Tahun Ajaran / Semester</label>
<?php 
$query = $this->db->query('SELECT id_tahun, semester,CONCAT(tahun_ajaran, "/") 
AS tahun_semester 
FROM tahun_ajaran');

$dropdowns = $query->result();

foreach($dropdowns as $dp) {
    if ($dp->semester == 1)
    {
        $tampilSemester = "Ganjil";

    }else {
        $tampilSemester = "Genap";
    }

    $dropDownList[$dp->id_tahun] = $dp->tahun_semester . " ". $tampilSemester;
}

echo '<br>'; echo form_dropdown('id_tahun', $dropDownList, ''. 'class="form-control" id="id_tahun"');
?>

</div>

<button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i> Cari</button>


</form>

</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->