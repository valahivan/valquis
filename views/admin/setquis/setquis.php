<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Set Quis</title>
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
            <h2 class="font-weight-bold title">Daftar Quis</h2>
            <p>Ini adalah halaman yang berisi data set quis</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between flex-wrap">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Daftar Quis</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Quis</h3>
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
        <table class="table table-sm table-bordered nowrap" id="list-setquis">
            <thead>
                <tr>
                  <th class="text-center align-middle">No</th>
                  <th class="text-center align-middle">Nama Quis</th>
                  <th class="text-center align-middle">Nama Topik</th>
                  <th class="text-center align-middle">Waktu Mulai</th>
                  <th class="text-center align-middle">Waktu Akhir</th>
                  <th class="text-center align-middle">Group yang dipilih</th>
                  <th class="text-center align-middle">Sepsifikasi Soal</th>
                  <th class="text-center align-middle">Token</th>
                  <th class="text-center align-middle">Tanggal dibuat</th>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tbody>
        </table>
        </div>
      <div class="card-footer bg-white border">
        <form action="add-quis-page" method="get">
          <button type="submit" class="btn btn-sm btn-success" id="btn-select">Tambah</button>
        </form>
      </div>
    </div>
  </section>
  </div>

  <div class="modal modal-delete" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="destroy-quis" method="post" class="form-delete">
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
    var table = $('#list-setquis').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-setquis",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "nama", "className": "align-middle"},
        {"data": "topik", "className": "align-middle"},
        {"data": "waktu_mulai", "className": "text-lg-center text-left align-middle"},
        {"data": "waktu_akhir", "className": "text-lg-center text-left align-middle"},
        {"data": "groups", "className": "text-left align-middle"},
        {"data": "soal", "className": "text-left align-middle"},
        {"data": "token", "className": "text-left align-middle"},
        {"data": "created_at", "className": "text-left align-middle"},
        {"data": "action", "className": "text-left align-middle"}
      ],
    });

    function deleteQuis(form) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.status == 1) {
            table.ajax.reload();
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            $('.modal-delete').modal('hide');
            $('.modal-loading').modal('hide');
          }
        }
      });
    }

    function modalDelete(idSetquis, nama) {
      $('.modal-delete').modal('show');
      $('.modal-delete form').attr('action', `destroy-quis?id=${idSetquis}`);
      $('.modal-delete form #info').text(`Apakah kamu yakin mau menghapus ${nama}`);
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();

        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });

      table.ajax.reload();

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteQuis(form);
      });
    });
  </script>
</body>
</html>