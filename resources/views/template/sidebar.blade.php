<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../logo.png" alt="Logo" class="brand-image img-circle elevation-5 " style="opacity:1"/>
      <span class="brand-text font-weight-light">Laundry </span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fa-solid fa-user img-circle elevation-2 text-white fs-4 "></i>
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>



      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <router-link to="dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="data-outlet" class="nav-link">
                  <i class="fa-solid fa-house-chimney-window nav-icon"></i>
                  <p>Outlet</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="data-paket" class="nav-link">
                  <i class="fa-solid fa-box nav-icon"></i>
                  <p>Paket</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="data-member" class="nav-link">
                  <i class="fa-solid fa-users nav-icon"></i>
                  <p>Member</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="data-pengurus" class="nav-link">
                  <i class="fa-solid fa-user-gear nav-icon"></i>
                  <p>Pengurus</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="data-transaksi" class="nav-link">
                  <i class="fa-solid fa-wallet nav-icon"></i>
                  <p>Transaksi</p>
                </router-link>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>