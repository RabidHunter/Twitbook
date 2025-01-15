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
