<?php
require_once 'functions/cekLogged.php';
require_once 'functions/functionDashboard.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width" , initial-scale="1.0">
  <title>HSE | Dashboard</title>
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
    <?php if ($levelRule !== '1') { ?>
      <p style="margin-bottom: 20px;">Selamat datang, <?= $nama; ?>!</p>
    <?php } ?>

    <?php if ($levelRule == 1) {
      include 'partials/summary-dashboard.php';
    } else if ($levelRule == 2 || $levelRule == 3 || $levelRule == 4 || $levelRule == 5) {
      include 'partials/reminder-dashboard.php';
    } ?>
  </main>

  <!-- Add Stock Modal popup-->
  <div id="myModal" class="modal">
    <div class="modal-content2">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3 style="color: red; text-align: center;"><img src="img/Icon Reminder.png" style="width: 17px;"> Reminder Preventive Maintenance!</h3>
      <br>
      <span style="font-size: 14px; padding: 10px 0px; text-align: center;" id="ketDetail" name="ketDetail">
    </div>
  </div>

  <!-- Finish Preventive Maintenance Modal popup-->
  <div id="myModal2" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal2()">&times;</span>
      <h3 style="color: yellow; text-align: center;"><img src="img/Icon Notifikasi.png" style="width: 17px;"> Finish Preventive Maintenance!</h3>
      <br>
      <span style="font-size: 14px;" id="ketDetail2" name="ketDetail2"></span>
      <br>
      <form method="post">
        <input style="margin-left: 75px; padding: 5px 50px; color: #40513B;" type="submit" name="submit-finish" value="Yakin"></input>
        <input style="margin-left: 10px; padding: 5px 50px; color: red;" type="submit" name="submit-kembali" value="Belum"></input>
        <input type="hidden" id="idTM" name="idTM" value="">
        <input type="hidden" id="updateTM" name="updateTM" value="">
      </form>
    </div>
  </div>

  <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/script_3.js"></script>
  <script>
    if (<?= $hitungReminder; ?> > 0) {
      openModalReminder('Jangan lupa menyelesaikan tugas, dalam waktu 3 hari kedepan tersisa sebanyak [ <?= $hitungReminder; ?> ] item! Terimakasih!!');
    }
  </script>
  <script>
    // JavaScript untuk membuka dan menutup modal popup
    var modal2 = document.getElementById("myModal2");

    function openModalFinish(ketDetail2, idTM, updateTM) {
      var ketDetail2Input = document.getElementById("ketDetail2");
      var idTMInput = document.getElementById("idTM");
      var updateTMInput = document.getElementById("updateTM");
      ketDetail2Input.innerText = ketDetail2;
      idTMInput.value = idTM;
      updateTMInput.value = updateTM;
      modal2.style.display = "block";
    }

    function closeModal2() {
      modal2.style.display = "none";
    }
  </script>

</body>

</html>