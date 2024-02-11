<?php
require_once 'koneksi.php';

$ambildataMesin = mysqli_query($conn, "SELECT * FROM mesin m, tipe_mesin tm, status_mesin sm WHERE m.id_tipe_mesin = tm.id_tipe_mesin AND m.id_status = sm.id_status ORDER BY m.id_mesin ASC");
$dataStatusMesin = mysqli_query($conn, "SELECT * FROM status_mesin WHERE id_status IN (5,6)");

if (isset($_POST['submit-changestatus'])) {
    $idItem = isset($_POST['mesinId']) ? $_POST['mesinId'] : '';
    $namaItem = isset($_POST['mesinNama']) ? $_POST['mesinNama'] : '';
    $statusItemOld = isset($_POST['statusIdOld']) ? $_POST['statusIdOld'] : '';
    $statusSelectItem = isset($_POST['statusSelect']) ? $_POST['statusSelect'] : '';

    if ($idItem !== '' && $namaItem !== '' && $statusItemOld !== '' && $statusSelectItem !== '' && $statusItemOld !== $statusSelectItem) {
        $updateSparepart = mysqli_query($conn, "UPDATE mesin SET id_status = '$statusSelectItem' WHERE id_mesin = '$idItem'");
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('Location: data-mesin');
    } else if ($statusItemOld == $statusSelectItem) {
        echo "<script>alert('Pilihan sama, pastikan pilihan sesuai!');</script>";
    } else {
        echo "<script>alert('Status Mesin [$namaItem] tidak berhasil diganti!');</script>";
    }
}
