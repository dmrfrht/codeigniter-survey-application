<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <?= $item->company_title  ?> Kaydını Düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("companies/update/$item->id") ?>" method="post">

          <!-- Firma Adı ve Vergi Numarası  -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Firma Adı</label>
                <input class="form-control" name="company_title" type="text"
                       value="<?= isset($form_error) ? set_value("company_title") : $item->company_title ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_title") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Vergi Numarası</label>
                <input class="form-control" name="tax_number" type="text"
                       value="<?= isset($form_error) ? set_value("tax_number") : $item->tax_number ?>" maxlength="10">
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
                          name="open_address"><?= $item->open_address  ?></textarea>
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
                       value="<?= isset($form_error) ? set_value("province") : $item->province ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("province") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>İlçe</label>
                <input class="form-control" name="district" type="text"
                       value="<?= isset($form_error) ? set_value("district") : $item->district ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("district") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Ülke</label>
                <input class="form-control" name="country" type="text"
                       value="<?= isset($form_error) ? set_value("country") : $item->country ?>">
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
                       value="<?= isset($form_error) ? set_value("company_phone") : $item->company_phone ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma Cep Telefonu</label>
                <input class="form-control" name="company_cell_phone" type="text" maxlength="10"
                       value="<?= isset($form_error) ? set_value("company_cell_phone") : $item->company_cell_phone ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_cell_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma E-posta</label>
                <input class="form-control" name="company_email" type="email"
                       value="<?= isset($form_error) ? set_value("company_email") : $item->company_email ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("company_email") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Firma Website</label>
                <input class="form-control" name="company_website" type="text"
                       value="<?= isset($form_error) ? set_value("company_website") : $item->company_website ?>">
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
                    <option <?= $item->number_staff_employed == '1-50' ? ' selected' : null  ?>  value="1-50">1-50</option>
                    <option <?= $item->number_staff_employed == '51-100' ? ' selected' : null  ?>  value="51-100">51-100</option>
                    <option <?= $item->number_staff_employed == '51-100' ? ' selected' : null  ?>  value="51-100">101-200</option>
                    <option <?= $item->number_staff_employed == '201-300' ? ' selected' : null  ?>  value="201-300">201-300</option>
                    <option <?= $item->number_staff_employed == '301-400' ? ' selected' : null  ?>  value="301-400">301-400</option>
                    <option <?= $item->number_staff_employed == '401-500' ? ' selected' : null  ?>  value="401-500">401-500</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("companies") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>
