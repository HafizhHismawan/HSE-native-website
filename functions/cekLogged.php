<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Pengguna belum login, arahkan kembali ke halaman login
    header('location: login');
    exit();
} else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $idAkun = $_SESSION['id_akun'];
    $idRule = $_SESSION['id_rule'];
    $namaRule = $_SESSION['nama_rule'];
    $levelRule = $_SESSION['level_rule'];
    $nama = $_SESSION['nama'];
    $username = $_SESSION['username'];
    $statNotify = $_SESSION['statNotify'];
}
