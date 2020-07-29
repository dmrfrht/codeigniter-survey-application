<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <strong><?= $item->name . ' ' . $item->surname ?></strong> kayıt bilgilerinizi düzenliyorsunuz
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("registration_info/update_information/$item->id") ?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Ad</label>
                <input class="form-control" placeholder="Ad" name="name" type="text"
                       value="<?= isset($form_error) ? set_value("name") : $item->name ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("name") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Soyad</label>
                <input class="form-control" placeholder="Soyad" name="surname" type="text"
                       value="<?= isset($form_error) ? set_value("surname") : $item->surname ?>">
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
                       value="<?= isset($form_error) ? set_value("email") : $item->email ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("email") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Telefon Numarası</label>
                <input class="form-control" placeholder="Telefon Numarası" name="mobile_phone" type="text"
                       maxlength="10"
                       value="<?= isset($form_error) ? set_value("mobile_phone") : $item->mobile_phone ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("mobile_phone") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Gizli Soru 1</label>
                <select name="secret_question_1_id" class="form-control">
                  <?php foreach ($secretQuestions as $secretQuestion): ?>
                    <option value="<?= $secretQuestion->id ?>"
                            <?= ($item->secret_question_1_id == $secretQuestion->id) ? ' selected' : null   ?>>
                      <?= $secretQuestion->secret_question ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gizli Soru 1 Cevap</label>
                <input type="text" class="form-control" name="secret_question_1_answer"
                value="<?= isset($form_error) ? set_value("secret_question_1_answer") : $item->secret_question_1_answer ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("secret_question_1_answer") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Gizli Soru 2</label>
                <select name="secret_question_2_id" class="form-control">
                  <?php foreach ($secretQuestions as $secretQuestion): ?>
                    <option value="<?= $secretQuestion->id ?>"
                      <?= ($item->secret_question_2_id == $secretQuestion->id) ? ' selected' : null   ?>>
                      <?= $secretQuestion->secret_question ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gizli Soru 2 Cevap</label>
                <input type="text" class="form-control" name="secret_question_2_answer"
                       value="<?= isset($form_error) ? set_value("secret_question_2_answer") : $item->secret_question_2_answer ?>">
                <?php if (isset($form_error)): ?>
                  <small class="pull-right input-form-error"><?= form_error("secret_question_2_answer") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success btn-md btn-outline">Güncelle</button>
          <a href="<?php echo base_url(); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>