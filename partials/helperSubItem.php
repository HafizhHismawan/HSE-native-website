<?php
require_once '../functions/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipeMesinId"])) {
        $tipeMesinId = $_POST["tipeMesinId"];
        // Lakukan query untuk mendapatkan sub items berdasarkan itemMesin
        $result = mysqli_query($conn, "SELECT * FROM sub_inspeksi  WHERE id_tipe_mesin = '$tipeMesinId'");
        // Buat array untuk menyimpan data sub items
        $subItems = array();
        // Ambil hasil query dan masukkan ke dalam array
        while ($dataSelect = mysqli_fetch_array($result)) {
            $subItem = array(
                "id_sub_inspeksi" => $dataSelect['id_sub_inspeksi'],
                "nama_sub_inspeksi" => $dataSelect['nama_sub_inspeksi']
            );
            $subItems[] = $subItem;
        }
        // Kembalikan data dalam bentuk JSON
        echo json_encode($subItems);
    }
}
