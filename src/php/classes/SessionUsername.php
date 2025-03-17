<?php

class SessionUsername {
    public static function checkSessionAndGetUsername() {
        session_start();

        if (!isset($_SESSION['username'])) {
            header('Location: ../templates/sign_in.html');
            exit;
        }

        return htmlspecialchars($_SESSION['username']);
    }
}
