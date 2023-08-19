<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                            <img class="mt-4" src="<?php echo base_url('assets/'); ?>img/forgot-password.svg" draggable="false" alt="Designed By Freepik">
                            </div>
                            <div class="col-lg-6 mt-3">
                                <div class="p-5">
                                    <div class="text-center">
                                    <img src="<?php echo base_Url('assets/') ?>img/logo_sekolah.png" width="75" draggable="false" alt="SMPN 4 Patokbeusi">
                                        <h3 class="h6 text-gray-900 mb-2">SMPN 4 Patokbeusi</h3>
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Katasandi ?</h1>
                                        <p class="mb-4">Pastikan email anda terhubung dengan akun yang anda miliki !</p>
                                    </div>
                                    <?php echo $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?php echo base_url('Auth/LupaPassword'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email"
                                                placeholder="Masukkan Email Anda" value="<?php echo set_value('email'); ?>">
                                                <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" >
                                            Reset Katasandi
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('Auth'); ?>">Kembali Halaman Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>