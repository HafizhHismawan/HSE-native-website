<?php
require_once 'koneksi.php';


// Cek apakah parameter idRecord telah diterima
if (isset($_GET['idRecord'])) {
    // Tangkap nilai idRecord
    $idRecordMaintenance = $_GET['idRecord'];
} else {
    // Jika parameter idRecord tidak ditemukan
    header("Location: data-maintenance");
}

date_default_timezone_set('Asia/Jakarta');
$tanggalHariIni = date('d/m/Y');
$idItemsSparepart = array();
// Mengambil data
$dataMaintenance = mysqli_query($conn, "SELECT * FROM record_maintenance recm, record_inspeksi rec, mesin m, tipe_mesin tm, akun ak, rule r WHERE recm.id_record_maintenance = '$idRecordMaintenance' AND recm.id_record_inspeksi = rec.id_record_inspeksi AND rec.id_akun_inspektor = ak.id_akun AND ak.id_rule = r.id_rule AND rec.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin");
while ($data = mysqli_fetch_array($dataMaintenance)) {
    $idInspektor = $data['id_akun'];
    $namaInspektor = $data['nama_lengkap'];
    $ruleInspektor = $data['nama_rule'];
    $idTipe = $data['id_tipe_mesin'];
    $tipeMesin = $data['nama_mesin'];
    $idMesin = $data['id_mesin'];
    $noMesin = $data['no_mesin'];
    $tanggalInspeksi = $data['tanggal_inspeksi'];
    $tanggalInspeksi = date("d/m/Y", strtotime($tanggalInspeksi));
    $tanggalMaintenance = $data['tanggal_maintenance'];
    $tanggalMaintenance = date("d/m/Y", strtotime($tanggalMaintenance));
}

$dataSparepart = mysqli_query($conn, "SELECT * FROM data_maintenance dm, sparepart sp, sparepart_rpn spr WHERE dm.id_record_maintenance = '$idRecordMaintenance' AND dm.status_data_maintenance = 'Belum' AND dm.id_sparepart_rpn = spr.id_sparepart_rpn AND spr.id_sparepart = sp.id_sparepart");
while ($dataIdSparepart = mysqli_fetch_array($dataSparepart)) {
    $idItem = $dataIdSparepart['id_data_maintenance'];
    $idItemsSparepart[] = $idItem;
}

// Masukkan data recordMaintenance
if (isset($_POST['submit-maintenance-progress'])) {
    $countFix = 0;
    $tanggalWaktu = date('Y-m-d H:i:s');

    foreach ($idItemsSparepart as $idItem) {
        $sparepartItem = $_POST['sparepart-' . $idItem];
        $keteranganItem = isset($_POST['keterangan-' . $idItem]) ? $_POST['keterangan-' . $idItem] : '';
        $idSparepartItem = isset($_POST['idSparepart-' . $idItem]) ? $_POST['idSparepart-' . $idItem] : '';
        $namaSparepartItem = isset($_POST['namaSparepart-' . $idItem]) ? $_POST['namaSparepart-' . $idItem] : '';
        $jumlahSparepartItem = isset($_POST['jumlahSparepart-' . $idItem]) ? $_POST['jumlahSparepart-' . $idItem] : '';
        $totalSparepart = $jumlahSparepartItem - 1;

        if ($sparepartItem == 'Fix' && $totalSparepart >= 0) {
            $keteranganSparepart = $nama . ' menggunakan suku cadang ' . $namaSparepartItem . ' sebanyak 1 unit untuk perbaikan ' . $tipeMesin . ' [ ' . $noMesin . ' ], sehingga dari total stok ' . $jumlahSparepartItem . ' unit menjadi ' . $totalSparepart . ' unit';
            $updateSparepart = mysqli_query($conn, "UPDATE sparepart SET jumlah_sparepart = '$totalSparepart' WHERE id_sparepart = '$idSparepartItem'");
            $queryRecordSparepart = mysqli_query($conn, "INSERT INTO record_sparepart (id_sparepart, id_akun_gudang, tindakan, jumlah, keterangan_tindakan, tanggal_sparepart) VALUES ('$idSparepartItem', '$idAkun', 'Gunakan', '1', '$keteranganSparepart', '$tanggalWaktu')");

            $queryUpdateData = "UPDATE data_maintenance SET status_data_maintenance = 'Sudah' WHERE id_data_maintenance = '$idItem'";
            $countFix = $countFix + 1;
        } else if ($sparepartItem == 'Pending' || $totalSparepart < 0) {
            $queryUpdateData = "UPDATE data_maintenance SET keterangan_data_maintenance = '$keteranganItem' WHERE id_data_maintenance = '$idItem'";
        }
        mysqli_query($conn, $queryUpdateData);
    }

    if ($countFix == count($idItemsSparepart)) {
        $updateMesin = mysqli_query($conn, "UPDATE mesin SET id_status = '1' WHERE id_mesin = '$idMesin'");
        $updateRecord = mysqli_query($conn, "UPDATE record_maintenance SET end_maintenance = '$tanggalWaktu', status_record_maintenance = 'Sudah' WHERE id_record_maintenance = '$idRecordMaintenance'");
    } else if ($countFix < count($idItemsSparepart)) {
        $updateMesin = mysqli_query($conn, "UPDATE mesin SET id_status = '4' WHERE id_mesin = '$idMesin'");
    }
    // Menutup koneksi database
    mysqli_close($conn);
    header("Location: data-maintenance");
}
