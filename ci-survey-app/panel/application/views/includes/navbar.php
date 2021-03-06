<?php $settings = get_settings(); ?>

<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

  <div class="navbar-header">
    <button type="button" id="menubar-toggle-btn"
            class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
      <span class="sr-only">Toggle navigation</span>
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
            data-target="#app-navbar-collapse" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
            data-target="#navbar-search" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-search"></span>
    </button>

    <a href="<?= base_url() ?>" class="navbar-brand">
      <span class="brand-icon">
<!--        <i class="fa fa-gg"></i>-->
        <?php if ($settings->logo != "default"): ?>
          <img
            src="<?= base_url("uploads/settings_v/$settings->logo") ?>"
            alt="<?= $settings->company_name ?>" class="img-responsive img-rounded"
            style="width: 80px; margin-top: 5px;">
        <?php else: ?>
          <img
            src="<?= base_url("assets/assets/images/index/infinity-logo.png") ?>"
            alt="<?= $settings->company_name ?>" class="img-responsive img-rounded"
            style="width: 30px; margin-top: 5px;">
        <?php endif; ?>
      </span>
      <span class="brand-name"><?= $settings->company_name ?></span>
    </a>
  </div>

  <!--<div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
        <li class="hidden-float hidden-menubar-top">
          <a href="javascript:void(0)" role="button" id="menubar-fold-btn"
             class="hamburger hamburger--arrowalt is-active js-hamburger">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
          </a>
        </li>
        <li>
          <h5 class="page-title hidden-menubar-top hidden-float">Dashboard</h5>
        </li>
      </ul>

      <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
        <li class="nav-item dropdown hidden-float">
          <a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
            <i class="zmdi zmdi-hc-lg zmdi-search"></i>
          </a>
        </li>

        <li class="dropdown">
          <a href="javascript:void(0)" class="side-panel-toggle" data-toggle="class" data-target="#side-panel"
             data-class="open" role="button"><i class="zmdi zmdi-hc-lg zmdi-apps"></i></a>
        </li>
      </ul>
    </div>
  </div>-->
</nav>