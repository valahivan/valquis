<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Token |Token</title>
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
            <h2 class="font-weight-bold title">Token Quis</h2>
            <p>Ini adalah halaman daftar token quis</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between flex-wrap">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Token Quis</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="card">
      <form action="store-token" method="post" class="form-generate">
        <div class="card-header">
            <h3 class="card-title">Tambah Token</h3>
        </div>
        <div class="card-body">
            <div id="list-error-generate" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="alert alert-info">
              <p class="mb-0 ml-1">Kode token generate preview</p>
              <h1 id="kode-token" class="font-weight-bold mb-0">000000</h1>
              <p class="mb-0 ml-1">Klik tombol Generate Token</p>
            </div>
            <div class="form-group mb-3">
                <input type="hidden" name="nama_token">
            </div>
            <div class="form-group mb-3">
                <label for="expired_at" class="form-label text-dark font-weight-medium">Waktu kadaluwarsa</label>
                <select name="expired_at" id="expired_at" class="form-control select2bs4" style="width: 100%;">
                    <option value="1" selected>1 Jam</option>
                    <option value="5">5 Jam</option>
                    <option value="24">1 Hari</option>
                    <option value="744">1 Bulan</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="setquis_id" class="form-label text-dark font-weight-medium">Terapkan Pada Quis</label>
                <select name="setquis_id" id="setquis_id" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected>Pilih Quis</option>
                    <?php while ($row = mysqli_fetch_assoc($setquis)) : ?>
                      <?php if (mysqli_num_rows($setquis) < 0) : ?>
                        <option>Belum Ada Quis</option>
                      <?php else : ?>
                        <option value="<?= $row['id_setquis'] ?>"><?= $row['nama'] ?></option>
                      <?php endif ?>
                    <?php endwhile ?>
                </select>
            </div>
        </div>
        <div class="card-footer bg-white border">
            <button type="submit" class="btn btn-sm btn-success">Generate Token</button>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-add">Tambah Token Custom</button>
        </div>
      </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Token</h3>
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
            <table class="table table-sm table-bordered" id="list-token">
                <thead>
                    <tr>
                      <th class="align-middle text-center">No</th>
                      <th class="align-middle text-center">Kode Token</th>
                      <th class="align-middle text-center">Quis</th>
                      <th class="align-middle text-center">Waktu Kadaluwarsa</th>
                      <th class="align-middle text-center">Waktu Generate</th>
                    </tr>
                </thead>
                <tbody>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tbody>
            </table>
        </div>
    </div>
  </section>
  </div>

  <div class="modal modal-add" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="store-token" method="post" class="form-add">
          <div class="modal-header">
            <h4 class="modal-title">Kode Token Custom</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="list-error-add" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="form-group mb-3">
              <label for="nama_token" class="form-label text-dark font-weight-medium">Kode Token</label>
              <input type="text" name="nama_token" id="nama_token" class="form-control form-control-sm" placeholder="Kode Token" autocomplete="off">
            </div>
            <div class="form-group mb-3">
                <label for="expired_at" class="form-label text-dark font-weight-medium">Waktu kadaluwarsa</label>
                <select name="expired_at" id="expired_at" class="form-control form-control-sm">
                    <option value="1" selected>1 Jam</option>
                    <option value="5">5 Jam</option>
                    <option value="24">1 Hari</option>
                    <option value="744">1 Bulan</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="setquis_id" class="form-label text-dark font-weight-medium">Terapkan Pada Quis</label>
                <select name="setquis_id" id="setquis_id" class="form-control form-control-sm">
                    <option value="" selected>Pilih Quis</option>
                    <?php mysqli_data_seek($setquis, 0) ?>
                    <?php while ($row = mysqli_fetch_assoc($setquis)) : ?>
                      <?php if (mysqli_num_rows($setquis) < 0) : ?>
                        <option>Belum Ada Quis</option>
                      <?php else : ?>
                        <option value="<?= $row['id_setquis'] ?>"><?= $row['nama'] ?></option>
                      <?php endif ?>
                    <?php endwhile ?>
                </select>
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
    var table = $('#list-token').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-token",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "nama_token", "className": "align-middle"},
        {"data": "nama_quis", "className": "text-left align-middle"},
        {"data": "expired_at", "className": "text-lg-center text-left align-middle"},
        {"data": "created_at", "className": "text-lg-center text-left align-middle"},
      ]
    });

    const namaToken = $('input[name="nama_token"]');
    const expiredAt = $('select[name="expired_at"]');
    const quisId = $('select[name="setquis_id"]');
    
    function refreshForm() {
      namaToken.val('');
      expiredAt.val('1').trigger('change');
      quisId.val('').trigger('change');
    }

    function generateToken() {
      $('.modal-loading').modal('show');
      $('#list-error-generate .list-group').html('');

      let angka = "1234567890";
      let huruf = "QWERTYUIOPASDFGHJKLZXCVBNM";
      
      let merge = angka + huruf;
      let tokenLength = 6;
      let token = "";

      for (i = 0; i < tokenLength; i++) {
        const randNum = Math.floor(Math.random() * merge.length);
        token += merge.substring(randNum, randNum + 1);
      }
      
      $.ajax({
        type: "POST",
        url: "store-token",
        data: {nama_token: token, expired_at: expiredAt.val(), setquis_id: quisId.val()},
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.errors) {
            $('#list-error-generate').removeClass('d-none');
            $.each(object.errors, function (key, error) {
              $('#list-error-generate .list-group').append(`<li>${error}</li>`);
            });
          }

          if (object.status == 1) {
            $('#kode-token').text(token);
            Swal.fire({
              title: 'Success !!',
              text: "Token berhasil digenerate",
              icon: 'success'
            });
            refreshForm();
            $('#list-error-generate').addClass('d-none');
            table.ajax.reload();
          }
          $('.modal-loading').modal('hide');
        }
      });
    }

    function addToken(form) {
      $('.modal-loading').modal('show');
      $('#list-error-add .list-group').html(``);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.errors) {
            $('#list-error-add').removeClass('d-none');
            $.each(object.errors, function (key, error) {
              $('#list-error-add .list-group').append(`<li>${error}</li>`);
            });
          }

          if (object.status == 1) {
            Swal.fire({
              title: 'Success !!',
              text: object.message.success,
              icon: 'success'
            });
            refreshForm();
            $('#list-error-add').addClass('d-none');
            table.ajax.reload();
            $('.modal-add').modal('hide');
          }
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

      $('.form-generate').submit(function (e) {
        e.preventDefault();
        generateToken();
      });

      $('.form-add').submit(function (e) {
        e.preventDefault();
        addToken($(this));
      });
    });
  </script>
</body>
</html>