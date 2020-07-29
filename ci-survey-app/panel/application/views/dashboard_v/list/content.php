<div class="row">
  <?php if (isAllowedViewModule("profile")): ?>
    <a href="<?= base_url("profile") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-primary"><span>Profilim</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-user"></i></span>
          </div>
          <footer class="widget-footer bg-primary">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("registration_info")): ?>
    <a href="<?= base_url("registration_info") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-danger"><span>Kayıt Bilgilerim</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-user-secret"></i></span>
          </div>
          <footer class="widget-footer bg-danger">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("change_password")): ?>
    <a href="<?= base_url("change_password") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-success"><span>Şifremi Değiştir</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-key"></i></span>
          </div>
          <footer class="widget-footer bg-success">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("surveys")): ?>
    <a href="<?= base_url("surveys") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-warning"><span>Anketler</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
          </div>
          <footer class="widget-footer bg-warning">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>
</div><!-- .row -->

<?php if (isAllowedViewModule("companies")): ?>
<div class="row">
  <a href="<?= base_url("companies") ?>">
    <div class="col-md-3 col-sm-6 hover-card">
      <div class="widget stats-widget">
        <div class="widget-body clearfix">
          <div class="pull-left">
            <h3 class="widget-title text-info"><span>Firmalar</span></h3>
          </div>
          <span class="pull-right big-icon watermark"><i class="fa fa-building"></i></span>
        </div>
        <footer class="widget-footer bg-info">
        </footer>
      </div><!-- .widget -->
    </div>
  </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("users")): ?>
    <a href="<?= base_url("users") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-warning"><span>Tüm Kullanıcılar</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-users"></i></span>
          </div>
          <footer class="widget-footer bg-warning">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("emailsettings")): ?>
    <a href="<?= base_url("emailsettings") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-dark"><span>E-posta Ayarları</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-envelope"></i></span>
          </div>
          <footer class="widget-footer bg-dark">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

  <?php if (isAllowedViewModule("settings")): ?>
    <a href="<?= base_url("settings") ?>">
      <div class="col-md-3 col-sm-6 hover-card">
        <div class="widget stats-widget">
          <div class="widget-body clearfix">
            <div class="pull-left">
              <h3 class="widget-title text-success"><span>Site Ayarları</span></h3>
            </div>
            <span class="pull-right big-icon watermark"><i class="fa fa-cog"></i></span>
          </div>
          <footer class="widget-footer bg-success">
          </footer>
        </div><!-- .widget -->
      </div>
    </a>
  <?php endif; ?>

</div><!-- .row -->

<!--<h1>Dashboard Sayfası</h1>-->

<?php
//echo '<pre>';
//print_r(get_active_user());
//echo '<hr>';
//echo '<pre>';
//print_r(get_user_roles());
//echo '<hr>';
//echo '<pre>';
//echo isAllowedViewModule();
?>

<style>
  .hover-card:hover,
  .hover-card:focus {
    transform: scale(1.025);
    cursor: pointer;
  }
</style>
