<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionSparepart.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Report Suku Cadang</title>
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
        <h2 style="font-weight: lighter; margin-bottom: 10px">Record Data Suku Cadang</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <td>Pegawai</td>
                    <td>Tipe Mesin</td>
                    <td>Suku Cadang Mesin</td>
                    <td>Tindakan</td>
                    <td>Detail</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambilallSparepart)) {
                    $idRecord = $data['id_record_sparepart'];
                    $pegawai = $data['nama_lengkap'];
                    $tipeMesin = $data['nama_mesin'];
                    $sparepartMesin = $data['nama_sparepart'];
                    $tindakan = $data['tindakan'];
                    $jumlah = $data['jumlah'];
                    $tanggal = $data['tanggal_sparepart'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                    $keteranganTindakan = $data['keterangan_tindakan'];
                ?>
                    <tr>
                        <td><?= $pegawai; ?></td>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $sparepartMesin; ?></td>
                        <td>
                            <?php if ($tindakan == 'Tambah') {
                                echo 'Stok baru ( +' . $jumlah . ' )';
                            } else if ($tindakan == 'Gunakan') {
                                echo 'Dipakai ( -' . $jumlah . ' )';
                            } ?>
                        </td>
                        <td style="text-align: center;"><a href="#" onclick="openModalRecordSparepart('<?= $keteranganTindakan; ?>')"><img src="img/Icon Detail.svg" style="width: 17px;"></a></td>
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
            <h3 style="text-align: center;">Detail Record Suku Cadang</h3>
            <br>
            <span style="padding: 10px 0px; text-align: center;" id="keteranganTindakan" name="keteranganTindakan">
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script_3.js"></script>

</body>

</html>