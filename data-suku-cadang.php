<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionSparepart.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width" , initial-scale="1.0">
  <title>HSE | Data Suku Cadang</title>
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
    <h2 style="font-weight: lighter; margin-bottom: 20px">Data Suku Cadang</h2>
    <table id="example" class="row-border" style="width:100%">
      <thead>
        <tr>
          <?php if ($levelRule == 6) { ?>
            <td></td>
          <?php } ?>
          <td>Tipe Mesin</td>
          <td>Suku Cadang Mesin</td>
          <td>Jumlah Suku Cadang</td>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($data = mysqli_fetch_array($ambildataSparepart)) {
          $idSparepart = $data['id_sparepart'];
          $tipeMesin = $data['nama_mesin'];
          $namaSparepart = $data['nama_sparepart'];
          $jumlahSparepart = $data['jumlah_sparepart'];
        ?>
          <tr>
            <?php if ($levelRule == 6) { ?>
              <td style="text-align: center;"><a href="#" onclick="openModalSparepart('<?= $idSparepart; ?>', '<?= $namaSparepart; ?>', '<?= $jumlahSparepart; ?>')"><img src="img/Icon AddStok.svg" style="width: 17px;"></a></td>
            <?php } ?>
            <td><?= $tipeMesin; ?></td>
            <td><?= $namaSparepart; ?></td>
            <td><?= $jumlahSparepart; ?> item</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>

  <!-- Add Stock Modal popup-->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3 style="text-align: center;">Stok Baru Suku Cadang</h3>
      <br>
      <form method="post">
        <label for="tambahStok">Jumlah:</label>
        <input style="padding: 5px 5px;" type="number" id="tambahStok" name="tambahStok" required>
        <input type="hidden" id="sparepartId" name="sparepartId" value="">
        <input type="hidden" id="sparepartNama" name="sparepartNama" value="">
        <input type="hidden" id="sparepartStok" name="sparepartStok" value="">
        <input style="margin-left: 20px; padding: 5px 10px;" class="btn btn-submit" type="submit" name="submit-addstok" value="Tambahkan"></input>
      </form>
    </div>
  </div>

  <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/script_3.js"></script>
</body>

</html>