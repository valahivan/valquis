<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link font-weight-medium" href="dashboard">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link font-weight-medium" href="user-page">Pengguna</a>
    </li>
  </ul>

    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <button type="button" class="btn btn-sm font-weight-medium" data-toggle="dropdown" href="#">
        <img src="<?= BASE_URL ?>public/assets/img/valah.jpg" alt="Profile" width="30px" height="30px" class="rounded-circle mr-1">
        <span class="d-lg-inline-block d-none text-dark">Valah Ivan Maulana</span>
      </button>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-center">
        <div class="profile pt-4">
          <img src="<?= BASE_URL ?>public/assets/img/valah.jpg" alt="Profile" width="100px" height="100px" class="rounded-circle">
          <h6 class="text-dark font-weight-bold mt-3 mb-0"><i class="fas fa-user"></i> Valah Ivan Maulana</h6>
        </div>
        <div class="btns-action p-4">
          <form action="logout-admin" method="post" class="form-logout mb-2">
            <button type="submit" class="btn btn-light border btn-block">Logout</button>
          </form>
          <button type="button" class="btn btn-light btn-block border" data-toggle="modal" data-target="#modal-password">Change Password</button>
        </div>
      </div>
    </li>
  </ul>
</nav>

 <div class="modal modal-password" id="modal-password">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="change-password?id=<?= $_SESSION['id_admin'] ?>" method="post" class="form-password">
          <input type="hidden" name="_method" value="PUT">
          <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="list-error-password" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="mb-3">
              <label for="old-password" class="form-label text-dark font-weight-medium">Old Password</label>
              <input type="text" name="old_password" id="old_password" class="form-control form-control-sm" placeholder="Old Password" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-dark font-weight-medium">New Password</label>
              <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="New Password" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label text-dark font-weight-medium">Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm" placeholder="Confirm Password" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>