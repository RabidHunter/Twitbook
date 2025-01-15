<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SelectTweet.php';


$username = SessionUsername::checkSessionAndGetUsername();

if (isset($_POST['delete_tweet_id'])) {
    $tweet_id = $_POST['delete_tweet_id'];

    $tweetSelection = new TweetSelection($pdo);
    $tweet = $tweetSelection->getTweetById($tweet_id, $username);

    if ($tweet) {
        if (!empty($tweet['image_url']) && file_exists($tweet['image_url'])) {
            unlink($tweet['image_url']);
        }
        
        $delete_sql = "DELETE FROM tweets WHERE id = :tweet_id";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->execute([':tweet_id' => $tweet_id]);

        header('Location: my_tweets.php');
        exit;
    } else {
        echo "Tweet not found";
    }
} else {
    echo "No tweet ID provided.";
}
?>
