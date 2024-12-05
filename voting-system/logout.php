<?php
require 'Database.php';
require 'Authentication.php';

$db = (new Database())->connect();
$auth = new Auth($db);

echo $auth->logout();
header('Location: login.php');
exit;
