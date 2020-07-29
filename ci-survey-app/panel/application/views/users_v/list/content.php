<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Kullanıcı Listesi
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?php echo base_url("users/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right">
          <i class="fa fa-plus"></i> Yeni Ekle
        </a>
      <?php endif; ?>
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <?php if (isAllowedWriteModule()): ?>
          <div class="alert alert-info text-center">
            <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a
                href="<?php echo base_url("users/new_form"); ?>">tıklayınız</a></p>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th>#id</th>
          <th>Site Rolü</th>
          <th>Ad-Soyad</th>
          <th>Telefon</th>
          <th>Email</th>
          <th>Durumu</th>
          <th>İşlem</th>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="w25 text-center">#<?php echo $item->id; ?></td>
              <td class="w100 text-center">
                <?php if ($item->user_role == 1) {
                  echo 'Admin';
                } elseif ($item->user_role == 2) {
                  echo 'Kurumsal';
                } elseif ($item->user_role == 3) {
                  echo 'Bireysel';
                } ?>
              </td>
              <td><?php echo $item->name . ' ' . $item->surname; ?></td>
              <td><?php echo $item->mobile_phone ?></td>
              <td><?php echo $item->email ?></td>
              <td class="w50 text-center">
                <input
                  data-url="<?= base_url("users/isActiveSetter/$item->id"); ?>"
                  class="isActive"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?php echo ($item->isActive) ? "checked" : ""; ?>
                />
              </td>
              <td class="w350 text-center">
                <?php if (isAllowedDeleteModule()): ?>
                  <button
                    data-url="<?= base_url("users/delete/$item->id") ?>"
                    class="btn btn-xs btn-danger btn-outline remove-btn"
                  >
                    <i class="fa fa-trash"></i> Sil
                  </button>
                <?php endif; ?>

                <?php if (isAllowedUpdateModule()): ?>
                  <a href="<?= base_url("users/update_form/$item->id") ?>" class="btn btn-xs btn-info btn-outline">
                    <i class="fa fa-pencil-square-o"></i> Düzenle
                  </a>

                  <a href="<?= base_url("users/update_password_form/$item->id") ?>"
                     class="btn btn-xs btn-dark btn-outline">
                    <i class="fa fa-key"></i> Şifre Değiştir
                  </a>
                <?php endif; ?>

              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>