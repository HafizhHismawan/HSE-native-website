<?php
require_once 'koneksi.php';
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('location: dashboard');
}
// Cek login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
    // Cek database untuk Email dan Password yg sesuai
    $cekdatabase = mysqli_query($conn, "SELECT * FROM akun ak, rule r WHERE ak.username='$username' AND ak.password='$password' AND ak.id_rule = r.id_rule");
    // Jumlah data jika Email dan Password ditemukan
    $hitung = mysqli_num_rows($cekdatabase);

    // Jika benar, maka dialihkan ke halaman dashboard
    // Jika salah, maka tetap di halaman login
    if ($hitung > 0) {
        $row = mysqli_fetch_assoc($cekdatabase);
        $idAkun = $row['id_akun'];
        $idRule = $row['id_rule'];
        $namaRule = $row['nama_rule'];
        $levelRule = $row['level_rule'];
        $nama = $row['nama_lengkap'];
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['id_akun'] = $idAkun;
        $_SESSION['id_rule'] = $idRule;
        $_SESSION['nama_rule'] = $namaRule;
        $_SESSION['level_rule'] = $levelRule;
        $_SESSION['nama'] = $nama;
        $_SESSION['statNotify'] = false;

        if ($levelRule == 7) {
            // Menutup koneksi database
            mysqli_close($conn);
            header('location:data-akun');
        } else {
            // Menutup koneksi database
            mysqli_close($conn);
            header('location:dashboard');
        }
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    };
};
