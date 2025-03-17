<?php 
class UserLogin {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($username, $password) {
        $username = trim($username);
        $password = trim($password);

        $checkUser = "SELECT password FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($checkUser);
        $stmt->execute([':username' => $username]);

        $storedPassword = $stmt->fetchColumn();

        if ($storedPassword && password_verify($password, $storedPassword)) {
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    }

    public function redirect($successRedirect, $failureRedirect) {
        if (isset($_SESSION['username'])) {
            header('Location: ' . $successRedirect);
        } else {
            header('Location: ' . $failureRedirect);
        }
        exit;
    }
}