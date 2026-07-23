<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Daftar Pengguna</title>
  <?php include_once 'views/admin/partial/link-admin-style.php' ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once 'views/admin/partial/navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once 'views/admin/partial/sidebar.php'  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="header pt-2">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body pb-0">
            <h2 class="font-weight-bold title">Daftar Pengguna</h2>
            <p>Ini adalah halaman yang berisi data pengguna</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between flex-wrap">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Daftar Pengguna</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Filter User</h3>
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="group" class="form-label text-dark font-weight-medium">Pilih Group</label>
                <select name="group" id="group" class="form-control select2bs4" style="width: 100%;" onchange="filterUser()">
                  <option value="">Semua Group</option>
                  <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                    <?php if (mysqli_num_rows($group) < 0) : ?>
                      <option>Belum ada group</option>
                    <?php else : ?>
                      <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?></option>
                    <?php endif ?>
                  <?php endwhile ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-12">
        <form action="destroys-user" method="post" class="form-delete">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar User</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-sm table-bordered" id="list-user">
                  <thead>
                      <tr>
                          <th class="text-center align-middle">No</th>
                          <th class="text-center align-middle">Nama Lengkap</th>
                          <th class="text-center align-middle">Group</th>
                          <th class="text-center align-middle">Username</th>
                          <th class="text-center align-middle">Tanggal Registrasi</th>
                          <th class="text-center align-middle">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tbody>
              </table>
            </div>
            <div class="card-footer bg-white border">
              <button type="button" class="btn btn-sm btn-success" id="btn-select">Pilih Semua</button>
              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-delete">Hapus</button>
              <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#modal-add">Tambah</button>
            </div>
            <div class="modal modal-delete" id="modal-delete">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Kamu yakin mau menghapus data pengguna ini?</p>
                  </div>
                  <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success">Hapus</button>
                  </div>
                </div>
              </div>
            </div>
          <div>
        </form>
        </div>
      </div>
    </section>
  </div>

  <div class="modal modal-add" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="store-user" method="post" class="form-add">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pengguna</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label text-dark font-weight-medium">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Lengkap" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label text-dark font-weight-medium">Username</label>
              <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="Username" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-dark font-weight-medium">Password</label>
              <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="group_id" class="form-label text-dark font-weight-medium">Group</label>
              <select name="group_id" id="group_id" class="form-control select2bs4" style="width: 100%">
                <option value="" selected>Pilih Group</option>
                <?php mysqli_data_seek($group, 0) ?>
                <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                  <?php if (mysqli_num_rows($group) < 0) : ?>
                    <option>Belum ada group</option>
                  <?php else : ?>
                    <option value="<?= $row['id_group'] ?>"><?= $row['nama'] ?></option>
                  <?php endif ?>
                <?php endwhile ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-dark font-weight-medium">Email</label>
              <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email (Opsional)" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal modal-loading" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body rounded d-flex justify-content-center align-items-center flex-column border-0">
          <img src="<?= BASE_URL ?>public/assets/img/loading.gif" alt="" width="50px" height="50px">
          <small class="text-center mt-2 mb-1">Permintaan sedang diproses...</span>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'views/admin/partial/footer.php' ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<!-- ./wrapper -->

  <?php include_once 'views/admin/partial/link-admin-script.php' ?>
  <script>
    var table = $('#list-user').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-user",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "nama", "className": "align-middle"},
        {"data": "nama_group", "className": "align-middle"},
        {"data": "username", "className": "align-middle"},
        {"data": "created_at", "className": "text-lg-center text-left align-middle"},
        {"data": "id_user", "className": "text-lg-center text-left align-middle"}
      ],
      "order": [[1, 'asc']]
    });

    function refreshForm() {
      const nama = $('#nama');
      const username = $('#username');
      const password = $('input[name="password"]');
      const group = $('#group_id');
      const email = $('#email');

      nama.val('');
      username.val('');
      password.val('');
      group.val('').trigger('change');
      email.val('');
    }

    function filterUser() {
      const group = $('#group').val();
      if (group == '') {
        table.column(2).search('').draw();
      } else {
        table.column(2).search('^' + group + '$', true, false).draw()
      };
    }

    function addUser(form) {
      $('.modal-loading').modal('show');
      $('#list-error .list-group').html(``);

      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);

          if (object.errors) {
            $('#list-error').removeClass('d-none');
            $.each(object.errors, function (key, error) {
              $('#list-error .list-group').append(`<li>${error}</li>`);
            });
          }

          if (object.status == 1) {
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            table.ajax.reload();
            $('.modal-add').modal('hide');
            $('#list-error').addClass('d-none');
            refreshForm();
          }
          $('.modal-loading').modal('hide');
        }
      });
    }

    function hapusUser(element) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: element.attr('method'),
        url: element.attr('action'),
        data: element.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.status == 0) {
            Swal.fire({
              title: "Oops!!",
              text: object.message.error,
              icon: "error"
            });
            $('.modal-delete').modal('hide');
          } else {
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            table.ajax.reload();
            $('.modal-delete').modal('hide');
          };

          $('.modal-loading').modal('hide');
        }
      });
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();

        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });
      table.ajax.reload();

      $('#btn-select').click(function () {
        const inputCheck = $('input[type="checkbox"]');
        inputCheck.each(function () {
          $(this).prop('checked', true);
        });
      });

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        hapusUser(form);
      });

      $('.form-add').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        addUser(form);
      });
    });
  </script>
</body>
</html>
