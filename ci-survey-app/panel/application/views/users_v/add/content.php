<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Kullanıcı Ekle
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?php echo base_url("users/save"); ?>" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Yetki Rolü</label>

                <select name="user_role" class="form-control">
                  <?php foreach ($user_roles as $user_role): ?>
                    <option value="<?= $user_role->id ?>"><?= $user_role->title ?></option>
                  <?php endforeach; ?>
                </select>

                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("client") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Ad</label>
                <input class="form-control" placeholder="Ad" name="name" type="text"
                       value="<?= isset($form_error) ? set_value("name") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("name") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Soyad</label>
                <input class="form-control" placeholder="Soyad" name="surname" type="text"
                       value="<?= isset($form_error) ? set_value("surname") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("surname") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder="Email" name="email" type="email"
                       value="<?= isset($form_error) ? set_value("email") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("email") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Telefon Numarası</label>
                <input class="form-control" placeholder="Telefon Numarası" name="mobile_phone" type="text"
                       maxlength="10" value="<?= isset($form_error) ? set_value("mobile_phone") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("mobile_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Şifre</label>
                <input class="form-control" placeholder="Şifre" name="password" type="password">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("password") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Şifre Tekrarı</label>
                <input class="form-control" placeholder="Şifre Tekrarı" name="re_password" type="password">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("re_password") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?php echo base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>