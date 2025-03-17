<?php
require_once 'db.php';
require_once './classes/TweetOperations.php';

$tweetFetcher = new TweetFetcher($pdo);
$tweetFetcher->sendJsonResponse();
?>
