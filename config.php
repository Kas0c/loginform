<?php
require_once('vendor/autoload.php');
require_once('class/User.class.php');
//loader to pomocnik do ładowania szablonów
$loader = new Twig\Loader\FilesystemLoader('templates');
//inicjacja twig'a
$twig = new Twig\Environment($loader);

$db = new mysqli('localhost', 'root', '', 'loginform');

?>