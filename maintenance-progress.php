<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionMaintenanceProgress.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>Form Maintenance Progress</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles-form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
</head>

<body>
    <div class="box-form box">
        <form method="post" enctype="multipart/form-data">
            <div class="box-initial">
                <div style="margin-right: 0px;">
                    <div class="flex flex-between" style="margin-bottom: 50px;">
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
                                <input class="btn btn-submit" type="submit" name="submit-maintenance-progress" value="Submit"></input>
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
                            <th style="text-align: center; border-right: none;">Suku Cadang</th>
                            <th style="text-align: center; border-left: none;">RPN</th>
                            <th style="text-align: center;">Fix</th>
                            <th style="text-align: center;">Pending</th>
                            <th style="text-align: center;">Keterangan</th>
                            <th style="text-align: center;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataSparepart = mysqli_query($conn, "SELECT * FROM data_maintenance dm, sparepart sp, sparepart_rpn spr WHERE dm.id_record_maintenance = '$idRecordMaintenance' AND dm.status_data_maintenance = 'Belum' AND dm.id_sparepart_rpn = spr.id_sparepart_rpn AND spr.id_sparepart = sp.id_sparepart ORDER BY spr.nilai_rpn DESC");
                        while ($data = mysqli_fetch_array($dataSparepart)) {
                            $idDataMaintenance = $data['id_data_maintenance'];
                            $idSparepart = $data['id_sparepart'];
                            $namaSparepart = $data['nama_sparepart'];
                            $rpnSparepart = $data['nilai_rpn'];
                            $jumlahSparepart = $data['jumlah_sparepart'];
                            $keteranganSparepart = $data['keterangan'];
                            $keteranganMaintenance = $data['keterangan_data_maintenance'];
                        ?>
                            <tr>
                                <td><?= $namaSparepart; ?> <?php if (!empty($keteranganSparepart)) echo '( ' . $keteranganSparepart . ' )'; ?></td>
                                <td style="text-align: center;"><?= $rpnSparepart; ?></td>
                                <td style="text-align: center;">
                                    <label class="form-check-custom">
                                        <input type="radio" name="sparepart-<?= $idDataMaintenance; ?>" id="dot-1" value="Fix" required>
                                        <span></span>
                                    </label>
                                </td>
                                <td style="text-align: center;">
                                    <label class="form-check-custom">
                                        <input type="radio" name="sparepart-<?= $idDataMaintenance; ?>" id="dot-2" value="Pending" required>
                                        <span></span>
                                    </label>
                                </td>
                                <td style="text-align: center;">
                                    <input type="text" id="keterangan-<?= $idDataMaintenance; ?>" name="keterangan-<?= $idDataMaintenance; ?>" value="<?= $keteranganMaintenance; ?>">
                                </td>
                                <td style="text-align: center;"><?= $jumlahSparepart; ?></td>
                                <input type="hidden" id="idSparepart-<?= $idDataMaintenance; ?>" name="idSparepart-<?= $idDataMaintenance; ?>" value="<?= $idSparepart; ?>">
                                <input type="hidden" id="namaSparepart-<?= $idDataMaintenance; ?>" name="namaSparepart-<?= $idDataMaintenance; ?>" value="<?= $namaSparepart; ?>">
                                <input type="hidden" id="jumlahSparepart-<?= $idDataMaintenance; ?>" name="jumlahSparepart-<?= $idDataMaintenance; ?>" value="<?= $jumlahSparepart; ?>">
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