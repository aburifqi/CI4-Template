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
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3"><?=lang('Auth.loginTitle')?></h3>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form id="frm-login" action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if ($config->validFields === ['email']): ?>
						<div class="form-group">
							<label for="login"><?=lang('Auth.email')?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
								   name="login" placeholder="<?=lang('Auth.email')?>">
							<div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
						</div>
                    <?php else: ?>
						<div class="form-group">
							<label for="login"><?=lang('Auth.emailOrUsername')?></label>
							<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
								   name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
							<div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
						</div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="password"><?=lang('Auth.password')?></label>
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <?php if ($config->allowRemembering): ?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
								<?=lang('Auth.rememberMe')?>
							</label>
						</div>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block enter-btn"><?=lang('Auth.loginAction')?></button>
                    </div>
                    <div id="footer-login">
                        <h1><span class="logo"><img src="/favicon.ico"
                                    alt="logo"></span><span>tes</span></h1>
                        <p class="text-center">©<?= date('Y'); ?> All Rights Reserved.</p>
                    </div>
                </form>
                <?php if ($config->allowRegistration) : ?>
					<p><a href="<?= url_to('register') ?>"><?=lang('Auth.needAnAccount')?></a></p>
                <?php endif; ?>
                <?php if ($config->activeResetter): ?>
                    <p><a href="<?= url_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('modals') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    sessionStorage.clear();
</script>
<!-- <script src="<?= base_url(); ?>/standard/jquery-validation/jquery.validate.min.js"></script> -->
<!-- <script src="<?= base_url(); ?>scripts/login.js"></script> -->

<?= $this->endSection() ?>