 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/DataKelas'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
    <form action="<?php echo site_url('Manager/DataKelas/ubahKelas/') . $row->id_kelas; ?>" method="post" enctype="multipart/form-data">
        <table id="table" width="70%">
        <input type="hidden" name="id_kelas" value="<?php echo $row->id_kelas; ?>">
        <tr> 
            <td>
              <div class="form-group">
                <label for="nama_kelas" class="text-info">Nama Kelas <span class="text-info">:</span></label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?php echo $row->nama_kelas; ?>" placeholder="Masukkan Nama Kelas">
                <?php echo form_error('nama_kelas', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="wali_kelas" class="text-info">Wali Kelas <span class="text-info">:</span></label>
                <select name="wali_kelas" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Wali kelas--</option>
                  <?php foreach($walikelas as $wakel)  { ?>
                  <option value="<?= $wakel['nama_guru'];?>" <?php echo $row->wali_kelas == $wakel['nama_guru'] ? 'selected' : '' ?>><?= $wakel['nama_guru'];?></option>
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