<?php
require 'functions/functionLogin.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Webpage Title -->
  <title>Login</title>
  <link rel="shortcut icon" href="img/logo-favicon.png" type="image/x-icon">

  <!-- Styles -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

  <!-- NAVBAR -->
  <?php include 'partials/navbar-home.php'; ?>
  <!-- NAVBAR -->

  <!-- Login card -->
  <div class="center">
    <h1>Login</h1>
    <form method="post">
      <div class="txt_field">
        <input type="text" id='username' name='username' required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" id='password' name='password' required>
        <span></span>
        <label>Password</label>
      </div>
      <input type="submit" name='login' value="Login">
      <div class="signup_link">
        Belum memiliki akun, daftar ? <a href="signup">Registrasi</a>
      </div>
    </form>
  </div>

</body>

</html>