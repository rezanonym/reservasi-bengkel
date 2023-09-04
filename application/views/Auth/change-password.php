<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-16 mb-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Ganti password for</h1>
                                <h5 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                            <form method="post" action="<?= base_url('auth/changepassword') ?>" class="user">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan password baru...">
                                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi password baru...">
                                    <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #2e59d9;">
                                    Ganti Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("password1");
            if (x.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>