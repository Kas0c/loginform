<?php
require_once('config.php');

if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {  
    //jeżeli juz podano dane logowania  
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    if($user->login()) {
        //echo "Zalogowano prawidłowo użytkownika: ".$user->getName();
        $v = array(
            'message' => "Zalogowano prawidłowo użytkownika: ".$user->getName(),
        );
        $twig->display('message.html.twig', $v);
    } else {
        //echo "Błędne login lub hasło";
        $twig->display('message.html.twig',
                     ["message" => "Błędne login lub hasło"]);
    }
} else {
    //jeżeli jeszcze nie podano danych logowania
    //wyswietla formularz logowania
    $twig->display('login.html.twig');
}
?>