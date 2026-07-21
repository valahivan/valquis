<?php

namespace ValahivanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Middleware\GuestMiddleware;
use ValahIvanMaulana\App\Model\Admin;
use ValahIvanMaulana\Core\Controller;

class AdminAuthController extends Controller {
    public function loginAdminPage() {
        GuestMiddleware::handle('id_admin', 'dashboard');
        return $this->view('user.login-admin');
    }

    public function loginAdmin(array $requests) {
        GuestMiddleware::handle('id_admin', 'dashboard');

        $username = $this->onlyCharsAndTrim($requests['username']);
        $password = $this->onlyCharsAndTrim($requests['password']);
        
        $this->setRulesValidate($requests, 'val_admin', [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username' => ['required' => 'Username tidak boleh kosong, wajib diisi!'],
            'password' => ['required' => 'Password tidak boleh kosong, wajib diisi!',],
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $loginAdmin = new Admin();
            $result = $loginAdmin->where('username', '=', $username)->get();

            if ($loginAdmin->numRows($result) > 0) {
                $row = $loginAdmin->fetchAssoc($result);
                $passwordHash = $row['password'];

                if ($password == $passwordHash) {
                    $_SESSION['id_admin'] = $row['id_admin'];
                    $_SESSION['nama_admin'] = $row['nama'];

                    $this->status['status'] = 1;
                    $this->status['id_admin'] = $_SESSION['id_admin'];
                    $this->status['nama_admin'] = $_SESSION['nama_admin'];
                } else {
                    $this->status['status'] = 0;
                    $this->status['errors']['password'] = 'Paswword yang anda inputkan salah!';
                }
            } else {
                $this->status['status'] = 0;
                $this->status['errors']['username'] = 'Username yang anda inputkan tidak ada!';
            }
        }
        echo json_encode($this->status);
    }

    public function changePassword(string $id, array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $password = $this->onlyCharsAndTrim($requests['password']);
        $confirm_password = $this->onlyCharsAndTrim($requests['confirm_password']);

        $this->setRulesValidate($requests, 'val_admin', [
            'old_password' => 'required|existspassword',
            'password' => 'required',
            'confirm_password' => 'required',
        ], [
            'old_password' => [
                'required' => 'Isi password lama!',
                'existspassword' => 'Samakan dengan password lama!',
            ],
            'password' => ['required' => 'Silahkan isi password baru'],
            'confirm_password' => ['required' => 'Konfimrasi password tidak boleh kosong!'],
        ]);

        if ($password !== $confirm_password) {
            $this->errors['confirm_password'] = "Konfirmasi password tidak sesuai!";
        }

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
           $admin = new Admin;
           
           $admin->where('id_admin', '=', $id)->updateData(['password' => $password]);
           $this->status['status'] = 1;
           $this->status['message']['success'] = "Password berhasil diubah!";

           echo json_encode($this->status);
        }
    }
    
    public function logoutAdmin() { 
        session_start();
        unset($_SESSION['id_admin']);
        unset($_SESSION['nama_admin']);
        
        $this->status['status'] = 1;
        echo json_encode($this->status);
    }
}