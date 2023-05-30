<?php
require_once('config.php');
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    $user->setFirstName($_REQUEST['firstName']);
    $user->setLastName($_REQUEST['lastName']);
    if($user->register()) {
        $twig->display('message.html.twig',
                     ["message" => "Zarejestrowano prawidłowo"]);
    } else {
        $twig->display('message.html.twig',
                     ["message" => "Błąd rejestracji"]);
    }
} else {
    $twig->display('register.html.twig');
}
?>