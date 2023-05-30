<?php

use Steampixel\Route;

require_once('config.php');
require_once('class/User.class.php');

Route::add('/', function() {
    echo "hello";
});

Route::add('/login', function() {
    echo "Strona logowania";
});

Route::add('/register', function() {
    echo "Strona rejestracji";
});

Route::run('/loginform');
?>