<?php
session_start();
require_once 'db_config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: todo.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: todo.php');
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'User not found';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Todo App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="header">
        <img src="img/i.jpg" alt="Profile Picture" class="profile-pic">
        <div class="header-info">
            <h1>To-do list</h1>
            <p>Dalle | Masan</p>
            <p>235314071</p>
        </div>
    </div>

    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>