<?php
include "service/database.php";
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "INSERT INTO users  (username, password) VALUES ('$username', '$password')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "berhasil daftar akun";
  } else {
    echo "Gagal daftar";
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Daftar akun</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="center-container">
    <form class="form-box" method="POST">
      <h2>Daftar Akun</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukkan username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
      </div>

      <button type="submit" name="login" class="btn-green">Daftar</button>
      <a href="index.php">Silakan login</a>
    </form>
  </div>
</body>

</html>