<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Quis</title>
</head>
<style>
*{
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;
    font-size: 1rem;
    margin: 0;
    padding: 0;
}
.container{
    width: 90%;
    padding-right: 7.5px;
    padding-left: 7.5px;
    margin-left: auto;
    margin-right: auto;
}
.ml-3,
.my-3 {
  margin-top: 1rem !important;
  margin-bottom: 1rem !important;
}
.mt-5,
.my-5 {
  margin-top: 3rem !important;
  margin-bottom: 3rem !important;
}
.text-utama{
    color: #3bb143;
    text-decoration: none;
}
.text-center{
    text-align: center;
}
.font-weight-bold{
    font-weight: bold;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  background-color: transparent;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 0.4rem;
  vertical-align: top;
  border-top: 1px solid #838585;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #838585;
  background-color: #3bb143;
  color: #ffffff;
}

.table tbody + tbody {
  border-top: 2px solid #838585;
}

.table-sm th,
.table-sm td {
  padding: 0.4rem;
}

.table-bordered {
  border: 1px solid #838585;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #838585;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 1px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
  border: 0;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(5, 243, 40, 0.05);
}

.table-hover tbody tr:hover {
  color: #212529;
  background-color: rgba(0, 0, 0, 0.075);
}

@media (max-width: 575.98px) {
  .table-responsive-sm {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table-responsive-sm > .table-bordered {
    border: 0;
  }
}

@media (max-width: 767.98px) {
  .table-responsive-md {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table-responsive-md > .table-bordered {
    border: 0;
  }
}

@media (max-width: 991.98px) {
  .table-responsive-lg {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table-responsive-lg > .table-bordered {
    border: 0;
  }
}

@media (max-width: 1199.98px) {
  .table-responsive-xl {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table-responsive-xl > .table-bordered {
    border: 0;
  }
}

.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.table-responsive > .table-bordered {
  border: 0;
}
</style>
<body>
    <div class="container my-5">
        <p class="text-center my-3 font-weight-normal">Berikut inilah daftar hasil Quis <?= $nama_quis ?> <?= $nama_group ?></p>
        <table class="table table-sm table-bordered" cellspacing='0'>
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Nama Lengkap</th>
                    <th class="text-center align-middle">Group</th>
                    <th class="text-center align-middle">Quis Yang di Kerjakan</th>
                    <th class="text-center align-middle">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($hasil_quis)) : ?>
                    <tr>
                        <td class="text-center align-middle"><?= $count ?></td>
                        <td class="align-middle"><?= $row['nama_user'] ?></td>
                        <td class="text-center align-middle"><?= $row['nama_group'] ?></td>
                        <td class="align-middle"><?= $row['nama_quis'] ?></td>
                        <td class="text-center align-middle"><?= $row['nilai'] ?></td>
                    </tr>
                    <?php $count++; ?>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>