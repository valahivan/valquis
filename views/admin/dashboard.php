<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Dashboard</title>
  <?php include_once 'partial/link-admin-style.php' ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once 'partial/navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php include_once 'partial/sidebar.php'  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="header pt-2">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body pb-0">
            <h2 class="font-weight-bold title">Selamat Datang di Dashboard</h2>
            <p>Ini adalah halaman dashboard yang berisi informasi data</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between flex-wrap">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Dashboard</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Diagram Bar</h3>
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
              <div class="chart">
                <canvas id="data-chart-bar" style="width: 100%; height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Diagram Line</h3>
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
              <div class="chart">
                <canvas id="data-chart-line" style="width: 100%; height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'partial/footer.php' ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
  <!-- /.control-sidebar -->

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
</div>
<!-- ./wrapper -->

  <?php include_once 'partial/link-admin-script.php' ?>
  <script>
    function loadChart() {
      $.ajax({
        type: "GET",
        url: "count-tables",
        success: function (response) {
          var object = $.parseJSON(response);

          const labels = [
            'Pengguna',
            'Group',
            'Topik',
            'Soal',
            'Quis',
            'Token',
            'Hasil Quis',
          ];

          const dataBar = {
            labels : labels,
            datasets: [
              {
                label : 'Jumlah data per Table',
                backgroundColor : 'rgb(209, 236, 241)',
                borderColor : 'rgb(12, 84, 96)',
                borderWidth : '1.2',
                pointRadius : false,
                pointHighlightFill  : '#fff',
                data : object.counts
              },
            ],
            
          };

          const dataLine = {
            labels  : labels,
            datasets: [
              {
                label : 'Jumlah data per Table',
                backgroundColor: 'rgb(204, 229, 255)',
                borderColor: 'rgb(0, 64, 133)',
                borderWidth : '1.2',
                pointRadius : 5,
                pointBackgroundColor : '#fff',
                pointHighlightFill : '#fff',
                pointStyle : 'circle',
                data : object.counts
              },
            ]
          };

          new Chart(document.getElementById('data-chart-bar'), {
            type: 'bar',
            data: dataBar,
            options: {
              responsive : true,
              maintainAspectRatio : false,
              title : {
                display : true,
                text : `Jumlah Data per Table`,
              },
              legend : {
                display : false,
              },
            }
          });

          new Chart(document.getElementById('data-chart-line'), {
            type: 'line',
            data: dataLine,
            options: {
              responsive : true,
              maintainAspectRatio : false,
              title : {
                display : true,
                text : `Jumlah Data per Table`,
              },
              legend : {
                display : false,
              },
            }
          });
        }
      });
    }

    document.onload = loadChart();
  </script>
</body>
</html>
