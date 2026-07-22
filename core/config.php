<?php
// Base url
define("BASE_URL", "http://localhost/valquis/");

// Database
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "valquis");

// Zona Waktu
date_default_timezone_set('Asia/Jakarta');

// Expired Token
use ValahIvanMaulana\App\Model\Token;
$token = new Token();
$result = $token->get();

$waktu_sekarang = date("Y-m-d H:i:s", time());
while ($row = $token->fetchAssoc($result)) {
    $expired_at = $row['expired_at'];
    if ($expired_at < $waktu_sekarang) {
        $token->where('expired_at', '<', $waktu_sekarang)->deleteData();
    }
}