<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form
          data-url="<?= base_url("product/refresh_image_list/$item->id") ?>"
          action="<?= base_url("product/image_upload/$item->id") ?>"
          id="dropzone"
          class="dropzone"
          data-plugin="dropzone"
          data-options="{ url: '<?= base_url("product/image_upload/$item->id") ?>'}">
          <div class="dz-message">
            <h3 class="m-h-lg">Yüklemek istediğiniz dosyalarınızı buraya sürükleyiniz</h3>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <?= $item->title ?> Kaydına Ait Resimleri
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body image_list_container">

        <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v") ?>

      </div>
    </div>
  </div>
</div>