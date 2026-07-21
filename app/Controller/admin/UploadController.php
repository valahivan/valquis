<?php
namespace ValahIvanMaulana\App\Controller\admin;

use ValahIvanMaulana\App\Middleware\AuthMiddleware;
use ValahIvanMaulana\Core\Controller;
include_once '../valquis/core/config.php';

class UploadController extends Controller {
    public function uploadImage() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');

        $fileGambar = $_FILES['upload']['name'];
        $extensionFile = strtolower(pathinfo($fileGambar, PATHINFO_EXTENSION));
        $uniqFileName = time().".".$extensionFile;

        $dir = "public/uploads/";
        $this->upload($dir, $uniqFileName);

        $url = BASE_URL .'public/uploads/'. $uniqFileName;
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');</script>";
        return TRUE;
    }

    public function uploadImageWord() {
        AuthMiddleware::handle('id_admin', 'login-admin-page');
        
        $fileGambar = $_FILES['upload']['name'];
        $extensionFile = strtolower(pathinfo($fileGambar, PATHINFO_EXTENSION));
        $uniqFileName = time().".".$extensionFile;

        $dir = "public/uploads/";
        $url = BASE_URL .'public/uploads/'. $uniqFileName;
        if ($this->upload($dir, $uniqFileName)) {
            echo json_encode([
                'uploaded' => 1,
                'fileName' => $fileGambar,
                'url' => $url
            ]);
        }
        return TRUE;
    }
}