<?php 

namespace ValahIvanMaulana\App\Controller\user;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\Core\Controller;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\App\Model\Token;
use ValahIvanMaulana\App\Model\User;

class QuizController extends Controller {
    public function listQuisPage() {
        AuthMiddleware::handle('id_user', 'login-page');
        
        $user = new User();
        $result = $user->select(['val_users.nama AS nama_user', 'val_group.nama AS nama_group'])
        ->innerJoin(['val_group ON val_users.group_id = val_group.id_group'])
        ->where('val_users.id_user', '=', $_SESSION['id_user'])->get();
        $row = $user->fetchAssoc($result);
        
        return $this->view('user.daftar-quis', [
            'nama' => $row['nama_user'] ?? null,
            'group' => $row['nama_group'] ?? null
        ]);
    }

    public function listQuis(array $params) {
        AuthMiddleware::handle('id_user', 'login-page');

        $id_user = $_SESSION['id_user'];
        $quisData = new SetQuis();
        $resQuis = $quisData->filters($quisData, $params['keyword'], $params['group'], $id_user)->get();
        
        $listQuis = "";
        $count = 1;
        while ($row = $quisData->fetchAssoc($resQuis)) {
            $nama = $row['nama'];
            $id_topik = $row['topik_id'];
            $id_setquis = $row['id_setquis'];
            $created_at = $row['created_at'];
            $waktu = $row['waktu'];
            $nilai_plus = $row['nilai_plus'];
            $nilai_minus = $row['nilai_minus'];
            $acak_soal = $row['acak_soal'];
            $acak_jawaban = $row['acak_jawaban'];
            $token = $row['token'];
           
            $status = $row['status'] == NULL ? 'belum' : $row['status'];
            $nilai = $row['nilai'] == NULL || $row['status'] == 'sedang' ? '-' : $row['nilai'];
            $listQuis .= "
                        <tr>
                            <td class='align-middle text-center'>$count</td>
                            <td class='align-middle'>$nama</td>
                            <td class='align-middle text-center'>$waktu menit</td>
                            <td class='align-middle text-center'>$nilai</td>
                            <td class='align-middle text-center'>$created_at</td>
                            <td class='align-middle text-center'>
                                <button type='button' name='$nama' value='$status' class='btn btn-sm' onclick='mulaiQuis(\"$id_setquis\",\"$nama\", \"$id_topik\", \"$id_user\", \"$waktu\", \"$nilai_plus\", \"$nilai_minus\", \"$acak_soal\", \"$acak_jawaban\", \"$token\", \"$status\")'></button>
                            </td>
                        </tr>
                        ";
            $count++;
        }
        echo $listQuis;
    }

    public function checkToken(array $requests) {
        AuthMiddleware::handle('id_user', 'login-page');
        
        $nama_token = $this->onlyCharsAndTrim($requests['nama_token']);
        $setquis_id = $this->onlyCharsAndTrim($requests['setquis_id']);

        $this->setRulesValidate($requests, 'val_token', [
            'nama_token' => 'required',
        ], ['nama_token' => ['required' => 'Token harap diisi!']]);
        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $dataToken = new Token();
            $result = $dataToken->where('setquis_id', '=', $setquis_id)
                ->where('nama_token', '=', $nama_token)
                ->get();
            $row = $dataToken->fetchAssoc($result);
            $tokenValid = $dataToken->numRows($result) > 0 ? $row['nama_token'] : "";

            if ($tokenValid !== "") {
                $this->status['status'] = 1;
            } else {
                $this->status['errors']['nama_token'] = "Token tidak valid!";
            }
        }

        
        echo json_encode($this->status);
    }
}