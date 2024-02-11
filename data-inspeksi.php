<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionInspeksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Data Inspeksi</title>
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
        <?php if ($levelRule == 2 || $levelRule == 3) { ?>
            <button style="margin-bottom: 20px" type="submit" value="inspeksi" onclick="openModal()"> <a href="#" style="color: inherit; text-decoration: none;">Buat Inspeksi <img src="img/Icon Edit.svg" style="width: 17px" />
                </a></button>
        <?php } ?>
        <h2 style="font-weight: lighter; margin-bottom: 10px">Data Inspeksi</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 2 || $levelRule == 3) { ?>
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
                <?php
                if (mysqli_num_rows($ambildataInspeksi) !== 0) {
                    while ($data = mysqli_fetch_array($ambildataInspeksi)) {
                        $idRecord = $data['id_record_inspeksi'];
                        $inspektor = $data['nama_lengkap'];
                        $tipeKendaraan = $data['nama_mesin'];
                        $noKendaraan = $data['no_mesin'];
                        $status = $data['keterangan_status'];
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
                            <td><?= $tipeKendaraan; ?></td>
                            <td><?= $noKendaraan; ?></td>
                            <td><?= $status; ?></td>
                            <td><?= $tanggal_baru; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">Belum ada Inspeksi</td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <!-- Modal popup -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 style="text-align: center;">Inspeksi Mesin</h3>
            <br>
            <form method="post" onsubmit="return validateForm('mesinSelect', 'Jenis Mesin')">
                <label for="mesinSelect">Jenis Mesin:</label>
                <select style="padding: 5px 5px;" id="mesinSelect" name="mesinSelect">
                    <option value="0">ㅤ</option>
                    <?php
                    while ($data = mysqli_fetch_array($dataTipemesin)) {
                        $idTipe = $data['id_tipe_mesin'];
                        $namaMesin = $data['nama_mesin'];
                    ?>
                        <option value="<?= $idTipe; ?>"><?= $namaMesin; ?></option>
                    <?php } ?>
                </select>
                <input style="margin-left: 20px; padding: 5px 20px;" class="btn btn-submit" type="submit" name="submit-tipemesin" value="Pilih" onclick="closeModal()"></input>
            </form>
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script_3.js"></script>
    <script>
        hideOptionZero(document.getElementById("mesinSelect"));
    </script>

</body>

</html>