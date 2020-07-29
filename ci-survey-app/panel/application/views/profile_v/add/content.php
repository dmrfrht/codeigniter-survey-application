<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Profil Bilgileriniz
    </h4>
  </div>

  <div class="col-md-12">
    <form action="<?php echo base_url("profile/save"); ?>" method="post">
      <div class="widget">
        <div class="m-b-lg nav-tabs-horizontal">

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab">
                Kişisel Sorular
              </a>
            </li>

            <li role="presentation">
              <a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab">
                Ailevi Sorular
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-3" aria-controls="tab-2" role="tab" data-toggle="tab">
                Sosyal Medya Hesaplarınız
              </a>
            </li>

          </ul>

          <div class="tab-content p-md">

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/personal-questions") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/family-questions") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/social-media-accounts") ?>

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
