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
                                <img class="mt-4" src="<?php echo base_url('assets/')?>img/login.svg" draggable="false" alt="Designed By Freepik">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?php echo base_Url('assets/') ?>img/logo_sekolah.png" width="75" draggable="false" alt="SMPN 4 Patokbeusi">
                                        <h3 class="h6 text-gray-900">SMPN 4 Patokbeusi</h3>
                                        <h3 class="h3 text-gray-900 mb-4">Selamat Datang!</h3>
                                    </div>
                                    <?php echo $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?php echo site_url('Auth/login'); ?>" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                name="email"
                                                placeholder="Masukkan Email Anda" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password"
                                                placeholder="Masukkan Katasandi Anda" size="16" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingatkan Saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('Auth/LupaPassword'); ?>">Lupa Katasandi ?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>