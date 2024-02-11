<?php
require_once 'koneksi.php';

if (isset($_GET['idRecord'])) {
    $idRecord = $_GET['idRecord'];
} else {
    // Jika parameter idRecord tidak ditemukan
    header("Location: data-inspeksi");
}

$ambildataRecord = mysqli_query($conn, "SELECT * FROM record_inspeksi rec, akun ak, rule r, mesin m, tipe_mesin tm WHERE rec.id_akun_inspektor = ak.id_akun AND ak.id_rule = r.id_rule AND rec.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin AND id_record_inspeksi = '$idRecord'");
while ($dataRecord = mysqli_fetch_array($ambildataRecord)) {
    $idTipeMesin = $dataRecord['id_tipe_mesin'];
    $namaTipeMesin = $dataRecord['nama_mesin'];
    $noMesin = $dataRecord['no_mesin'];
    $namaInspektor = $dataRecord['nama_lengkap'];
    $ruleInspektor = $dataRecord['nama_rule'];
    $tanggalInspeksi = $dataRecord['tanggal_inspeksi'];
    $tanggalInspeksi = date("d/m/Y H:i:s", strtotime($tanggalInspeksi));
}
$dataSub = mysqli_query($conn, "SELECT * FROM sub_inspeksi WHERE id_tipe_mesin = '$idTipeMesin'");

if (isset($_POST['submit-kembali'])) {
    header('location: data-inspeksi');
}
