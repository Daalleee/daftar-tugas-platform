<?php
session_start();
include "service/database.php";

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}

$username = $_SESSION['username'];


if (isset($_POST['tambah'])) {
  $task = $_POST['task'];
  mysqli_query($conn, "INSERT INTO todos (username, task) VALUES ('$username', '$task')");
}


if (isset($_GET['selesai'])) {
  $id = $_GET['selesai'];
  mysqli_query($conn, "UPDATE todos SET status = 'done' WHERE id = $id AND username = '$username'");
}


if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM todos WHERE id = $id AND username = '$username'");
}

$result = mysqli_query($conn, "SELECT * FROM todos WHERE username = '$username'");
?>

<!DOCTYPE html>
<html>

<head>
  <title>To-Do List</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="navbar">
    <div class="profile-info">
      <img src="img/i.jpg" alt="Foto Profil">
      <div>
        <h3>Leonardus Dale Masan</h3>
        <p>235314071</p>
      </div>
    </div>
  </div>

  <div class="center-container">
    <div class="form-box">
      <h2>To Do List</h2>

      <!-- Tombol Tambah -->
      <form method="POST" class="add-task-form">
        <input type="text" name="task" placeholder="Tulis pesan" required>
        <button type="submit" name="tambah" class="btn-blue">Tambah</button>
      </form>

      <!-- Daftar Tugas -->
      <div class="todo-list">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <div class="todo-item <?= $row['status'] === 'done' ? 'done' : '' ?>">
            <span><?= htmlspecialchars($row['task']) ?></span>
            <div class="buttons">
              <?php if ($row['status'] === 'done') : ?>
                <button class="btn-done" disabled>Selesai ✔</button>
              <?php else : ?>
                <a href="?selesai=<?= $row['id'] ?>"><button class="btn-green">Selesai</button></a>
              <?php endif; ?>
              <a href="?hapus=<?= $row['id'] ?>"><button class="btn-red">Hapus</button></a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Logout -->
      <a href="logout.php"><button class="btn-blue logout">Logout</button></a>
    </div>
  </div>
</body>

</html>