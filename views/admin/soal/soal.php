<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Soal</title>
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
              <h2 class="font-weight-bold title">Daftar Soal</h2>
              <p>Ini adalah halaman yang berisi data tambah dan daftar soal</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <form action="store-soal" method="post" enctype="multipart/form-data" class="form-add">
          <div class="card-header">
            <h4 class="card-title">Tambah Soal</h4>
          </div>
          <div class="card-body">
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>  
            <div class="mb-3">
              <label for="topik_id" class="form-label text-dark font-weight-medium">Kategori atau Topik</label>
              <select name="topik_id" id="topik_id" class="form-control form-control-sm select2bs4" style="width: 100%;" onchange="filterSoal()">
                <option value="">Pilih topik</option>
                <?php while ($row = mysqli_fetch_assoc($topik)) : ?>
                  <?php if (mysqli_num_rows($topik) == 0) : ?>
                    <option>Topik belum dibuat</option>
                  <?php else : ?>
                    <option value="<?= $row['nama'] ?>, <?= $row['id_topik'] ?>"><?= $row['nama'] ?></option>
                  <?php endif ?>
                <?php endwhile ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="no_soal" class="form-label text-dark font-weight-medium">Nomor Soal</label>
              <input type="text" name="no_soal" id="no_soal" class="form-control form-control-sm" placeholder="Contoh : soal-1" autocomplete="off" value="soal-">
            </div>
            <div class="mb-3">
              <label for="soal" class="form-label text-dark font-weight-medium">Nama Soal</label>
              <textarea name="soal" id="soal"></textarea>
            </div>
          </div>
          <div class="card-footer bg-white border-top">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <button type="reset" class="btn btn-sm btn-light">Clear</button>
          </div>
        </form>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar soal</h3>
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
          <table class="table table-sm table-bordered" id="list-soal">
              <thead>
                  <tr>
                      <th class="text-center align-middle">No</th>
                      <th class="text-center align-middle">Kategori Quis</th>
                      <th class="text-center align-middle">Nomor Soal</th>
                      <th class="text-center align-middle">Nama Soal</th>
                      <th class="text-center align-middle">Jawaban</th>
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
      <div>
    </section>
  </div>
  
  <div class="modal modal-delete" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="destroy-soal" method="post" class="form-delete">
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
    var table = $('#list-soal').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-soal",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "topik", "className": "align-middle"},
        {"data": "no_soal", "className": "align-middle"},
        {"data": "soal", "className": "align-middle"},
        {"data": "jawaban", "className": "align-middle text-center"},
        {"data": "action", "className": "text-center align-middle"},
      ],
    });

    function refreshForm() {
      const noSoal = $('#no_soal');
      
      noSoal.val('soal-');
      CKEDITOR.instances.soal.setData('');
    }

    function filterSoal() {
      const arr_topik = $('#topik_id').val().split(',');
      let topik = arr_topik[0];

      localStorage.setItem('topik', arr_topik);
      if (topik == '') {
        table.column(1).search('').draw();
      } else {
        table.column(1).search('^' + topik + '$', true, false).draw()
      };
    }

    function addSoal(form, formData) {
      $('.modal-loading').modal('show');
      $('#list-error .list-group').html(``);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        processData: false,
        contentType: false,
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

    function deleteSoal(form) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          console.log(response);
          var object = $.parseJSON(response);
          if (object.status == 1) {
            table.ajax.reload();
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            $('.modal-delete').modal('hide');
          }
          $('.modal-loading').modal('hide');
        }
      });
    }

    function modalDelete(id_soal) {
      $('.modal-delete').modal('show');
      $('.modal-delete form').attr('action', `destroy-soal?id=${id_soal}`);
      $('.modal-delete #info').text('Apakah kamu yakin mau menghapus soal ini?');
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();
        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });
      table.ajax.reload();

      CKEDITOR.replace('soal', {
        height: 200,
        filebrowserUploadUrl: 'upload-image',
        filebrowserUploadMethod: 'form'
      });

      $('.form-add').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.set('soal', CKEDITOR.instances.soal.getData());

        addSoal(form, formData);
      });

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteSoal(form);
      });
    });

    window.addEventListener('DOMContentLoaded', function () {
      let getTopik = localStorage.getItem('topik');
      if (getTopik) {
        let optionTopik = $('select[name="topik_id"]').find(`option[value="${getTopik}"]`);
        optionTopik.prop('selected', true);

        let arrOptionTopik = optionTopik.val().split(',');
        table.column(1).search('^' + arrOptionTopik[0] + '$', true, false).draw();
      }
    });
  </script>
</body>
</html>
