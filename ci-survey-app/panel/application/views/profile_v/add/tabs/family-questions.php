<div role="tabpanel" class="tab-pane fade" id="tab-2">

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Aileniz Yaşıyormu?</label>
        <select name="is_family_alive" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Beraber mi Yaşıyorsunuz?</label>
        <select name="is_family_together" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Evli misiniz?</label>
        <select name="you_married" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Çocuğunuz var mı?</label>
        <select name="have_a_child" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Çocuk Sayısı</label>
        <input class="form-control" placeholder="Çocuk Sayısı" name="number_of_children" type="number"
               value="<?= isset($form_error) ? set_value("number_of_children") : null ?>">
      </div>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Eviniz varmı?</label>
        <select name="have_a_house" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Kiracı mısınız?</label>
        <select name="you_a_tenant" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Arabanız var mı?</label>
        <select name="have_a_car" class="form-control">
          <option value="1">Evet</option>
          <option value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Araba Sayısı</label>
        <input class="form-control" placeholder="Araba Sayısı" name="how_many_cars" type="number"
               value="<?= isset($form_error) ? set_value("how_many_cars") : null ?>">
      </div>
    </div>
  </div>

</div>
