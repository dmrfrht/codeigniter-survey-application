<div class="simple-page-wrap">
  <div class="simple-page-logo animated swing">
    <a href="<?= base_url() ?>">
      <span><i class="fa fa-gg"></i></span>
      <span>Survey App</span>
    </a>
  </div><!-- logo -->
  <div class="simple-page-form animated flipInY" id="reset-password-form">
    <h4 class="form-title m-b-xl text-center">Şifremi Değiştir</h4>

    <form action="<?= base_url("guncelle?ci=$email") ?>" method="post">
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Yeni Şifre" name="password"
               value="<?= isset($form_error) ? set_value("password") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("password") ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" placeholder="Yeni Şifre Tekrar" name="re_password"
               value="<?= isset($form_error) ? set_value("re_password") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("re_password") ?></small>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary">Şifremi Güncelle</button>
    </form>
  </div>
</div>