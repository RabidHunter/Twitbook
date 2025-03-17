<?php
class TweetEditor {
    private $pdo;
    private $username;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->username = SessionUsername::checkSessionAndGetUsername();
    }

    public function fetchTweet($tweet_id) {
        if (!$tweet_id) {
            return $this->jsonResponse(false, 'Not passed tweet_id');
        }

        $tweetSelection = new TweetSelection($this->pdo);
        $tweet = $tweetSelection->getTweetById($tweet_id, $this->username);

        if ($tweet) {
            return $this->jsonResponse(true, '', ['tweet' => $tweet]);
        } else {
            return $this->jsonResponse(false, 'Tweet was not found');
        }
    }

    private function jsonResponse($success, $message = '', $data = []) {
        echo json_encode(array_merge(['success' => $success, 'message' => $message], $data));
        exit;
    }
}