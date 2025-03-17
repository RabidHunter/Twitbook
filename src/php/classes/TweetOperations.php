<?php

class TweetPresence {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function executeQuery($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}

class TweetFetcher {
    private $dbHelper;

    public function __construct($pdo) {
        $this->dbHelper = new TweetPresence($pdo);
    }

    public function getAllTweets() {
        $sql = "SELECT * FROM tweets ORDER BY created_at DESC";
        return $this->dbHelper->executeQuery($sql);
    }

    public function sendJsonResponse() {
        header('Content-Type: application/json');

        $tweets = $this->getAllTweets();
        echo json_encode(['status' => 'success', 'tweets' => $tweets]);
        exit;
    }
}

class UserTweetFetcher {
    private $pdo;
    private $dbHelper;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->dbHelper = new TweetPresence($pdo);
    }

    private function getUsernameFromSession() {
        return SessionUsername::checkSessionAndGetUsername();
    }

    public function getUserTweets() {
        $username = $this->getUsernameFromSession();

        $sql = "SELECT * FROM tweets WHERE username = :username ORDER BY created_at DESC";
        $params = [":username" => $username];

        return $this->dbHelper->executeQuery($sql, $params);
    }

    public function sendJsonResponse() {
        header('Content-Type: application/json');
        $tweets = $this->getUserTweets();
        echo json_encode(['status' => 'success', 'tweets' => $tweets]);
        exit;
    }
}