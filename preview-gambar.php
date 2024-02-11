<!DOCTYPE html>
<html>

<head>
  <title>Gambar Kerusakan</title>
  <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .image-container {
      text-align: center;
    }

    .image-container img {
      max-width: 100%;
      max-height: 80vh;
    }

    .image-title {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .image-description {
      font-size: 16px;
      color: #666;
    }
  </style>
</head>

<body>
  <div class="image-container">
    <?php
    // Cek apakah parameter judul dan keterangan ada pada URL
    if (isset($_GET['verifikasiItem'])  && isset($_GET['keteranganItem']) && isset($_GET['previewItem'])) {
      $verifikasiItem = $_GET['verifikasiItem'];
      $keteranganItem = $_GET['keteranganItem'];
      $previewItem = $_GET['previewItem'];
    ?>
      <h2 class="image-title"><?= $verifikasiItem; ?></h2>
      <br>
      <span class="image-description"><?= $keteranganItem; ?></span>
      <br>
      <img src="uploadsImageInspeksi/<?= $previewItem; ?>" alt="<?= $verifikasiItem; ?>">
    <?php } else { ?>
      <img src="img/lost.png" alt="Halaman Kosong">
    <?php } ?>
  </div>
</body>

</html>