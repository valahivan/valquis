<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Val Quis | Start Quis</title>
    <?php include_once 'partial/link-user-style.php' ?>
</head>
<body>
    <input type="hidden" name="id_topik" value="<?= $id_topik ?>">
    <input type="hidden" name="id_setquis" value="<?= $id_setquis ?>">
    <input type="hidden" name="id_user" value="<?= $id_user ?>">
    <input type="hidden" name="waktu" value="<?= $waktu ?>">
    <input type="hidden" name="nilai_plus" value="<?= $nilai_plus ?>">
    <input type="hidden" name="nilai_minus" value="<?= $nilai_minus ?>">
    <input type="hidden" name="acak_soal" value="<?= $acak_soal ?>">
    <input type="hidden" name="acak_jawaban" value="<?= $acak_jawaban ?>">

    <div class="container-fluid py-3">
        <header class="card-title col-lg-10 col-11 border-top border-success bg-white border-5 rounded shadow">
            <div class="title-info p-3">
                <div class="title-group d-flex justify-content-between pb-2 align-items-center">
                    <h5 class="brand text-utama fw-semibold mb-0"><i class="bi bi-layers-fill"></i> VALQUIS <span class="text-dark">CBT</span></h5>
                    <span class="title d-lg-block d-none"><?= $nama_quis ?></span>
                </div>
                <h2>Selamat Mengerjakan, <?= $nama_quis ?></h2>
                <p>Ini adalah daftar soal <?= $nama_quis ?></p>
            </div>
            <footer class="py-2 px-3 border-top">
                <small><span id="timer"></span></small>
            </footer>
        </header>
        <div class="card-form-quis col-lg-10 col-11"></div>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-stop" id="btn-stop">Hentikan Quis</button>
    </div>

    <div class="modal modal-timer">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body d-flex justify-content-center">
                    <div class="clock position-relative">
                        <span class="jarum position-absolute top-50 start-50"></span>
                        <span class="bundar position-absolute top-50 start-50 translate-middle"></span>
                        <h1 class="countdown">0</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-lg modal-stop" tabindex="-1" id="modal-stop" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Hentikan Quis</h4>
              <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mt-2">Apakah Kamu yakin akan menghentikan quis ini? Silahkan periksa lagi soal sebelum dihentikan!</p>
              <div class="alert alert-info">
                <span id="checked" class="d-block"></span>
                <span id="not-checked" class="d-block"></span>
              </div>
              <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="check-stop">
                <label for="stop" class="form-check-label">Hentikan Quis</label>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-sm btn-primary" onclick="stopQuis(<?= $id_setquis ?>, <?= $id_user ?>)">Hentikan</button>
            </div>
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
        const idTopik = $('input[name="id_topik"]');
        const idUser = $('input[name="id_user"]');
        const idSetQuis = $('input[name="id_setquis"]');
        const waktu = $('input[name="waktu"]');
        const nilaiPlus = $('input[name="nilai_plus"]');
        const nilaiMinus = $('input[name="nilai_minus"]');
        const acakSoal = $('input[name="acak_soal"]');
        const acakJawaban = $('input[name="acak_jawaban"]');
        const checkStop = $('input[type="checkbox"][id="check-stop"]');

        let menit = parseInt(waktu.val());
        let detik = menit * 60;
        let interval;
        function countDownTimer() {
            interval = setInterval(function () {
                let menitBerjalan = Math.floor(detik / 60) ;
                let sisaDetik = detik % 60;
                $.get("update-time", {id_setquis: idSetQuis.val(), id_user: idUser.val(), waktu: menitBerjalan}, (respone) => respone);

                localStorage.setItem(`detik${idSetQuis.val()}${idUser.val()}`, detik);

                menitBerjalan = menitBerjalan < 10 ? "0" + menitBerjalan : menitBerjalan;
                sisaDetik = sisaDetik < 10 ? "0" + sisaDetik : sisaDetik;

                $('#timer').html(`<i class="bi bi-clock"></i> Sisa Waktu : ${menitBerjalan} menit : ${sisaDetik} detik`);

                if (detik <= 9) {
                    $('.modal-timer').modal('show');
                    $('.countdown').removeClass('pop').html(detik);
                    $('.countdown')[0].offsetWidth;
                    $('.countdown').addClass('pop').html(detik);
                }

                if (detik <= 0) {
                    checkStop.prop('checked', true);
                    stopQuis(idSetQuis.val(), idUser.val());
                    
                    localStorage.clear();
                    return clearInterval(interval);
                }
                detik--;
            }, 1000);
        }

        function loadStartQuis() {
            let ambilDetik = localStorage.getItem(`detik${idSetQuis.val()}${idUser.val()}`);
            if (ambilDetik) detik = ambilDetik;

            $.get("start-quis", {
                id_topik: idTopik.val(),
                id_setquis: idSetQuis.val(),
                id_user: idUser.val(),
                nilai_plus: nilaiPlus.val(),
                acak_soal: acakSoal.val(),
                acak_jawaban: acakJawaban.val()
            }, function (respone) {
                $('.card-form-quis').append(respone);
                const options = $('input[type="radio"]');
                options.each(function () {
                    var pilihanTersimpan = localStorage.getItem($(this).attr('name'));
                    if (pilihanTersimpan) {
                        $(`input[name="${$(this).attr('name')}"][value="${pilihanTersimpan}"]`).prop('checked', true);
                    }
                });
            });
        }

        function checkOption(id_setquis, id_user, id_soal, pilihan) {
            $('.modal-loading').modal('show');
            const options = $('input[type="radio"]');
            options.each(function () {
                if ($(this).prop('checked') == true) {
                    localStorage.setItem($(this).attr('name'), $(this).attr('value'));
                }
            });
            $.ajax({
                type: "POST",
                url: "check-option",
                data: {
                    id_setquis: idSetQuis.val(),
                    id_user: id_user,
                    id_soal: id_soal,
                    pilihan: pilihan,
                    nilai_plus: nilaiPlus.val(),
                    nilai_minus: nilaiMinus.val()
                },
                success: function (response) {
                    var object = $.parseJSON(response);
                    if(object.status == 1) {
                        $('.modal-loading').modal('hide');
                    }
                }
            });
        }

        function stopQuis(id_setquis, id_user) {
            $('.modal-loading').modal('show');
            if (checkStop.prop('checked') == false) {
                Swal.fire({
                    title: "Oops !!",
                    text: "Silahkan centang hentikan quis!",
                    icon: "warning"
                });
                $('.modal-loading').modal('hide');
                return;
            }

            $.post("stop-quis", {id_setquis: id_setquis, id_user: id_user}, function (respone) {
                console.log(respone);
                var object = $.parseJSON(respone);
                if (object.status == 1 && object.session) {
                    localStorage.clear();
                    window.location.href = 'list-quis-page';
                }
            });
        }
    
        $(document).ready(function () {
            loadStartQuis();
            countDownTimer();
            
            $('#btn-stop').click(function () {
                const options = $('input[type="radio"]');
                let radioNotChecked = [];
                let notChecked = 0;

                options.each(function () {
                    let name = $(this).attr('name');
                    if (name && !radioNotChecked.includes(name)) {
                        radioNotChecked.push(name);
                    }
                });

                radioNotChecked.forEach(function (name) {
                    let checked = $(`input[type="radio"]:checked`).length;
                    if ($(`input[name="${name}"]:checked`).length === 0) notChecked++;

                    $('#checked').text(`Soal yang sudah dijawab : ${checked} Soal`);
                    $('#not-checked').text(`Soal yang belum dijawab : ${notChecked} Soal`);
                });
            });
        });
    </script>
</body>
</html>