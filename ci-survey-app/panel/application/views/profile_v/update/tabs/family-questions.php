<div role="tabpanel" class="tab-pane fade" id="tab-2">

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Aileniz Yaşıyormu?</label>
        <select name="is_family_alive" class="form-control">
          <option <?= ($items->is_family_alive == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->is_family_alive == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Beraber mi Yaşıyorsunuz?</label>
        <select name="is_family_together" class="form-control">
          <option <?= ($items->is_family_together == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->is_family_together == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
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
          <option <?= ($items->you_married == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->you_married == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Çocuğunuz var mı?</label>
        <select name="have_a_child" class="form-control">
          <option <?= ($items->have_a_child == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->have_a_child == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Çocuk Sayısı</label>
        <input class="form-control" placeholder="Çocuk Sayısı" name="number_of_children" type="number"
               value="<?= isset($form_error) ? set_value("number_of_children") : $items->number_of_children ?>">
      </div>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Eviniz varmı?</label>
        <select name="have_a_house" class="form-control">
          <option <?= ($items->have_a_house == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->have_a_house == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Kiracı mısınız?</label>
        <select name="you_a_tenant" class="form-control">
          <option <?= ($items->you_a_tenant == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->you_a_tenant == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
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
          <option <?= ($items->have_a_car == 1 ? " selected" : null)  ?>  value="1">Evet</option>
          <option <?= ($items->have_a_car == 0 ? " selected" : null)  ?>  value="0">Hayır</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Araba Sayısı</label>
        <input class="form-control" placeholder="Araba Sayısı" name="how_many_cars" type="number"
               value="<?= isset($form_error) ? set_value("how_many_cars") : $items->how_many_cars ?>">
      </div>
    </div>
  </div>

</div>
