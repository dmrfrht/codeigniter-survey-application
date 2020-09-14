<div id="back-to-home">
  <a href="http://www.anketofis.com" class="btn btn-outline btn-default">
    <i class="fa fa-home animated zoomIn"></i>
  </a>
</div>
<div class="simple-page-wrap">
  <div class="simple-page-logo animated swing">
    <a href="http://anketofis.com">
      <span><i class="fa fa-gg"></i></span>
      <span>Survey App</span>
    </a>
  </div>
  <!-- logo -->
  <div class="simple-page-form animated flipInY" id="login-form">
    <h4 class="form-title m-b-xl text-center">
      Uygulama Yönetim Paneli
    </h4>
    <form action="<?= base_url("userop/do_login") ?>" method="post">
      <div class="form-group">
        <input
          id="sign-in-email"
          type="email"
          class="form-control"
          placeholder="Email"
          name="email"
          value="<?php if (isset($_COOKIE["loginEmail"])) {
            echo $_COOKIE["loginEmail"];
          } ?>"
        />
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("email") ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <input
          id="sign-in-password"
          type="password"
          class="form-control"
          placeholder="Şifre"
          name="password"
          value="<?php if (isset($_COOKIE["loginPass"])) {
            echo $_COOKIE["loginPass"];
          } ?>"
        />
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("password") ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group m-b-xl">
        <div class="checkbox checkbox-primary">
          <input type="checkbox" id="keep_me_logged_in" name="remember_me"
            <?php if (isset($_COOKIE["loginEmail"])) { ?> checked="checked" <?php } ?>
          />
          <label for="keep_me_logged_in">Beni Hatırla</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Giriş Yap</button>
    </form>
  </div>

  <div class="form-group">
    <a href="<?= $google_client->createAuthUrl() ?>" class="btn btn-success btn-sm">
      <i class="fa fa-google"></i> Google İle Giriş Yap
    </a>

    <a href="<?= $facebook_login  ?>" class="btn btn-purple btn-sm pull-right">
      <i class="fa fa-facebook"></i> Facebook İle Giriş Yap
    </a>
  </div>

  <div class="simple-page-footer">
    <p><a href="<?= base_url("sifremi-unuttum") ?>">Şifremi Unuttum ?</a></p>
  </div>
</div>