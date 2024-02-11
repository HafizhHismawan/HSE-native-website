<?php

// Koneksi ke Database MySQL
$servername = "localhost";
$database = "hse_ppns";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

// Cek koneksi, jika error kirimkan pesan errornya
if (mysqli_connect_error()) {
    echo "Koneksi database gagal :" . mysqli_connect_error();
}
