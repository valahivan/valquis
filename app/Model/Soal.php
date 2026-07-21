<?php
namespace ValahIvanMaulana\App\Model;

use mysqli_sql_exception;
use ValahIvanMaulana\Core\Model;

class Soal extends Model {
    protected $table = "val_soal";
    private $sql;

    public function insertSoal(array $data_soal, array $status, array $error) {
        try {
            $soal_values = [];
            $jawaban_values = [];

            foreach ($data_soal as $data) {
                $topik_id = "'".mysqli_escape_string($this->connect, $data['topik_id'])."'";
                $no_soal = "'". "soal-".mysqli_escape_string($this->connect, $data['no_soal'])."'";
                $soal =  "'".mysqli_escape_string($this->connect, $data['soal'])."'";
                $soal_values[] = "($topik_id, $no_soal, $soal)";
            }
            
            if (!empty($soal_values)) {
                $this->sql = "INSERT INTO val_soal (topik_id, no_soal, soal) VALUES" .implode(",", $soal_values);
                mysqli_query($this->connect, $this->sql);
                $first_id = mysqli_insert_id($this->connect);
            }

            $count_soal = 0;
            foreach ($data_soal as $data) {
                $soal_id = $first_id + $count_soal;
                $length_pilihan = count($data['pilihan']);

                for ($i = 0; $i < $length_pilihan; $i++) {
                    $pilihan = "'".mysqli_escape_string($this->connect, $data['pilihan'][$i])."'";
                    $kunci_jawaban = "'".mysqli_escape_string($this->connect, $data['pilihan_benar'][$i])."'";
                    $jawaban_values[] = "($soal_id, $pilihan, $kunci_jawaban)";
                }
                $count_soal++;
            }

            if (!empty($jawaban_values)) {
                $this->sql = "INSERT INTO val_jawaban(soal_id, pilihan, pilihan_benar) VALUES" .implode(",", $jawaban_values);
                mysqli_query($this->connect, $this->sql);
            }

            $status['status'] = 1;
            $status['message']['success'] = "Soal Berhasil diimport";
            echo json_encode($status);
        } catch (mysqli_sql_exception $e) {
            $error['soals'] = $e->getMessage();
            echo json_encode($status);
        }
    }
}