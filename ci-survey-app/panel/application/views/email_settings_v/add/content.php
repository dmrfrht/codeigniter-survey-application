<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Eposta Ayarı Ekle
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?php echo base_url("emailsettings/save"); ?>" method="post">

          <div class="form-group">
            <label>Protokol</label>
            <input
              class="form-control"
              placeholder="Protokol"
              name="protocol"
              type="text"
              value="<?= isset($form_error) ? set_value("protocol") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("protocol") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Sunucu Bilgisi</label>
            <input
              class="form-control"
              placeholder="Hostname"
              name="host"
              type="text"
              value="<?= isset($form_error) ? set_value("host") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("host") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Port Numarası</label>
            <input
              class="form-control"
              placeholder="Port"
              name="port"
              type="text"
              value="<?= isset($form_error) ? set_value("port") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("port") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Adresi (User)</label>
            <input
              class="form-control"
              placeholder="User"
              name="user"
              type="emailsettings"
              value="<?= isset($form_error) ? set_value("user") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("user") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Adresine Ait Şifre</label>
            <input class="form-control" placeholder="Şifre" name="password" type="password">
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("password") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Adresi (Kimden-> From)</label>
            <input
              class="form-control"
              placeholder="Kimden"
              name="from"
              type="emailsettings"
              value="<?= isset($form_error) ? set_value("from") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("from") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Adresi (Kime-> To)</label>
            <input
              class="form-control"
              placeholder="Kime"
              name="to"
              type="emailsettings"
              value="<?= isset($form_error) ? set_value("to") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("to") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eposta Başlık</label>
            <input
              class="form-control"
              placeholder="Eposta Başlık (user_name)"
              name="user_name"
              type="text"
              value="<?= isset($form_error) ? set_value("user_name") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("user_name") ?></small>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?php echo base_url("emailsettings"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>