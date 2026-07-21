<?php
namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\App\Model\Hasil;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\App\Model\Soal;
use ValahIvanMaulana\App\Model\Token;
use ValahIvanMaulana\App\Model\Topik;
use ValahIvanMaulana\App\Model\User;
use ValahIvanMaulana\Core\Controller;

class DashboardController extends Controller {
    public function dashboard() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        return $this->view('admin.dashboard');
    }

    public function countDataTables() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        
        $users = new User();
        $groups = new Group();
        $topiks = new Topik();
        $soals = new Soal();
        $quiss = new SetQuis();
        $tokens = new Token();
        $results = new Hasil();

        $jumlahUser = $users->numRows($users->get());
        $jumlahGroup = $groups->numRows($groups->get());
        $jumlahTopik = $topiks->numRows($topiks->get());
        $jumlahSoal = $soals->numRows($soals->get());
        $jumlahQuis = $quiss->numRows($quiss->get());
        $jumlahToken = $tokens->numRows($tokens->get());
        $jumlahResult = $results->numRows($results->get());

        echo json_encode([
            'counts' => [
                $jumlahUser,
                $jumlahGroup,
                $jumlahTopik,
                $jumlahSoal,
                $jumlahQuis,
                $jumlahToken,
                $jumlahResult,
            ],
        ]);
    }
}