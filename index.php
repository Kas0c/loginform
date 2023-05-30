<?php

use Steampixel\Route;

require_once('config.php');
require_once('class/User.class.php');

session_start();

Route::add('/', function() {
    global $twig;
    $v = array();
    if(isset($_SESSION['auth']))
        if($_SESSION['auth']){
            $user = $_SESSION['user'];
            $v['user'] = $user;
        }
    $twig->display('home.html.twig', $v);
});

Route::add('/login', function() {
    global $twig;
    $twig->display('login.html.twig');
});

Route::add('/login', function() {
    global $twig;
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {  
        //jeżeli juz podano dane logowania  
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if($user->login()) {
            $_SESSION['auth'] = true;
            $_SESSION['user'] = $user;
            $v = array(
                'message' => "Zalogowano prawidłowo użytkownika: ".$user->getName(),
            );
            $twig->display('message.html.twig', $v);
        } else {
            $twig->display('login.html.twig',
                         ["message" => "Błędne login lub hasło"]);
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/register', function() {
    global $twig;
    $twig->display('register.html.twig');
});

Route::add('/register', function() {
    global $twig;
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        if(empty($_REQUEST['login']) || empty($_REQUEST['password'])
        || empty($_REQUEST['firstName']) || empty($_REQUEST['lastName'])) {
            //nie podano jednej z wymaganych wartości
            $twig->display('register.html.twig', 
                            ['message' => "Nie podano wymaganej wartości"]);
            exit();
        }
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        $user->setFirstName($_REQUEST['firstName']);
        $user->setLastName($_REQUEST['lastName']);
        if($user->register()) {
            $twig->display('message.html.twig',
                         ["message" => "Zarejestrowano prawidłowo"]);
        } else {
            $twig->display('register.html.twig',
                         ["message" => "Błąd rejestracji"]);
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/logout', function() {
    global $twig;
    session_destroy();
    $twig->display('message.html.twig',
                    ['message' => "Wylogowane z powodzeniem"]);
});

Route::run('/loginform');
?>