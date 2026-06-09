<?php
$server = "localhost" ;
$username = "root";
$password = "";
$db = "LokalThrift";

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Koneksi Gagal". $conn->connect_error);
} else {
    echo "Koneksi Berhasil";
}

?>