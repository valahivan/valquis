<?php
namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Jawaban;
use ValahIvanMaulana\App\Model\Soal;
use ValahIvanMaulana\Core\Controller;

class JawabanController extends Controller {
  public function jawabanPage(array $params) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');
        
    $id = $params['id'];
    $soal = new Soal();
    $resSoal = $soal->findOrFails('id_soal', $id);

    return $this->view('admin.jawaban.jawaban', ['soal' => $resSoal]);
  }

  public function listJawaban(array $params) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');

    $soal_id = $params['soal_id'];
    $soalJawaban = new Jawaban();
    $result = $soalJawaban->where('soal_id', '=', $soal_id)->get();

    $data = [];
    $count = 1;
    while ($row = $soalJawaban->fetchAssoc($result)) {
      $id_jawaban = $row['id_jawaban'];
      $pilihan = str_replace(['<p>', '</p>'], ['', ''], $row['pilihan']);

      $data[] = [
        'count' => $count,
        'pilihan' => $row['pilihan'],
        'pilihan_benar' => $row['pilihan_benar'] == 1 ? "<b>Benar</b>" : "Salah",
        'action' => "<a href='edit-jawaban?id=$id_jawaban&soal_id=$soal_id' class='btn btn-sm text-info font-weight-bold py-0'><i class='bi bi-pencil-square'></i></a>
        <button type='button' class='btn btn-sm text-info font-weight-bold py-0' onclick='modalDelete(\"$id_jawaban\", ".json_encode($pilihan).")'><i class='bi bi-trash-fill'></i></button>"
      ];
      $count++;
    }

    echo json_encode(["data" => $data]);
  }

  public function storeJawaban(array $requests) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');
    
    $soal_id = $this->onlyCharsAndTrim($requests['soal_id']);
    $pilihan = $requests['pilihan'];
    $pilihan_benar = $this->onlyCharsAndTrim($requests['pilihan_benar']);

    $this->setRulesValidate($requests, 'val_jawaban', [
      'pilihan' => 'required',
    ], [ 'pilihan' => ['required' => 'Pilihan wajib diisi!']]);

    if ($this->validated() === TRUE) {
      echo json_encode($this->status);
      return FALSE;
    } else {
      $soalJawaban = new Jawaban();
      $soalJawaban->insertData(['soal_id' => $soal_id, 'pilihan' => $pilihan, 'pilihan_benar' => $pilihan_benar]);

      $this->status['status'] = 1;
      $this->status['message']['success'] = "Jawaban berhasi ditambahkan!";
    }

    echo json_encode($this->status);
  }

  public function editJawaban(array $params) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');

    $id_jawaban = $params['id'];
    $soal_id = $params['soal_id'];
    $soal = new Soal();
    $jawaban = new Jawaban();
    
    return $this->view('admin.jawaban.edit-jawaban', [
      'soal' => $soal->get(),
      'soal_id' => $soal_id,
      'jawaban' => $jawaban->findOrFails('id_jawaban', $id_jawaban),
    ]);
  }
  

  public function updateJawaban(string $id, array $requests) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');
    
    $pilihan = $requests['pilihan'];
    $pilihan_benar = $this->onlyCharsAndTrim($requests['pilihan_benar']);

     $this->setRulesValidate($requests, 'val_jawaban', [
      'pilihan' => 'required',
    ], [ 'pilihan' => ['required' => 'Pilihan wajib diisi!']]);

    if ($this->validated() == TRUE) {
      echo json_encode($this->status);
      return FALSE;
    } else {
      $jawaban = new Jawaban();
      $result = $jawaban->where('id_jawaban', '=', $id)->get();
      $row = $jawaban->fetchAssoc($result);

      preg_match('/<img[^>]+src="([^"]+)"/', $row['pilihan'], $match);
      $matchLama = $match[1] ?? false;
      $gambarLama = basename($matchLama);

      preg_match('/<img[^>]+src="([^"]+)"/', $requests['pilihan'], $match);
      $matchBaru = $match[1] ?? false;
      $gambarBaru = basename($matchBaru);

      if ($gambarLama !== $gambarBaru) {
        $path = "public/uploads/" . $gambarLama;
        if ($gambarLama != false) $this->deleteImage($path);
      }

      $jawaban->where('id_jawaban', '=', $id)->updateData([
        'pilihan' => $pilihan,
        'pilihan_benar' => $pilihan_benar
      ]);

      $this->status['status'] = 1;
      $this->status['message']['success'] = "Jawaban berhasil diubah!";
    }

    echo json_encode($this->status);
  }

  public function destroyJawaban(string $id) {
    AuthMiddleware::handle('id_admin', 'login-admin-page');
        
    $jawaban = new Jawaban();
    $result = $jawaban->where('id_jawaban', '=', $id)->get();
    $row = $jawaban->fetchAssoc($result);

    preg_match('/<img[^>]+src="([^"]+)"/', $row['pilihan'], $match);
    $imgMatch = $match[1] ?? false;
    $gambar = basename($imgMatch);

    if ($gambar) {
      $path = "public/uploads/" . $gambar;
      if ($gambar != false) $this->deleteImage($path);
    }

    $jawaban->where('id_jawaban', '=', $id)->deleteData();
    $this->status['status'] = 1;
    $this->status['message']['success'] = "Data Jawaban berhasil dihapus!";

    echo json_encode($this->status);
  }
}