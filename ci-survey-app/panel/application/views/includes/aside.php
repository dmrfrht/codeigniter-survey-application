<?php $user = get_active_user(); ?>
<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)">
            <img class="img-responsive" src="<?= base_url("assets") ?>/assets/images/221.jpg"
                 alt="avatar"/>
          </a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username"><?= $user->name . ' ' . $user->surname ?></a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">
                <small>İşlemler</small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="<?= base_url("profile") ?>">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profilim</span>
                  </a>
                </li>
                <?php if (isAllowedViewModule("company_information")): ?>
                  <li>
                    <a class="text-color" href="<?= base_url("company_information") ?>">
                      <span class="m-r-xs"><i class="fa fa-building"></i></span>
                      <span>Firma Bilgilerim</span>
                    </a>
                  </li>
                <?php endif; ?>
                <li>
                  <a class="text-color" href="<?= base_url("registration_info") ?>">
                    <span class="m-r-xs"><i class="fa fa-user-secret"></i></span>
                    <span>Kayıt Bilgilerim</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="<?= base_url("change_password") ?>">
                    <span class="m-r-xs"><i class="fa fa-key"></i></span>
                    <span>Şifremi Değiştir</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="<?= base_url("logout") ?>">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Çıkış Yap</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">

        <?php if (isAllowedViewModule("dashboard")): ?>
          <li>
            <a href="<?= base_url("dashboard") ?>">
              <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">Dashboards</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isAllowedViewModule("product")): ?>
          <li>
            <a href="<?= base_url("product") ?>">
              <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">Ürünler</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isAllowedViewModule("settings")): ?>
          <li>
            <a href="<?= base_url("settings") ?>">
              <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
              <span class="menu-text">Site Ayarları</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Bu yapılacak  -->
        <?php if (isAllowedViewModule("surveys")): ?>
          <li class="has-submenu">
            <a href="javascript:void(0)" class="submenu-toggle">
              <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
              <span class="menu-text">Anketler</span>
              <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
            </a>
            <ul class="submenu">
              <li><a href="<?= base_url("surveys") ?>"><span class="menu-text">Anket Listesi</span></a></li>
              <li><a href="#"><span class="menu-text">Anket Ekle</span></a></li>
            </ul>
          </li>
        <?php endif; ?>
        <!--********************* -->

        <?php if (isAllowedViewModule("companies")): ?>
          <li>
            <a href="<?= base_url("companies") ?>">
              <i class="menu-icon zmdi zmdi-compare zmdi-hc-lg"></i>
              <span class="menu-text">Firmalar</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isAllowedViewModule("users")): ?>
          <li>
            <a href="<?= base_url("users") ?>">
              <i class="menu-icon fa fa-user-secret"></i>
              <span class="menu-text">Kullanıcılar</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isAllowedViewModule("user_roles")): ?>
          <li>
            <a href="<?= base_url("user_roles") ?>">
              <i class="menu-icon fa fa-eye"></i>
              <span class="menu-text">Kullanıcı Rolleri</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isAllowedViewModule("emailsettings")): ?>
          <li>
            <a href="<?= base_url("emailsettings") ?>">
              <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
              <span class="menu-text">Eposta Ayarları</span>
            </a>
          </li>
        <?php endif; ?>

        <li class="menu-separator">
          <hr>
        </li>

        <li>
          <a href="http://anketofis.com/">
            <i class="menu-icon zmdi zmdi-view-web zmdi-hc-lg"></i>
            <span class="menu-text">Ana Sayfa</span>
          </a>
        </li>

      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>