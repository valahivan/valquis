<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Val Quis | Daftar Quis</title>
    <?php include_once 'partial/link-user-style.php' ?>
</head>
<body>
    <div class="container-fluid py-3">
        <header class="card-title col-lg-10 col-11 border-top border-success bg-white border-5 rounded mb-3 shadow">
            <div class="title-info p-3">
                <div class="title-group d-flex justify-content-between pb-2 align-items-center">
                    <h5 class="brand text-utama fw-semibold mb-0"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h5>
                    <div class="profile d-flex justify-content-start gap-2 align-items-center d-lg-block d-none">
                        <img src="<?= BASE_URL ?>public/assets/img/profil-kosong.png" alt="Profile" class="img-fluid rounded-circle" width="28px" height="28px">
                        <span class="title d-inline-block"><?= $nama ?></span>
                    </div>
                </div>
                <h2>Selamat Datang di Daftar Quis, <?= $nama ?> <?= $group ?></h2>
                <p>Silahkan pilih quis yang ingin dikerjakan. Jika quis tidak muncul silahkan hubungi admin atau operator</p>
            </div>
            <footer class="py-2 px-3 border-top d-flex justify-content-between flex-wrap gap-2">
                <small><i class="bi bi-person-fill"></i> <?= $nama ?></small>
                <span id="clock-digital"></span>
            </footer>
        </header>
        <div class="list-quis bg-white p-3 col-lg-10 col-11 shadow rounded">
            <header class="card-header">
                <h5>Daftar Quis</h5>
            </header>
            <div class="py-2 d-flex justify-content-between">
                <form action="logout" method="post" class="form-logout">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right-from-bracket"></i> Logout</button>
                </form>
                <input type="search" class="form-control form-control-sm w-auto" id="search" placeholder="Search" oninput="loadDaftarQuis()">
            </div>
            <div class="table-responsive">
            <table class="table table-sm table-bordered" id="listQuis">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama Quis</th>
                        <th class="text-center align-middle">Waktu Mulai</th>
                        <th class="text-center align-middle">Waktu Akhir</th>
                        <th class="text-center align-middle">Nilai Akhir</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody id="daftar-quis"></tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="modal modal-lg modal-token" tabindex="-1" id="modal-token" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-5 fw-semibold">Konfirmasi Quis</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="check-token" method="post" class="form-confirm">
                    <input type="hidden" name="id_topik">
                    <input type="hidden" name="id_setquis">
                    <input type="hidden" name="id_user">
                    <input type="hidden" name="waktu">
                    <input type="hidden" name="nilai_plus">
                    <input type="hidden" name="nilai_minus">
                    <input type="hidden" name="acak_soal">
                    <input type="hidden" name="acak_jawaban">
                    <div class="modal-body px-0 px-2">
                        <table class="table table-striped">
                            <tr>
                                <td class="fw-semibold text-dark align-middle">Nama Quis</td>
                                <td>:</td>
                                <td id="nama-quis"></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark align-middle">Waktu</td>
                                <td>:</td>
                                <td id="waktu"></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark align-middle">Nilai Plus</td>
                                <td>:</td>
                                <td id="nilai-plus"></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark align-middle">Nilai Minus</td>
                                <td>:</td>
                                <td id="nilai-minus"></td>
                            </tr>
                            <tr class="input-token d-none">
                                <td class="fw-semibold text-dark align-middle"><label for="nama_token">Isi Token</label></td>
                                <td>:</td>
                                <td>
                                    <input type="text" id="nama_token" name="nama_token" class="form-control form-control-sm"placeholder="Masukkan Kode Token" autocomplete="off">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                        <div class="action-btn"></div>
                    </div>
                </form>
            </div>
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

        function loadDaftarQuis() {
            $.get("list-quis", {keyword: $('#search').val(), group: "<?= $group ?>"}, function (result) {
                if (result == '') {
                    let rowKosong = `<tr><td class="align-middle text-center" colspan="7">Belum ada quis untuk <?= $group ?></td></tr>`;
                    $('#daftar-quis').html(rowKosong);
                } else {
                    $('#daftar-quis').html(result);
                }

                const buttons = $('button[type="button"]');
                buttons.each(function () {
                    let button = $(this);
                    if (button.val() == 'belum') $(`button[name="${button.attr('name')}"][value="${button.val()}"]`).text('Mulai').addClass('btn-primary').attr('name');
                    if (button.val() == 'sedang') $(`button[name="${button.attr('name')}"][value="${button.val()}"]`).text('Lanjutkan').addClass('btn-light').attr('name');
                    if (button.val() == 'selesai') $(`button[name="${button.attr('name')}"][value="${button.val()}"]`).text('Selesai').addClass('btn-light').prop('disabled', true).attr('name');
                });
            });
        }

        function enterToken(form, id_setquis, id_topik, id_user, waktu, nilai_plus, nilai_minus, acak_soal, acak_jawaban, token) {
            $('.modal-loading').modal('show');
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: {nama_token: token, setquis_id: id_setquis},
                success: function (response) {
                    var object = $.parseJSON(response);
                    if (object.errors.nama_token) {
                        Swal.fire({
                            title: "Oops !!!",
                            text: object.errors.nama_token,
                            icon: "error"
                        });
                        $('.modal-loading').modal('hide');
                    } else {
                        window.location.href = `start-quis-page?id_topik=${id_topik}&id_user=${id_user}&waktu=${waktu}&nilai_plus=${nilai_plus}&nilai_minus=${nilai_minus}&acak_soal=${acak_soal}&acak_jawaban=${acak_jawaban}`;
                    }
                }
            });
        }

        function mulaiQuis(id_setquis, nama, id_topik, id_user, waktu, nilai_plus, nilai_minus, acak_soal, acak_jawaban, token, $status) {
            $('.modal-loading').modal('show');

            const btnSubmit = $('.btn-submit');
            const btnNext = $('.btn-next');
            if ($status == 'sedang' || $status == 'selesai') {
                window.location.href = `start-quis-page?id_topik=${id_topik}&id_user=${id_user}&waktu=${waktu}&nilai_plus=${nilai_plus}&nilai_minus=${nilai_minus}&acak_soal=${acak_soal}&acak_jawaban=${acak_jawaban}`;
            } else {
                $('.modal-token').modal('show');

                $('.modal-token form input[name="id_setquis"]').val(id_setquis);
                $('.modal-token form input[name="id_topik"]').val(id_topik);
                $('.modal-token form input[name="id_user"]').val(id_user);
                $('.modal-token form input[name="acak_soal"]').val(acak_soal);
                $('.modal-token form input[name="acak_jawaban"]').val(acak_jawaban);

                $('.modal-token table tr #nama-quis').text(nama);
                $('.modal-token form input[name="waktu"], .modal-token table tr #waktu').val(waktu).text(waktu);
                $('.modal-token form input[name="nilai_plus"], .modal-token table tr #nilai-plus').val(nilai_plus).text(nilai_plus + " Poin");
                $('.modal-token form input[name="nilai_minus"], .modal-token table tr #nilai-minus').val(nilai_minus).text(nilai_minus + " Poin");

                let btnNext = `<a href="start-quis-page?id_topik=${id_topik}&id_user=${id_user}&waktu=${waktu}&nilai_plus=${nilai_plus}&nilai_minus=${nilai_minus}&acak_soal=${acak_soal}&acak_jawaban=${acak_jawaban}" class="btn btn-sm btn-primary">Lanjutkan</a>`;
                let btnSubmit = `<button type="submit" class="btn btn-sm btn-primary">Lanjutkan</button>`;
                
                $('.action-btn').html(btnNext);
                if (token == 1) {
                    $('.action-btn').html(btnSubmit);
                    $('.modal-token form .modal-body table .input-token').removeClass('d-none');
                }
                
                $('.modal-loading').modal('hide');
            }
        }

        function logout(element) {
            $('.modal-loading').modal('show');
            $.ajax({
                type: element.attr('method'),
                url: element.attr('action'),
                success: function (response) {
                    var object = $.parseJSON(response);
                    if (object.status == 1) window.location.href = 'login-page';
                }
            });
        }

        $(document).ready(function () {
            clockDigital();
            loadDaftarQuis();

            $('.form-logout').submit(function (e) {
                e.preventDefault();
                logout($(this));
            });

            $('.form-confirm').submit(function (e) {
                e.preventDefault();

                let id_setquis = $('input[name="id_setquis"]').val();
                let id_topik = $('input[name="id_topik"]').val();
                let id_user = $('input[name="id_user"]').val();
                let waktu = $('input[name="waktu"]').val();
                let nilai_plus = $('input[name="nilai_plus"]').val();
                let nilai_minus = $('input[name="nilai_minus"]').val();
                let acak_soal = $('input[name="acak_soal"]').val();
                let acak_jawaban = $('input[name="acak_jawaban"]').val();
                let token = $('input[name="nama_token"]').val();
                
                enterToken($(this), id_setquis, id_topik, id_user, waktu, nilai_plus, nilai_minus, acak_soal, acak_jawaban, token);
            });

            if ("<?= $nama ?>" == "") return logout($('.form-logout'));
        });
    </script>
</body>
</html>