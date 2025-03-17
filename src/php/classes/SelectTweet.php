<?php

class TweetSelection {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getTweetById($tweet_id, $username) {
        $sql = "SELECT * FROM tweets WHERE id = :tweet_id AND username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':tweet_id' => $tweet_id, ':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
