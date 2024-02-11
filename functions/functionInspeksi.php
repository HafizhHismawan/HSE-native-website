<?php
require_once 'koneksi.php';

$ambildataInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi rec, akun ak, rule r, mesin m, tipe_mesin tm, status_mesin sm  WHERE rec.id_akun_inspektor = ak.id_akun AND rec.id_mesin = m.id_mesin AND m.id_status = sm.id_status AND m.id_status IN (2, 3, 4) AND m.id_tipe_mesin = tm.id_tipe_mesin AND ak.id_rule = r.id_rule");
$dataTipemesin = mysqli_query($conn, "SELECT * FROM tipe_mesin");

if (isset($_POST['submit-tipemesin'])) {
    $tipeMesin = isset($_POST['mesinSelect']) ? $_POST['mesinSelect'] : '';

    if (!empty($tipeMesin)) {
        // Menutup koneksi database
        mysqli_close($conn);
        header(
            "Location: form-inspeksi?idTipeMesin=$tipeMesin"
        );
    } else {
        return;
    }
}

// Untuk halaman all-inspeksi
$ambildataMesin = mysqli_query($conn, "SELECT * FROM mesin m, tipe_mesin tm WHERE m.id_tipe_mesin = tm.id_tipe_mesin");
$ambilallInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi rec, akun ak, rule r, mesin m, tipe_mesin tm WHERE rec.id_akun_inspektor = ak.id_akun AND rec.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin AND ak.id_rule = r.id_rule");
