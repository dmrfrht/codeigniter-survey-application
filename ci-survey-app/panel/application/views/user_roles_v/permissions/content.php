<?php
$permissions = json_decode($item->permissions);
?>

<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <strong><?= $item->title ?></strong> yetkisini düzenliyorsunuz
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("user_roles/update_permissions/$item->id") ?>" method="post">
          <table class="table table-bordered table-striped table-hover">
            <thead>
            <th>Modül Adı</th>
            <th>Görüntüleme</th>
            <th>Ekleme</th>
            <th>Düzenleme</th>
            <th>Silme</th>
            </thead>
            <tbody>
            <?php foreach (getControllerList() as $controllerName): ?>
              <tr>
                <td><?= $controllerName ?></td>
                <td class="w25 text-center">
                  <input
                    <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? " checked" : null   ?>
                    name="permissions[<?php echo $controllerName; ?>][read]" type="checkbox" data-switchery data-color="#10c469"/>
                </td>
                <td class="w25 text-center">
                  <input
                    <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? " checked" : null  ?>
                    name="permissions[<?php echo $controllerName; ?>][write]" type="checkbox" data-switchery data-color="#10c469"/>
                </td>
                <td class="w25 text-center">
                  <input
                    <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? " checked" : null  ?>
                    name="permissions[<?php echo $controllerName; ?>][update]" type="checkbox" data-switchery data-color="#10c469"/>
                </td>
                <td class="w25 text-center">
                  <input
                    <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? " checked" : null  ?>
                    name="permissions[<?php echo $controllerName; ?>][delete]" type="checkbox" data-switchery data-color="#10c469"/>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
          <hr>
          <button type="submit" class="btn btn-success btn-md btn-outline">Güncelle</button>
          <a href="<?php echo base_url("user_roles"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>
