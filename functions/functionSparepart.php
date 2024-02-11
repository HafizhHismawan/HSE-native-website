<?php
require_once 'koneksi.php';

$ambildataSparepart = mysqli_query($conn, "SELECT * FROM sparepart sp, tipe_mesin tm WHERE sp.id_tipe_mesin = tm.id_tipe_mesin");

if (isset($_POST['submit-addstok'])) {
    $idItem = isset($_POST['sparepartId']) ? $_POST['sparepartId'] : '';
    $tambahItem = isset($_POST['tambahStok']) ? $_POST['tambahStok'] : '';
    $namaItem = isset($_POST['sparepartNama']) ? $_POST['sparepartNama'] : '';
    $jumlahItem = isset($_POST['sparepartStok']) ? $_POST['sparepartStok'] : '';

    if ($idItem !== '' && $namaItem !== '' && $tambahItem !== '' && $jumlahItem !== '') {
        date_default_timezone_set('Asia/Jakarta');
        $tanggalWaktu = date('Y-m-d H:i:s');
        $totalSparepart = $tambahItem + $jumlahItem;
        $keterangan = $nama . ' menambahkan stok suku cadang ' . $namaItem . ', dari jumlah ' . $jumlahItem . ' unit ditambahkan sebanyak ' . $tambahItem . ' unit sehingga menjadi ' . $totalSparepart . ' unit.';
        $updateSparepart = mysqli_query($conn, "UPDATE sparepart SET jumlah_sparepart = '$totalSparepart' WHERE id_sparepart = '$idItem'");
        $queryRecord = mysqli_query($conn, "INSERT INTO record_sparepart (id_sparepart, id_akun_gudang, tindakan, jumlah, keterangan_tindakan, tanggal_sparepart) VALUES ('$idItem', '$idAkun', 'Tambah', '$jumlahItem', '$keterangan', '$tanggalWaktu')");
        echo "<script>closeModal();</script>";
        // Menutup koneksi database
        mysqli_close($conn);
        header('Location: data-suku-cadang');
    } else {
        echo "<script>alert('Stok [$namaItem] tidak berhasil ditambahkan!');</script>";
    }
}

$ambildataSparepart = mysqli_query($conn, "SELECT * FROM sparepart sp, tipe_mesin tm WHERE sp.id_tipe_mesin = tm.id_tipe_mesin");

// Untuk halaman all-suku-cadang
$ambilallSparepart = mysqli_query($conn, "SELECT * FROM record_sparepart recs, sparepart sp, tipe_mesin tm, akun ak WHERE recs.id_sparepart = sp.id_sparepart AND sp.id_tipe_mesin = tm.id_tipe_mesin AND recs.id_akun_gudang = ak.id_akun ORDER BY recs.tanggal_sparepart");
