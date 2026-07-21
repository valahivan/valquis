<?php
namespace ValahIvanMaulana\App\Controller\user;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Hasil;
use ValahIvanMaulana\App\Model\Jawaban;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\App\Model\Soal;
use ValahIvanMaulana\App\Model\User;
use ValahIvanMaulana\Core\Controller;

class StartQuizController extends Controller {
    public function startQuisPage(array $params) {
        AuthMiddleware::handle('id_user', 'login-page');

        $id_topik = $params['id_topik'];
        $id_user = $params['id_user'];
        $waktu = $params['waktu'];
        $nilai_plus = $params['nilai_plus'];
        $nilai_minus = $params['nilai_minus'];
        $acak_soal = $params['acak_soal'];
        $acak_jawaban = $params['acak_jawaban'];

        $dataSetquis = new SetQuis();
        $dataHasil = new Hasil();
        $dataUser = new User();
        
        $id_setquis = $dataSetquis->where('topik_id', '=', $id_topik)->pluck('id_setquis');
        $nama_quis = $dataSetquis->where('topik_id', '=', $id_topik)->pluck('nama');
        $group_id = $dataUser->where('id_user', '=', $id_user)->pluck('group_id');
        
        $resHasil = $dataHasil->where('setquis_id', '=', $id_setquis)
                              ->where('user_id', '=', $id_user)->get();
        if ($dataHasil->numRows($resHasil) <= 0) {
            $dataHasil->insertData([
                'setquis_id' => $id_setquis,
                'group_id' => $group_id,
                'user_id' => $id_user
            ]);
        };

        $status = isset($_SESSION['status']) ? $_SESSION['status'] : 'sedang';
        if ($status == 'sedang') {
            $dataHasil->where('setquis_id', '=', $id_setquis)
                      ->where('user_id', '=', $id_user)
                      ->updateData(['status' => 'sedang']);
        }elseif ($status == 'selesai') {
            unset($_SESSION['status']);
            $dataHasil->where('setquis_id', '=', $id_setquis)
                      ->where('user_id', '=', $id_user)
                      ->updateData(['nilai' => 0, 'status' => 'sedang']);
        }

        return $this->view('user.mulai-quis', [
            'id_user' => $id_user,
            'id_topik' => $id_topik,
            'id_setquis' => $id_setquis,
            'waktu' => $waktu,
            'nilai_plus' => $nilai_plus,
            'nilai_minus' => $nilai_minus,
            'acak_soal' => $acak_soal,
            'acak_jawaban' => $acak_jawaban,
            'nama_quis' => $nama_quis
        ]);
    }

    public function startQuis(array $params) {
        AuthMiddleware::handle('id_user', 'login-page');

        $id_topik = $params['id_topik'];
        $id_setquis = $params['id_setquis'];
        $id_user = $params['id_user'];
        $acak_soal = $params['acak_soal'];
        $acak_jawaban = $params['acak_jawaban'];
        $point = $params['nilai_plus'];

        $dataSoal = new Soal();
        $resSoal = $dataSoal->select(['val_soal.*', 'val_jawaban.*'])
        ->innerJoin(['val_jawaban ON val_soal.id_soal = val_jawaban.soal_id'])
        ->where('val_soal.topik_id', '=', $id_topik)
        ->get();

        $soals = [];
        while ($row = $dataSoal->fetchAssoc($resSoal)) {
            $soals[$row['soal']][] = $row;
        }

        if ($acak_soal == 1) {
            $keys = array_keys($soals);
            shuffle($keys);
            $soal_acak = [];
            foreach ($keys as $k) {
                $soal_acak[$k] = $soals[$k];
            }
            $soals = $soal_acak;
        }

        $count = 1;
        $listQuis = "";
        foreach ($soals as $soal => $items) {
            $listQuis .= 
            "<form action=' method='post' class='form-soal bg-white mt-3 rounded border-utama'>
                <header class='card-header py-2 px-4 border-bottom d-flex justify-content-between align-items-center'>
                    <span class='text-utama fw-medium'>Soal Nomor ke $count</span>
                    <small>Point $point</small>
                </header>
                <div class='form-group p-4'>
                    <p class='my-0 soal'>$soal</p>";
                    $huruf = ["A", "B", "C", "D", "E"];
                    $index = 0;
                        
                    if ($acak_jawaban == 1)shuffle($items);
                    foreach ($items as $item) {
                        $soal_id = $item['id_soal'];
                        $jawaban_id = $item['id_jawaban'];
                        $noSoal = $item['no_soal'];
                        $pilihan = str_replace(['<p>', '</p>'], ['', ''], $item['pilihan']);

                        $listQuis .= "
                        <div class='form-check mb-2'>
                            <input type='radio' name='$noSoal' id='$jawaban_id' class='form-check-input' value='$pilihan' onchange='checkOption($id_setquis, $id_user, $soal_id, ".htmlspecialchars(json_encode($item['pilihan'])).")'> <label for='$jawaban_id' style='cursor: pointer;'>$huruf[$index]. $pilihan</label>
                        </div>";
                        $index++;
                    }
                    $listQuis .= "
                </div>
            </form>
            ";
            $count++;
        }
        echo $listQuis;
    }

