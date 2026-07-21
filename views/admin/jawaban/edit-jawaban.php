<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Edit Jawaban</title>
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
              <h2 class="font-weight-bold title">Edit Jawaban</h2>
              <p>Ini adalah halaman untuk mengedit jawaban</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <input type="hidden" id="soal-id" value="<?= $soal_id ?>">
        <form action="update-jawaban?id=<?= $jawaban['id_jawaban'] ?>" method="post" class="form-edit">
          <input type="hidden" name="_method" value="PUT">
          <div class="card-header">
            <h3 class="card-title">Edit Jawaban</h3>
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
            <div class="form-group mb-3">
              <label for="pilihan" class="form-label text-secondary text-dark font-weight-medium">Jawaban</label>
              <textarea name="pilihan" id="pilihan"><?= $jawaban['pilihan'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="pilihan_benar" class="form-label text-secondary text-dark font-weight-medium">Kunci Jawaban</label>
              <select name="pilihan_benar" id="pilihan_benar" class="form-control form-control-sm">
                <?php if ($jawaban['pilihan_benar'] == 1) : ?>
                  <option value="0">Salah</option>
                  <option value="1" selected>Benar</option>
                <?php else : ?>
                  <option value="0" selected>Salah</option>
                  <option value="1">Benar</option>
                <?php endif ?>
              </select>
            </div>
          </div>
          <div class="card-footer bg-white border-top">
            <button type="submit" class="btn btn-sm btn-success">Edit</button>
            <button type="reset" class="btn btn-sm btn-light">Clear</button>
          </div>
        </form>
      </div>
    </section>
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
    function editJawaban(form, formData) {
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
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            $('#list-error').addClass('d-none');
            setTimeout(() => window.location.href = 'jawaban-page?id=' + $('#soal-id').val(), 1000);
          };
          $('.modal-loading').modal('hide');
        }
      });
    }

    $(document).ready(function () {
      CKEDITOR.replace('pilihan', {
        height: 100,
        filebrowserUploadUrl: 'upload-image',
        filebrowserUploadMethod: 'form'
      });

      $('.form-edit').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.set('pilihan', CKEDITOR.instances.pilihan.getData());

        editJawaban(form, formData);
      });
    });
  </script>
</body>
</html>