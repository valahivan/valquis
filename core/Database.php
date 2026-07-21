<?php 
namespace ValahIvanMaulana\Core;

use Exception;

class Database {
    private string $hostname;
    private string $username;
    private string $password;
    private string $dbname;

    public function __construct(string $hostname, string $username, string $password, string $dbname) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connectToDb() {
        try {
            return mysqli_connect($this->hostname,$this->username, $this->password, $this->dbname);
        } catch (Exception $e) {
            http_response_code(500);

            $status_code = '500';
            $title = 'Internal Server Error';
            $message = $e->getMessage();

            return include_once 'views/error.php';
        }
    }
}