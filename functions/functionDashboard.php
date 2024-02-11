<?php
require_once 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');
$tanggalHariIni = date('Y-m-d');
$tanggalWaktu = date('Y-m-d H:i:s');

// Untuk tampilan summary
if ($levelRule == 1) {
    $ambildataPegawai = mysqli_query($conn, "SELECT * FROM akun ak, rule r WHERE ak.id_rule = r.id_rule AND r.level_rule IN (3, 5, 6) ORDER BY ak.id_akun ASC");
    $ambildataMesin = mysqli_query($conn, "SELECT * FROM mesin m, tipe_mesin tm, status_mesin sm WHERE m.id_tipe_mesin = tm.id_tipe_mesin AND m.id_status = sm.id_status ORDER BY m.id_mesin ASC");
    $ambildataSparepart = mysqli_query($conn, "SELECT * FROM tipe_mesin tm, sparepart sp WHERE sp.id_tipe_mesin = tm.id_tipe_mesin ORDER BY sp.id_sparepart ASC");
    $ambildataStatus = mysqli_query($conn, "SELECT * FROM status_mesin ORDER BY id_status ASC");
}

// Untuk tampilan reminder Preventive Maintenance
if ($levelRule == 4 || $levelRule == 5) {
    $hitungReminder = 0;
    $ambildataSparepartTM = mysqli_query($conn, "SELECT * FROM tipe_mesin tm, sparepart sp, sparepart_tm spt WHERE sp.id_tipe_mesin = tm.id_tipe_mesin AND spt.id_sparepart = sp.id_sparepart ORDER BY spt.tanggal_tm ASC");
}

if (isset($_POST['submit-finish'])) {
    $idSparepartTM = isset($_POST['idTM']) ? $_POST['idTM'] : '';
    $updateTM = isset($_POST['updateTM']) ? $_POST['updateTM'] : '';
    if ($idSparepartTM !== '' && $updateTM !== '') {
        $queryPreventive = mysqli_query($conn, "INSERT INTO record_preventive (id_sparepart_tm, id_akun_teknisi, tanggal_preventive) VALUES ('$idSparepartTM', '$idAkun', '$tanggalWaktu')");
        $updateTanggalTM = mysqli_query($conn, "UPDATE sparepart_tm SET tanggal_tm = '$updateTM' WHERE id_sparepart_tm = '$idSparepartTM'");
        // Menutup koneksi database
        mysqli_close($conn);
    } else {
        echo "<script>alert('Penyelesaian Preventive Maintenance belum berhasil, ulangi lagi!');</script>";
    }
    header('location: dashboard');
} else if (isset($_POST['submit-kembali'])) {
    echo "<script>closeModal2();</script>";
}
