<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Firma Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("companies/save") ?>" method="post">
          <!-- Firma Adı ve Vergi Numarası  -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Firma Adı</label>
                <input class="form-control" name="company_title" type="text"
                       value="<?= isset($form_error) ? set_value("company_title") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_title") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Vergi Numarası</label>
                <input class="form-control" name="tax_number" type="text"
                       value="<?= isset($form_error) ? set_value("tax_number") : null ?>" maxlength="10">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("tax_number") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Açık Adres -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputPassword1">Açık Adres</label>
                <textarea class="m-0" data-plugin="summernote" data-options="{height: 250}"
                          name="open_address"></textarea>
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("open_address") ?></small>
                <?php endif; ?>
              </div>
            </div>

          </div>

          <!-- İl, İlçe, Ülke  -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>İl</label>
                <input class="form-control" name="province" type="text"
                       value="<?= isset($form_error) ? set_value("province") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("province") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>İlçe</label>
                <input class="form-control" name="district" type="text"
                       value="<?= isset($form_error) ? set_value("district") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("district") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Ülke</label>
                <input class="form-control" name="country" type="text"
                       value="<?= isset($form_error) ? set_value("country") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("country") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Telefon Numarası, Cep Telefon Numarası, Email Adresi ve WebSite  -->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma Telefonu</label>
                <input class="form-control" name="company_phone" type="text" maxlength="10"
                       value="<?= isset($form_error) ? set_value("company_phone") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma Cep Telefonu</label>
                <input class="form-control" name="company_cell_phone" type="text" maxlength="10"
                       value="<?= isset($form_error) ? set_value("company_cell_phone") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_cell_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma E-posta</label>
                <input class="form-control" name="company_email" type="email"
                       value="<?= isset($form_error) ? set_value("company_email") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_email") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma Website</label>
                <input class="form-control" name="company_website" type="text"
                       value="<?= isset($form_error) ? set_value("company_website") : null ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_website") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Çalıştırılan Personel Aralığı  -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Çalıştırılan Personel Aralığı</label>
                <div class="form-group">
                  <select class="form-control" name="number_staff_employed">
                    <option value="1-50">1-50</option>
                    <option value="51-100">51-100</option>
                    <option value="101-200">101-200</option>
                    <option value="201-300">201-300</option>
                    <option value="301-400">301-400</option>
                    <option value="401-500">401-500</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("companies") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>