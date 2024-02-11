<?php
require_once 'koneksi.php';

$ambilitemInspeksi = mysqli_query($conn, "SELECT * FROM item_verifikasi iv, sub_inspeksi si, tipe_mesin tm  WHERE iv.id_sub_inspeksi = si.id_sub_inspeksi AND iv.id_tipe_mesin = tm.id_tipe_mesin AND si.id_tipe_mesin = tm.id_tipe_mesin ORDER BY iv.id_tipe_mesin ASC");
$ambildataTipeMesin = mysqli_query($conn, "SELECT * FROM tipe_mesin");

if (isset($_POST['submit-additem'])) {
    $idTipeMesin = isset($_POST['tipeMesinId']) ? $_POST['tipeMesinId'] : '';
    $idItemSub = isset($_POST['itemSub']) ? $_POST['itemSub'] : '';
    $itemKode = isset($_POST['itemKode']) ? $_POST['itemKode'] : '';
    $itemInspeksi = isset($_POST['itemInspeksi']) ? $_POST['itemInspeksi'] : '';

    if ($idTipeMesin !== '' && $idItemSub !== '' && $itemKode !== '' && $itemInspeksi !== '') {
        $addItemInspeksi = mysqli_query($conn, "INSERT INTO item_verifikasi (id_sub_inspeksi, id_tipe_mesin, kode_item, pertanyaan_inspeksi) VALUES ('$idItemSub', '$idTipeMesin', '$itemKode', '$itemInspeksi')");
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('location: item-inspeksi');
    } else {
        echo "<script>closeModal();</script>";
        echo "<script>alert('Tidak berhasil disimpan, ulangi lagi!');</script>";
    }
}

if (isset($_POST['submit-edititem'])) {
    $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : '';
    $itemKode = isset($_POST['itemKode2']) ? $_POST['itemKode2'] : '';
    $itemInspeksi = isset($_POST['itemInspeksi2']) ? $_POST['itemInspeksi2'] : '';

    if ($itemId !== '' && $itemKode !== '' && $itemInspeksi !== '') {
        $addItemInspeksi = mysqli_query($conn, "UPDATE item_verifikasi SET kode_item = '$itemKode', pertanyaan_inspeksi = '$itemInspeksi' WHERE id_item_verifikasi = '$itemId'");
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('location: item-inspeksi');
    } else {
        echo "<script>closeModal();</script>";
        echo "<script>alert('Tidak berhasil disimpan, ulangi lagi!');</script>";
    }
}

if (isset($_POST['submit-removeitem'])) {
    $itemId = isset($_POST['itemId2']) ? $_POST['itemId2'] : '';

    if ($itemId !== '') {
        $addItemInspeksi = mysqli_query($conn, "DELETE FROM item_verifikasi WHERE id_item_verifikasi = '$itemId'");
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('location: item-inspeksi');
    } else {
        echo "<script>closeModal();</script>";
        echo "<script>alert('Tidak berhasil dihapus, ulangi lagi!');</script>";
    }
} else if (isset($_POST['submit-batal'])) {
    echo "<script>closeModal();</script>";
}
