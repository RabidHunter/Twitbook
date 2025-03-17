<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SelectTweet.php';
require_once './classes/TweetEditor.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tweet_id = $_POST['tweet_id'] ?? null;

    $tweetFetcher = new TweetEditor($pdo);
    $tweetFetcher->fetchTweet($tweet_id);
}