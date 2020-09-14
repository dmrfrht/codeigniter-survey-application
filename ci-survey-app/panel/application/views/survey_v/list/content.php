<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Anket Listesi
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?= base_url("surveys/new_form/$unique_id") ?>"
           class="btn btn-primary btn-outline btn-xs pull-right"><i
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
                href="<?= base_url("surveys/new_form/$unique_id") ?>">tıklayınız</a>
            </p>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <tr>
            <th>#id</th>
            <th>Başlık</th>
            <th>url</th>
            <th>Durumu</th>
            <th>İşlem</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="text-center"><?= $item->id ?></td>
              <td><?= $item->title ?></td>
              <td><a target="_blank" href="<?= $item->unique_url ?>"><?= $item->unique_url ?></a></td>
              <td class="text-center">
                <input
                  data-url="<?= base_url("surveys/isActiveSetter/$item->id") ?>"
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
                    data-url="<?= base_url("surveys/delete/$item->id") ?>"
                  >
                    <i class="fa fa-trash"></i>Sil
                  </button>
                <?php endif; ?>

                <?php if (isAllowedUpdateModule()): ?>
                  <a class="btn btn-dark btn-outline btn-xs"
                     href="<?= $item->unique_url ?>"><i class="fa fa-eye"></i>Önizleme</a>
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