<div role="tabpanel" class="tab-pane fade" id="tab-3">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group image_upload_container">
        <img src="<?= base_url("uploads/$viewFolder/$item->logo") ?>" alt="<?= $item->company_name ?>"
             class="img-responsive img-rounded">
      </div>
    </div>

    <div class="col-md-10">
      <div class="form-group image_upload_container">
        <label>Görsel Seçiniz</label>
        <input type="file" class="form-control" name="logo">
      </div>
    </div>
  </div>
</div>