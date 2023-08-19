<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Guru/Dashboard'); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo base_url('assets/')?>img/logo_sekolah.png" alt="logo_sekolah" width="60">
                </div>
                <div class="sidebar-brand-text mx-1">Guru Patokbeusi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $this->uri->segment(2) == 'Dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Guru/Dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Menu Absensi Murid
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?php echo $this->uri->segment(2) == 'AbsenMurid' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Guru/AbsenMurid'); ?>">
                    <i class="fas fa-fw fa-tv"></i>
                    <span>Presensi Murid</span></a>
            </li>

            <li class="nav-item <?php echo $this->uri->segment(2) == 'DataAbsen' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url('Guru/DataAbsen'); ?>">
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

        
