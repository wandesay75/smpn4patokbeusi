 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

<div class="card shadow mb-4">
                        <div class="card-body">
                        <a href="<?php echo base_url('Manager/AbsenMurid/buatKelas'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="far fa-calendar-plus"></i>
                                        </span>
                                        <span class="text">Buat Absen Kelas</span>
                                    </a>
                            <div class="table-responsive">
                            <?php echo $this->session->flashdata('message'); ?>
                                <table class="table table-bordered table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kelas</th>
                                            <th>Nama Guru</th>
                                            <th>Matapelajaran</th>
                                            <th>Tanggal Absen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id_absen = 1; foreach ($table as $murid) :?>
                                            <tr>
                                                <td><?= $id_absen++ ?></td>
                                                <td><?= $murid->nama_kelas; ?></td>
                                                <td><?= $murid->nama_guru; ?></td>
                                                <td><?= $murid->matapelajaran; ?></td>
                                                <td><?= $murid->waktu_absen; ?></td>
                                                <td>
                                                <a href="<?php echo site_url('Manager/AbsenMurid/lihatAbsen/'. $murid->id_absen); ?>" 
                                class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                <a href="<?php echo site_url('Manager/AbsenMurid/hapus/'. $murid->id_absen); ?>" 
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
