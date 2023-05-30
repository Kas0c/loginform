<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <form action="" method="post">
        <label for="loginID">Login:</label><br>
        <input type="text" name="login" id="loginID"><br>
        <label for="passwordID">Hasło:</label><br>
        <input type="password" name="password" id="passwordID"><br>
        <label for="firstNameID">Imie:</label><br>
        <input type="text" name="firstName" id="firstNameID"><br>
        <label for="lastNameID">Nazwisko:</label><br>
        <input type="text" name="lastName" id="lastNameID"><br>
        <input type="submit" value="Zarejestruj">
</form>
<?php
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('class/User.class.php');
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    if($user->register()) {
        echo "Zarejestrowano prawidłowo";
    } else {
        echo "Błąd rejestracji";
    }
}
?>
</body>
</html>