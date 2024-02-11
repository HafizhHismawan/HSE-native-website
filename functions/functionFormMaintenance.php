<?php
require_once 'koneksi.php';

// Cek apakah parameter idMesin telah diterima
if (isset($_GET['idRecord'])) {
    // Tangkap nilai idMesin
    $idRecordInspeksi = $_GET['idRecord'];
} else {
    // Jika parameter idMesin tidak ditemukan
    header("Location: data-maintenance");
}

date_default_timezone_set('Asia/Jakarta');
$tanggalHariIni = date('d/m/Y');
$idItemsSparepart = array();
// Mengambil data
$dataInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi rec, mesin m, tipe_mesin tm, akun ak, rule r WHERE id_record_inspeksi = '$idRecordInspeksi' AND rec.id_akun_inspektor = ak.id_akun AND ak.id_rule = r.id_rule AND rec.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin");
while ($data = mysqli_fetch_array($dataInspeksi)) {
    $idInspektor = $data['id_akun'];
    $namaInspektor = $data['nama_lengkap'];
    $ruleInspektor = $data['nama_rule'];
    $idTipe = $data['id_tipe_mesin'];
    $tipeMesin = $data['nama_mesin'];
    $idMesin = $data['id_mesin'];
    $noMesin = $data['no_mesin'];
    $tanggalInspeksi = $data['tanggal_inspeksi'];
    $tanggalInspeksi = date("d/m/Y", strtotime($tanggalInspeksi));
}

$dataSub = mysqli_query($conn, "SELECT * FROM sub_inspeksi WHERE id_tipe_mesin = '$idTipe'");

$cekdataInspeksi = mysqli_query($conn, "SELECT * FROM data_inspeksi di WHERE id_record_inspeksi = '$idRecordInspeksi' AND kondisi_data = 'Not Good'");
$hitungcekData = mysqli_num_rows($cekdataInspeksi);

$dataSparepart = mysqli_query($conn, "SELECT * FROM sparepart sp, sparepart_rpn spr WHERE spr.id_sparepart = sp.id_sparepart AND sp.id_tipe_mesin = '$idTipe'");
while ($dataIdSparepart = mysqli_fetch_array($dataSparepart)) {
    $idItem = $dataIdSparepart['id_sparepart_rpn'];
    $idItemsSparepart[] = $idItem;
}

// Masukkan data recordMaintenance
if (isset($_POST['submit-maintenance'])) {
    if ($hitungcekData > 0) {
        $tanggalWaktu = date('Y-m-d H:i:s');
        $tanggalImage = date('YmdHis');

        $query1 = "INSERT INTO record_maintenance (id_record_inspeksi, id_akun_teknisi, tanggal_maintenance, status_record_maintenance) VALUES ('$idRecordInspeksi', '$idAkun', '$tanggalWaktu', 'Belum')";

        // Tambah data recordMaintenance berhasil
        if (mysqli_query($conn, $query1)) {
            $cekId = mysqli_query($conn, "SELECT * FROM record_maintenance WHERE id_record_inspeksi='$idRecordInspeksi' AND tanggal_maintenance='$tanggalWaktu'");
            $rowId = mysqli_fetch_assoc($cekId);
            $recordId = $rowId['id_record_maintenance'];

            foreach ($idItemsSparepart as $idItem) {
                $sparepartItem = isset($_POST['sparepart-' . $idItem]) ? $_POST['sparepart-' . $idItem] : '';
                $keteranganItem = isset($_POST['keterangan-' . $idItem]) ? $_POST['keterangan-' . $idItem] : '';

                if ($sparepartItem !== '') {
                    $queryInsertItem = "INSERT INTO data_maintenance (id_record_maintenance, id_sparepart_rpn, status_data_maintenance, keterangan_data_maintenance) VALUES ('$recordId', '$idItem', 'Belum', '$keteranganItem')";
                    mysqli_query($conn, $queryInsertItem);
                }
            }
            $updateMesin = mysqli_query($conn, "UPDATE mesin SET id_status = '2' WHERE id_mesin = '$idMesin'");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        $updateMesin = mysqli_query($conn, "UPDATE mesin SET id_status = '1' WHERE id_mesin = '$idMesin'");
    }
    // Menutup koneksi database
    mysqli_close($conn);
    header("Location: data-maintenance");

    // Menutup koneksi database
    mysqli_close($conn);
}
