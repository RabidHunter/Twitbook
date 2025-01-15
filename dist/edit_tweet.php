<?php
require_once 'db.php';
require_once './classes/SessionUsername.php';
require_once './classes/SessionActivity.php';
require_once './classes/SelectTweet.php';

$username = SessionUsername::checkSessionAndGetUsername();
SessionActivity::SessionShutDown();

date_default_timezone_set('Europe/Kiev');

if (isset($_POST['tweet_id'])) {
    $tweet_id = $_POST['tweet_id'];

    $tweetSelection = new TweetSelection($pdo);
    $tweet = $tweetSelection->getTweetById($tweet_id, $username);

    if (!$tweet) {
        echo "Tweet not found";
        exit;
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];
    $image_url = $tweet['image_url'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!empty($tweet['image_url']) && file_exists($tweet['image_url'])) {
            unlink($tweet['image_url']);
        }
        
        $image_url = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    $created_at = date('Y-m-d H:i:s');

    try {
        $sql = "UPDATE tweets SET content = :content, image_url = :image_url, created_at = :created_at WHERE id = :tweet_id AND username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':content' => $content,
            ':image_url' => $image_url,
            ':created_at' => $created_at,
            ':tweet_id' => $tweet_id,
            ':username' => $username
        ]);

        header('Location: my_tweets.php');
        exit;

    } catch (PDOException $e) {
        echo "Помилка оновлення твіта: " . $e->getMessage();
    }
}
}

require "edit_tweet_front.php";
?>


