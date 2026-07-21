<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Detail</title>
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
                <input type="hidden" name="nama_group" value="<?= $nama_group ?>">
                <input type="hidden" name="nama_quis" value="<?= $nama_quis ?>">
                <h2 class="font-weight-bold title">Detail Nilai <?= $nama_quis ?></h2>
                <p>Ini adalah halaman dashboard yang berisi informasi detail nilai quis</p>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Diagram Nilai</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-sm p-0 text-info btn-print font-weight-medium"><i class="fas fa-print"></i> Cetak Diagram</button>
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
            <canvas id="data-chart-bar" style="min-height: 390px; height: 390px; max-height: 390px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'views/admin/partial/footer.php' ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <?php include_once 'views/admin/partial/link-admin-script.php' ?>
  <script>
    const namaGroup = $('input[name="nama_group"]');
    const namaQuis = $('input[name="nama_quis"]');
    function loadChart() {
      $.ajax({
        type: "GET",
        url: `detail-chart?nama_group=${namaGroup.val()}&nama_quis=${namaQuis.val()}`,
        success: function (response) {
          var object = $.parseJSON(response);

          const labels = object.labels;
          const dataBar = {
            labels : labels,
            datasets: [
              {
                label : 'Rating nilai',
                backgroundColor : 'rgb(209, 236, 241)',
                borderColor : 'rgb(12, 84, 96)',
                borderWidth : '1.2',
                pointRadius : false,
                data : object.data,
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
                text : `Nilai ${namaQuis.val()} ${namaGroup.val()}`,
              },
              legend : {
                display : false,
              },
              scales : {
                yAxes : [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                    }
                }]
              }
            }
          });
        }
      });
    }

    $('.btn-print').click(() => window.location.href = `print-page?nama_group=${namaGroup.val()}&nama_quis=${namaQuis.val()}`);
    document.onload = loadChart();
  </script>
</body>
</html>