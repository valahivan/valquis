<?php
namespace ValahIvanMaulana\App\Controller\admin;

use Dompdf\Dompdf;
use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Group;
use ValahIvanMaulana\App\Model\Hasil;
use ValahIvanMaulana\App\Model\SetQuis;
use ValahIvanMaulana\Core\Controller;

class ResultController extends Controller {
    public function resultPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $group = new Group();
        $setquis = new SetQuis();
        return $this->view('admin.hasil.hasil-quis', [
            'group' => $group->get(),
            'setquis' => $setquis->get(),
        ]);
    }

    public function listResult() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        $hasil = new Hasil();
        $result = $hasil->select(['val_hasil.*', 'val_setquis.*', 'val_group.nama AS nama_group', 'val_users.nama AS nama_user'])
            ->innerJoin(['val_setquis ON val_hasil.setquis_id = val_setquis.id_setquis'])
            ->innerJoin(['val_group ON val_hasil.group_id = val_group.id_group'])
            ->innerJoin(['val_users ON val_hasil.user_id = val_users.id_user'])
            ->get();

        $data = [];
        while ($row = $hasil->fetchAssoc($result)) {
            $id_result = $row['id_hasil'];
            $nama_user = $row['nama_user'];
            $nama_group = $row['nama_group'];
            $nama_quis = $row['nama'];
            $nilai_akhir = $row['nilai'];
            $tanggal = $row['created_at'];
            $status = $row['status'] == 'sedang' ? $row['waktu_berjalan'] : strtoupper($row['status']);

            $data[] = [
                'nama_user' => $nama_user,
                'nama_group' => $nama_group,
                'nama_quis' => "<a href='detail-page?nama_group=$nama_group&nama_quis=$nama_quis' class='font-weight-medium text-info'><i class='bi bi-bar-chart-fill'></i> $nama_quis</a>",
                'status' => $status,
                'nilai_akhir' => $nilai_akhir,
                'tanggal' => $tanggal,
                'action' => "<input type='checkbox' name='pilihan[]' value='$id_result'>"
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function exportPDF(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $arr_group = explode(',', $params['group']);
        $arr_quis = explode(',', $params['quis']);

        $group_id = $arr_group[1] ?? false;
        $setquis_id = $arr_quis[1] ?? false;

        $hasilQuis = new Hasil();
        $result = $hasilQuis->filter($hasilQuis, $group_id, $setquis_id)->get();

        $dompPDF = new Dompdf();
        ob_start();
        $this->view('admin.hasil.hasil-quis-pdf', [
            'nama_quis' => !empty($params['quis']) ? 'yaitu '. $arr_quis[0] : '',
            'nama_group' => !empty($params['group']) ? 'group '. $arr_group[0] : '',
            'hasil_quis' => $result
        ]);
        $html = ob_get_clean();
        $dompPDF->loadHtml($html);
        $dompPDF->setPaper('A4', 'potrait');
        $dompPDF->render();

        $param_quis = !empty($params['quis']) ?'-'. $arr_quis[0] : '';
        $param_group = !empty($params['group']) ? '-'. $arr_group[0] : '';

        return $dompPDF->stream("daftar-hasil-quis$param_quis$param_group");
    }

    public function destroysResult(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $pilihan = isset($requests['pilihan']) ? $requests['pilihan'] : [];
        $hasil = new Hasil();

        if (empty($pilihan)) {
            $this->status['status'] = 0;
            $this->status['message']['error'] = "Silahkan pilih dulu datanya!";
        } else {
            $hasil->destroys('id_hasil', $pilihan);
            $this->status['status'] = 1;
            $this->status['message']['success'] = "Data hasil berhasil dihapus!";
        }

        echo json_encode($this->status);
    }

    public function detailPage(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        return $this->view('admin.hasil.detail', [
            'nama_group' => $params['nama_group'],
            'nama_quis' => $params['nama_quis'],
        ]);
    }

    public function printPage(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        return $this->view('admin.hasil.print-diagram', [
            'nama_group' => $params['nama_group'],
            'nama_quis' => $params['nama_quis'],
        ]);
    }
    

    public function detailChart(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $nama_group = $params['nama_group'];
        $nama_quis = $params['nama_quis'];

        $hasil= new Hasil();
        $result = $hasil->select(['val_hasil.*', 'val_group.nama AS nama_group', 'val_setquis.nama AS nama_quis', 'val_users.nama AS nama_user'])
            ->innerJoin(['val_group ON val_hasil.group_id = val_group.id_group'])
            ->innerJoin(['val_setquis ON val_hasil.setquis_id = val_setquis.id_setquis'])
            ->innerJoin(['val_users ON val_hasil.user_id = val_users.id_user'])
            ->where('val_group.nama', '=', $nama_group)
            ->where('val_setquis.nama', '=', $nama_quis)
            ->get();

        $labels = [];
        $data = [];

        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['nama_user'];
            $data[] = $row['nilai'];
            $index++;
        }

        echo json_encode([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}