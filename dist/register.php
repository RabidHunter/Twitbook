<?php
require_once 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        $pdo->beginTransaction();

        $checkEmail = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $pdo->prepare($checkEmail);
        $stmt->execute([':email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $pdo->rollBack();
            header('Location: failed_register.html');
        exit;
        }

        $checkUser = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $pdo->prepare($checkUser);
        $stmt->execute([':username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            $pdo->rollBack();
            header('Location: failed_register.html');
        exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($insert);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password
        ]);

        $pdo->commit();
        header('Location: success.html');
        exit;
    }
?>