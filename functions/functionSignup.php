<?php
require_once 'koneksi.php';

// Cek login
if (isset($_POST['register'])) {
    // Mengambil nilai masukan dari form
    $namaLengkap = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $noTelepon = $_POST['noTlp'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['rePassword'];
    $gender = $_POST['gender'];
    date_default_timezone_set('Asia/Jakarta');
    $tanggalWaktu = date('Y-m-d H:i:s');

    // Memeriksa apakah password dan konfirmasi password cocok
    if ($password !== $confirmPassword) {
        echo "Password dan Konfirmasi Password tidak cocok.";
        exit();
    }

    $password = md5($password);

    // Query untuk menambahkan data signup ke dalam tabel pengguna
    $query = "INSERT INTO akun (id_rule, nama_lengkap, username, email, telepon, password, jenis_kelamin, created_at) VALUES (9, '$namaLengkap', '$username', '$email', '$noTelepon', '$password', '$gender', '$tanggalWaktu')";

    if (mysqli_query($conn, $query)) {
        // Registrasi berhasil, arahkan pengguna ke halaman login
        // Menutup koneksi database
        mysqli_close($conn);
        header("Location: login");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
};
