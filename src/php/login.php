<?php
require_once 'db.php';
require_once './classes/UserLogin.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = new UserLogin($pdo);
    
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if ($login->login($username, $password)) {
            $login->redirect('../templates/home_front.html', '../templates/failed_login.html');
        } else {
            $login->redirect('../templates/failed_login.html', '../templates/failed_login.html');
        }
    }