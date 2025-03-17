<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/TweetOperations.php';

$userTweetFetcher = new UserTweetFetcher($pdo);
$userTweetFetcher->sendJsonResponse();
