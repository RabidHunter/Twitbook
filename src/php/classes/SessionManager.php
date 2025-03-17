<?php
class SessionManager {
    public static function getUsername() {
        if (!isset($_SESSION['username'])) {
            echo json_encode(["error" => "User not logged in"]);
            exit;
        }

        echo json_encode(["username" => htmlspecialchars($_SESSION['username'])]);
    }
}