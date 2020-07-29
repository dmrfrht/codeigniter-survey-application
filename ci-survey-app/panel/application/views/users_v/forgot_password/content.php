<div id="back-to-home">
  <a href="<?= base_url()  ?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div class="simple-page-wrap">
  <div class="simple-page-logo animated swing">
    <a href="<?= base_url() ?>">
      <span><i class="fa fa-gg"></i></span>
      <span>Survey App</span>
    </a>
  </div><!-- logo -->
  <div class="simple-page-form animated flipInY" id="reset-password-form">
    <h4 class="form-title m-b-xl text-center">Şifrenizi mi Unuttunuz ?</h4>

    <form action="<?= base_url("sifremi-sifirla") ?>" method="post">
      <div class="form-group">
        <input type="email" class="form-control" placeholder="Eposta Adresiniz" name="email"
               value="<?= isset($form_error) ? set_value("email") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("email") ?></small>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary">Sıfırlama Maili Gönder</button>
    </form>
    <div class="form-group">
      <a href="https://www.google.com" class="btn" style="margin-top: 10px !important;">SMS ile Şifre Değiştirme</a>
    </div>

  </div>
</div>