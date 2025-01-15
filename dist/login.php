<?php
require_once 'db.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $checkUser = "SELECT password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($checkUser);
        $stmt->execute([':username' => $username]);

        $storedPassword = $stmt->fetchColumn();

        if ($storedPassword) {
            if (password_verify($password, $storedPassword)) {
                $_SESSION['username'] = $username;
                header('Location: home.php');
                exit;
            } else {
                header('Location: failed_login.html');
                exit;
            }
        } else {
            header('Location: failed_login.html');
            exit;
        }
    }
?>