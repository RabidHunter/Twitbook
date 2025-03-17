<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/TweetUpdater.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tweet_id = $_POST['tweet_id'] ?? null;
    $content = trim($_POST['content'] ?? '');
    $image = $_FILES ?? null;

    $tweetUpdater = new TweetUpdater($pdo);
    $tweetUpdater->updateTweet($tweet_id, $content, $image);
}
?>
