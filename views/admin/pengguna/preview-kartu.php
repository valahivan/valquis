<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Kartu</title>
    <?php include_once 'views/admin/partial/link-admin-style.php' ?>
</head>
<body class="bg-white">
    <div class="container-fluid p-4">
        <?php if ($num_rows == 0) : ?>
            <div class="col-12 d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
                <h3 class="brand-text font-weight-bold text-utama"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h3>
                <h5>Belum ada data pengguna untuk group <?= $nama_group ?></h5>
            </div>
        <?php else : ?>
        <table class="table table-borderless">
        <tr>
            <?php $index = 0 ?>
            <?php while ($row = mysqli_fetch_assoc($user)) : ?>
                <?php if ($index > 0 && $index % 2 == 0) : ?>
                    <tr></tr>
                <?php endif ?>
                <td class="col-4 py-0">
                    <div class="card card-pengguna shadow-none">
                        <div class="card-header text-center pb-0 border-0">
                            <h3 class="brand-text font-weight-bold text-utama"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h3>
                        </div>
                        <div class="card-body pt-1">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-medium col-4"><i class="fas fa-user"></i> Nama Lengkap</td>
                                    <td class="col-0">:</td>
                                    <td class="col-8"><?= $row['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-medium col-4"><i class="fas fa-user"></i> Username</td>
                                    <td class="col-0">:</td>
                                    <td class="col-8"><?= $row['username'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-medium col-4"><i class="fas fa-key"></i> Password</td>
                                    <td class="col-0">:</td>
                                    <td class="col-8"><?= $row['password'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-medium col-4"><i class="fas fa-envelope"></i> Email</td>
                                    <td class="col-0">:</td>
                                    <td class="col-8"><?= $row['email'] == null ? "Tidak Ada" : $row['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-medium col-4"><i class="fas fa-users"></i> Group</td>
                                    <td class="col-0">:</td>
                                    <td class="col-8"><?= $row['nama_group'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <?php $index ++ ?>
            <?php endwhile ?>
        </tr>
        </table>
        <?php endif ?>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>