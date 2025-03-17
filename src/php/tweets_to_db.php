<?php
require_once 'db.php';
require_once './classes/TweetPoster.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_tweet'])) {
    session_start();

    $tweetPoster = new TweetPoster($pdo);

    $username = $_SESSION['username'];
    $content = trim($_POST['content']);
    $image = $_FILES['image'];

    $tweetPoster->postTweet($username, $content, $image);
    $tweetPoster->redirect('../templates/home_front.html');
}