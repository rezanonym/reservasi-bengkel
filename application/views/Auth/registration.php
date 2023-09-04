<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-4 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Form Registrasi!</h1>
                            </div>
                            <form method="post" action="<?= base_url('auth/registration') ?>" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap" value="<?= set_value('name') ?>">
                                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= set_value('email') ?>">
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No.Telpon" value="<?= set_value('no_telp') ?>">
                                    <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan password">
                                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
                                        <label class="custom-control-label" for="customCheck1">Tampilkan Password</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi password">
                                    <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #2e59d9;">
                                    Buat Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Sudah mempunyai akun? Login!</a>
                            </div>
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