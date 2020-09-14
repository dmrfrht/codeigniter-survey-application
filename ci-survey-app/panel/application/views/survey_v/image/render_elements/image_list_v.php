<?php if (empty($item_images)): ?>
  <div class="alert alert-warning">
    <p class="text-center">Burada herhangi bir resim kaydı bulunmamaktadır</p>
  </div>
<?php else: ?>

  <table class="table table-bordered table-striped table-hover pictures_list">
    <thead>
    <th><i class="fa fa-reorder"></i></th>
    <th>#id</th>
    <th>Görsel</th>
    <th>Resim Adı</th>
    <th>Kapak</th>
    <th>Durumu</th>
    <th>İşlemler</th>
    </thead>
    <tbody class="sortable" data-url="<?= base_url("product/imageRankSetter") ?>">
    <?php foreach ($item_images as $image): ?>
      <tr id="ord-<?= $image->id ?>">
        <td class="w25"><i class="fa fa-reorder"></i></td>
        <td class="w50 text-center">#<?= $image->id ?></td>
        <td class="w100 text-center">
          <img width="50"
               src="<?= base_url("uploads/{$viewFolder}/$image->img_url") ?>" alt="<?= $image->img_url ?>"
               class="img-responsive">
        </td>
        <td><?= $image->img_url ?></td>
        <td class="w100 text-center">
          <input
            data-url="<?= base_url("product/isCoverSetter/$image->id/$image->product_id") ?>"
            class="isCover"
            type="checkbox"
            data-switchery
            data-color="#ff5b5b"
            <?= $image->isCover ? ' checked' : null ?>
          />
        </td>
        <td class="w100 text-center">
          <input
            data-url="<?= base_url("product/imageIsActiveSetter/$image->id") ?>"
            class="isActive"
            type="checkbox"
            data-switchery
            data-color="#10c469"
            <?= $image->isActive ? ' checked' : null ?>
          />
        </td>
        <td class="w100 text-center">
          <button class="btn btn-danger btn-outline btn-xs remove-btn btn-block"
                  data-url="<?= base_url("product/image_delete/$image->id/$image->product_id") ?>"><i
              class="fa fa-trash"></i>
            Sil
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
