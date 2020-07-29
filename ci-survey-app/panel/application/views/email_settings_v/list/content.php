<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      E-posta Ayarları
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?php echo base_url("emailsettings/new_form"); ?>"
           class="btn btn-outline btn-primary btn-xs pull-right">
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
                href="<?php echo base_url("emailsettings/new_form"); ?>">tıklayınız</a></p>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th>#id</th>
          <th>E-posta Başlık</th>
          <th>Sunucu Adı</th>
          <th>Protokol</th>
          <th>Port</th>
          <th>Eposta</th>
          <th>Kimden</th>
          <th>Kime</th>
          <th>Durumu</th>
          <th>İşlem</th>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="order w40">#<?php echo $item->id; ?></td>
              <td class="w200"><?php echo $item->user_name; ?></td>
              <td><?php echo $item->host; ?></td>
              <td><?php echo $item->protocol; ?></td>
              <td><?php echo $item->port; ?></td>
              <td><?php echo $item->user; ?></td>
              <td><?php echo $item->from; ?></td>
              <td><?php echo $item->to; ?></td>

              <td class="order w100">
                <input
                  data-url="<?= base_url("emailsettings/isActiveSetter/$item->id"); ?>"
                  class="isActive"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?php echo ($item->isActive) ? "checked" : ""; ?>
                />
              </td>
              <td class="order w200">
                <?php if (isAllowedDeleteModule()): ?>
                  <button
                    data-url="<?= base_url("emailsettings/delete/$item->id") ?>"
                    class="btn btn-sm btn-danger btn-outline remove-btn"
                  >
                    <i class="fa fa-trash"></i> Sil
                  </button>
                <?php endif; ?>
                <?php if (isAllowedUpdateModule()): ?>
                  <a href="<?= base_url("emailsettings/update_form/$item->id") ?>"
                     class="btn btn-sm btn-info btn-outline">
                    <i class="fa fa-pencil-square-o"></i> Düzenle
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