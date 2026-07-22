<?php
namespace ValahIvanMaulana\App\Controller\admin;

use mysqli_sql_exception;
use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Topik;
use ValahIvanMaulana\Core\Controller;

class TopikController extends Controller {
    public function topikPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        return $this->view('admin.topik.topik');
    }

    public function listTopik() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = new Topik();
        $result = $topik->get();

        $data = [];
        $count = 1;
        while ($row = $topik->fetchAssoc($result)) {
            $id_topik = $row['id_topik'];
            $nama = $row['nama'];
            $deskripsi = $row['deskripsi'];

            $data[] = [
                'count' => $count,
                'nama' => $nama,
                'deskripsi' => $this->limit($deskripsi, 40),
                'id_topik' => "<button type='button' class='btn btn-sm font-weight-bold text-info py-0' onclick='modalEdit($id_topik, \"$nama\", \"$deskripsi\")'><i class='bi bi-pencil-square'></i></button><button type='button' class='btn btn-sm font-weight-bold text-info py-0' onclick='modalDelete($id_topik, \"$nama\")'><i class='bi bi-trash-fill'></i></button>
                "
            ];
            $count++;
        }
        echo json_encode(["data" => $data]);
    }

    public function addTopik(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $deskripsi = $this->onlyCharsAndTrim($requests['deskripsi']);
        $this->setRulesValidate($requests, 'val_topik', [
            'nama' => 'required|unique',
            'deskripsi' => 'required'
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $topik = new Topik();
            $topik->insertData([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Topik quis berhasil ditambahkan!";
        }

        echo json_encode($this->status);
    }

    public function updateTopik(string $id, array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $deskripsi = $this->onlyCharsAndTrim($requests['deskripsi']);

        $this->setRulesValidate($requests, 'val_topik', [
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $topik = new Topik();
            $topik->where('id_topik', '=', $id)->updateData([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Topik quis berhasil diubah!";
        }

        echo json_encode($this->status);
    }

    public function destroyTopik(string $id) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = new Topik();
        try {
            $topik->where('id_topik', '=', $id)->deleteData();
            $this->status['status'] = 1;
            $this->status['message']['success'] = 'Topik quis berhasil dihapus!';
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            if (str_contains($error, 'Cannot delete') || str_contains($error, 'foreign key')) {
                $this->status['status'] = 0;
                $this->status['message']['error'] = "Quis masih ada! tidak bisa dihapus!";
            }
        }
        echo json_encode($this->status);
    }
}