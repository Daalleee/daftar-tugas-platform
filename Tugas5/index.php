<?php
include "service/database.php";
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $username;
    header("Location: home.php");
  } else {
    $error = "Username atau Password salah!";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="center-container">
    <form class="form-box" method="POST">
      <h2>Login</h2>
      <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
      <?php endif; ?>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukkan username" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
      </div>

      <button type="submit" name="login" class="btn-green">Login</button>
      <a href="registrasi.php">Daftar akun</a>
    </form>
  </div>
</body>

</html>