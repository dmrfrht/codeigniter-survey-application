<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Site Ayarları
    </h4>
  </div>

  <div class="col-md-12">
    <form action="<?php echo base_url("settings/save"); ?>" method="post" enctype="multipart/form-data">
      <div class="widget">
        <div class="m-b-lg nav-tabs-horizontal">

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab">
                Site Bilgileri
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab">
                Hakkımızda
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-3" aria-controls="tab-2" role="tab" data-toggle="tab">
                Logo Ayarları
              </a>
            </li>
          </ul>

          <div class="tab-content p-md">

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/about-us") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/logo") ?>

          </div>

        </div>
      </div>
      <div class="widget">
        <div class="widget-body">
          <button type="submit" class="btn btn-primary btn-md">Kaydet</button>
          <a href="<?php echo base_url(); ?>" class="btn btn-md btn-danger">İptal</a>
        </div>
      </div>
    </form>
  </div>

</div>
