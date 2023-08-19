 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?php echo base_url('Manager/TahunAjaran'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
        </a>
        <?php foreach($tahun_ajaran as $ajar) : ?>
    <form action="<?php echo site_url('Manager/TahunAjaran/ubahTahunAjaran'); ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="tahun_ajaran" class="text-info">Tahun Ajaran</label>
            <input type="hidden" name="id_tahun" placeholder="Masukkan Tahun Ajaran, contoh: 2023/2024" class="form-control" value="<?php echo $ajar->id_tahun; ?>">
            <?= form_error('tahun_ajaran', '<div class="text-danger small" ml-3>'); ?>
            <input type="text" name="tahun_ajaran" placeholder="Masukkan Tahun Ajaran, contoh: 2023/2024" class="form-control" value="<?php echo $ajar->tahun_ajaran; ?>">
            <?= form_error('tahun_ajaran', '<div class="text-danger small" ml-3>'); ?>
        </div>


          <tr>
            <td>
              <div class="form-group">
                <label for="semester" class="text-info">Semester <span class="text-info">:</span></label>
                <select name="semester" class="form-control">
                    <option><?php echo $ajar->semester ?></option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
                <?= form_error('semester', '<div class="text-danger small" ml-3>'); ?>
              </div>
            </td>
          </tr> 

          <tr>
            <td>
              <div class="form-group">
                <label for="status" class="text-info">Status <span class="text-info">:</span></label>
                <select name="status" class="form-control">
                    <option><?php echo $ajar->status; ?></option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <?= form_error('status', '<div class="text-danger small" ml-3>'); ?>
              </div>
            </td>
          </tr> 

        <button type="submit" class="btn btn-success" style="margin-left: 4px;"><i class="fa fa-save"></i> Simpan</button>
      </form>
      <?php endforeach; ?>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->