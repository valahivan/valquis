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
          <div class="card-body pb-0">
            <h2 class="font-weight-bold title">Cetak Kartu</h2>
            <p>Ini adalah halaman untuk mencetak kartu pengguna</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Cetak Kartu</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <form action="preview-card" method="post">
          <div class="card-header">
            <h3 class="card-title">Cetak Kartu</h3>
          </div>
          <div class="card-body">
            <div class="form-group mb-2">
              <label for="group" class="form-label text-dark font-weight-medium">Pilih Group</label>
              <select name="group" id="group" class="form-control select2bs4" style="width: 100%;">
                <option value="">Semua Group</option>
                  <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                    <option value="<?= $row['id_group'] ?>, <?= $row['nama'] ?>"><?= $row['nama'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>
              <p class="text-dark">Silahkan pilih sesuai group. Ketika tombol cetak ditekan, akan diarahkan ke preview Kartu</p>
            </div>
            <div class="card-footer bg-white border">
              <button type="submit" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#modal-add">Cetak</button>
            </div>
        </form>
      <div>
    </section>
  </div>

  <?php include_once 'views/admin/partial/footer.php' ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<!-- ./wrapper -->

  <?php include_once 'views/admin/partial/link-admin-script.php' ?>
</body>
</html>