<body class="img js-fullheight overflow-hidden" style="background-image: url(assets/images/bg-bengkel.jpg);">
    <section class="ftco-section">
        <div class="container">


            <div class="card o-hidden border-0 shadow-lg my-4 col-lg-5 mx-auto" style="background-color: #3d828d;">
                <div class="card-body p-0">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="login-wrap p-0">
                                <div class="row justify-content-center">
                                    <div class="col-md-auto text-center mb-5">
                                        <h2 class="heading-section text-gray-900 mt-5">Login Page</h2>
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                                <form action="<?= base_url('auth') ?>" method="post" class="signin-form">
                                    <div class="form-group">
                                        <input type="text" style="width: 300px; margin-left: -75px; background-color: #ffffff36;" class="form-control text-dark" placeholder="Email" id="email" name="email" required value="<?= set_value('email') ?>">
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" style="width: 300px; margin-left: -75px; background-color: #ffffff36;" class="form-control" placeholder="Password" name="password" required>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                        <span toggle="#password-field" onclick="myFunction()" class="fa fa-eye field-icon toggle-password" style="color: black;"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                                    </div>
                                    <div class="form-group d-md-flex small" style="width: 200px;">
                                        <div class="w-150" style="color: black; margin-left: -55px;">
                                            Belum punya akun?<br>
                                            <a href="<?= base_url('auth/registration'); ?>" style="color: blue">Daftar!</a>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="<?= base_url('auth/forgotpassword') ?>" style="color: blue; margin-rigth: 55px;">Lupa Password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>