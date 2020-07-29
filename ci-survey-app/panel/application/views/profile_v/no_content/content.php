<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Kişisel Bilgiler
      <?php if (isAllowedWriteModule()): ?>
        <a href="<?php echo base_url("profile/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right">
          <i class="fa fa-plus"></i> Yeni Ekle
        </a>
      <?php endif; ?>
    </h4>
  </div>
  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <?php if (isAllowedWriteModule()): ?>
          <div class="alert alert-info text-center">
            <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a
                href="<?php echo base_url("profile/new_form"); ?>">tıklayınız</a></p>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>