    public function updateTime(array $params) {
        $id_setquis = $params['id_setquis'];
        $id_user = $params['id_user'];
        $waktu = $params['waktu'];

        $dataHasil = new Hasil();
        $dataHasil->where('setquis_id', '=', $id_setquis)
                  ->where('user_id', '=', $id_user)
                  ->updateData(['waktu_berjalan' => "Berjalan $waktu menit"]);
    }

    public function checkOption(array $requests) {
        AuthMiddleware::handle('id_user', 'login-page');

        $id_setquis = $requests['id_setquis'];
        $id_user = $requests['id_user'];
        $id_soal = $requests['id_soal'];
        $pilihan = $requests['pilihan'];
        $nilai_plus = $requests['nilai_plus'];
        $nilai_minus = $requests['nilai_minus'];
        
        $dataJawaban = new Jawaban();
        $dataHasil = new Hasil();

        $resJawaban = $dataJawaban->where('soal_id', '=',$id_soal)
                                  ->where('pilihan', '=', $pilihan)
                                  ->get();
        
        $nilai = $dataHasil->where('setquis_id', '=', $id_setquis)
                           ->where('user_id', '=', $id_user)
                           ->pluck('nilai');
        $score = $_SESSION['score'] ?? $nilai;

        while ($row = $dataJawaban->fetchAssoc($resJawaban)) {
            if ($dataJawaban->numRows($resJawaban) > 0) {
               if ($row['pilihan_benar'] == 1) {
                    $score+=$nilai_plus;
                    $_SESSION['score'] = $score;
               } else {
                    $score-=trim($nilai_minus, '-');
                    $score = $score < 0 ? 0 : $score;
                    $_SESSION['score'] = $score;
            }
        }
        
        $score = $_SESSION['score'];
        $dataHasil->where('setquis_id', '=', $id_setquis)
            ->where('user_id', '=', $id_user)
            ->updateData(['nilai' => $score]);
        }

        $this->status['status'] = 1;
        echo json_encode($this->status);
    }

    public function stopQuis(array $requests) {
        AuthMiddleware::handle('id_user', 'login-page');

        $id_setquis = $requests['id_setquis'];
        $id_user = $requests['id_user'];

        $dataHasil = new Hasil();
        $status = $dataHasil->where('user_id', '=', $id_user)->pluck('status');

        $dataHasil->where('setquis_id', '=', $id_setquis)
                  ->where('user_id', '=', $id_user)
                  ->updateData(['status' => 'selesai']);

        $_SESSION['score'] = 0;
        $_SESSION['status'] = $status;

        $this->status['status'] = 1;
        $this->status['session'] = $_SESSION['status'];

        echo json_encode($this->status);
    }
}