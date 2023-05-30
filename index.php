<?php
require_once('class/User.class.php');

$user = new User('jkowalski', '12345');
//$user->register();
$user->login();
echo '<pre>';
var_dump($user);
?>