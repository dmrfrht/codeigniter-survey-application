<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label>2. E-posta Adresiniz</label>
        <input class="form-control" placeholder="2. E-posta Adresi" name="email_2" type="email"
               value="<?= isset($form_error) ? set_value("email_2") : $items->email_2 ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>2. Telefon Numaranız</label>
        <input class="form-control" placeholder="2. Telefon Numarası" name="mobile_phone_2" type="text" maxlength="10"
               value="<?= isset($form_error) ? set_value("mobile_phone_2") : $items->mobile_phone_2 ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>Ev Telefon Numaranız</label>
        <input class="form-control" placeholder="Ev Telefon Numarası" name="home_phone" type="text" maxlength="10"
               value="<?= isset($form_error) ? set_value("home_phone") : $items->home_phone ?>">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Aylık Net Geliriniz</label>
        <input class="form-control" placeholder="Aylık Net Geliriniz" name="monthly_net_income" type="text"
               value="<?= isset($form_error) ? set_value("monthly_net_income") : $items->monthly_net_income ?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Evin Aylık Net Geliriniz</label>
        <input class="form-control" placeholder="Evin Aylık Net Geliriniz" name="monthly_income_of_the_house"
               type="text"
               value="<?= isset($form_error) ? set_value("monthly_income_of_the_house") : $items->monthly_income_of_the_house ?>">
      </div>
    </div>
  </div>
</div>


