<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <strong><?= $item->name . ' ' . $item->surname ?></strong> kullanıcısının şifresini değiştiriyorsunuz
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("users/update_password/$item->id") ?>" method="post">
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

          <button type="submit" class="btn btn-success btn-md btn-outline">Güncelle</button>
          <a href="<?php echo base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>