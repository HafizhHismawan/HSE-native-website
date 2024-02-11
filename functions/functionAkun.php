<?php
require_once 'koneksi.php';

if ($levelRule !== '8') {
    $queryDataAkun = "SELECT * FROM akun ak, rule r WHERE ak.id_rule = r.id_rule AND ak.id_akun = '$idAkun'";
} else if ($levelRule == 8) {
    $queryDataAkun = "SELECT * FROM akun ak, rule r WHERE ak.id_rule = r.id_rule ORDER BY ak.id_rule ASC";
}
$ambildataAkun = mysqli_query($conn, $queryDataAkun);

$dataRule = mysqli_query($conn, "SELECT * FROM rule WHERE id_rule NOT IN (9)");

if (isset($_POST['submit-changerule'])) {
    $akunId = isset($_POST['akunId']) ? $_POST['akunId'] : '';
    $idRuleOld = isset($_POST['ruleId']) ? $_POST['ruleId'] : '';
    $ruleSelect = isset($_POST['ruleSelect']) ? $_POST['ruleSelect'] : '';

    if ($akunId !== '' && $idRuleOld !== '' && $ruleSelect !== '' && $idRuleOld !== $ruleSelect) {
        $updateRule = mysqli_query($conn, "UPDATE akun SET id_rule = '$ruleSelect' WHERE id_akun = '$akunId'");
        echo "<script>closeModal();</script>";
        echo "<script>alert('Silahkan login kembali!');</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('location: clear-log');
    } else {
        echo "<script>alert('Posisi tidak berhasil disesuaikan!');</script>";
    }
}

if (isset($_POST['submit-editakun'])) {
    $akunId = isset($_POST['akunId']) ? $_POST['akunId'] : '';
    $ruleSelect = isset($_POST['ruleSelect']) ? $_POST['ruleSelect'] : '';
    $akunNama = isset($_POST['akunNama']) ? $_POST['akunNama'] : '';
    $akunUsername = isset($_POST['akunUsername']) ? $_POST['akunUsername'] : '';
    $akunPassword = isset($_POST['akunPassword']) ? $_POST['akunPassword'] : '';
    $akunEmail = isset($_POST['akunEmail']) ? $_POST['akunEmail'] : '';
    $akunTelepon = isset($_POST['akunTelepon']) ? $_POST['akunTelepon'] : '';
    $genderSelect = isset($_POST['genderSelect']) ? $_POST['genderSelect'] : '';

    if ($akunId !== '' && $akunNama !== '' && $akunUsername !== '' && $akunEmail !== '' && $akunTelepon !== '' && $genderSelect !== '') {
        if ($levelRule == 8 && $ruleSelect !== '') {
            $queryUpdateAkun = "UPDATE akun SET nama_lengkap = '$akunNama', id_rule = '$ruleSelect',  username = '$akunUsername', email = '$akunEmail', telepon = '$akunTelepon', jenis_kelamin = '$genderSelect' WHERE id_akun = '$akunId'";
        } else if ($levelRule !== '8') {
            if ($akunPassword == '') {
                $queryUpdateAkun = "UPDATE akun SET nama_lengkap = '$akunNama', username = '$akunUsername', email = '$akunEmail', telepon = '$akunTelepon', jenis_kelamin = '$genderSelect' WHERE id_akun = '$akunId'";
            } else {
                $akunPassword = md5($akunPassword);
                $updateAkun = mysqli_query($conn, "UPDATE akun SET nama_lengkap = '$akunNama', username = '$akunUsername', password = '$akunPassword', email = '$akunEmail', telepon = '$akunTelepon', jenis_kelamin = '$genderSelect' WHERE id_akun = '$akunId'");
                echo "<script>alert('Coba untuk login kembali menggunakan password baru Anda!');</script>";
                // Menutup koneksi database
                mysqli_close($conn);
                return;
            }
        }
        $updateAkun = mysqli_query($conn, $queryUpdateAkun);
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('location: data-akun');
    } else {
        echo "<script>alert('Akun tidak berhasil diedit!');</script>";
    }
}
