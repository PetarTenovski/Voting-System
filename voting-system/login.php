<?php 

require 'Database.php';
require 'Authentication.php';

$db = (new Database())->connect();

$auth = new Auth($db);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = $auth->login($username,$password);
    echo $message;
    if($auth->isLoggedIn()){
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/login.css">
</head>
<body>
<div class="login">
    <div class="login-section">
        
        <form method="POST">
            <h1>Login</h1>
            <label for="">Username</label>
            <input type="text" name="username" placeholder="Username" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <p>If you do not have an account, <a href="./register.php">create one now.</a></p>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
</body>
</html>