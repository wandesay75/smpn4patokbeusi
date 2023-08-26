 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/DataMurid'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
    <form action="<?php echo site_url('Manager/DataMurid/ubahMurid/'). $row->id_murid; ?>" method="post" enctype="multipart/form-data">
        <table id="table" width="70%">
        <input type="hidden" name="id_murid" value="<?php echo $row->id_murid; ?>">
        <tr> 
            <td>
              <div class="form-group">
                <label for="nis" class="text-info">NIS <span class="text-info">:</span></label>
                <input type="number" name="nis" id="nis" class="form-control" value="<?php echo $row->nis; ?>" placeholder="Masukkan Nomor Induk Siswa">
                <?php echo form_error('nis', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="nama_murid" class="text-info">Nama <span class="text-info">:</span></label>
                <input type="text" name="nama_murid" id="nama_murid" class="form-control" value="<?php echo $row->nama_murid; ?>" placeholder="Masukkan Nama Murid">
                <?php echo form_error('nama_murid', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr> 
          
          <tr>
            <td>
              <div class="form-group">
                <label for="nama_kelas" class="text-info">Kelas <span class="text-info">:</span></label>
                <select name="nama_kelas" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Kelas--</option>
                  <?php foreach($kelas as $kls)  : ?>
                  <option value="<?= $kls['nama_kelas'];?>" <?php echo $row->nama_kelas == $kls['nama_kelas'] ? 'selected' : '' ?>><?= $kls['nama_kelas'];?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </td>
          </tr>        

          <tr>
            <td>
              <div class="form-group">
                <label for="tempat_tanggal_lahir" class="text-info">Tempat, Tanggal Lahir <span class="text-info">:</span></label> <br>
                <div class="row pl-3">
                  <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control w-50" value="<?php echo $row->tempat_lahir; ?>" placeholder="Masukkan Tempat, Tanggal Lahir">
                  <input type="date" style="margin-left:25px;" name="tanggal_lahir" id="tanggal_lahir" class="form-control-date text-center" value="<?php echo $row->tanggal_lahir; ?>" placeholder="Masukkan Tanggal Lahir">
                </div>
            <br><?php echo form_error('tempat_lahir', '<small class="text-danger pl-1">', '</small'); ?>
            <br><?php echo form_error('tanggal_lahir', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr>     


          <tr>
            <td>
              <div class="form-group">
                <label for="jenis_kelamin" class="text-info">Jenis Kelamin <span class="text-info">:</span></label>
                <select name="jenis_kelamin" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Jenis Kelamin--</option>
                  <option value="Laki-Laki" <?php if ($row->jenis_kelamin == 'Laki-Laki') {echo 'selected';} ?>>Laki-Laki</option>
                  <option value="Perempuan" <?php if ($row->jenis_kelamin == 'Perempuan') {echo 'selected';} ?>>Perempuan</option>
                </select>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="no_telepon" class="text-info">Nomor Telepon Orang Tua<span class="text-info">:</span></label>
                <input type="number" name="no_telepon" id="no_telepon" class="form-control" value="<?php echo $row->no_telepon ?>" placeholder="Masukkan No. Telepon Orang Tua">
                <?php echo form_error('no_telepon', '<small class="text-danger pl-1">', '</small'); ?>
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