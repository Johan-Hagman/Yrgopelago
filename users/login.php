<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if ($username === 'Johan' && $password === '1010') {
        $_SESSION['is_admin'] = true;
        header('Location: /admin.php');
        exit;
    } else {
        echo 'Invalid credentials.';
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <button onclick="location.href='/../index.php';">Back to startpage</button>
</form>