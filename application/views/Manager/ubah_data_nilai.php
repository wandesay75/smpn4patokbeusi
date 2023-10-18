<div class="container-fluid">


<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
<div class="card-body">

<form action="<?php echo base_url('Manager/Nilai/simpanUpdate')?>" method="post">
<div class="form-group">
    <label for="tahun_ajaran">Tahun Ajaran</label>
    <input type="hidden" name="id_nilai" class="form-control" value="<?php echo $id_nilai; ?>">
    <input type="hidden" name="id_tahun" class="form-control" value="<?php echo $id_tahun; ?>">
    <input type="text" name="tahun_ajaran" class="form-control" value="<?php echo $tahun_ajaran. 
    '/' .$semester; ?>" readonly>
</div>

<div class="form-group">
    <label for="nis">NIS</label>
    <input type="text" name="nis" class="form-control" value="<?php echo $nis; ?>" readonly>
</div>

<div class="form-group">
    <label for="nama_murid">Nama Murid</label>
    <input type="text" class="form-control" name="nama_murid" value="<?php echo $nama_murid; ?>" readonly>
</div>



<div class="form-group">
    <label for="kd_mapel">Matapelajaran</label>
    <?php 
    $query = $this->db->query('SELECT kd_mapel,nama_mapel FROM matapelajaran');

    $dropdowns = $query->result();
    foreach($dropdowns as $dp) {
        $dropDownList[$dp->kd_mapel] = $dp->nama_mapel;
    }

    echo form_dropdown('kd_mapel', $dropDownList, $kd_mapel, 'class="form-control" id="kd_mapel"');
    ?>
</div>

<div class="form-group">
    <label for="nilai_tugas">Nilai Tugas</label>
    <input type="number" class="form-control" id="nilai_tugas" name="nilai_tugas" value="<?php echo $nilai_tugas; ?>">
</div>

<div class="form-group">
    <label for="nilai_uts">Nilai UTS</label>
    <input type="number" class="form-control" id="nilai_uts" name="nilai_uts" value="<?php echo $nilai_uts; ?>">
</div>

<div class="form-group">
    <label for="nilai_uas">Nilai UAS</label>
    <input type="number" class="form-control" id="nilai_uas" name="nilai_uas" value="<?php echo $nilai_uas; ?>">
    <?php
    // Perhitungan total nilai
    if(isset($_POST['nilai_tugas']) && isset($_POST['nilai_uts']) && isset($_POST['nilai_uas'])){
        $tugas = $_POST['nilai_tugas'];
        $uts = $_POST['nilai_uts'];
        $uas = $_POST['nilai_uas'];
                                
        $total_nilai = round(($tugas + $uts + $uas) / 3);
        return $total_nilai;
    } 
    ?>
    <!-- <input type="hidden" class="form-control" id="total_nilai" name="total_nilai" value="<= $total_nilai; ?>"> -->
</div>



<button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i>
    Simpan
</button>
<a href="<?php echo base_url('Manager/Nilai/DataNilai/'. $nis. '/' . $id_tahun); ?>" class="btn btn-warning">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-undo"></i>
                                                </span>
                                                <span class="text">Kembali</span>
</a>
</form>
</div>
</div>
</div>
