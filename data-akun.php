<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionAkun.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Data Akun</title>
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
        <h2 style="font-weight: lighter; margin-bottom: 20px">Data Akun</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <td></td>
                    <td>Nama Lengkap</td>
                    <td>Jabatan</td>
                    <td>Email</td>
                    <td>Nomer Telepon</td>
                    <td>Jenis Kelamin</td>
                    <td>Tanggal Dibuat</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambildataAkun)) {
                    $idAkunData = $data['id_akun'];
                    $idRuleAkun = $data['id_rule'];
                    $usernameAkun = $data['username'];
                    $namaAkunData = $data['nama_lengkap'];
                    $jabatanAkun = $data['nama_rule'];
                    $emailAkun = $data['email'];
                    $teleponAkun = $data['telepon'];
                    $genderAkun = $data['jenis_kelamin'];
                    $tanggal = $data['created_at'];
                    $tanggal_baru = date('d/m/Y H:i:s', strtotime($tanggal));
                ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php if ($levelRule == 7) { ?>
                                <a href="#" onclick="openModalAkun('<?= $idAkunData; ?>', '<?= $idRuleAkun; ?>')">
                                    <img src="img/Icon Edit 2.png" style="width: 17px;">
                                </a>
                            <?php } else { ?>
                                <a href="#" onclick="openModalEditAkun('<?= $idAkunData; ?>', '<?= $idRuleAkun; ?>', '<?= $namaAkunData; ?>', '<?= $emailAkun; ?>', '<?= $usernameAkun; ?>', '<?= $teleponAkun; ?>', '<?= $genderAkun; ?>')">
                                    <img src="img/Icon Edit 2.png" style="width: 17px;">
                                </a>
                            <?php } ?>
                        </td>
                        <td><?= $namaAkunData; ?></td>
                        <td><?= $jabatanAkun; ?></td>
                        <td><?= $emailAkun; ?></td>
                        <td><?= $teleponAkun; ?></td>
                        <td><?= $genderAkun; ?></td>
                        <td><?= $tanggal_baru; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <!-- Edit Akun Modal popup-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <?php if ($levelRule == 7) { ?>
                <h3 style="text-align: center;">Posisi Jabatan Akun</h3>
                <br>
                <form method="post" onsubmit="return validateForm('ruleSelect', 'Posisi')">
                    <label for="ruleSelect">Posisi:</label>
                    <select style="padding: 5px 5px;" id="ruleSelect" name="ruleSelect">
                        <option value="0">ㅤ</option>
                        <?php
                        while ($dataSelect = mysqli_fetch_array($dataRule)) {
                            $idRuleSelect = $dataSelect['id_rule'];
                            $namaRuleSelect = $dataSelect['nama_rule'];
                        ?>
                            <option value="<?= $idRuleSelect; ?>"><?= $namaRuleSelect; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="akunId" name="akunId" value="">
                    <input type="hidden" id="ruleId" name="ruleId" value="">
                    <input style="margin-left: 20px; padding: 5px 20px;" type="submit" name="submit-changerule" value="Sesuaikan"></input>
                </form>
            <?php } else { ?>
                <h3 style="text-align: center;">Edit Akun</h3>
                <br>
                <form method="post" onsubmit="return validateForm('ruleSelect', 'Posisi')">
                    <label style="margin-left: 22px;" for="akunNama">- Nama:</label>
                    <input style="margin-left: 81px; margin-bottom: 10px; padding: 5px;" type="text" id="akunNama" name="akunNama" value="" required>
                    <br>
                    <label style="margin-left: 22px;" for="akunUsername">- Username:</label>
                    <input style="margin-left: 48px; margin-bottom: 10px; padding: 5px;" type="text" id="akunUsername" name="akunUsername" value="" required>
                    <br>
                    <label style="margin-left: 22px;" for="akunEmail">- Email:</label>
                    <input style="margin-left: 87px; margin-bottom: 10px; padding: 5px;" type="email" id="akunEmail" name="akunEmail" value="" required>
                    <br>
                    <?php if ($levelRule !== '8') { ?>
                        <label style="margin-left: 22px;" for="akunPassword">- Password baru:</label>
                        <input style="margin-left: 10px; margin-bottom: 10px; padding: 5px;" type="password" id='akunPassword' name='akunPassword' placeholder="*boleh dikosongi">
                        <br>
                    <?php } ?>
                    <label style="margin-left: 22px;" for="akunTelepon">- Telepon:</label>
                    <input style="margin-left: 66px; margin-bottom: 10px; padding: 5px;" type="text" id="akunTelepon" name="akunTelepon" pattern="[0-9]+" value="" required>
                    <br>
                    <?php if ($levelRule == 8) { ?>
                        <label style="margin-left: 22px;" for="ruleSelect">- Posisi:</label>
                        <select style="margin-left: 103px; margin-bottom: 10px; padding: 5px;" id="ruleSelect" name="ruleSelect">
                            <option value="0">ㅤ</option>
                            <?php
                            while ($dataSelect = mysqli_fetch_array($dataRule)) {
                                $idRuleSelect = $dataSelect['id_rule'];
                                $namaRuleSelect = $dataSelect['nama_rule'];
                            ?>
                                <option value="<?= $idRuleSelect; ?>"><?= $namaRuleSelect; ?></option>
                            <?php } ?>
                        </select>
                        <br>
                    <?php } else { ?>
                        <label style="margin-left: 22px;" for="ruleSelect">- Posisi:</label>
                        <select style="margin-left: 103px; margin-bottom: 10px; padding: 5px;" id="ruleSelect" name="ruleSelect">
                            <option value="<?= $levelRule; ?>"><?= $namaRule; ?></option>
                        </select>
                        <br>
                    <?php } ?>
                    <label style="margin-left: 22px;" for="genderSelect">- Jenis Kelamin:</label>
                    <select style="margin-left: 93px; margin-bottom: 10px; padding: 5px;" id="genderSelect" name="genderSelect">
                        <option value="Laki - laki">Laki - laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <br>
                    <input type="hidden" id="akunId" name="akunId" value="">
                    <input style="margin: 5px 70px; padding: 5px 100px; color: #40513B" type="submit" name="submit-editakun" value="Edit"></input>
                </form>
            <?php } ?>
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script_3.js"></script>
    <script>
        hideOptionZero(document.getElementById("ruleSelect"));
    </script>
</body>

</html>