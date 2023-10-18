<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Manager/Dashboard'); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo base_url('assets/')?>img/logo_sekolah.png" alt="logo_sekolah" width="60">
                </div>
                <div class="sidebar-brand-text mx-1">Admin Patokbeusi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $this->uri->segment(2) == 'Dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Manager/Dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo $this->uri->segment(2) == 'DataMurid' ? 'active' : '' ?>
            <?php echo $this->uri->segment(2) == 'DataKelas' ? 'active' : '' ?>
            <?php echo $this->uri->segment(2) == 'DataGuru' ? 'active' : '' ?>
            <?php echo $this->uri->segment(2) == 'DataAkun' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Sekolah : </h6>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'DataMurid' ? 'active' : '' ?>" href="<?php echo base_url('Manager/DataMurid'); ?>"> <i class="fas fa-users fa-2x text-gray-300" style="font-size:15px;;"> </i> Data Murid</a>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'DataKelas' ? 'active' : '' ?>" href="<?php echo base_url('Manager/DataKelas'); ?>"><i class="fas fa-school fa-2x text-gray-300" style="font-size:15px;;"> </i> Data Kelas</a>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'DataGuru' ? 'active' : '' ?>" href="<?php echo base_url('Manager/DataGuru'); ?>"><i class="fas fa-chalkboard-teacher fa-2x text-gray-300" style="font-size:15px;;"> </i> Data Guru</a>
                        <hr>
                        <h6 class="collapse-header">Data Lainnya : </h6>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'DataAkun' ? 'active' : '' ?>" href="<?php echo base_url('Manager/DataAkun') ?>"><i class="fas fa-key fa-2x text-gray-300" style="font-size:15px;;"> </i> Data Akun</a>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'TahunAjaran' ? 'active' : '' ?>" href="<?php echo base_url('Manager/TahunAjaran') ?>"><i class="fas fa-book fa-2x text-gray-300" style="font-size:15px;;"> </i> Tahun Akademik</a>
                        <a class="collapse-item <?php echo $this->uri->segment(2) == 'Nilai' ? 'active' : '' ?>" href="<?php echo base_url('Manager/Nilai') ?>"><i class="fas fa-warehouse fa-2x text-gray-300" style="font-size:15px;;"> </i> Data Nilai</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Menu Absensi Murid
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?php echo $this->uri->segment(2) == 'AbsenMurid' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Manager/AbsenMurid'); ?>">
                    <i class="fas fa-fw fa-tv"></i>
                    <span>Presensi Murid</span></a>
            </li>

            <li class="nav-item <?php echo $this->uri->segment(2) == 'DataAbsen' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Manager/DataAbsen'); ?>">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Rekap Data Absensi</span></a>
            </li>


            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
