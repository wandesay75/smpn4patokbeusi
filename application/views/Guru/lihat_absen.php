 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?> <?php echo $nama_kelas; ?> - <?= $tahun_ajaran; ?> Semester (<?= $semester; ?>)</h1>

<div class="card shadow mb-4">
                        <div class="card-body">
                        <a href="<?php echo base_url('Manager/AbsenMurid/'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-left"></i>
                                        </span>
                                        <span class="text">Kembali</span>
                                    </a>
                            <div class="table-responsive">
                                

                           
                                <table class="table table-hover" width="50%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Murid</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="<?php echo site_url('Manager/AbsenMurid/submitAbsen/'. $nama_kelas. '/'. $id_tahun. '/'. $id_absen); ?>" method="post" enctype="multipart/form-data">
                                            <tr>
                                                   
                                                <?php foreach ($dataSubmit as $murid) :?>
                                                    <input type="text" name="id_absen[]" value="<?= $murid->id_absen; ?>">
                                                    <input type="hidden" name="id_murid[]" value="<?= $murid->id_murid; ?>">
                                                <input type="hidden" name="id_tahun[]" value="<?= $murid->id_tahun; ?>">
                                                <td><input type="hidden" name="nama_murid[]" value="<?= $murid->nama_murid; ?>"><?= $murid->nama_murid; ?></td>
                                                <td><input type="hidden" name="nama_kelas[]" value="<?= $murid->nama_kelas; ?>"><?= $murid->nama_kelas; ?></td>
                                                <td>
                                                    <select name="status[]" class="form-control form-control-user" required>
                                                        <option value="" disabled>--Keterangan--</option>
                                                        <option value="Tanpa Keterangan" >Tanpa Keterangan</option>
                                                        <option value="Hadir" >Hadir</option>
                                                        <option value="Izin" >Izin</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success mb-3" style="margin-left: 4px;"><i class="fa fa-save"></i> Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
