<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionMaintenance.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Data Maintenance</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
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
        <h2 style="font-weight: lighter; margin-bottom: 20px">Maintenance</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                        <td></td>
                    <?php } ?>
                    <td>Teknisi</td>
                    <td>Tipe Mesin</td>
                    <td>Nomer Mesin</td>
                    <td>Status Mesin</td>
                    <td>Perbaikan</td>
                    <td>RPN</td>
                    <td>Mulai Maintenance</td>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($ambildatamaintenanceRPN) == 0) { ?>
                    <tr>
                        <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                            <td></td>
                        <?php } ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">Belum ada maintenance.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php } else {
                    while ($data = mysqli_fetch_array($ambildatamaintenanceRPN)) {
                        $idMaintenance = $data['id_record_maintenance'];
                        $idTeknisi = $data['id_akun'];
                        $namaTeknisi = $data['nama_lengkap'];
                        $tipeMesin = $data['nama_mesin'];
                        $noMesin = $data['no_mesin'];
                        $statusMesin = $data['keterangan_status'];
                        $perbaikanSparepart = $data['nama_sparepart'];
                        $rpnSparepart = $data['nilai_rpn'];
                        $tanggal = $data['tanggal_maintenance'];
                        $tanggal_baru = date('d/m/Y', strtotime($tanggal));
                    ?>
                        <tr>
                            <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                                <td style="text-align: center;">
                                    <?php if ($idTeknisi == $idAkun || $levelRule == 4) { ?>
                                        <a href="maintenance-progress?idRecord=<?= $idMaintenance; ?>"><img src="img/Icon Fix.svg" style="width: 17px;"></a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td><?= $namaTeknisi; ?></td>
                            <td><?= $tipeMesin; ?></td>
                            <td><?= $noMesin; ?></td>
                            <td><?= $statusMesin; ?></td>
                            <td><?= $perbaikanSparepart; ?></td>
                            <td><?= $rpnSparepart; ?></td>
                            <td><?= $tanggal_baru; ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <br>
        <h2 style="font-weight: lighter; margin-bottom: 20px">Menunggu Maintenance</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                        <td></td>
                    <?php } ?>
                    <td>Inspektor</td>
                    <td>Tipe Mesin</td>
                    <td>Nomer Mesin</td>
                    <td>Status Mesin</td>
                    <td>Tanggal Inspeksi</td>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($ambildatainspeksi) == 0) { ?>
                    <tr>
                        <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                            <td></td>
                        <?php } ?>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">Belum ada data untuk cek maintenance.</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php } else {
                    while ($data = mysqli_fetch_array($ambildatainspeksi)) {
                        $idRecord = $data['id_record_inspeksi'];
                        $namaInspektor = $data['nama_lengkap'];
                        $tipeMesin = $data['nama_mesin'];
                        $noMesin = $data['no_mesin'];
                        $status = $data['keterangan_status'];
                        $tanggal = $data['tanggal_inspeksi'];
                        $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                    ?>
                        <tr>
                            <?php if ($levelRule == 4 || $levelRule == 5) { ?>
                                <td style="text-align: center;">
                                    <a href="form-maintenance?idRecord=<?= $idRecord; ?>"><img src="img/Icon Edit 2.png" style="width: 17px;"></a>
                                </td>
                            <?php } ?>
                            <td><?= $namaInspektor; ?></td>
                            <td><?= $tipeMesin; ?></td>
                            <td><?= $noMesin; ?></td>
                            <td><?= $status; ?></td>
                            <td><?= $tanggal_baru; ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>