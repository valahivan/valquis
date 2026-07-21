<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Edit Quis</title>
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
              <h2 class="font-weight-bold title">Edit Quis</h2>
              <p>Ini adalah halaman untuk mengubah quis</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="card">
      <form action="update-quis?id=<?= $setquis['id_setquis'] ?>"  method="post" class="form-edit">
        <input type="hidden" name="_method" value="PUT">
        <div class="card-header">
            <h3 class="card-title">Edit Quis</h3>
        </div>
        <div class="card-body">
            <div id="list-error" class="alert alert-danger d-none">
              <h5><i class="fas fa-warning"></i> Warning !!!</h5>
              <ul class="list-group px-3"></ul>
            </div>
            <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group mb-3">
                <label for="nama" class="form-label text-dark font-weight-medium">Nama Quis</label>
                <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Quis" autocomplete="off" value="<?= $setquis['nama'] ?>">
              </div>
              <div class="form-group mb-3">
                <label for="topik_id" class="form-label text-dark font-weight-medium">Nama Quis</label>
                <select name="topik_id" id="topik_id" class="form-control select2bs4" style="width: 100%;">
                  <option value="" selected>Pilih Topik</option>
                  <?php while ($row = mysqli_fetch_assoc($topik)) : ?>
                    <?php if ($row['id_topik'] == $setquis['topik_id']) : ?>
                      <option value="<?= $row['id_topik'] ?>" selected><?= $row['nama'] ?></option>
                    <?php else : ?>
                      <option value="<?= $row['id_topik'] ?>"><?= $row['nama'] ?></option>
                    <?php endif ?>
                  <?php endwhile ?>
                </select>
              </div>
              <div class="form-group">
                <input type="hidden" name="old_groups" value="<?= $setquis['groups'] ?>">
                <label for="groups[]" class="form-label text-dark font-weight-medium">Pilih Group</label>
                <select name="groups[]" id="groups[]" multiple="multiple" class="form-control select2bs4" multiple="multiple" data-placeholder="Pilih beberapa group" style="height: 200px;">
                  <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                    <?php if (mysqli_num_rows($group) <= 0) : ?>
                      <option>Belum Ada Topik</option>
                    <?php else : ?>
                      <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?></option>
                    <?php endif ?>
                  <?php endwhile ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group mb-3">
                <label for="waktu" class="form-label text-dark font-weight-medium">Waktu</label>
                <input type="text" name="waktu" id="waktu" class="form-control form-control-sm" placeholder="Waktu Pengerjaan" autocomplete="off" value="<?= $setquis['waktu'] ?>">
              </div>
              <div class="form-group mb-3">
                <label for="nilai_plus" class="form-label text-dark font-weight-medium">Nilai Plus</label>
                <input type="text" name="nilai_plus" id="nilai_plus" class="form-control form-control-sm" placeholder="Nilai Plus" autocomplete="off" value="<?= $setquis['nilai_plus'] ?>">
              </div>
              <div class="form-group mb-3">
                <label for="nilai_minus" class="form-label text-dark font-weight-medium">Nilai Minus</label>
                <input type="text" name="nilai_minus" id="nilai_minus" class="form-control form-control-sm" placeholder="Nilai Minus" autocomplete="off" value="<?= $setquis['nilai_minus'] ?>">
              </div>
              <div class="checks d-flex justify-content-start" style="gap: 20px;">
                <div class="form-check mb-3">
                  <input type="checkbox" name="token" id="token" class="form-check-input" value="1" <?= $setquis['token'] == 1 ? 'checked' : '' ?>>
                  <label for="token" class="form-label text-dark font-weight-medium">Token</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" name="acak_soal" id="acak_soal" class="form-check-input" value="1" <?= $setquis['acak_soal'] == 1 ? 'checked' : '' ?>>
                  <label for="acak_soal" class="form-label text-dark font-weight-medium">Acak Soal</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" name="acak_jawaban" id="acak_jawaban" class="form-check-input" value="1" <?= $setquis['acak_jawaban'] == 1 ? 'checked' : '' ?>>
                  <label for="acak_jawaban" class="form-label text-dark font-weight-medium">Acak Jawaban</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border">
            <button type="submit" class="btn btn-sm btn-success" id="btn-select">Ubah</button>
            <a href="setquis-page" class="btn btn-sm btn-light" id="btn-select">Kembali</a>
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
    function editQuis(form) {
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

          $('#list-error').addClass('d-none');
          if (object.status == 1) {
            Swal.fire({
            title: 'Success !!',
              text: object.message.success,
              icon: 'success'
            });
          }
          setTimeout(() =>window.location.href = 'setquis-page', 1000); 
          $('.modal-loading').modal('hide');
        }
      });
    }

    $(document).ready(function () {
        $('.form-edit').submit(function (e) {
            e.preventDefault();

            let form = $(this);
            editQuis(form);
        });
    });
  </script>
</body>
</html>