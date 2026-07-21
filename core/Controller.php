<?php 
namespace ValahIvanMaulana\Core;

use ValahIvanMaulana\Core\Database;
include_once 'config.php';

abstract class Controller {
    protected $connect;
    protected array $status = [];
    protected bool $isValidate = FALSE;
    protected array $errors = [];
    private string $sql;

    public function __construct() {
        $db = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $connect = $db->connectToDb();
        return $this->connect = $connect;
    }

    private function validate_unique($input, string $table, string $key, $message = '') {
        $result = $this->selectByField($table, [$key => $input]);
        if (mysqli_num_rows($result) > 0) {
            $this->status['status'] = 0;
            if (empty($message)) {
                $this->errors[$key] = "$key tidak boleh kosong!";
            } else {
                $this->errors[$key] = "$message";
            }
            return $message;
        }
    }

    private function validate_required($input, string $table, string $key, $message = '') {
        if (empty($input)) {
            $this->status['status'] = 0;
            if (empty($message)) {
                $this->errors[$key] = "$key tidak boleh kosong!";
            } else {
                $this->errors[$key] = "$message";
            }
            return $message;
        }
    }

    private function validate_length($input, string $table, string $key, $message) {
        if (empty($input)) return;
        if (strlen($input) < 8) {
            $this->status['status'] = 0;
            if (empty($message)) {
                $this->errors[$key] = "$key tidak boleh kosong!";
            } else {
                $this->errors[$key] = "$message";
            }
            return $message;
        }
    }

    private function validate_existspassword($input, string $table, string $key, $message) {
        if (empty($input)) return;
        $result = $this->selectByField($table, ['password' => $input]);
        
        if (mysqli_num_rows($result) <= 0) {
            $this->status['status'] = 0;
            if (empty($message)) {
                $this->errors[$key] = "$key tidak ada!";
            } else {
                $this->errors[$key] = "$message";
            }
            return $message;
        }
    }

    public function setRulesValidate($inputs, string $table, array $rules, $messages = []) {
        foreach ($rules as $key => $rule) {
            $validateRules = explode('|', $rule);
            for ($i = 0; $i < count($validateRules); $i++) { 
                $method = "validate_" . $validateRules[$i];
                $msg = $messages[$key][$validateRules[$i]] ?? '';
                if (method_exists($this, $method)) $this->$method($inputs[$key], $table,  $key, $msg);
            }
        }

        if (!empty($this->errors)) return $this->isValidate = TRUE;
    }

    public function validated() {
        $this->status['errors'] = $this->errors;
        return $this->isValidate;
    }

    public function onlyCharsAndTrim(string $teks) {
        $trimText = trim($teks);
        $specialChars = htmlspecialchars($trimText);
        return $specialChars;
    }

    public function limit(string $text, int $limit) {
        $lengthText = strlen($text);
        $text = $lengthText >= $limit ? substr($text, 0, $limit) . "..." : substr($text, 0, $limit);
        return $text;
    }

    public function selectByField(string $table, array $keyValue) {
        $setKeyValues = [];
        foreach ($keyValue as $key => $value) {
            $setKeyValues[] = "$key = '$value'";
            $whereString = implode(' AND ', $setKeyValues);
            $this->sql = "SELECT * FROM $table WHERE $whereString";
        }
        return mysqli_query($this->connect, $this->sql);
    }
    
    public static function upload(string $dir, string $fileName) {
        $tmp_name = $_FILES['upload']['tmp_name'];
        return move_uploaded_file($tmp_name, $dir . $fileName);
    }

    public function deleteImage(string $path) {
        if (file_exists($path)) unlink($path);
    }

    public function view(string $dir, array $data = []) {
        $view = str_replace('.', '/', $dir);
        extract($data);
        return include_once 'views/' . $view . '.php';
    }

    public function download($file) {
        // Specify the file path
        $filePath = "public/assets/files/". $file; // Replace with the actual path to your file
        
        // Check if the file exists
        if (file_exists($filePath)) {
            // Set headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream'); // Or the specific MIME type of your file (e.g., image/jpeg, application/pdf)
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            // Clear output buffer if necessary (for large files to prevent memory issues)
            ob_clean();
            flush();

            // Read and output the file content
            readfile($filePath);
            exit;
        } else {
            // Handle the case where the file does not exist
            echo 'File not found.';
        }
    }
}