<?php

class TweetUpdater {
    private $pdo;
    private $username;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->username = SessionUsername::checkSessionAndGetUsername();
    }

    public function updateTweet($tweet_id, $content, $image) {

        $tweet = $this->getTweetById($tweet_id);

        $image_url = $this->handleImageUpload($tweet['image_url'], $image);
        $created_at = date('Y-m-d H:i:s');

        $sql = "UPDATE tweets SET content = :content, image_url = :image_url, created_at = :created_at WHERE id = :tweet_id AND username = :username";
        $stmt = $this->pdo->prepare($sql);
        $success = $stmt->execute([
            'content' => $content,
            'image_url' => $image_url,
            'created_at' => $created_at,
            'tweet_id' => $tweet_id,
            'username' => $this->username
        ]);

        header("Location: ../templates/my_tweets_front.html");
        exit;
    }

    private function getTweetById($tweet_id) {
        $sql = "SELECT image_url FROM tweets WHERE id = :tweet_id AND username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['tweet_id' => $tweet_id, 'username' => $this->username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function handleImageUpload($existingImageUrl, $image) {
        if (isset($image['image']) && $image['image']['error'] == 0) {
            if (!empty($existingImageUrl) && file_exists($existingImageUrl)) {
                unlink($existingImageUrl);
            }

            $uploadDir = '../uploads/';
            $imagePath = $uploadDir . basename($image['image']['name']);

            if (move_uploaded_file($image['image']['tmp_name'], $imagePath)) {
                return $imagePath;
            }
        }
        return $existingImageUrl;
    }

    private function redirectWithError($message) {
        die($message);
    }
}
?>
