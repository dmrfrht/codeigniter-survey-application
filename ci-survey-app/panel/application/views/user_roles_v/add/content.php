<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Kullanıcı Rolü Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("user_roles/save") ?>" method="post">
          <div class="form-group">
            <label>Başlık</label>
            <input type="text" class="form-control" placeholder="Başlık" name="title">

            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("title") ?></small>
            <?php endif; ?>

          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("user_roles") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>