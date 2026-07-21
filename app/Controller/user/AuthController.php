<?php 
namespace ValahIvanMaulana\App\Controller\user;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Middleware\GuestMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\App\Model\User;
use ValahIvanMaulana\Core\Controller;

class AuthController extends Controller {
    public function registerPage() {
        GuestMiddleware::handle('id_user', 'list-quis-page');

        $group = new Group();
        return $this->view('user.register', ['group' => $group->get()]);
    }

    public function registerData(array $requests) {
        GuestMiddleware::handle('id_user', 'list-quis-page');

        $nama = $this->onlyCharsAndTrim($requests['nama']);
        $username = $this->onlyCharsAndTrim($requests['username']);
        $group = $this->onlyCharsAndTrim($requests['group_id']);
        $email = $this->onlyCharsAndTrim($requests['email']);
        $password = $this->onlyCharsAndTrim($requests['password']);

        $this->setRulesValidate($requests, 'val_users', [
            'nama' => 'required',
            'username' => 'required|unique',
            'group_id' => 'required',
            'password' => 'required|length',
        ], [
            'nama' => ['required' => 'Nama lengkap tidak boleh kosong, wajib diisi!'],
            'username' => [
                'required' => 'Username tidak boleh kosong, wajib diisi!',
                'unique' => 'Username sudah terdaftar!',
            ],
            'group_id' => ['required' => 'Silahkan pilih group terlebih dahulu!'],
            'password' => [
                'required' => 'Password tidak boleh kosong, wajib diisi!',
                'length' => 'Panjang password minimal & karakter!',
            ],
        ]);

        if ($this->validated() === TRUE) {
            echo json_encode($this->status);
            return false;
        } else {
            $register = new User();
            $register->insertData([
                'nama' => $nama,
                'username' => $username, 
                'group_id' => $group, 
                'email' => $email, 
                'password' => $password,
            ]);

            $this->status['status'] = 1;
            $this->status['success'] = 'Kamu berhasil registrasi. Silahkan login!';
            echo json_encode($this->status);
        }
    }

    public function loginPage() {
        GuestMiddleware::handle('id_user', 'list-quis-page');
        return $this->view('user.login');
    }

    public function loginData(array $requests) {
        GuestMiddleware::handle('id_user', 'list-quis-page');

        $username = $this->onlyCharsAndTrim($requests['username']);
        $password = $this->onlyCharsAndTrim($requests['password']);

        $this->setRulesValidate($requests, 'val_users', [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username' => ['required' => 'Username tidak boleh kosong, wajib diisi!'],
            'password' => ['required' => 'Password tidak boleh kosong, wajib diisi!',],
        ]);

        if ($this->validated() === TRUE) {
            echo json_encode($this->status);
            return false;
        } else {
            $login = new User();
            $result = $login->where('username', '=', $username)->get();

            if ($login->numRows($result) > 0) {
                $row = $login->fetchAssoc($result);
                $passwordHashed = $row['password'];

                if ($password == $passwordHashed) {
                    $_SESSION['id_user'] = $row['id_user'];

                    $this->status['status'] = 1;
                    $this->status['session_id'] = $_SESSION['id_user'];

                    $session_id = bin2hex(random_bytes(32));
                    setcookie('remember_token_user', $session_id, time() + 60*60*24*365);
                    $login->where('id_user', '=', $row['id_user'])->updateData(['remember_token' => $session_id]);
                } else {
                    $this->status['status'] = 0;
                    $this->status['errors']['password'] = 'Password yang anda masukkan salah!';
                }
            } else {
                $this->status['status'] = 0;
                $this->status['errors']['username'] = 'Username yang anda masukkan belum terdaftar!';
            }
            echo json_encode($this->status);
        }
    }

    public function logingOut() {
        AuthMiddleware::handle('id_user', 'login-page');

        unset($_SESSION['id_user']);
        unset($_SESSION['nama_user']);

        setcookie('remember_token_user', '', time() - 60*60*24*365);
        $this->status['status'] = 1;
        echo json_encode($this->status);
    }
}