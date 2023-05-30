<?php
class User {
    private int $id;
    private string $login;
    private string $password;
    private string $firstName;
    private string $lastName;

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
        $this->firstName = "";
        $this->lastName = "";
    }

    public function register() {
        $passwordHash = password_hash($this->password, PASSWORD_ARGON2I);
        $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $db = new mysqli('localhost', 'root', '', 'loginform');
        $preparedQuery = $db->prepare($query);
        $preparedQuery->bind_param('ssss', $this->login, 
                                            $passwordHash, 
                                            $this->firstName, 
                                            $this->lastName);
        $preparedQuery->execute();
    }

    public function login() {
        $query = "SELECT * FROM user WHERE login = ?";
        $db = new mysqli('localhost', 'root', '', 'loginform');
        $preparedQuery = $db->prepare($query);
        $preparedQuery->bind_param('s', $this->login);
        $preparedQuery->execute();
        $result = $preparedQuery->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwordHash = $row['password'];
            if(password_verify($this->password, $passwordHash)) {
                $this->id = $row['id'];
                $this->firstName = $row['firstName'];
                $this->lastName = $row['lastName'];
                echo "zalogowano poprawnie";
            } else {
                echo "Błędne login lub hasło";
            }
        } else {
            //brak zgadzających się wyników - wyjście z funkcji
            echo "Błędne login lub hasło";
            return;
        }
    }
}
?>