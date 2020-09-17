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
                <li class="nav-item">
                  <a href="dashboard" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                      Dashboard
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Dashboard END -->
                <!-- Expense -->
                <li class="nav-item">
                  <a href="expense" class="nav-link">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>
                      Expense
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Expense END -->
                <!-- Assets -->
                <li class="nav-item">
                  <a href="assets" class="nav-link">
                    <i class="nav-icon fas fa-fire-extinguisher"></i>
                    <p>
                      Assets
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Assets END -->
                <!-- Trainers -->
                <li class="nav-item">
                  <a href="trainers" class="nav-link">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>
                      Trainers
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Trainers END -->
                <!-- Logbook -->
                <li class="nav-item">
                  <a href="logbook" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Logbook
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Logbook END -->
                <!-- Clients -->
                <li class="nav-item">
                  <a href="clients" class="nav-link">
                    <i class="nav-icon fas fa-people-arrows"></i>
                    <p>
                      Clients
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Clients END -->
                <!-- Users -->
                <li class="nav-item">
                  <a href="users" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                      Users
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <!-- Users END -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

      </aside>
