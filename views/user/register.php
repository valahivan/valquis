<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Val Quis | Register Page</title>
    <?php include_once 'partial/link-user-style.php' ?>
</head>
<body>
   <div class="container-fluid py-3 px-0">
    <header class="card-title col-lg-10 col-11 border-top border-success bg-white border-5 rounded mb-3 shadow">
        <div class="title-info p-3">
            <div class="title-group d-flex justify-content-between pb-2 align-items-center">
                <h5 class="brand text-utama fw-semibold mb-0"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h5>
                <h6 class="text-utama d-lg-block d-none"><i class="fas fa-pager"></i> Halaman | Registrasi</h6>
            </div>
            <h2>Selamat datang di Halaman Registrasi</h2>
            <p>Silahkan masukkan data diri anda!</p>
            <ul class="p-0 d-flex justify-content-start gap-4 m-0" type="none">
                <li class="nav-item small"><a href="login-page" class="nav-link"><i class="bi bi-person"></i> Login User</a></li>
                <li class="nav-item small"><a href="register-page" class="nav-link <?= $_SERVER['PATH_INFO'] == '/register-page' ? 'text-utama' : '' ?>"><i class="bi bi-person-add"></i> Register</a></li>
                <li class="nav-item small"><a href="admin/login-admin-page" class="nav-link"><i class="bi bi-person-badge"></i> Login Admin</a></li>
            </ul>
        </div>
        <?php include_once 'partial/footer.php' ?>
    </header>
    <div class="card-form bg-white shadow col-lg-10 col-11 rounded">
        <header class="mt-4 mb-0">
            <h4 class="title px-3 fw-bold">Register User</h4>
        </header>
        <form action="register" method="post" class="register-form p-3">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-2">
                        <label for="nama" class="form-label text-secondary fw-medium small">Nama Lengkap</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm err-border-nama" name="nama" id="nama"
                                placeholder="Nama Lengkap" autocomplete="off">
                            <span class="input-group-text bg-white err-border-nama"><i class="fas fa-lock"></i></span>
                        </div>
                        <small class="err-nama text-danger m-0"></small>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="form-label text-secondary fw-medium small">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm err-border-username" name="username" id="username"
                                placeholder="Create Username" autocomplete="off">
                            <span class="input-group-text bg-white err-border-username"><i class="fas fa-user"></i></span>
                        </div>
                        <small class="err-username text-danger m-0"></small>
                    </div>
                    <div class="mb-2">
                        <label for="group_id" class="form-label text-secondary fw-medium small">Pilih Group</label>
                        <div class="input-group">
                            <select name="group_id" id="group_id" class="form-select form-select-sm err-border-group">
                                <option value="" selected>Pilih Group</option>
                                <?php while ($row = mysqli_fetch_assoc($group)) : ?>
                                    <option value="<?= $row['id_group'] ?>"><?= $row['nama'] ?></option>
                                <?php endwhile ?>
                            </select>
                            <span class="input-group-text bg-white err-border-group"><i class="fas fa-users"></i></span>
                        </div>
                        <small class="err-group text-danger m-0"></small>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-2">
                        <label for="email" class="form-label text-secondary fw-medium small">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control form-control-sm" name="email" id="email"
                                placeholder="Create Email (Opsional)" autocomplete="off">
                            <span class="input-group-text bg-white"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label text-secondary fw-medium small">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm err-border-password" name="password" id="password"
                                placeholder="Create Password" autocomplete="off">
                            <span class="input-group-text bg-white err-border-password"><i class="fas fa-lock"></i></span>
                        </div>
                        <small class="err-password text-danger m-0"></small>
                    </div>
                </div>
            </div>
            <div class="form-check my-3">
                <input type="checkbox" class="form-check-input" id="check-password">
                <label for="check-password" class="form-check-label small">Show Password</label>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100 mt-3"><i class="fas fa-registered"></i> Register Now</button>
        </form>
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

    <?php include_once 'partial/main-footer.php' ?>
    <?php include_once 'partial/link-user-script.php' ?>

    <script>
       const nama= $('#nama');
       const username = $('#username');
       const group = $('#group');
       const password = $('#password');
       const checkPassword = $('#check-password');

       const errNama = $('.err-nama');
       const errUsername = $('.err-username');
       const errGroup = $('.err-group');
       const errPassword = $('.err-password');

       const errBorderNama = $('.err-border-nama');
       const errBorderUsername = $('.err-border-username');
       const errBorderGroup = $('.err-border-group');
       const errBorderPassword = $('.err-border-password');

        function clockDigital() {
            setInterval(function () {
            let currentTime = new Date();

            let hours = currentTime.getHours();
            let minutes = currentTime.getMinutes();
            let seconds = currentTime.getSeconds();

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

                $('#clock-digital').html(`<small><i class="bi bi-clock"></i> Pukul ${hours}:${minutes}:${seconds}</small>`);
            }, 1000);
        }

        function refreshForm() {
            nama.val('');
            username.val('');
            group.val('');
            password.val('');
            password.attr('type', 'password');
            checkPassword.prop('checked', false);

            errUsername.html(``);
            errGroup.html(``);
            errPassword.html(``);

            errBorderUsername.addClass('border-safe').removeClass('border-danger');
            errBorderGroup.addClass('border-safe').removeClass('border-danger');
            errBorderPassword.addClass('border-safe').removeClass('border-danger');
            errBorderNama.addClass('border-safe').removeClass('border-danger');
        }

        function showPassword() {
            if (password.attr('type') === 'password') {
                password.attr('type', 'text');
            } else {
                password.attr('type', 'password');
            }
        }

        function errCharacterPassword() {
            if (password.val().length < 8) {
                errPassword.html(`<i class="fas fa-warning"></i> Panjang password minimal & karakter!`);
                errBorderPassword.addClass('border-danger').removeClass('border-safe');
            } else {
                errPassword.html(``);
                errBorderPassword.addClass('border-safe').removeClass('border-danger');
            }
        }

        function errorMessage(object) {
            if (object.errors.nama) {
                errNama.html(`<i class="fas fa-warning"></i> ${object.errors.nama}`);
                errBorderNama.addClass('border-danger').removeClass('border-safe');
            } else {
                errNama.html(``);
                errBorderNama.addClass('border-safe').removeClass('border-danger');
            }
            if (object.errors.username) {
                errUsername.html(`<i class="fas fa-warning"></i> ${object.errors.username}`);
                errBorderUsername.addClass('border-danger').removeClass('border-safe');
            } else {
                errUsername.html(``);
                errBorderUsername.addClass('border-safe').removeClass('border-danger');
            }
            if (object.errors.group_id) {
                errGroup.html(`<i class="fas fa-warning"></i> ${object.errors.group_id}`);
                errBorderGroup.addClass('border-danger').removeClass('border-safe');
            } else {
                errGroup.html(``);
                errBorderGroup.addClass('border-safe').removeClass('border-danger');
            }
            if (object.errors.password) {
                errPassword.html(`<i class="fas fa-warning"></i> ${object.errors.password}`);
                errBorderPassword.addClass('border-danger').removeClass('border-safe');
            } else {
                errPassword.html(``);
                errBorderPassword.addClass('border-safe').removeClass('border-danger');
            }
            $('.modal-loading').modal('hide');
        }

        function register(element) {
            $('.modal-loading').modal('show');
            $.ajax({
                type: element.attr('method'),
                url: element.attr('action'),
                data: element.serialize(),
                success: function(response) {
                    var object = $.parseJSON(response);
                    if (object.status == 0) {
                        errorMessage(object);
                        nama.focus();
                    } else if (object.status == 1) {
                        Swal.fire({
                            title: 'Success !!!',
                            text: object.success,
                            icon: 'success'
                        });
                        refreshForm();
                        $('.modal-loading').modal('hide');
                    }
                }
            });
        }

        $(document).ready(function() {
            clockDigital();
            checkPassword.click(() => showPassword());
            password.keyup(() => errCharacterPassword());
        
            $('.register-form').submit(function(e) {
                e.preventDefault();
                register($(this));
            });
        });
    </script>
</body>
</html>