<?= $this->extend('coronadark/auth/index') ?>

<?= $this->section('style') ?>
    <style>
        .auth.login-bg {
            height: 100vh;
        }

        #footer-login h1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #footer-login span.logo {
            background-color: white;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid gold;
            border-radius: 10px;
            width: 50px;
            height: 50px;
        }

        #footer-login span.logo img {
            width: 45px;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('page-content') ?>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3"><?=lang('Auth.register')?></h3>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form action="<?= url_to('register') ?>" method="post">
                    <div class="form-group">
                        <label for="email"><?=lang('Auth.email')?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                        <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                    </div>

                    <div class="form-group">
                        <label for="username"><?=lang('Auth.username')?></label>
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                        <label for="password"><?=lang('Auth.password')?></label>
                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block enter-btn"><?=lang('Auth.register')?></button>
                    </div>
                  <!-- <div class="d-flex">
                    <button class="btn btn-facebook col mr-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="#"> Sign Up</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p> -->
                </form>
                <hr>
                <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->

<?= $this->endSection() ?>

<?= $this->section('modals') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- <script src="<?= base_url(); ?>/standard/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>scripts/login.js"></script> -->

<?= $this->endSection() ?>