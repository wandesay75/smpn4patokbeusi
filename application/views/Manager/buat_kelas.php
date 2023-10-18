 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/AbsenMurid/DataAbsen/'. $nama_kelas. '/'. $id_tahun); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
    <form action="<?php echo site_url('Manager/AbsenMurid/buatKelas/'. $nama_kelas . '/'. $id_tahun); ?>" method="post" enctype="multipart/form-data">
        <table id="table" width="70%">

        <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
        <input type="hidden" name="id_tahun" value="<?php echo $id_tahun;  ?>">

          <tr>
            <td>
              <div class="form-group">
                <label for="nama_kelas" class="text-info">Nama kelas <span class="text-info">:</span></label>
                <input type="text" name="nama_kelas" class="form-control form-control-user" value="<?php echo $nama_kelas; ?>" readonly>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="nama_guru" class="text-info">Nama Guru <span class="text-info">:</span></label>
                <select name="nama_guru" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Guru--</option>
                  <?php foreach($guru as $wakel)  { ?>
                  <option value="<?= $wakel['nama_guru'];?>"><?= $wakel['nama_guru'];?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr> 

          <tr>
            <td>
              <div class="form-group">
                <label for="matapelajaran" class="text-info">Matapelajaran <span class="text-info">:</span></label>
                <select name="matapelajaran" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Matapelajaran--</option>
                  <?php foreach($mapel as $apel)  { ?>
                  <option value="<?= $apel['nama_mapel'];?>"><?= $apel['nama_mapel'];?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>            

        </table>
        <button type="reset" class="btn btn-warning"><i class="fas fa-undo"></i> Ulangi</button>
        <button type="submit" class="btn btn-success" style="margin-left: 4px;"><i class="fa fa-save"></i> Simpan</button>
      </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->