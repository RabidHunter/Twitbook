<?php 
class UserRegistration {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $email, $password) {
        try {
            $this->pdo->beginTransaction();

            if ($this->emailExists($email)) {
                $this->pdo->rollBack();
                $this->redirect('../templates/failed_register.html');
            }

            if ($this->usernameExists($username)) {
                $this->pdo->rollBack();
                $this->redirect('../templates/failed_register.html');
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->insertUser($username, $email, $hashed_password);

            $this->pdo->commit();
            $this->redirect('../templates/success.html');
        } catch (Exception $e) {
            $this->pdo->rollBack();
            die("Registration error: " . $e->getMessage());
        }
    }

    private function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    private function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    private function insertUser($username, $email, $hashed_password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password
        ]);
    }

    private function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}