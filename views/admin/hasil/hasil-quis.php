<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Val Quis | Hasil Quis</title>
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
            <h2 class="font-weight-bold title">Hasil Quis</h2>
            <p>Ini adalah halaman yang berisi data hasil quis</p>
          </div>
          <div class="card-footer py-2 border-top bg-white d-flex justify-content-between flex-wrap">
            <small><i class="fas fa-user"></i> <?= $_SESSION['nama_admin'] ?></small>
            <small><i class="fas fa-pager"></i> Halaman | Hasil Quis</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="card">
      <form action="" method="post" class="form-filter">
        <div class="card-header">
          <h3 class="card-title">Filter Hasil Quis</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group mb-3">
                <label for="group" class="form-label text-dark font-weight-medium">Filter Berdasarkan Group</label>
                <select name="group" id="group" class="form-control select2bs4" style="width: 100%;">
                  <option value="" selected>Semua Group</option>
                  <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                    <?php if (mysqli_num_rows($group) < 0) : ?>
                      <option>Belum ada Group</option>
                    <?php else : ?>
                      <option value="<?= $row['nama'] ?>, <?= $row['id_group'] ?>"><?= $row['nama'] ?></option>
                    <?php endif ?>
                  <?php endwhile ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group mb-3">
                <label for="setquis" class="form-label text-dark font-weight-medium">Filter Berdasarkan Nama Quis</label>
                <select name="setquis" id="setquis" class="form-control select2bs4" style="width: 100%;">
                  <option value="" selected>Semua Quis</option>
                  <?php while ($row = mysqli_fetch_assoc($setquis)) : ?>
                    <?php if (mysqli_num_rows($setquis) < 0) : ?>
                      <option>Belum ada quis</option>
                    <?php else : ?>
                      <option value="<?= $row['nama'] ?>, <?= $row['id_setquis'] ?>"><?= $row['nama'] ?></option>
                    <?php endif ?>
                  <?php endwhile ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-top">
          <button type="submit" class="btn btn-sm btn-success">Terapkan</button>
        </div>
      </form>
    </div>
    <form action="destroys-result" method="post" class="form-delete">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Hasil</h3>
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
          <table class="table table-sm table-bordered" id="list-result">
              <thead>
                <tr>
                  <th class="text-center align-middle">No</th>
                  <th class="text-center align-middle">Nama Lengkap</th>
                  <th class="text-center align-middle">Group</th>
                  <th class="text-center align-middle">Quis Yang di Kerjakan</th>
                  <th class="text-center align-middle">Status</th>
                  <th class="text-center align-middle">Nilai Akhir</th>
                  <th class="text-center align-middle">Tanggal Dikerjakan</th>
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
              </tbody>
          </table>
        </div>
        <div class="card-footer bg-white border">
          <button type="button" class="btn btn-sm btn-success" id="btn-select">Pilih Semua</button>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-delete">Hapus</button>
          <button type="button" class="btn btn-sm btn-success" id="btn-export">Export ke PDF</button>
        </div>
        <div class="modal modal-delete" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah Kamu yakin mau menghapus data hasil ini?</p>
              </div>
              <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-success">Hapus</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
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
    var table = $('#list-result').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "ajax": "list-result",
      "columns": [
        {"data": null, "defaultContent": '', "className": "text-center align-middle"},
        {"data": "nama_user", "className": "align-middle"},
        {"data": "nama_group", "className": "text-center align-middle"},
        {"data": "nama_quis", "className": "align-middle"},
        {"data": "status", "className": "text-lg-center text-left align-middle"},
        {"data": "nilai_akhir", "className": "text-lg-center align-middle"},
        {"data": "tanggal", "className": "text-lg-center text-left align-middle"},
        {"data": "action", "className": "text-lg-center text-left align-middle"},
      ],
      "columnDefs": [ {
        "searchable": false,
        "orderhable": false,
        "targets": 0,
      }],
      "order": [[5, "desc"]]
    });

    function exportPDF(group, quis) {
      return window.location.href = `export-pdf?group=${group}&quis=${quis}`;
    }

    function deleteResult(form) {
      $('.modal-loading').modal('show');
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          var object = $.parseJSON(response);
          if (object.status == 1) {
            Swal.fire({
              title: "Success!!",
              text: object.message.success,
              icon: "success"
            });
            table.ajax.reload();
            $('.modal-delete').modal('hide');
          } else {
            Swal.fire({
              title: "Oops!!",
              text: object.message.error,
              icon: "error"
            });
            $('.modal-delete').modal('hide');
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

      $('.form-filter').submit(function (e) {
        e.preventDefault();

        let arrGroup = $('#group').val().split(',');
        let arrSetQuis = $('#setquis').val().split(',');
        let group = arrGroup[0];
        let setquis = arrSetQuis[0];

        localStorage.setItem('group', arrGroup);
        localStorage.setItem('setquis', arrSetQuis);

        if (group == '') {
          table.column(2).search('').draw();
        } else {
          table.column(2).search('^' + group + '$', true, false).draw();
        }
        table.column(3).search(setquis).draw();
      });

      $('#btn-export').click(function () {
        let group = $('#group').val();
        let setquis = $('#setquis').val();
        
        exportPDF(group, setquis);
      });

      $('#btn-select').click(function () {
        const inputCheck = $('input[type="checkbox"]');
        inputCheck.each(function () {
          $(this).prop('checked', true);
        });
      });

      $('.form-delete').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        deleteResult(form);
      });
    });

    window.addEventListener('DOMContentLoaded', function () {
        let getGroup = localStorage.getItem('group');
        let getSetQuis = localStorage.getItem('setquis');

        if (getGroup) {
          let optionGroup = $('select[name="group"]').find(`option[value="${getGroup}"]`);
          optionGroup.prop('selected', true);

          let arrOptionGroup = optionGroup.val().split(',');
          table.column(2).search('^' + arrOptionGroup[0] + '$', true, false).draw();
        }

        if (getSetQuis) {
          let optionSetQuis = $('select[name="setquis"]').find(`option[value="${getSetQuis}"]`);
          optionSetQuis.prop('selected', true);

          let arrOptionSetquis = optionSetQuis.val().split(',');
          table.column(3).search(arrOptionSetquis[0]).draw();
        }
    });
  </script>
</body>
</html>
