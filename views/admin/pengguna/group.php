<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Daftar Group</title>
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
          <div class="title-info py-3 px-4">
              <h2 class="font-weight-bold title">Daftar Group</h2>
              <p>Ini adalah halaman yang berisi data Group</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Group</h3>
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
          <table class="table table-sm table-bordered" id="list-group">
            <thead>
              <tr>
                <th class="text-center align-middle col-1">No</th>
                <th class="text-center align-middle">Nama Group</th>
                <th class="text-center align-middle col-1">Action</th>
              </tr>
            </thead>
            <tbody>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
          </table>
        </div>
        <div class="card-footer bg-white border">
          <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#modal-add">Tambah</button>
        </div>
      <div>
    </section>
  </div>

  <div class="modal modal-add" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="store-group" method="post" class="form-add">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="list-error" class="alert alert-danger d-none"><ul class="list-group px-3"></ul></div>
            <div class="mb-3">
              <label for="nama" class="form-label text-dark font-weight-medium">Nama Group</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Group" autocomplete="off">
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
  
  <div class="modal modal-edit" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="update-group" method="post" class="form-edit">
          <input type="hidden" name="_method" value="PUT">
          <div class="modal-header">
            <h4 class="modal-title">Edit Group</h4>
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
              <label for="nama" class="form-label text-dark font-weight-medium">Nama Group</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Group" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-success">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal modal-delete" id="modal-delete">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="destroy-group" method="post" class="form-delete">
          <input type="hidden" name="_method" value="DELETE">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="info"></p>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-success">Hapus</button>
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
    var table = $('#list-group').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-group",
      "columns": [
        {"data": null,"defaultContent": '', "className": "text-center align-middle"},
        {"data": "nama", "className": "align-middle"},
        {"data": "action", "className": "text-lg-center text-left align-middle"},
      ],
    });

    function refreshForm() {
      const nama = $('#nama');
      nama.val('');
    }

    function addGroup(form) {
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

    function editGroup(form) {
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
            $('.modal-edit').modal('hide');
            $('#list-error').addClass('d-none');
            refreshForm();
          }
          $('.modal-loading').modal('hide');

        }
      });
    }

    function deleteGroup(form) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.status == 1) {
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

    function modalEdit(id_group, nama) {
      $('.modal-edit').modal('show');
      $('.modal-edit form').attr('action', `update-group?id=${id_group}`);
      $('.modal-edit form #nama').val(nama);
    }

    function modalDelete(id_group, nama) {
      $('.modal-delete').modal('show');
      $('.modal-delete form').attr('action', `destroy-group?id=${id_group}`);
      $('.modal-delete form .info').text(`Apakah anda yakin mau menghapus Group ${nama}`);
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();

        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });
      table.ajax.reload();

      $('.form-add').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        addGroup(form);
      });

      $('.form-edit').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        editGroup(form);
      });

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteGroup(form);
      });
    });
  </script>
</body>
</html>
