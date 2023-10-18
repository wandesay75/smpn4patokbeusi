<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?php echo base_url('Manager/AbsenMurid/Data'); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nama_kelas">Kelas</label>
                    <select name="nama_kelas" class="form-control form-control-user w-50" required>
                        <option value="" disabled>--Pilih Kelas--</option>
                        <?php foreach($kelas as $kls)  { ?>
                        <option value="<?= $kls['nama_kelas'];?>">Kelas - <?= $kls['nama_kelas'];?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun Ajaran Semester</label>
                    <?php 
                    $query = $this->db->query('SELECT id_tahun, semester, CONCAT(tahun_ajaran, " -") AS tahun_semester FROM tahun_ajaran');

                    $dropdowns = $query->result();

                    $dropDownList = array(); // Inisialisasi array kosong

                    foreach($dropdowns as $dp) {
                        if ($dp->semester == "Ganjil") {
                            $tampilSemester = "Ganjil";
                        } else {
                            $tampilSemester = "Genap";
                        }

                        $dropDownList[$dp->id_tahun] = $dp->tahun_semester . " " . $tampilSemester;
                    }

                    echo form_dropdown('id_tahun', $dropDownList, $tampilSemester, 'class="form-control w-50" id="id_tahun"');
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
