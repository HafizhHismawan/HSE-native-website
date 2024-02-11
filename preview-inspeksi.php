<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionPreviewInspeksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>Preview Inspeksi <?= $namaTipeMesin; ?> [<?= $noMesin; ?>]</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles-form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
    <style>
        /* Ganti warna cerah yang Anda inginkan, misalnya hijau */
        input[type="radio"][disabled]:checked::before {
            content: '';
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #9DC08B;
            margin: 2px 2px;
        }
    </style>
</head>

<body>
    <div class="box-form box">
        <form method="post">
            <div class="box-initial">
                <div style="margin-right: 0px;">
                    <div class="flex flex-between" style="margin-bottom: 30px;">
                        <div class="container">
                            <label style="margin-right: 10px;">Mesin</label>
                            <div class="custom-select" style="width:175px;">
                                <select>
                                    <option><?= $namaTipeMesin; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <label style="margin-right: 10px;">No. Seri</label>
                            <div class="custom-select" style="width:175px;">
                                <select>
                                    <option><?= $noMesin; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <div class="custom-select" style=" width:175px; margin-right: 0px;">
                                <input class="btn btn-submit" type="submit" name="submit-kembali" value="Kembali"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="container-table" style="max-height: 550px; overflow-y: auto;">
                <table class="table-rd">
                    <thead>
                        <tr>
                            <th style="border-right: none;"></th>
                            <th style="border-left: none;">Verification Item</th>
                            <th style="text-align: center;">G</th>
                            <th style="text-align: center;">NG</th>
                            <th style="text-align: center;">A</th>
                            <th style="text-align: center;">NA</th>
                            <th style="text-align: center; border-right: none; border-left: none;">Keterangan</th>
                            <th style="border-left: none;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($dataSub)) {
                            $idSub = $data['id_sub_inspeksi'];
                            $namaSub = $data['nama_sub_inspeksi'];
                        ?>
                            <tr>
                                <td colspan="2"><?= $idSub; ?> <?= $namaSub; ?></td>
                            </tr>
                            <?php
                            $dataItemInspeksi = mysqli_query($conn, "SELECT * FROM item_verifikasi WHERE id_sub_inspeksi = '$idSub' AND id_tipe_mesin = '$idTipeMesin'");
                            while ($dataPertanyaan = mysqli_fetch_array($dataItemInspeksi)) {
                                $idItem = $dataPertanyaan['id_item_verifikasi'];
                                $kodeItem = $dataPertanyaan['kode_item'];
                                $pertanyaan = $dataPertanyaan['pertanyaan_inspeksi'];
                                $cekdataInspeksi = mysqli_query($conn, "SELECT * FROM data_inspeksi WHERE id_record_inspeksi = '$idRecord' AND id_item_verifikasi = '$idItem'");
                                if ($cekdataInspeksi && mysqli_num_rows($cekdataInspeksi) > 0) {
                                    while ($dataCek = mysqli_fetch_array($cekdataInspeksi)) {
                                        $kondisiData = $dataCek['kondisi_data'];
                                        $statusData = $dataCek['status_data'];
                                        $keteranganData = $dataCek['keterangan'];
                                        $imageData = $dataCek['image_broken'];
                                    }
                                }
                            ?>
                                <tr>
                                    <th></th>
                                    <td><?= $kodeItem; ?> <?= $pertanyaan; ?></td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="kondisi-<?= $idItem; ?>" <?= (!empty($kondisiData) && $kondisiData == 'Not Good') ? '' : 'checked'; ?> disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="kondisi-<?= $idItem; ?>" <?= (!empty($kondisiData) && $kondisiData == 'Not Good') ? 'checked' : ''; ?> disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="status-<?= $idItem; ?>" <?= (!empty($statusData) && $statusData == 'Available') ? 'checked' : ''; ?> disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="status-<?= $idItem; ?>" <?= (!empty($statusData) && $statusData == 'Not Available') ? 'checked' : ''; ?> disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><input type="text" id='keterangan-<?= $idItem; ?>' name='keterangan-<?= $idItem; ?>' value="<?= (!empty($keteranganData)) ? $keteranganData : ''; ?>" readonly></td>
                                    <td>
                                        <?php if (!empty($imageData)) { ?>
                                            <a href="preview-gambar?verifikasiItem=<?= $pertanyaan; ?>&keteranganItem=<?= $keteranganData; ?>&previewItem=<?= $imageData; ?>" target="_blank">
                                                <img src="img/Icon Preview.svg" style="width: 17px; text-align: center;">
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <?php include 'partials/sidebar-form.php'; ?>

    <script src="js/script_2.js"></script>

</body>

</html>