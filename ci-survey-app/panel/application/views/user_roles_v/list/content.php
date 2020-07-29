<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Kullanıcı Rolleri
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?= base_url("user_roles/new_form") ?>" class="btn btn-primary btn-outline btn-xs pull-right"><i
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
                href="<?= base_url("user_roles/new_form") ?>">tıklayınız</a>
            </p>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <tr>
            <th>#id</th>
            <th>Başlık</th>
            <th>Durumu</th>
            <th>İşlem</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="text-center w25"><?= $item->id ?></td>
              <td><?= $item->title ?></td>
              <td class="text-center w50">
                <input
                  data-url="<?= base_url("user_roles/isActiveSetter/$item->id") ?>"
                  class="isActive"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= $item->isActive ? ' checked' : null ?>
                />
              </td>
              <td class="text-center w250">
                <?php if (isAllowedDeleteModule()): ?>
                  <button
                    class="btn btn-danger btn-outline btn-xs remove-btn"
                    data-url="<?= base_url("user_roles/delete/$item->id") ?>"
                  >
                    <i class="fa fa-trash"></i>Sil
                  </button>
                <?php endif; ?>

                <?php if (isAllowedUpdateModule()): ?>
                  <a class="btn btn-primary btn-outline btn-xs"
                     href="<?= base_url("user_roles/update_form/$item->id") ?>"><i class="fa fa-edit"></i>Düzenle</a>
                <?php endif; ?>

                <?php if (isAllowedWriteModule()): ?>
                  <a href="<?= base_url("user_roles/permissions_form/$item->id") ?>"
                     class="btn btn-xs btn-purple btn-outline">
                    <i class="fa fa-eye"></i> Yetki Tanımı
                  </a>
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