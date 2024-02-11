<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionItemInspeksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width" , initial-scale="1.0">
    <title>HSE | Daftar Item Inspeksi</title>
    <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style4.css" />
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
        <h2 style="font-weight: lighter; margin-bottom: 20px">Jumlah Item Inspeksi</h2>
        <table class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 2 || $levelRule == 8) { ?>
                        <td></td>
                    <?php } ?>
                    <td>Tipe Mesin</td>
                    <td>Sub Inspeksi</td>
                    <td>Item Inspeksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambildataTipeMesin)) {
                    $idTipe = $data['id_tipe_mesin'];
                    $tipeMesin = $data['nama_mesin'];
                    $cekSub = mysqli_query($conn, "SELECT * FROM sub_inspeksi WHERE id_tipe_mesin = '$idTipe'");
                    $hitungSub = mysqli_num_rows($cekSub);
                    $cekItem = mysqli_query($conn, "SELECT * FROM item_verifikasi WHERE id_tipe_mesin = '$idTipe'");
                    $hitungItem = mysqli_num_rows($cekItem);
                ?>
                    <tr>
                        <?php if ($levelRule == 2 || $levelRule == 8) { ?>
                            <td style="text-align: center;">
                                <a href="#" onclick="openModalAddItem('<?= $idTipe; ?>', '<?= $tipeMesin; ?>')"><img src="img/Icon AddStok.svg" style="width: 17px; margin-left: 10px" alt="Tambah"></a>
                            </td>
                        <?php } ?>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $hitungSub; ?> Sub</td>
                        <td><?= $hitungItem; ?> Item Verifikasi</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <h2 style="font-weight: lighter; margin-bottom: 20px">Daftar Item Inspeksi</h2>
        <table id="example" class="row-border" style="width:100%">
            <thead>
                <tr>
                    <?php if ($levelRule == 2 || $levelRule == 8) { ?>
                        <td style="border-right: none;"></td>
                        <td style="border-left: none;"></td>
                    <?php } ?>
                    <td>Tipe Mesin</td>
                    <td>Sub Inspeksi</td>
                    <td>Kode Item</td>
                    <td>Item Inspeksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($ambilitemInspeksi)) {
                    $idItemVerifikasi = $data['id_item_verifikasi'];
                    $tipeMesin = $data['nama_mesin'];
                    $subItem = $data['nama_sub_inspeksi'];
                    $kodeItem = $data['kode_item'];
                    $pertanyaan = $data['pertanyaan_inspeksi'];
                ?>
                    <tr>
                        <?php if ($levelRule == 2 || $levelRule == 8) { ?>
                            <td style="text-align: center;">
                                <a href="#" onclick="openModalEditItem('<?= $idItemVerifikasi; ?>', '<?= $tipeMesin; ?>', '<?= $subItem; ?>', '<?= $kodeItem; ?>', '<?= $pertanyaan; ?>')"><img src="img/Icon Edit 2.png" style="width: 17px; margin-left: 10px" alt="Edit"></a>
                            </td>
                            <td>
                                <a href="#" onclick="openModalRemoveItem('Anda menghapus Item Inspeksi [ <?= $pertanyaan; ?> ] dari Inspeksi [ <?= $tipeMesin; ?> ] ?', '<?= $idItemVerifikasi; ?>')"><img src="img/Icon Remove.png" style="width: 17px; margin-right: 10px" alt="Hapus"></a>
                            </td>
                        <?php } ?>
                        <td><?= $tipeMesin; ?></td>
                        <td><?= $subItem; ?></td>
                        <td style="text-align: center;"><?= $kodeItem; ?></td>
                        <td><?= $pertanyaan; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <!-- Add Item Inspeksi Modal popup-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalAdd()">&times;</span>
            <h3 style="text-align: center;">Tambah Item Inspeksi</h3>
            <br>
            <form method="post">
                <label style="margin-left: 20px;" for="itemMesin">Tipe Mesin:</label>
                <input style="margin-left: 67px; margin-bottom: 15px; padding: 5px;" type="text" id="itemMesin" name="itemMesin" value="" readonly>
                <br>
                <label style="margin-left: 20px;" for="itemSub">Sub Item:</label>
                <select style="margin-left: 51px; margin-bottom: 15px; padding: 5px;" id="itemSub" name="itemSub" required>
                    <option value="0">ㅤ</option>
                </select>
                <br>
                <label style="margin-left: 20px;" for="itemKode">Kode Item:</label>
                <input style="margin-left: 70px; margin-bottom: 15px; padding: 5px;" type="text" id="itemKode" name="itemKode" value="" required>
                <br>
                <label style="margin-left: 20px;" for="itemInspeksi">Pertanyaan:</label>
                <input style="margin-left: 58px; margin-bottom: 25px; padding: 5px;" type="text" id="itemInspeksi" name="itemInspeksi" value="" required>
                <br>
                <input type="hidden" id="tipeMesinId" name="tipeMesinId" value="">
                <input style="margin: 5px 70px; padding: 5px 90px; color: #40513B" type="submit" name="submit-additem" value="Tambah"></input>
            </form>
        </div>
    </div>

    <!-- Edit Item Inspeksi Modal popup-->
    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal2()">&times;</span>
            <h3 style="text-align: center;">Edit Item Inspeksi</h3>
            <br>
            <form method="post">
                <label style="margin-left: 20px;" for="itemMesin2">Tipe Mesin:</label>
                <input style="margin-left: 55px; margin-bottom: 15px; padding: 5px;" type="text" id="itemMesin2" name="itemMesin2" value="" readonly>
                <br>
                <label style="margin-left: 20px;" for="itemSub2">Sub Item:</label>
                <input style="margin-left: 69px; margin-bottom: 15px; padding: 5px;" type="text" id="itemSub2" name="itemSub2" value="" readonly>
                <br>
                <label style="margin-left: 20px;" for="itemKode2">Kode Item:</label>
                <input style="margin-left: 59px; margin-bottom: 15px; padding: 5px;" type="text" id="itemKode2" name="itemKode2" value="" required>
                <br>
                <label style="margin-left: 20px;" for="itemInspeksi2">Pertanyaan:</label>
                <input style="margin-left: 45px; margin-bottom: 25px; padding: 5px;" type="text" id="itemInspeksi2" name="itemInspeksi2" value="" required>
                <br>
                <input type="hidden" id="itemId" name="itemId" value="">
                <input style="margin: 5px 70px; padding: 5px 100px; color: #40513B" type="submit" name="submit-edititem" value="Edit"></input>
            </form>
        </div>
    </div>

    <!-- Remove Item Inspeksi Modal popup-->
    <div id="myModal3" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal3()">&times;</span>
            <h3 style="color: red; text-align: center;"><img src="img/Icon Notifikasi.png" style="width: 17px;"> Menghapus Item Inspeksi!</h3>
            <br>
            <span style="font-size: 14px;" id="ketDetail" name="ketDetail"></span>
            <br>
            <form method="post">
                <input style="margin-left: 75px; padding: 5px 50px; color: red;" type="submit" name="submit-removeitem" value="Hapus"></input>
                <input style="margin-left: 10px; padding: 5px 50px;" type="submit" name="submit-batal" value="Batal"></input>
                <input type="hidden" id="itemId2" name="itemId2" value="">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script_3.js"></script>

    <script>
        // JavaScript untuk membuka dan menutup modal popup
        var modal2 = document.getElementById("myModal2");
        var modal3 = document.getElementById("myModal3");

        function openModalAddItem(tipeMesinId, itemMesin) {
            // Make an AJAX request to get sub items based on itemMesinValue
            // You can use any AJAX method or library of your choice
            // For simplicity, we'll use jQuery for the AJAX request
            $.ajax({
                url: 'partials/helperSubItem.php', // Replace with the path to your PHP file handling the database query
                type: 'POST',
                data: {
                    tipeMesinId: tipeMesinId
                },
                dataType: 'json',
                success: function(data) {
                    // Update the options in the select element with the new data
                    var selectElement = document.getElementById('itemSub');

                    data.forEach(function(option) {
                        var optionElement = document.createElement('option');
                        optionElement.value = option.id_sub_inspeksi;
                        optionElement.innerText = option.nama_sub_inspeksi;
                        selectElement.appendChild(optionElement);
                    });
                },
                error: function(error) {
                    console.error('Error fetching data: ', error);
                }
            });
            hideOptionZero(document.getElementById("itemSub"));
            var itemMesinInput = document.getElementById("itemMesin");
            var tipeMesinIdInput = document.getElementById("tipeMesinId");
            itemMesinInput.value = itemMesin;
            tipeMesinIdInput.value = tipeMesinId;
            modal.style.display = "block";
        }

        function closeModalAdd() {
            modal.style.display = "none";
            var selectElement = document.getElementById('itemSub');
            var options = selectElement.querySelectorAll('option');
            // Remove all option elements except the first one (index 0)
            for (var i = options.length - 1; i > 0; i--) {
                selectElement.removeChild(options[i]);
            }
        }

        function openModalEditItem(itemId, itemMesin, itemSub, itemKode, itemInspeksi) {
            var itemIdInput = document.getElementById("itemId");
            var itemMesinInput = document.getElementById("itemMesin2");
            var itemSubInput = document.getElementById("itemSub2");
            var itemKodeInput = document.getElementById("itemKode2");
            var itemInspeksiInput = document.getElementById("itemInspeksi2");
            itemIdInput.value = itemId;
            itemMesinInput.value = itemMesin;
            itemSubInput.value = itemSub;
            itemKodeInput.value = itemKode;
            itemInspeksiInput.value = itemInspeksi;
            modal2.style.display = "block";
        }

        function openModalRemoveItem(ketDetail, itemId) {
            var ketDetailInput = document.getElementById("ketDetail");
            var itemIdInput = document.getElementById("itemId2");
            ketDetailInput.innerText = ketDetail;
            itemIdInput.value = itemId;
            modal3.style.display = "block";
        }

        function closeModal2() {
            modal2.style.display = "none";
        }

        function closeModal3() {
            modal3.style.display = "none";
        }
    </script>

</body>

</html>