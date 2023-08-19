 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/DataAkun'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
    <form action="<?php echo site_url('Manager/DataAkun/ubahAkun/'). $row->id_user; ?>" method="post" enctype="multipart/form-data">
        <table id="table" width="70%">
          <input type="hidden" name="id_user" value="<?php echo $row->id_user; ?>">
          <tr>
            <td>
              <div class="form-group">
                <label for="nama_user" class="text-info">Nama <span class="text-info">:</span></label>
                <input type="text" name="nama_user" id="nama_user" class="form-control" value="<?php echo $row->nama_user; ?>" placeholder="Masukkan Nama Pengguna">
                <?php echo form_error('nama_user', '<small class="text-danger pl-3">', '</small'); ?>
              </div>
            </td>
          </tr> 

          <tr> 
            <td>
              <div class="form-group">
                <label for="email" class="text-info">Email <span class="text-info">:</span></label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $row->email; ?>" placeholder="Masukkan Email Pengguna">
                <?php echo form_error('email', '<small class="text-danger pl-3">', '</small'); ?>
              </div>
            </td>
          </tr>

          <tr> 
            <td>
                <div class="form-group">
                    <label for="password1" class="text-info">Katasandi <span class="text-info">:</span></label>
                    <input type="password" name="password1" size="16" id="password1" class="form-control" placeholder="Masukkan Katasandi Pengguna">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small'); ?>
                  </div>
            </td>
            <td>
                <div class="form-group" style="margin-left:20px;">
                    <label for="password2" class="text-info">Konfirmasi Katasandi <span class="text-info">:</span></label>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Katasandi Pengguna">
                    <?php echo form_error('password', '<small class="text-danger pl-3">', '</small'); ?>
                  </div>
            </td>
          </tr>

          <tr> 
            <td>
              <div class="form-group">
                <label for="foto" class="text-info">Foto Pengguna <span class="text-info">:</span></label> <br>
                <img data-toggle="modal" data-target="#myModal<?= $row->id_user;?>" src="<?= base_url('assets/img/') . $row->foto; ?>" src="<?php echo base_url('assets/img/'). $row->foto; ?>" alt="" class="img-thumbnail mb-2" width="100">
                <input type="file" name="foto" id="foto" class="form-control-file" placeholder="Masukkan Foto Pengguna" required>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="form-group">
                <label for="role" class="text-info">Role <span class="text-info">:</span></label>
                <select name="role" class="form-control form-control-user" required>
                  <option value="" disabled>--Pilih Role--</option>
                  <option value="guru"  <?php if ($row->role == 'guru') {echo 'selected';} ?>>Guru</option>
                  <option value="admin" <?php if ($row->role == 'admin') {echo 'selected';} ?> >Admin</option>
                  <option disabled class="bg-danger text-white">Murid</option>
                </select>
                <p class="h6 mt-2 text-danger">* Note : apabila jabatan yang ditandai berwarna <br> merah, maka fitur tersebut belum tersedia!
                </p>
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

<?php foreach ($table as $r) { ?>

<div class="modal fade" id="myModal<?= $r->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title text-primary" id="myModalLabel"><b> <?= $r->foto; ?> </b></h4>
	      </div>
	      <div class="modal-body">
	      	<center>	
	        	<img src="<?= base_url('assets/img/') . $r->foto; ?>" alt="" class="img-thumbnail">
	        </center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>	
	      </div>
	    </div>
	  </div>
</div>

<?php } ?>

</script>