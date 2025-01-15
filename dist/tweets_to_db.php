<?php
session_start();
require_once 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_tweet'])) {
        $content = trim($_POST['content']);
        $username = $_SESSION['username'];
        $image_url = NULL;

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_url = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
        } 

        $sql = "INSERT INTO tweets (username, content, image_url) VALUES (:username, :content, :image_url)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':content' => $content,
            ':image_url' => $image_url
        ]);

        header('Location: home.php');
        exit;
    }

?>