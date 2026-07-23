<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Quis</title>
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
              <h2 class="font-weight-bold title">Daftar Topik</h2>
              <p>Ini adalah halaman yang berisi data Topik quis</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content d-flex justify-content-between flex-wrap">
    <div class="col-lg-4 col-12 pr-lg-2 p-0">
      <div class="card">
        <form action="add-topik" method="post" class="form-add">
          <div class="card-header">
            <h3 class="card-title">Tambah Topik Quis</h3>
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
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label text-dark font-weight-medium">Nama Topik</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Topik" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label text-dark font-weight-medium">Deskripsi</label>
              <input type="text" name="deskripsi" id="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi" autocomplete="off">
            </div>
          </div>
          <div class="card-footer bg-white border-top">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <button type="reset" class="btn btn-sm btn-light">Clear</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-8 col-12 pl-lg-2 p-0">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Topik Quis</h3>
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
            <table class="table table-sm table-bordered" id="list-topik">
              <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="align-middle">Nama Topik</th>
                    <th class="align-middle">Deskripsi</th>
                    <th class="text-center align-middle">Action</th>
                </tr>
              </thead>
              <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </section>
  </div>

  <div class="modal modal-edit" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="update-topik" method="post" class="form-edit">
          <input type="hidden" name="_method" value="PUT">
          <div class="modal-header">
            <h4 class="modal-title">Edit Topik</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3">
            <div id="list-error" class="alert alert-danger d-none"><ul class="list-group px-3"></ul></div>
            <div class="mb-3">
              <label for="nama" class="form-label font-weight-normal">Nama Topik</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Topik" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label font-weight-normal">Deskripsi</label>
              <input type="text" name="deskripsi" id="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-success" id="btn-delete">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal modal-delete" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="destroy-topik" method="post" class="form-delete">
          <input type="hidden" name="_method" value="DELETE">
          <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
        <div class="modal-body">
          <p id="info"></p>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="btn-delete">Hapus</button>
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
    var table = $('#list-topik').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "ajax" : "list-topik",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "nama", "className": "align-middle"},
        {"data": "deskripsi", "className": "align-middle"},
        {"data": "id_topik", "className": "text-lg-center text-left align-middle"}
      ],
      "destroy": true,
    });

    function refreshForm() {
      const nama = $('.form-add #nama');
      const deskripsi = $('.form-add #deskripsi');

      nama.val('');
      deskripsi.val('');
    }

    function addTopik(form) {
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
            table.ajax.reload();
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            $('#list-error').addClass('d-none');
            refreshForm();
          };
          $('.modal-loading').modal('hide');
        }
      });
    }

    function editTopik(form) {
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
            table.ajax.reload();
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            $(`.modal-edit`).modal('hide');
            $('#list-error').addClass('d-none');
          }
          $('.modal-loading').modal('hide');
        }
      });
    }

    function deleteTopik(form) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.status == 0) {
            Swal.fire({
              title: "Opps!!",
              text: object.message.error,
              icon: "error"
            });
            table.ajax.reload();
            $('.modal-delete').modal('hide');
          } else {
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            table.ajax.reload();
            $('.modal-delete').modal('hide');
          }
          $('.modal-loading').modal('hide');
        }
      });
    }

    function modalEdit(id, nama, deskripsi) {
      $('.modal-edit').modal('show');
      $('.modal-edit form').attr('action', `update-topik?id=${id}`);
      $('.modal-edit form #nama').val(nama);
      $('.modal-edit form #deskripsi').val(deskripsi);
    }

    function modalDelete(id, nama) {
      $('.modal-delete').modal('show');
      $('.modal-delete form').attr('action', `destroy-topik?id=${id}`);
      $('.modal-delete form #info').text(`Apakah anda yakin mau menghapus Topik ${nama}`);
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();

        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });
      table.ajax.reload();

      $('.form-add').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        addTopik(form);
      });

      $(`.form-edit`).submit(function (e) {
        e.preventDefault();
        let form = $(this);
        editTopik(form);
      });
      
      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteTopik(form);
      });
      
    });
  </script>
</body>
</html>