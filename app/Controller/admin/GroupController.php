<?php 

namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\Core\Controller;

class GroupController extends Controller {
    public function groupPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        return $this->view('admin.pengguna.group');
    }

    public function listGroup() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $group = new Group();
        $result = $group->get();

        $data = [];
        $count = 1;
        while ($row = $group->fetchAssoc($result)) {
            $id_group = $row['id_group'];
            $nama = $row['nama'];
            $data[] = [
                'count' => $count,
                'nama' => $nama,
                'action' => "<button class='btn btn-sm text-info py-0' onclick='modalEdit(\"$id_group\", \"$nama\")'><i class='bi bi-pencil-square'></i></button>
                <button class='btn btn-sm text-info py-0' onclick='modalDelete(\"$id_group\", \"$nama\")'><i class='bi bi-trash-fill'></i></button>"
            ];

            $count++;
        }

        echo json_encode(["data" => $data]);
    }

    public function storeGroup(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $this->setRulesValidate($requests, 'val_group', [
            'nama' => 'required'
        ], ['nama' => ['required' => 'Nama group wajib diisi']]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $group = new Group();
            $group->insertData(['nama' => $nama]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Group berhasil ditambahkan!";
        }

        echo json_encode($this->status);
    }

    public function updateGroup(string $id, array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $this->setRulesValidate($requests, 'val_group', ['nama' => 'required']);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $group = new Group();
            $group->where('id_group', '=', $id)->updateData(['nama' => $nama]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Group berhasil diubah!";
        }

        echo json_encode($this->status);
    }

    public function destroyGroup(string $id) {
        $group = new Group();
        $group->where('id_group', '=', $id)->deleteData();

        $this->status['status'] = 1;
        $this->status['message']['success'] = "Group berhasil dihapus!";

        echo json_encode($this->status);
    }
}