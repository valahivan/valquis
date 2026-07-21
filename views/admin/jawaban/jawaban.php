<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Jawaban</title>
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
              <h2 class="font-weight-bold title">Daftar Jawaban</h2>
              <p>Ini adalah halaman yang berisi data Jawaban</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <form action="store-jawaban" method="post" enctype="multipart/form-data" class="form-add">
          <div class="card-header">
            <h4 class="card-title">Tambah Jawaban</h4>
          </div>
          <div class="card-body">
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="mb-3">
              <input type="hidden" name="soal_id" id="soal-id" value="<?= $soal['id_soal'] ?>">
              <label for="kategori" class="form-label text-dark font-weight-medium">Nama Soal</label>
              <input type="text" class="form-control form-control-sm" value="<?= $soal['soal'] ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="pilihan" class="form-label text-dark font-weight-medium">Jawaban</label>
              <textarea name="pilihan" id="pilihan"></textarea>
            </div>
            <div class="mb-3">
              <label for="pilihan_benar" class="form-label text-bg-dark font-weight-normal">Kunci Jawaban</label>
              <select name="pilihan_benar" id="pilihan_benar" class="form-control form-control-sm">
                <option value="0" selected>Salah</option>
                <option value="1">Benar</option>
              </select>
            </div>
          </div>
          <div class="card-footer bg-white border-top">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <a href="soal-page" class="btn btn-sm btn-light">Kembali</a>
          </div>
        </form>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Jawaban</h3>
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
          <table class="table table-sm table-bordered" id="list-jawaban">
              <thead>
                  <tr>
                      <th class="text-center align-middle col-1">No</th>
                      <th class="text-center align-middle col-7">Jawaban</th>
                      <th class="text-center align-middle col-2">Kunci Jawaban</th>
                      <th class="text-center align-middle col-2">Action</th>
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
      <div>
    </section>
  </div>
  
  <div class="modal modal-delete" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="destroy-jawaban" method="post" class="form-delete">
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
    var table = $('#list-jawaban').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-jawaban?soal_id=" + $('#soal-id').val(),
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-lg-center text-left align-middle"},
        {"data": "pilihan", "className": "align-middle"},
        {"data": "pilihan_benar", "className": "align-middle"},
        {"data": "action", "className": "text-center align-middle"},
      ],
    });

    function refreshForm() {
      const pilihanBenar = $('#pilihan_benar');

      pilihanBenar.find('option[value="0"]').prop('selected', true);
      CKEDITOR.instances.pilihan.setData('');
    }

    function addJawaban(form, formData) {
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

    function deleteJawaban(form) {
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

    function modalDelete(id_jawaban, pilihan) {
      $('.modal-delete').modal('show');
      $('.modal-delete form').attr('action', `destroy-jawaban?id=${id_jawaban}`);
      $('.modal-delete #info').html(`Apakah kamu yakin mau menghapus pilihan : ${pilihan}?`);
    }

    $(document).ready(function () {
      table.on('draw.dt', function () {
        var info = table.page.info();

        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
      });
      table.ajax.reload();

      CKEDITOR.replace('pilihan', {
        height: 100,
        filebrowserUploadUrl: 'upload-image',
        filebrowserUploadMethod: 'form'
      });

      $('.form-add').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.set('pilihan', CKEDITOR.instances.pilihan.getData());

        addJawaban(form, formData);
      });

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteJawaban(form);
      });
    });
  </script>
</body>
</html>