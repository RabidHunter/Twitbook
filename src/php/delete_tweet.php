<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SelectTweet.php';
require_once './classes/TweetDeleter.php';


$tweetDeleter = new TweetDeleter($pdo);

$username = $tweetDeleter->getUsernameFromSession();
$tweet_id = $_POST['delete_tweet_id'];

$tweet = $tweetDeleter->getTweetById($tweet_id, $username);

if ($tweet) {
    $tweetDeleter->deleteImage($tweet['image_url']);
    $tweetDeleter->deleteTweet($tweet_id);
    $tweetDeleter->redirect('../templates/my_tweets_front.html');
} else {
    $tweetDeleter->sendError("Tweet not found");
}
