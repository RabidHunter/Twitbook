<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tweet</title>
    <link rel="stylesheet" href="style_twitter.css">
    <script src="script_twitter.js" defer></script>
    <link rel="icon" type="image/jpg" href="y.jpg">

</head>
<body>
    <div class="sidebar">
        <p class="username-display">Logged in as: <span id="username"><?php echo htmlspecialchars($username); ?></span></p>
        <button onclick="window.location.href='home.php'" class="btn back">Back to Home</button>
        <button class="btn view" onclick="window.location.href='my_tweets.php'">View My Tweets</button>
        <button id="tweetBtn" class="btn create">Create Tweet</button>
        <form method="post" style="margin-top: auto;">
            <button class="btn" name="logout">Sign out</button>
        </form>
    </div>

    <div class="main-content">
        <div class="main-title">
            <h2 class="title">Edit Your Tweet</h2>
        </div>
        <div class="tweet_edit_content">
            <form action="edit_tweet.php" method="POST" enctype="multipart/form-data">
                <textarea name="content" required><?php echo htmlspecialchars($tweet['content']); ?></textarea>
                <input type="file" name="image" accept="image/*">
                <?php if ($tweet['image_url']): ?>
                    <img src="<?php echo $tweet['image_url']; ?>" alt="Current Tweet Image" width="100">
                <?php endif; ?>
                <input type="hidden" name="tweet_id" value="<?php echo $tweet['id']; ?>">
                <button type="submit" class="btn update">Update Tweet</button>
            </form>
        </div>
    </div>
</body>
</html>