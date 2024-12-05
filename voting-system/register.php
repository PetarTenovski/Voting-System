<?php
require 'Database.php';
require 'Authentication.php';

$db = (new Database())->connect();
$auth = new Auth($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = $auth->register($name, $username, $password);
    echo $message;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/register.css">
</head>
<body>
    <div class="register">
        <div class="register-section">
            <form method="POST">
                <h1>Register</h1>
                <label for="">Full Name</label>
                <input type="text" name="name" placeholder="Full Name" required>
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <div class="buttons">
                    <button type="submit">Register</button>
                    <button><a href="./login.php">Log In</a></button>
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>

