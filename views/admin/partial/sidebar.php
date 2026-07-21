  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
      <span class="brand-text font-weight-bold text-white"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-utama">CBT</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar p-0">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex align-items-center">
        <div class="image">
          <img src="<?= BASE_URL ?>public/assets/img/valah.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p class="text-white mb-0"><?= $_SESSION['nama_admin'] ?></p>
          <div class="bg-success rounded-circle d-inline-block" style="width: 10px; height: 10px;"></div> <small class="text-white">Online</small>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-control-sidebar bg-black p-2 mt-2 w-100 border-0" style="background-color: #292929"><small class="text-secondary d-block">MAIN NAVIGATION</small></div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="dashboard" class="nav-link text-white">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="topik-page" class="nav-link text-white">
              <i class="nav-icon fas fa-book-open-reader"></i>
              <p>Topik Soal</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="nav-icon fas fa-users"></i>
              <p>Pengguna<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="group-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="print-card-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cetak Kartu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="nav-icon fas fa-book"></i>
              <p>Bank Soal<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="soal-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Soal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="import-soal-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Soal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>Quis<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="setquis-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Quis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add-quis-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Quis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="token-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Token</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="result-page" class="nav-link text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hasil Quis</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>