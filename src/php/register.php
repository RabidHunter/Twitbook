<?php
require_once 'db.php';
require_once './classes/UserRegistration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $registration = new UserRegistration($pdo);
    $registration->registerUser($username, $email, $password);
}
?>