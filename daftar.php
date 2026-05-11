<?php
include 'connection.php';

if (isset($_POST['submit'])){
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql = "INSERT INTO pengguna(nama, email, no_hp, alamat, password, role) 
            VALUE ('$nama', '$email', '$no_hp', '$alamat', '$password', '$role')";

if(mysqli_query($conn, $sql)) {
    echo "Berhasil Mendaftar";    
} else {
    echo "Eror" . mysqli_error($conn);
}
}
?>