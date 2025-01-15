<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SessionActivity.php';
require_once './classes/TweetPresence.php';

$username = SessionUsername::checkSessionAndGetUsername();
SessionActivity::SessionShutDown();

    $sql = "SELECT * FROM tweets ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);

    $dbHelper = new TweetPresence($pdo);
    $tweets = $dbHelper->executeQuery($sql);

require 'home_front.php';
?>
