<?php

class SessionActivity {
    public static function SessionShutDown() {
        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('Location: sign_in.html');
            exit;
        }   
    }
}

