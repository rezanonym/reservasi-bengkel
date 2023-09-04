<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-16 mb-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                            <form method="post" action="<?= base_url('auth/forgotpassword') ?>" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan alamat email...">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #2e59d9;">
                                    Reset Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Kembali ke login</a>
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