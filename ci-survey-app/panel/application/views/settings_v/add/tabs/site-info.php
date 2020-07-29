<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Şifrket Adı</label>
        <input class="form-control" placeholder="Şirket Adı" name="company_name" type="text"
               value="<?= isset($form_error) ? set_value("company_name") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("company_name") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Site Başlık</label>
        <input class="form-control" placeholder="Site Başlık" name="site_title" type="text"
               value="<?= isset($form_error) ? set_value("site_title") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("site_title") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>E-posta Adresi</label>
        <input class="form-control" placeholder="E-posta Adresi" name="email" type="text"
               value="<?= isset($form_error) ? set_value("email") : null ?>">
        <?php if (isset($form_error)): ?>
          <small class="pull-right input-form-error"><?= form_error("email") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>