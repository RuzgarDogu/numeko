<?php
// echo '<pre>' . var_export($this->authorized, true) . '</pre>';
$m = $this->authorized;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard" class="brand-link-new">
          <img src="public/images\Numeko_logo_PNG_min.png" alt="Numeko Logo" class="brand-image" style="opacity: .8">
          <!-- <span class="brand-text font-weight-light">Numeko CRM</span> -->
        </a>

        <!-- Sidebar -->

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="nav-icon usericon fas fa-user"></i>
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a id="user-logout" href="login/logout" class="d-block"><?= Session::get("username");?></a>
        </div>
      </div>
            <nav>
              <ul id="solmenuul" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <?php foreach ($m as $menu) : ?>
                  <li class="nav-item">
                    <a href="<?=$menu['link']?>" class="nav-link">
                      <i class="nav-icon <?=$menu['ikon']?>"></i>
                      <p>
                        <?=$menu['name']?>
                        <!-- <span class="badge badge-info right">2</span> -->
                      </p>
                    </a>
                  </li>
                <?php endforeach; ?>

                <!-- Dashboard END -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

      </aside>
