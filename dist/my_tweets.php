<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SessionActivity.php';
require_once './classes/TweetPresence.php';

$username = SessionUsername::checkSessionAndGetUsername();
SessionActivity::SessionShutDown();

    $sql = "SELECT * FROM tweets WHERE username = :username ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $params = [":username"=> $username];

    $dbHelper = new TweetPresence($pdo);
    $tweets = $dbHelper->executeQuery($sql, $params);

require "my_tweets_front.php";
?>


