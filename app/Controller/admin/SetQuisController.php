<?php
namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\App\Model\Topik;
use ValahIvanMaulana\Core\Controller;

class SetQuisController extends Controller {
    public function setQuisPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        return $this->view('admin.setquis.setquis');
    }

    public function listSetQuis() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $set_quis = new SetQuis();
        $result = $set_quis->select(['val_setquis.*', 'val_topik.nama AS nama_topik'])
            ->innerJoin(['val_topik ON val_setquis.topik_id = val_topik.id_topik'])
            ->get();

        $data = [];
        $count = 1;
        while ($row = $set_quis->fetchAssoc($result)) {
            $id_setQuis = $row['id_setquis'];
            $nama = $row['nama'];
            $topik = $row['nama_topik'];
            $groups = $row['groups'];
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            $waktu = $row['waktu'];
            $nilai_plus = $row['nilai_plus'];
            $nilai_minus = $row['nilai_minus'];
            $acak_soal = $row['acak_soal'] == 1 ? "yes" : "No";
            $acak_jawaban = $row['acak_jawaban'] == 1 ? "yes" : "No";
            $created_at = $row['created_at'];
            $token = $row['token'] == 1 ? "Yes" : "No";

            $data[] = [
                'count' => $count,
                'nama' => $nama,
                'topik' => $topik,
                'waktu_mulai' => $start_date,
                'waktu_akhir' => $end_date,
                'groups' => $groups,
                'soal' => "Waktu=$waktu Menit, Nilai Plus=$nilai_plus, Nilai Minus=$nilai_minus, = Acak Soal=$acak_soal, Acak Jawaban=$acak_jawaban",
                'token' => $token,
                'created_at' => $created_at,
                'action' => "<a href='edit-quis-page?id=$id_setQuis' class='btn btn-sm font-weight-bold text-info py-0'><i class='bi bi-pencil-square'></i></a>
                <button type='button' class='btn btn-sm font-weight-bold text-info py-0' onclick='modalDelete(\"$id_setQuis\", \"$nama\")'><i class='bi bi-trash-fill'></i></button>"
            ];
            $count++;
        }

        echo json_encode(["data" => $data]);
    }

    public function addQuisPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = new Topik();
        $group = new Group();
        return $this->view('admin.setquis.tambah-setquis', [
            'topik' => $topik->get(),
            'group' => $group->get()
        ]);
    }

    public function storeQuis(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $topik = $this->onlyCharsAndTrim($requests['topik_id']);
        $waktu = $this->onlyCharsAndTrim($requests['waktu']);
        $nilai_plus = $this->onlyCharsAndTrim($requests['nilai_plus']);
        $nilai_minus = $this->onlyCharsAndTrim($requests['nilai_minus']);

        $this->setRulesValidate($requests, 'val_setquis', [
            'nama' => 'required|unique',
            'topik_id' => 'required',
            'date_range' => 'required',
            'waktu' => 'required',
            'nilai_plus' => 'required',
            'nilai_minus' => 'required'
        ], [
            'nama' => [
                'required' => 'Nama topik tidak boleh kosong!',
                'unique' => 'Nama topik tidak boleh sama!',
            ],
            'topik_id' => ['required' => 'Topik tidak boleh kosong, silahkan pilih dulu!'],
            'date_range' => ['required' => 'Silahkan pilih rentang waktu quis!'],
            'waktu' => ['required' => 'Waktu tidak boleh kosong!'],
            'nilai_plus' => ['required' => 'Nilai plus tidak boleh kosong!'],
            'nilai_minus' => ['required' => 'Nilai minus boleh kosong!'],
        ]);

        
        $date_range = explode(' - ', $requests['date_range']);
        $start_date = $this->onlyCharsAndTrim($date_range[0]);
        $end_date = $this->onlyCharsAndTrim($date_range[1]);

        $groups = !isset($requests['groups']) ? $this->errors['groups'] = "Silahkan Pilih Group Minimal 1" : $requests['groups'];
        if ($this->validated() === TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $set_quis = new SetQuis();
            $acak_soal = $requests['acak_soal'] ?? 0;
            $acak_jawaban = $requests['acak_jawaban'] ?? 0;
            $token = $requests['token'] ?? 0;
            $set_quis->insertData([
                'nama' => $nama,
                'topik_id' => $topik,
                'groups' => implode(', ', $groups),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'waktu' => $waktu,
                'nilai_plus' => $nilai_plus,
                'nilai_minus' => $nilai_minus,
                'acak_soal' => $acak_soal,
                'acak_jawaban' => $acak_jawaban,
                'token' => $token,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Quis berhasil ditambahkan";
        }

        echo json_encode($this->status);
    }

    public function editQuisPage(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $id = $params['id'];
        $set_quis = new SetQuis();
        $topik = new Topik();
        $group = new Group();
        
        return $this->view('admin.setquis.edit-setquis', [
            'setquis' => $set_quis->findOrFails('id_setquis', $id), 
            'topik' => $topik->get(),
            'group' => $group->get(),
        ]);
    }

    public function updateQuis(string $id, array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        
        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $topik = $this->onlyCharsAndTrim($requests['topik_id']);
        $waktu = $this->onlyCharsAndTrim($requests['waktu']);
        $nilai_plus = $this->onlyCharsAndTrim($requests['nilai_plus']);
        $nilai_minus = $this->onlyCharsAndTrim($requests['nilai_minus']);

        $this->setRulesValidate($requests, 'val_setquis', [
            'nama' => 'required',
            'topik_id' => 'required',
            'date_range' => 'required',
            'waktu' => 'required',
            'nilai_plus' => 'required',
            'nilai_minus' => 'required'
        ], [
            'nama' => ['required' => 'Nama topik tidak boleh kosong!'],
            'topik_id' => ['required' => 'Topik tidak boleh kosong, silahkan pilih dulu!'],
            'date_range' => ['required' => 'Silahkan pilih rentang waktu quis!'],
            'waktu' => ['required' => 'Waktu tidak boleh kosong!'],
            'nilai_plus' => ['required' => 'Nilai plus tidak boleh kosong!'],
            'nilai_minus' => ['required' => 'Nilai minus boleh kosong!'],
        ]);

        $date_range = explode(' - ', $requests['date_range']);
        $start_date = $this->onlyCharsAndTrim($date_range[0]);
        $end_date = $this->onlyCharsAndTrim($date_range[1]);

        $groups = !isset($requests['groups']) ? $requests['old_groups'] : implode(', ', $requests['groups']);
        if ($this->validated() === TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $set_quis = new SetQuis();

            $acak_soal = $requests['acak_soal'] ?? 0;
            $acak_jawaban = $requests['acak_jawaban'] ?? 0;
            $token = $requests['token'] ?? 0;
            $set_quis->where('id_setquis', '=', $id)->updateData([
                'nama' => $nama,
                'topik_id' => $topik,
                'groups' => $groups,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'waktu' => $waktu,
                'nilai_plus' => $nilai_plus,
                'nilai_minus' => $nilai_minus,
                'acak_soal' => $acak_soal,
                'acak_jawaban' => $acak_jawaban,
                'token' => $token,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Quis berhasil diubah!";
        }

        echo json_encode($this->status);
    }

    public function destroyQuis(string $id) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $set_quis = new SetQuis();
        $set_quis->where('id_setquis', '=', $id)->deleteData();
        $this->status['status'] = 1;
        $this->status['message']['success'] = "Data quis berhasil dihapus!";

        echo json_encode($this->status);
    }
}