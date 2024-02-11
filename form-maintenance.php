<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionFormMaintenance.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>Form Maintenance</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles-form-maintenance.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
</head>

<body>
    <div class="box-form box">
        <form method="post" enctype="multipart/form-data">
            <div class="box-initial">
                <div style="margin-right: 0px;">
                    <div class="flex flex-between" style="margin-bottom: 30px;">
                        <div class="container">
                            <label style="margin-right: 10px;">Mesin</label>
                            <div class="custom-select" style="width:175px;">
                                <select>
                                    <option><?= $tipeMesin; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <label style="margin-right: 10px;">No. Seri</label>
                            <div class="custom-select" style="width:175px;">
                                <select name="id-mesin">
                                    <option><?= $noMesin; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <div class="custom-select" style=" width:100px; margin-right: 0px;">
                                <input class="btn btn-submit" type="submit" name="submit-maintenance" value="Submit"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="container-table">
                <table class="table-rd">
                    <thead>
                        <tr>
                            <th style="border-right: none;"></th>
                            <th style="border-left: none;">Verification Item</th>
                            <th style="text-align: center;">Not Good<br>[ A / NA ]</th>
                            <th style="text-align: center; border-right: none; border-left: none;">Keterangan</th>
                            <th style="border-left: none;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($hitungcekData > 0) {
                            while ($data = mysqli_fetch_array($dataSub)) {
                                $idSub = $data['id_sub_inspeksi'];
                                $namaSub = $data['nama_sub_inspeksi'];
                                $dataItem = mysqli_query($conn, "SELECT * FROM item_verifikasi iv, data_inspeksi di WHERE di.id_item_verifikasi = iv.id_item_verifikasi AND di.id_record_inspeksi = '$idRecordInspeksi' AND di.kondisi_data = 'Not Good' AND id_sub_inspeksi = '$idSub' AND id_tipe_mesin = '$idTipe'");
                                $hitung = mysqli_num_rows($dataItem);
                                if ($hitung > 0) { ?>
                                    <tr>
                                        <td colspan="2"><?= $idSub; ?> <?= $namaSub; ?></td>
                                    </tr>
                                    <?php
                                    while ($dataPertanyaan = mysqli_fetch_array($dataItem)) {
                                        $idItem = $dataPertanyaan['id_item_verifikasi'];
                                        $kodeItem = $dataPertanyaan['kode_item'];
                                        $pertanyaan = $dataPertanyaan['pertanyaan_inspeksi'];
                                        $statusData = $dataPertanyaan['status_data'];
                                        $keterangan = $dataPertanyaan['keterangan'];
                                        $imageBroken = $dataPertanyaan['image_broken'];
                                    ?>
                                        <tr>
                                            <th></th>
                                            <td><?= $kodeItem; ?> <?= $pertanyaan; ?></td>
                                            <td style="text-align: center;"><?= $statusData; ?></td>
                                            <td style="text-align: center;"><?= $keterangan; ?></td>
                                            <td>
                                                <?php if (!empty($imageBroken)) { ?>
                                                    <a href="preview-gambar?verifikasiItem=<?= $pertanyaan; ?>&keteranganItem=<?= $keterangan; ?>&previewItem=<?= $imageBroken; ?>" target="_blank">
                                                        <img src="img/Icon Preview.svg" style="width: 17px; text-align: center;">
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                            <?php }
                                }
                            }
                        } else { ?>
                            <tr>
                                <td style="text-align: center;" colspan="5">Tidak ada kerusakan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Table -->
            <div class="container-table-sparepart">
                <table class="table-rd">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Replace</th>
                            <th style="text-align: center;">Suku Cadang</th>
                            <th style="text-align: center;">Keterangan</th>
                            <th style="text-align: center;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($hitungcekData > 0) {
                            $dataSparepart = mysqli_query($conn, "SELECT * FROM sparepart sp, sparepart_rpn spr WHERE spr.id_sparepart = sp.id_sparepart AND sp.id_tipe_mesin = '$idTipe'");
                            while ($data = mysqli_fetch_array($dataSparepart)) {
                                $idSparepart = $data['id_sparepart'];
                                $idSparepartRPN = $data['id_sparepart_rpn'];
                                $namaSparepart = $data['nama_sparepart'];
                                $jumlahSparepart = $data['jumlah_sparepart'];
                                $keteranganSparepart = $data['keterangan'];
                        ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="checkbox" name="sparepart-<?= $idSparepartRPN; ?>" id="check-sparepart1" value="Replace">
                                        </label>
                                    </td>
                                    <td><?= $namaSparepart; ?><?php if (!empty($keteranganSparepart)) echo ' ( ' . $keteranganSparepart . ' )'; ?></td>
                                    <td style="text-align: center;">
                                        <input type="text" id="keterangan-<?= $idSparepartRPN; ?>" name="keterangan-<?= $idSparepartRPN; ?>">
                                    </td>
                                    <td style="text-align: center;"><?= $jumlahSparepart; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td style="text-align: center;" colspan="4">Tidak ada kerusakan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <?php include 'partials/sidebar-form.php'; ?>

    <script src="js/script_2.js"></script>

</body>

</html>