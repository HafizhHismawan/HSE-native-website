<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionMesin.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Data Mesin</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/style4.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
</head>

<body>
    <navbar>
        <?php include 'partials/navbar-dashboard.php'; ?>
    </navbar>

    <sidebar>
        <?php include 'partials/sidebar.php'; ?>
    </sidebar>

    <main>
        <h2 style="font-weight: lighter; margin-bottom: 20px">Data Mesin</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 2 || $levelRule == 3 || $levelRule == 4 || $levelRule == 5) { ?>
                        <td></td>
                    <?php } ?>
                    <td>Nomer Mesin</td>
                    <td>Tipe Mesin</td>
                    <td>Status Mesin</td>
                    <td>Terakhir Inspeksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambildataMesin)) {
                    $idMesin = $data['id_mesin'];
                    $tipeMesin = $data['nama_mesin'];
                    $noMesin = $data['no_mesin'];
                    $idStatus = $data['id_status'];
                    $status = $data['keterangan_status'];
                    $tanggal = $data['terakhir_inspeksi'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                ?>
                    <tr>
                        <?php if ($levelRule == 2 || $levelRule == 3 || $levelRule == 4 || $levelRule == 5) { ?>
                            <td style="text-align: center;">
                                <?php if ($idStatus !== '2' && $idStatus !== '3' && $idStatus !== '4') { ?>
                                    <a href="#" onclick="openModalMesin('<?= $idMesin; ?>', '<?= $noMesin; ?>', '<?= $idStatus; ?>')"><img src="img/Icon Edit 2.png" style="width: 17px;"></a>
                                <?php } ?>
                            </td>
                        <?php } ?>
                        <td><?= $noMesin; ?></td>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $status; ?></td>
                        <td><?= $tanggal_baru; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <!-- Add Stock Modal popup-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 style="text-align: center;">Ubah Status Mesin</h3>
            <br>
            <form method="post" onsubmit="return validateForm('statusSelect', 'Status Mesin')">
                <label for="statusSelect">Status:</label>
                <select style="padding: 5px 5px;" id="statusSelect" name="statusSelect">
                    <option value="0">ㅤ</option>
                    <?php
                    while ($dataSelect = mysqli_fetch_array($dataStatusMesin)) {
                        $idStatusData = $dataSelect['id_status'];
                        $keteranganStatus = $dataSelect['keterangan_status'];
                    ?>
                        <option value="<?= $idStatusData; ?>"><?= $keteranganStatus; ?></option>
                    <?php } ?>
                </select>
                <input type="hidden" id="mesinId" name="mesinId" value="">
                <input type="hidden" id="mesinNama" name="mesinNama" value="">
                <input type="hidden" id="statusIdOld" name="statusIdOld" value="">
                <input style="margin-left: 20px; padding: 5px 20px;" type="submit" name="submit-changestatus" value="Pilih"></input>
            </form>
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script_3.js"></script>
    <script>
        hideOptionZero(document.getElementById("statusSelect"));
    </script>
</body>

</html>