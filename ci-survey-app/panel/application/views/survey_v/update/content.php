<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <?= $item->title  ?> Kaydını Düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("product/update/$item->id") ?>" method="post">
          <div class="form-group">
            <label>Başlık</label>
            <input
              type="text"
              class="form-control"
              placeholder="Başlık"
              name="title"
              value="<?= $item->title ?>"
            >

            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("title") ?></small>
            <?php endif; ?>

          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Açıklama</label>
            <textarea class="m-0" data-plugin="summernote" data-options="{height: 250}" name="description"><?= $item->description ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("product") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>
