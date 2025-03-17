<?php
class TweetPoster {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function postTweet($username, $content, $image) {
        $image_url = $this->uploadImage($image);

        $sql = "INSERT INTO tweets (username, content, image_url) VALUES (:username, :content, :image_url)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':content' => $content,
            ':image_url' => $image_url
        ]);
    }

    private function uploadImage($image) {
        if (isset($image) && $image['error'] == 0) {
            $image_url = '../uploads/' . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $image_url);
            return $image_url;
        }
        return NULL;
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}