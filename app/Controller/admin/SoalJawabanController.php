<?php
namespace ValahIvanMaulana\App\Controller\admin;

use DOMDocument;
use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\App\Model\Soal;
use ValahIvanMaulana\App\Model\Topik;
use ValahIvanMaulana\Core\Controller;

class SoalJawabanController extends Controller {
    public function importSoalPage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik = new Topik();
        return $this->view('admin.soal.import-soal', ['topik' => $topik->get()]);
    }

    public function downloadFormWord(array $params) {
        $nama_file = $params['nama_file'];
        return $this->download($nama_file);
    }

    private function getInnerHTML($node) {
        $inner_html = '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $inner_html .= $node->ownerDocument->saveHTML($child);
        }
        return trim($inner_html);
    }

    public function importSoal(array $requests) {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $topik_id = $this->onlyCharsAndTrim($requests['topik_id']);
        $soals = $requests['soals'];

        $this->setRulesValidate($requests, 'val_soal', [
            'topik_id' => 'required',
            'soals' => 'required',
        ], [
            'topik_id' => ['required' => 'Silahkan pilih topik yang akan dijadikan soal!'],
            'soals' => ['required' => 'Pastekan soal yang berada di MS Word!']
        ]);
        
        if ($this->validated() == TRUE) {
            echo json_encode($this->status);
            return FALSE;
        } else {
            $dom = new DOMDocument();
            $dom->loadHTML($soals);

            $data_soal = [];
            $soal_aktif = null;

            $rows = $dom->getElementsByTagName('tr');
            foreach ($rows as $row) {
                $cols = $row->getElementsByTagName('td');

                $cell_values = [];
                $cell_konten = [];

                foreach ($cols as $col) {
                    $cell_values[] = trim($col->nodeValue);
                    $cell_konten[] = $col;
                }
                if (strtoupper($cell_values[0]) == "JAWABAN" || strtoupper($cell_values[0]) == "SOAL") {
                    array_unshift($cell_values, '');
                    array_unshift($cell_konten, '');
                }

                $nomor = $cell_values[0] ?? '';
                $tipe = strtoupper($cell_values[1]) ?? '';
                $konten = $this->getInnerHTML($cell_konten[2]) ?? '';
                $kunci_jawaban = $cell_values[3];

                if (str_replace(chr(194).chr(160), '', $cell_values[2]) == "") continue;
                if ($nomor !== "") $soal_aktif = $nomor;

                if ($soal_aktif !== null) {
                    if ($tipe === "SOAL") {
                        $data_soal[$soal_aktif] = [
                            'no_soal' => $nomor,
                            'topik_id' => $topik_id,
                            'soal' => $konten,
                            'pilihan' => [],
                            'pilihan_benar' => [],
                        ];
                    } elseif ($tipe == "JAWABAN") {
                        $data_soal[$soal_aktif]['pilihan'][] = $konten;
                        $data_soal[$soal_aktif]['pilihan_benar'][] = $kunci_jawaban;
                    } else {
                        echo "TIPE TIDAK VALID";
                    }
                }
            }

            if (empty($data_soal)) {
                $this->errors['errors']['soals'] = 'Format data harus berupa table yang suah ditentukan';
                echo json_encode($this->errors);
                return false;
            }
            
            $objSoal = new Soal();
            return $objSoal->insertSoal($data_soal, $this->status, $this->errors);
        }
    }
}