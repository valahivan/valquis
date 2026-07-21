<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Val Quis | login Page</title>
    <?php include_once 'partial/link-user-style.php' ?>
</head>
<body>
    <div class="container-fluid py-3">
        <header class="card-title col-lg-10 col-11 border-top border-success bg-white border-5 rounded mb-3">
            <div class="title-info p-3">
                <div class="title-group d-flex justify-content-between pb-2 align-items-center">
                    <h5 class="brand text-utama fw-semibold mb-0"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h5>
                    <h6 class="text-utama d-lg-block d-none"><i class="fas fa-pager"></i> Halaman | Login Admin</h6>
                </div>
                <h2>Selamat datang di Halaman Login Admin</h2>
                <p>Ini adalah halaman login khusus untuk admin</p>
                <ul class="p-0 d-flex justify-content-start gap-4 m-0" type="none">
                    <li class="nav-item small"><a href="../login-page" class="nav-link"><i class="bi bi-person"></i> Login User</a></li>
                    <li class="nav-item small"><a href="../register-page" class="nav-link"><i class="bi bi-person-add"></i> Register</a></li>
                    <li class="nav-item small"><a href="login-admin-page" class="nav-link <?= $_SERVER['PATH_INFO'] == '/admin/login-admin-page' ? 'text-utama' : '' ?>"><i class="bi bi-person-badge"></i> Login Admin</a></li>
                </ul>
            </div>
            <?php include_once 'partial/footer.php' ?>
        </header>
        <div class="card-form-login bg-white shadow col-lg-10 col-11 rounded">
            <header class="mt-4 mb-0">
                <h4 class="title px-3 fw-bold">Login Admin</h4>
            </header>
            <form action="login-admin" method="post" class="login-form p-3">
                <div class="mb-2">
                    <label for="username" class="form-label text-secondary fw-medium small">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm err-border-username" name="username" id="username"
                            placeholder="Username" autocomplete="off">
                        <span class="input-group-text bg-white err-border-username"><i class="fas fa-user"></i></span>
                    </div>
                    <small class="err-username text-danger m-0"></small>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label text-secondary fw-medium small">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-sm err-border-password" name="password" id="password"
                            placeholder="Password" autocomplete="off">
                        <span class="input-group-text bg-white err-border-password"><i class="fas fa-lock"></i></span>
                    </div>
                    <small class="err-password text-danger m-0"></small>
                </div>
                <div class="form-check my-3">
                    <input type="checkbox" class="form-check-input" id="check-password">
                    <label for="check-password" class="form-check-label small">Show Password</label>
                </div>
                <button type="submit" class="btn btn-sm btn-primary w-100"><i class="fas fa-arrow-right-from-bracket"></i> Login Now</button>
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
        var username = $('#username');
        var password = $('#password');
        var checkPassword = $('#check-password');

        var errUsername = $('.err-username');
        var errPassword = $('.err-password');
        var errBorderUsername = $('.err-border-username');
        var errBorderPassword = $('.err-border-password');

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
            username.val('');
            password.val('');
            password.prop('checked', false);

            errUsername.html(``);
            errPassword.html(``);

            errBorderUsername.addClass('border-safe').removeClass('border-danger');
            errBorderPassword.addClass('border-safe').removeClass('border-danger');
        }

        function showPassword() {
            if (password.attr('type') === 'password') {
                password.attr('type', 'text');
            } else {
                password.attr('type', 'password');
            }
        }

        function errorMessage(object) {
            if (object.errors.username) {
                errUsername.html(`<i class="fas fa-warning"></i> ${object.errors.username}`);
                errBorderUsername.addClass('border-danger').removeClass('border-safe');
            } else {
                errUsername.html(``);
                errBorderUsername.addClass('border-safe').removeClass('border-danger');
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
        function login(element) {
            $('.modal-loading').modal('show');
            $.ajax({
                type: element.attr('method'),
                url: element.attr('action'),
                data: element.serialize(),
                success: function(response) {
                    var object = $.parseJSON(response);
                    if (object.status == 0) {
                        errorMessage(object);
                        username.focus();
                    } else if (object.status == 1  && object.id_admin && object.nama_admin) {
                        window.location.href = 'dashboard';
                        $('.modal-loading').modal('hide');
                    }
                }
            });
        }

        $(document).ready(function() {
            clockDigital();
            checkPassword.click(() => showPassword());

            $('.login-form').submit(function(e) {
                e.preventDefault();
                login($(this));
            });
        });
    </script>
</body>
</html>