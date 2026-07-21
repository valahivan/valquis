<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Import Soal</title>
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
              <h2 class="font-weight-bold title">Import Soal Word</h2>
              <p>Mengimport soal dari aplikasi Microsoft Word</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <form action="import-soal" method="post" enctype="multipart/form-data" class="form-import">
          <div class="card-header">
            <h4 class="card-title">Import Soal</h4>
            <div class="card-tools">
              <a href="download-file-word?nama_file=form-soal-word.docx" class="btn btn-sm p-0 text-info btn-print font-weight-medium"><i class="fas fa-download"></i> Download File Word</a>
            </div>
          </div>
          <div class="card-body">
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>  
            <div class="mb-3">
              <label for="topik_id" class="form-label text-dark font-weight-medium">Kategori atau Topik</label>
              <select name="topik_id" id="topik_id" class="form-control form-control-sm select2bs4" style="width: 100%;">
                <option value="" selected>Pilih topik</option>
                <?php while ($row = mysqli_fetch_assoc($topik)) : ?>
                  <?php if (mysqli_num_rows($topik) <= 0) : ?>
                    <option>Topik belum dibuat</option>
                  <?php else : ?>
                    <option value="<?= $row['id_topik'] ?>"><?= $row['nama'] ?></option>
                  <?php endif ?>
                <?php endwhile ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="soals" class="form-label text-dark font-weight-medium">Import Soal</label>
              <textarea name="soals" id="soals">Pastekan di sini!</textarea>
            </div>
            <p class="text-dark">Silahkan cek kembali soalnya! Jika ada yang enter berlebih atau ketinggalan beberapa jawaban segera perbaiki! <br> Format Table harus sesuai dengan yang ada di file word</p>
          </div>
          <div class="card-footer bg-white border-top">
            <button type="submit" class="btn btn-sm btn-success">Import</button>
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
    function refreshForm() {
      const topikId = $('select[name="topik_id"]');

      topikId.val('').trigger('change');
      CKEDITOR.instances.soals.setData('');
    }

    function importHandle(form, formData) {
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
            refreshForm();
          };
          $('.modal-loading').modal('hide');
        }
      });
    }

    $(document).ready(function () {
      CKEDITOR.replace('soals', {
        height: 200,
        filebrowserUploadUrl: 'upload-image-word',
        uploadUrl: 'upload-image-word',
        extraPlugins: 'uploadimage',
        filebrowserUploadMethod: 'form'
      });

      CKEDITOR.instances.soals.on('fileUploadRequest', function (e) {
        let fileLoader = e.data.fileLoader;
        let formData = new FormData();

        formData.append('upload', fileLoader.file);
      });

      $('.form-import').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.set('soals', CKEDITOR.instances.soals.getData());

        importHandle(form, formData);
      });
    });
  </script>
</body>
</html>