<?php

namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\App\Model\Token;
use ValahIvanMaulana\Core\Controller;

class TokenController extends Controller {
    public function tokenPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $seqtquis = new SetQuis();
        return $this->view('admin.setquis.token', ['setquis' => $seqtquis->get()]);
    }

    public function storeToken(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama_token = $this->onlyCharsAndTrim($requests['nama_token']);
        $setquis_id = $this->onlyCharsAndTrim($requests['setquis_id']);
        $expired_at = (int) $requests['expired_at'];
        
        $this->setRulesValidate($requests, 'val_token', [
            'nama_token' => 'required|unique',
            'setquis_id' => 'required',
        ], [
            'nama_token' => ['required' => 'Silahkan isi kode token'],
            'setquis_id' => ['required' => 'Harap pilih quis yang ingin dijadikan token']
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $waktu_expired = date("Y-m-d H:i:s", strtotime("+ $expired_at hour"));
            $token = new Token();
            $token->insertData([
                'nama_token' => $nama_token, 
                'expired_at' => $waktu_expired,
                'setquis_id' => $setquis_id
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Token berhasil ditambahkan!";
        }

        echo json_encode($this->status);
    }

    public function listToken() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $token = new Token();
        $result = $token->select(['val_token.*', 'val_setquis.nama AS nama_quis'])
            ->innerJoin(['val_setquis ON val_token.setquis_id = val_setquis.id_setquis'])
            ->get();
            
        $data = [];
        $count = 1;
        while ($row = $token->fetchAssoc($result)) {
            $nama_token = $row['nama_token'];
            $nama_quis = $row['nama_quis'];
            $expired_at = $row['expired_at'];
            $created_at = $row['created_at'];

            $data[] = [
                'count' => $count,
                'nama_token' => $nama_token,
                'nama_quis' => $nama_quis,
                'expired_at' => "$created_at Sampai $expired_at",
                'created_at' => $created_at,
            ];
            $count++;
        }

        echo json_encode(["data" => $data]);
    }
}