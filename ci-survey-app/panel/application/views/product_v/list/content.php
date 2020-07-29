<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Ürün Listesi
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?= base_url("product/new_form") ?>" class="btn btn-primary btn-outline btn-xs pull-right"><i
            class="fa fa-plus"></i>Yeni Ekle</a>
      <?php endif; ?>
    </h4>
  </div><!-- END column -->

  <div class="col-md-12">
    <div class="widget p-lg">

      <?php if (empty($items)): ?>
        <?php if (isAllowedWriteModule()): ?>
          <div class="alert alert-warning">
            <p class="text-center">Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
                href="<?= base_url("product/new_form") ?>">tıklayınız</a>
            </p>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <tr>
            <th><i class="fa fa-reorder"></i></th>
            <th>#id</th>
            <th>Başlık</th>
            <th>url</th>
            <th>Açıklama</th>
            <th>Durumu</th>
            <th>İşlem</th>
          </tr>
          </thead>
          <tbody class="sortable" data-url="<?= base_url("product/rankSetter") ?>">
          <?php foreach ($items as $item): ?>
            <tr id="ord-<?= $item->id ?>">
              <td class="w25"><i class="fa fa-reorder"></i></td>
              <td class="text-center"><?= $item->id ?></td>
              <td><?= $item->title ?></td>
              <td><?= $item->url ?></td>
              <td><?= $item->description ?></td>
              <td class="text-center">
                <input
                  data-url="<?= base_url("product/isActiveSetter/$item->id") ?>"
                  class="isActive"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= $item->isActive ? ' checked' : null ?>
                />
              </td>
              <td class="text-center">

                <?php if (isAllowedDeleteModule()): ?>
                  <button
                    class="btn btn-danger btn-outline btn-xs remove-btn"
                    data-url="<?= base_url("product/delete/$item->id") ?>"
                  >
                    <i class="fa fa-trash"></i>Sil
                  </button>
                <?php endif; ?>

                <?php if (isAllowedUpdateModule()): ?>
                  <a class="btn btn-primary btn-outline btn-xs"
                     href="<?= base_url("product/update_form/$item->id") ?>"><i class="fa fa-edit"></i>Düzenle</a>
                  <a class="btn btn-dark btn-outline btn-xs"
                     href="<?= base_url("product/image_form/$item->id") ?>"><i class="fa fa-picture-o"></i>Resimler</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div><!-- .widget -->
  </div><!-- END column -->
</div>

<!--<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>-->