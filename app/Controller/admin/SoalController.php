<?php 

namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Soal;
use ValahIvanMaulana\App\Model\Topik;
use ValahIvanMaulana\Core\Controller;

class SoalController extends Controller {
    public function soalPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = new Topik();
        $result = $topik->get();
        return $this->view('admin.soal.soal', ['topik' => $result]);
    }

    public function listSoal() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $soals = new Soal();
        $result = $soals->select(['val_soal.*', 'val_topik.nama AS nama_topik', 'COUNT(val_jawaban.id_jawaban) AS jumlah_jawaban'])
            ->leftJoin(['val_topik ON val_soal.topik_id = val_topik.id_topik'])
            ->leftJoin(['val_jawaban ON val_soal.id_soal = val_jawaban.soal_id'])
            ->groupBy('val_soal.id_soal')
            ->orderBy('val_topik.id_topik', 'ASC')
            ->get();
        
        $data = [];
        while ($row = $soals->fetchAssoc($result)) {
            $id_soal = $row['id_soal'];
            $topik = $row['nama_topik'];
            $no_soal = $row['no_soal'];
            $soal = $row['soal'];
            $jumlah_jawaban = $row['jumlah_jawaban'];

            $data[] = [
                'topik' => $topik, 
                'no_soal' => $no_soal,
                'soal' => str_contains($soal, 'img') ? $soal : $this->limit($soal, 50), 
                'jawaban' => "<a href='jawaban-page?id=$id_soal' class='btn btn-sm font-weight-medium text-info py-0'' target='_blank'><i class='bi bi-question-circle-fill'></i> $jumlah_jawaban jawaban</a>",
                'action' => "<a href='edit-soal?id=$id_soal' class='btn btn-sm font-weight-bold text-info py-0''><i class='bi bi-pencil-square'></i></a>
                <button type='button' class='btn btn-sm font-weight-bold text-info py-0'' onclick='modalDelete(\"$id_soal\")'><i class='bi bi-trash-fill'></i></button>
                "
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function storeSoal(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $arr_topik = explode(',', $this->onlyCharsAndTrim($requests['topik_id']));
        $no_soal = $this->onlyCharsAndTrim($requests['no_soal']);
        $namaSoal = $requests['soal'];

        $this->setRulesValidate($requests, 'val_soal', [
            'topik_id' => 'required',
            'no_soal' => 'required',
            'soal' => 'required'
        ], [
            'topik_id' => ['required' => 'Silahkan pilih topik!'],
            'no_soal' => ['required' => 'Nomor soal wajib diisi!'],
            'soal' => ['required' => 'Soal wajib diisi!'],
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $soal = new Soal();
            $topik = $arr_topik[1];
            $soal->insertData([
                'topik_id' => $topik,
                'no_soal' => $no_soal,
                'soal' => $namaSoal,
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Soal berhasil ditambahkan!"; 
        }

        echo json_encode($this->status);
    }

    public function editSoal(array $params) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $id_soal = $params['id'];
        $topik = new Topik();
        $soal = new Soal();

        return $this->view('admin.soal.edit-soal', [
            'topik' => $topik->get(),
            'soal' => $soal->findOrFails('id_soal', $id_soal),
        ]);
    }

    public function updateSoal(string $id, array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = $this->onlyCharsAndTrim($requests['topik_id']);
        $no_soal = $this->onlyCharsAndTrim($requests['no_soal']);
        $namaSoal = $requests['soal'];
        
        $this->setRulesValidate($requests, 'val_soal', [
            'topik_id' => 'required',
            'no_soal' => 'required',
            'soal' => 'required'
        ], [
            'topik_id' => ['required' => 'Silahkan pilih topik!'],
            'no_soal' => ['required' => 'Nomor soal wajib diisi!'],
            'soal' => ['required' => 'Soal wajib diisi!'],
        ]);

        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $soal = new Soal();
            $result = $soal->where('id_soal', '=', $id)->get();
            $row = $soal->fetchAssoc($result);

            preg_match('/<img[^>]+src="([^"]+)"/', $row['soal'], $match);
            $matchLama = $match[1] ?? false;
            $gambarLama = basename($matchLama);

            preg_match('/<img[^>]+src="([^"]+)"/', $requests['soal'], $match);
            $matchBaru = $match[1] ?? false;
            $gambarBaru = basename($matchBaru);

            if ($gambarLama !== $gambarBaru) {
                $path = "public/uploads/" . $gambarLama;
                if ($gambarLama != false) $this->deleteImage($path);
            }

            $soal->where('id_soal', '=', $id)->updateData([
                'topik_id' => $topik,
                'no_soal' => $no_soal,
                'soal' => $namaSoal
            ]);

            $this->status['status'] = 1;
            $this->status['message']['success'] = "Soal berhasil diubah!"; 
        }

        echo json_encode($this->status);
    }

    public function destroySoal(string $id) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        
        $soal = new Soal();
        $result = $soal->where('id_soal', '=', $id)->get();
        $row = $soal->fetchAssoc($result);

        preg_match('/<img[^>]+src="([^"]+)"/', $row['soal'], $match);
        $imgMatch = $match[1] ?? false;
        $gambar = basename($imgMatch);

        if ($gambar) {
            $path = "public/uploads/" . $gambar;
            if ($gambar != false) $this->deleteImage($path);
        }

        $soal->where('id_soal', '=', $id)->deleteData();
        $this->status['status'] = 1;
        $this->status['message']['success'] = "Data soal berhasil dihapus!";

        echo json_encode($this->status);
    }
}