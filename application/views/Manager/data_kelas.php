 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

<div class="card shadow mb-4">
                        <div class="card-body">
                        <a href="<?php echo base_url('Manager/DataKelas/tambahKelas'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        <span class="text">Tambah Kelas</span>
                                    </a>
                            <div class="table-responsive">
                            <?php echo $this->session->flashdata('message'); ?>
                                <table class="table table-bordered table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kelas</th>
                                            <th>Wali Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id_kelas = 1; foreach ($table as $kelas) :?>
                                            <tr>
                                                <td><?= $id_kelas++ ?></td>
                                                <td><?= $kelas->nama_kelas ?></td>
                                                <td><?= $kelas->wali_kelas ?></td>
                                                <td>
                                                <a href="<?php echo site_url('Manager/DataKelas/ubahKelas/'. $kelas->id_kelas); ?>" 
                                class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('Manager/DataKelas/hapus/'. $kelas->id_kelas); ?>" 
                                class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapusnya ?')"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- <php foreach ($table as $user) { ?>

<div class="modal fade" id="myModal<= $user->id_guru;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title text-primary" id="myModalLabel"><b> <= $user->foto ;?> </b></h4>
	      </div>
	      <div class="modal-body">
	      	<center>	
	        	<img src="<= base_url('assets/img/') . $user->foto; ?>" alt="" class="img-thumbnail">
	        </center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>	
	      </div>
	    </div>
	  </div>
</div>

<php } ?>

</script> -->