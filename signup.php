<?php
require 'functions/functionSignup.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Registrasi</title>
  <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="css/style2.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <div class="title">Registrasi</div>
    <div class="content">
      <form method='POST' action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nama Lengkap</span>
            <input type="text" placeholder='Masukkan nama' id='name' name='name' required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder='Masukkan username' id='username' name='username' required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder='contoh: admin@inspeksi.site' id='email' name='email' required>
          </div>
          <div class="input-box">
            <span class="details">Nomer Telepon</span>
            <input type="text" placeholder='contoh: 085000000000' id='noTlp' name='noTlp' pattern="[0-9]+" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id='password' name='password' required>
          </div>
          <div class="input-box">
            <span class="details">Ulangi Password</span>
            <input type="password" id='rePassword' name='rePassword' required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="Laki-laki">
          <input type="radio" name="gender" id="dot-2" value="Perempuan">
          <span class="gender-title">Jenis Kelamin</span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Laki-laki</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Perempuan</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="register" value="Register">
        </div>
        <div class="login_link">
          Sudah memiliki akun, masuk ? <a href="login">Login</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>