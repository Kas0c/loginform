<?php
require_once('class/User.class.php');

$user = new User('jkowalski', '12345');
/*
if($user->register()) {
    echo "Zarejestrowano prawidłowo";
} else {
    echo "Błąd rejestracji";
}
*/

if($user->login()) {
    echo "Zalogowano prawidłowo";
} else {
    echo "Błędne login lub hasło";
}

?>