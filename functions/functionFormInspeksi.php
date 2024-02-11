<?php
require_once 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');
$tanggalHariIni = date('d/m/Y');
$tanggalHariIni2 = date('Y-m-d');
$hitungNG = 0;
$idItems = array();

// Cek apakah parameter idMesin telah diterima
if (isset($_GET['idTipeMesin'])) {
    // Tangkap nilai idMesin
    $idTipe = $_GET['idTipeMesin'];
    if (isset($_GET['statusReminder'])) {
        $statReminder = $_GET['statusReminder'];
    }
} else {
    // Jika parameter idMesin tidak ditemukan
    header("Location: data-inspeksi");
}

// Mengambil data item verifikasi
$dataTipemesin = mysqli_query($conn, "SELECT * FROM tipe_mesin WHERE id_tipe_mesin = '$idTipe'");
$dataMesin = mysqli_query($conn, "SELECT * FROM mesin WHERE id_tipe_mesin = '$idTipe' AND id_status IN (1, 5, 6)");
$dataSub = mysqli_query($conn, "SELECT * FROM sub_inspeksi WHERE id_tipe_mesin = '$idTipe'");
$dataItem = mysqli_query($conn, "SELECT * FROM item_verifikasi WHERE id_tipe_mesin = '$idTipe'");
while ($dataPertanyaan = mysqli_fetch_array($dataItem)) {
    $idItem = $dataPertanyaan['id_item_verifikasi'];
    $idItems[] = $idItem;
}

// Masukkan data recordInspeksi
if (isset($_POST['submit-inspeksi'])) {
    $idMesin = $_POST['id-mesin'];
    if ($idMesin !== '0') {
        $tanggalWaktu = date('Y-m-d H:i:s');
        $tanggalImage = date('YmdHis');

        $query1 = "INSERT INTO record_inspeksi (id_akun_inspektor, id_mesin, tanggal_inspeksi) VALUES ('$idAkun', '$idMesin', '$tanggalWaktu')";

        // Tambah data recordInspeksi berhasil
        if (mysqli_query($conn, $query1)) {
            $cekId = mysqli_query($conn, "SELECT * FROM record_inspeksi WHERE id_akun_inspektor='$idAkun' AND tanggal_inspeksi='$tanggalWaktu'");
            $rowId = mysqli_fetch_assoc($cekId);
            $recordId = $rowId['id_record_inspeksi'];

            $targetDir = "uploadsImageInspeksi/"; // Direktori tempat menyimpan file yang diunggah

            foreach ($idItems as $idItem) {
                $kondisiItem = $_POST['kondisi-' . $idItem];
                if ($kondisiItem == 'Not Good') {
                    $statusItem = isset($_POST['status-' . $idItem]) ? $_POST['status-' . $idItem] : '';
                    $keteranganItem = isset($_POST['keterangan-' . $idItem]) ? $_POST['keterangan-' . $idItem] : '';

                    $fileInfo = isset($_FILES['img-' . $idItem]) ? $_FILES['img-' . $idItem] : null;
                    if ($fileInfo['name'] !== '' || $fileInfo['tmp_name'] !== '' || $fileInfo['type'] !== '') {
                        $imageItem = $recordId . '-' . $idItem . '-' . $tanggalImage . '.jpg';

                        $tempimageItem = $_FILES['img-' . $idItem]['tmp_name'];
                        move_uploaded_file($tempimageItem, $targetDir . $imageItem);
                    } else {
                        $imageItem = '';
                    }

                    $queryInsertItem = "INSERT INTO data_inspeksi (id_record_inspeksi, id_item_verifikasi, kondisi_data, status_data, keterangan, image_broken) VALUES ('$recordId', '$idItem', '$kondisiItem', '$statusItem', '$keteranganItem', '$imageItem')";
                    mysqli_query($conn, $queryInsertItem);

                    $hitungNG = $hitungNG + 1;
                }
            }
            if ($hitungNG > 0) {
                $queryUpdateMesin = "UPDATE mesin SET id_status = '2', terakhir_inspeksi = '$tanggalWaktu' WHERE id_mesin = '$idMesin'";
                $queryUpdateRecord = "UPDATE record_inspeksi SET status_record_inspeksi = 'Bermasalah' WHERE id_record_inspeksi = '$recordId'";
            } else {
                $queryUpdateMesin = "UPDATE mesin SET id_status = '1', terakhir_inspeksi = '$tanggalWaktu' WHERE id_mesin = '$idMesin'";
                $queryUpdateRecord = "UPDATE record_inspeksi SET status_record_inspeksi = 'Baik' WHERE id_record_inspeksi = '$recordId'";
            }
            mysqli_query($conn, $queryUpdateMesin);
            mysqli_query($conn, $queryUpdateRecord);
            // Menutup koneksi database
            mysqli_close($conn);
            header('location: data-inspeksi');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
