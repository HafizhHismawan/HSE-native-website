<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionFormInspeksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>Form Inspeksi</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles-form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">

    <style>
        /* Menghapus dekorasi dan menampilkan kata Upload pada elemen input file */
        input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="box-form box">
        <form onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
            <div class="box-initial">
                <div style="margin-right: 0px;">
                    <div class="flex flex-between" style="margin-bottom: 30px;">
                        <div class="container">
                            <label style="margin-right: 10px;">Mesin</label>
                            <div class="custom-select" style="width:175px;">
                                <select>
                                    <?php
                                    while ($data = mysqli_fetch_array($dataTipemesin)) {
                                        $idTipe = $data['id_tipe_mesin'];
                                        $namaMesin = $data['nama_mesin'];
                                    ?>
                                        <option><?= $namaMesin; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <label style="margin-right: 10px;">No. Seri</label>
                            <div class="custom-select" style="width:175px;">
                                <select name="id-mesin" id="id-mesin">
                                    <option value="0">ㅤ</option>
                                    <?php
                                    while ($data = mysqli_fetch_array($dataMesin)) {
                                        $idMesin = $data['id_mesin'];
                                        $noMesin = $data['no_mesin'];
                                    ?>
                                        <option value="<?= $idMesin; ?>"><?= $noMesin; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <div class="custom-select" style=" width:175px; margin-right: 0px;">
                                <input class="btn btn-submit" type="submit" name="submit-inspeksi" value="Submit"></input>
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
                            <th></th>
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
                            $dataItem = mysqli_query($conn, "SELECT * FROM item_verifikasi WHERE id_sub_inspeksi = '$idSub' AND id_tipe_mesin = '$idTipe'");
                            while ($dataPertanyaan = mysqli_fetch_array($dataItem)) {
                                $idItem = $dataPertanyaan['id_item_verifikasi'];
                                $kodeItem = $dataPertanyaan['kode_item'];
                                $pertanyaan = $dataPertanyaan['pertanyaan_inspeksi'];
                            ?>
                                <tr>
                                    <th></th>
                                    <td><?= $kodeItem; ?> <?= $pertanyaan; ?></td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="kondisi-<?= $idItem; ?>" id="dot-1" value="Good" required>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="kondisi-<?= $idItem; ?>" id="dot-2" value="Not Good" required>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="status-<?= $idItem; ?>" id="dot-3" value="Available">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="form-check-custom">
                                            <input type="radio" name="status-<?= $idItem; ?>" id="dot-4" value="Not Available">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><a onclick="clearRadioSelection('status-<?= $idItem; ?>')"><img src="img/Icon Remove.svg" style="width: 20px; text-align: center;"></a></td>
                                    <td><input type="text" id='keterangan-<?= $idItem; ?>' name='keterangan-<?= $idItem; ?>'></td>
                                    <td>
                                        <label class="custom-file-upload" for="img-<?= $idItem; ?>"><img src="img/camera.png" style="width: 17px; text-align: center;"></label>
                                        <input type="file" id="img-<?= $idItem; ?>" name="img-<?= $idItem; ?>" accept=".jpg, .jpeg">
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
    <script src="js/script_4.js"></script>

</body>

</html>