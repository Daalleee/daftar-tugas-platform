<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $stmt = $pdo->prepare("INSERT INTO todos (user_id, task) VALUES (:user_id, :task)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task', $task);
        $stmt->execute();
    }
    header('Location: todo.php');
    exit;
}

if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $stmt = $pdo->prepare("UPDATE todos SET completed = NOT completed WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    header('Location: todo.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    header('Location: todo.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM todos WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header">
        <img src="img/i.jpg" alt="Profile Picture" class="profile-pic">
        <div class="header-info">
            <h1>Todo Application</h1>
            <p>Dalle | Masan</p>
            <p>235314071</p>
        </div>
    </div>

    <div class="container">
        <div class="todo-container">
            <div class="logout-section" style="margin-bottom: 20px;">
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>

            <form method="post" action="" class="add-task-form" style="margin-bottom: 20px;">
                <input type="text" name="task" placeholder="Masukan pesan" required>
                <button type="submit" class="btn-add">Tambah</button>
            </form>

            <div class="todo-list">
                <?php if (count($todos) > 0): ?>
                    <?php foreach ($todos as $todo): ?>
                        <div class="todo-item <?php echo $todo['completed'] ? 'completed' : ''; ?>">
                            <span class="task-text">
                                <?php if ($todo['completed']): ?>
                                    <del><?php echo htmlspecialchars($todo['task']); ?></del>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($todo['task']); ?>
                                <?php endif; ?>
                            </span>
                            <div class="todo-actions">
                                <a href="?complete=<?php echo $todo['id']; ?>" class="btn-complete">Selesai</a>
                                <a href="?delete=<?php echo $todo['id']; ?>" class="btn-delete">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-tasks">Daftar kosong</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>