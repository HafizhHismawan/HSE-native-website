<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionInspeksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Report Inspeksi</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css" />
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
        <?php if ($levelRule == 2 || $levelRule == 8) { ?>
            <h2 style="font-weight: lighter; margin-bottom: 10px">Summary Inspeksi</h2>
            <table id="example" class="row-border" style="width:100%">
                <thead>
                    <tr>
                        <td>Tipe Mesin</td>
                        <td>Nomer Mesin</td>
                        <td>Inspeksi</td>
                        <td>Not Good - Available</td>
                        <td>Not Good - Not Available</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($ambildataMesin)) {
                        $idMesin = $data['id_mesin'];
                        $tipeMesin = $data['nama_mesin'];
                        $noMesin = $data['no_mesin'];
                        $cekInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi WHERE id_mesin = '$idMesin'");
                        $hitungInspeksi = mysqli_num_rows($cekInspeksi);
                        $cekNgAv = mysqli_query($conn, "SELECT * FROM record_inspeksi reci, data_inspeksi di WHERE reci.id_mesin = '$idMesin' AND reci.id_record_inspeksi = di.id_record_inspeksi AND di.status_data = 'Available'");
                        $hitungNgAv = mysqli_num_rows($cekNgAv);
                        $cekNgNA = mysqli_query($conn, "SELECT * FROM record_inspeksi reci, data_inspeksi di WHERE reci.id_mesin = '$idMesin' AND reci.id_record_inspeksi = di.id_record_inspeksi AND di.status_data = 'Not Available'");
                        $hitungNgNA = mysqli_num_rows($cekNgNA);
                    ?>
                        <tr>
                            <td><?= $tipeMesin; ?></td>
                            <td><?= $noMesin; ?></td>
                            <td style="text-align: center;"><?= $hitungInspeksi; ?> kali</td>
                            <td style="text-align: center;"><?= $hitungNgAv; ?> item</td>
                            <td style="text-align: center;"><?= $hitungNgNA; ?> item</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        <?php } ?>
        <h2 style="font-weight: lighter; margin-bottom: 10px">Record Data Inspeksi</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 2 || $levelRule == 3) { ?>
                        <td></td>
                    <?php } ?>
                    <td>Inspektor</td>
                    <td>Tipe Mesin</td>
                    <td>Nomer Mesin</td>
                    <td>Tanggal Inspeksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambilallInspeksi)) {
                    $idRecord = $data['id_record_inspeksi'];
                    $inspektor = $data['nama_lengkap'];
                    $tipeMesin = $data['nama_mesin'];
                    $noMesin = $data['no_mesin'];
                    $tanggal = $data['tanggal_inspeksi'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                ?>
                    <tr>
                        <?php if ($levelRule == 2 || $levelRule == 3) { ?>
                            <td style="text-align: center;">
                                <a href="preview-inspeksi?idRecord=<?= $idRecord; ?>"><img src="img/Icon View.png" style="width: 17px; text-align: center;"></a>
                            </td>
                        <?php } ?>
                        <td><?= $inspektor; ?></td>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $noMesin; ?></td>
                        <td><?= $tanggal_baru; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>