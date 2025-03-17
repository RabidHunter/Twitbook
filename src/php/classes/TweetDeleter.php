<?php
class TweetDeleter {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsernameFromSession() {
        return SessionUsername::checkSessionAndGetUsername();
    }

    public function getTweetById($tweet_id, $username) {
        $tweetSelection = new TweetSelection($this->pdo);
        return $tweetSelection->getTweetById($tweet_id, $username);
    }

    public function deleteTweet($tweet_id) {
        $delete_sql = "DELETE FROM tweets WHERE id = :tweet_id";
        $delete_stmt = $this->pdo->prepare($delete_sql);
        $delete_stmt->execute([':tweet_id' => $tweet_id]);
    }

    public function deleteImage($image_url) {
        if (!empty($image_url) && file_exists($image_url)) {
            unlink($image_url);
        }
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    public function sendError($message) {
        echo $message;
        exit;
    }
}