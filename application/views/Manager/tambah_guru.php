 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/DataGuru'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
    <form action="<?php echo site_url('Manager/DataGuru/tambahGuru'); ?>" method="post" enctype="multipart/form-data">
        <table id="table" width="70%">

        <tr> 
            <td>
              <div class="form-group">
                <label for="nip" class="text-info">NIP <span class="text-info">:</span></label>
                <input type="number" name="nip" id="nip" class="form-control" value="<?php echo set_value('nip'); ?>" placeholder="Masukkan Nomor Induk Pengajar">
                <?php echo form_error('nip', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="nama_guru" class="text-info">Nama <span class="text-info">:</span></label>
                <input type="text" name="nama_guru" id="nama_guru" class="form-control" value="<?php echo set_value('nama_guru'); ?>" placeholder="Masukkan Nama Guru">
                <?php echo form_error('nama_guru', '<small class="text-danger pl-1">', '</small'); ?>
              </div>
            </td>
          </tr> 
          
          <tr>
            <td>
              <div class="form-group">
                <label for="tanggal_lahir" class="text-info">Tanggal Lahir <span class="text-info">:</span></label> <br>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control-date text-center" value="<?php echo set_value('tanggal_lahir'); ?>" placeholder="Masukkan Tanggal Lahir">
            <br><?php echo form_error('tanggal_lahir', '<small class="text-danger pl-1">', '</small'); ?>
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

          

          <tr>
            <td>
              <div class="form-group">
                <label for="jabatan" class="text-info">Jabatan <span class="text-info">:</span></label>
                <select name="jabatan" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Jabatan--</option>
                  <option value="Kepala Sekolah">Kepala Sekolah</option>
                  <option value="Wakil Kepala Sekolah">Wakasek</option>
                  <option value="Kesiswaan">Kesiswaan</option>
                  <option value="Kurikulum">Kurikulum</option>
                  <option value="Sarpras">Sarpras</option>
                  <option value="Humas">Humas</option>
                  <option value="Guru">Guru</option>
                  <option value="Admin/Staff TU">Admin/Staff TU</option>
                </select>
              </div>
            </td>
          </tr>

          <tr> 
            <td>
              <div class="form-group mb-5">
                <label for="foto" class="text-info">Foto Guru <span class="text-info">:</span></label>
                <input type="file" name="foto" id="foto" class="form-control-file" value="<?php echo set_value('foto'); ?>" placeholder="Masukkan Foto Pengguna">
                <?php echo $this->session->flashdata('message'); ?>
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