<?php
$mysqli = new mysqli("localhost", "root", "",
"penjualan");

 if ($mysqli->connect_error) {
 die("Koneksi gagal: " . $mysqli->connect_error);
 }

?>