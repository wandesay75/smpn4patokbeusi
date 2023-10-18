 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?> <?php echo $nama_kelas; ?> - <?php echo $tahun_ajaran; ?> <?php echo $semester; ?></h1>

<div class="card shadow mb-4">
                        <div class="card-body">
                        <a href="<?php echo base_url('Manager/DataMurid'); ?>" class="btn btn-primary btn-icon-split mb-3">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Kembali</span>
                        </a>
                        <br>
                        <a href="<?php echo base_url('Manager/DataMurid/tambahMurid/'. $nama_kelas.'/'.$id_tahun); ?>" class="btn btn-secondary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        <span class="text">Tambah Murid</span>
                                    </a>
                        <a href="<?php echo base_url('Manager/DataMurid/Cetak/'. $nama_kelas.'/'.$id_tahun); ?>" target="_blank" class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-print"></i>
                                        </span>
                                        <span class="text">Cetak Data</span>
                                    </a>
                            <div class="table-responsive">
                            <?= $this->session->flashdata('pesan'); ?>
                                <table class="table table-bordered table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIS</th>
                                            <th>Nama Murid</th>
                                            <th>Kelas</th>
                                            <th>Tempat Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Telepon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id_murid = 1; foreach ($data_murid as $murid) :?>
                                            <tr>
                                                <td><?= $id_murid++ ?></td>
                                                <td><?= $murid->nis ?></td>
                                                <td><?= $murid->nama_murid ?></td>
                                                <td><?= $murid->nama_kelas; ?></td>
                                                <td><?php echo $murid->tempat_lahir;  echo ' , '; echo $murid->tanggal_lahir;   ?></td>
                                                <td><?= $murid->jenis_kelamin; ?></td>
                                                <td><?= $murid->no_telepon; ?></td>
                                                <td>
                                                <a href="<?php echo site_url('Manager/DataMurid/ubahMurid/'. $murid->id_murid); ?>" 
                                class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('Manager/DataMurid/hapus/'. $murid->id_murid); ?>" 
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
