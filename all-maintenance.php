<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionMaintenance.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Report Maintenance</title>
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
        <?php if ($levelRule == 4 || $levelRule == 8) { ?>
            <h2 style="font-weight: lighter; margin-bottom: 10px">Summary Maintenance</h2>
            <table id="example" class="row-border" style="width:100%">
                <thead>
                    <tr>
                        <td>Tipe Mesin</td>
                        <td>Nomer Mesin</td>
                        <td>Maintenance</td>
                        <td>Penggantian Suku Cadang</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($ambildataMesin)) {
                        $idMesin = $data['id_mesin'];
                        $tipeMesin = $data['nama_mesin'];
                        $noMesin = $data['no_mesin'];
                        $cekMaintenance = mysqli_query($conn, "SELECT * FROM record_maintenance recm, record_inspeksi reci WHERE recm.id_record_inspeksi = reci.id_record_inspeksi AND reci.id_mesin = '$idMesin'");
                        $hitungMaintenance = mysqli_num_rows($cekMaintenance);
                        $cekSukuCadang = mysqli_query($conn, "SELECT * FROM record_maintenance recm, record_inspeksi reci, data_maintenance dm WHERE reci.id_mesin = '$idMesin' AND reci.id_record_inspeksi = recm.id_record_inspeksi AND recm.id_record_maintenance = dm.id_record_maintenance AND dm.status_data_maintenance = 'Sudah'");
                        $hitungSukuCadang = mysqli_num_rows($cekSukuCadang);
                    ?>
                        <tr>
                            <td><?= $tipeMesin; ?></td>
                            <td><?= $noMesin; ?></td>
                            <td style="text-align: center;"><?= $hitungMaintenance; ?> kali</td>
                            <td style="text-align: center;"><?= $hitungSukuCadang; ?> item</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        <?php } ?>
        <h2 style="font-weight: lighter; margin-bottom: 10px">Record Data Maintenance</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <td>Teknisi</td>
                    <td>Tipe Mesin</td>
                    <td>Nomer Mesin</td>
                    <td>Mulai Maintenance</td>
                    <td>Selesai Maintenance</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambilallMaintenance)) {
                    $teknisi = $data['nama_lengkap'];
                    $tipeMesin = $data['nama_mesin'];
                    $noMesin = $data['no_mesin'];
                    $status = $data['status_record_maintenance'];
                    $tanggal = $data['tanggal_maintenance'];
                    $tanggalSelesai = $data['end_maintenance'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                    $tanggalSelesai_baru = date('d/m/Y H:i:s', strtotime($tanggalSelesai));
                ?>
                    <tr>
                        <td><?= $teknisi; ?></td>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $noMesin; ?></td>
                        <td><?= $tanggal_baru; ?></td>
                        <td>
                            <?php if ($status == 'Sudah') {
                                echo $tanggalSelesai_baru;
                            } else if ($status == 'Belum') {
                                echo '[ Proses Maintenance ]';
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <h2 style="font-weight: lighter; margin-bottom: 10px">Record Preventive Maintenance</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <td>Teknisi</td>
                    <td>Preventive Suku Cadang</td>
                    <td>TM</td>
                    <td>Preventive Berikutnya</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambilallPreventive)) {
                    $teknisi = $data['nama_lengkap'];
                    $nilaiTM = $data['nilai_tm'];
                    $sparepart = $data['nama_sparepart'];
                    $tanggal = $data['tanggal_preventive'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                    $updateTM = date('d/m/Y', strtotime($tanggal . ' + ' . $nilaiTM . ' days'));
                ?>
                    <tr>
                        <td><?= $teknisi; ?></td>
                        <td><?= $sparepart; ?></td>
                        <td style="text-align: center;"><?= $nilaiTM; ?> hari</td>
                        <td style="text-align: center;"><?= $updateTM; ?></td>
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