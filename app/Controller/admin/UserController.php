<?php
namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\App\Model\User;
use ValahIvanMaulana\Core\Controller;

class UserController extends Controller {
    public function userPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $group = new Group();
        return $this->view('admin.pengguna.user', ['group' => $group->get()]);
    }

    public function listUser() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $dataUser = new User();
        $result = $dataUser->select(['val_users.*', 'val_group.nama AS nama_group'])
            ->innerJoin(['val_group ON val_users.group_id = val_group.id_group'])
            ->orderBy('nama', 'ASC')
            ->orderBy('group_id', 'ASC')
            ->get();

        $data = [];
        $count = 1;
        while ($row = $dataUser->fetchAssoc($result)) {
            $idUser = $row['id_user'];
            $nama_lengkap = $row['nama'];
            $nama_group = $row['nama_group'];
            $username = $row['username'];
            $created_at = $row['created_at'];

            $data[] = [
                'count' => $count,
                'nama' => $nama_lengkap,
                'nama_group' => $nama_group,
                'username' => $username,
                'created_at' => $created_at,
                'id_user' => "<input type='checkbox' name='pilihan[]' value='$idUser'>"
            ];
            $count++;
        }
        echo json_encode(["data" => $data]);
    }

    public function storeUser(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama_lengkap = $this->onlyCharsAndTrim($requests['nama']);
        $username = $this->onlyCharsAndTrim($requests['username']);
        $password = $this->onlyCharsAndTrim($requests['password']);
        $group_id = $this->onlyCharsAndTrim($requests['group_id']);
        $email = $this->onlyCharsAndTrim($requests['email']);

        $this->setRulesValidate($requests, 'val_users', [
            'nama' => 'required',
            'username' => 'required|unique',
            'password' => 'required|length',
            'group_id' => 'required',
        ], [
            'nama' => ['required' => 'Nama lengkap wajib diisi!'],
            'username' => [
                'required' => 'Username wajib diisi!',
                'unique' => 'Username tidak boleh sama dengan pengguna lain!'
            ],
            'password' => [
                'required' => 'Password wajib diisi',
                'unique' => 'Panjang password minimal & karakter!'
            ],
            'group_id' => ['required' => 'Silahkan pilih group untuk pengguna ini!'],
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $user = new User();
            $user->insertData([
                'nama' => $nama_lengkap,
                'username' => $username,
                'password' => $password,
                'group_id' => $group_id,
                'email' => $email,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Pengguna berhasil ditambahkan!";
        }

        echo json_encode($this->status);
    }

    public function printCardPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $group = new Group();
        return $this->view('admin.pengguna.cetak-kartu', [
            'group' => $group->get()
        ]);
    }

    public function previewCard(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $group = explode(',', $requests['group']);
        $id_group = $group[0 ?? false];
        $nama_group = $group[1] ?? false;

        $user = new User();
        $result = $user->filter($user, $id_group)->orderBy('val_users.nama', 'ASC')->get();

        return $this->view('admin.pengguna.preview-kartu', [
            'user' => $result,
            'num_rows' => $user->numRows($result),
            'nama_group' => $nama_group,
        ]);
    }

    public function destroysUser(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $pilihan = isset($requests['pilihan']) ? $requests['pilihan'] : [];
        $dataUser = new User();

        if(empty($pilihan)) {
            $this->status['status'] = 0;
            $this->status['message']['error'] = "Silahkan pilih dulu datanya!";
        } else {
            $dataUser->destroys('id_user', $pilihan);
            $this->status['status'] = 1;
            $this->status['message']['success'] = "Data pengguna berhasil dihapus!";
        };

        echo json_encode($this->status);
    }
}