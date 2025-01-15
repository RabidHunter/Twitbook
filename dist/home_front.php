<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitbook</title>
    <link rel="stylesheet" href="style_twitter.css">
    <link rel="icon" type="image/jpg" href="y.jpg">
    <script src="script_twitter.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <p class="username-display">Logged in as: <span id="username"><?php echo $username; ?></span></p>
        <button onclick="window.location.href='home.php'" class="btn back">Back to Home</button>
        <button class="btn view" onclick="window.location.href='my_tweets.php'">View My Tweets</button>
        <button id="tweetBtn" class="btn create">Create Tweet</button>
        <form method="post" style="margin-top: auto;">
            <button class="btn" name="logout">Sign out</button>
        </form>
    </div>
    <div class="main-content">
        <div class="main-title">
            <h2  class="title">Recent tweets from our users</h2>
        </div>
        <div class="tweets">
        <?php if (!empty($tweets)):
        foreach ($tweets as $tweet): ?>
        <div class="tweet">
            <h3><strong><?php echo htmlspecialchars($tweet['username']) ?></strong></h3>
            <h4><?php echo $tweet['created_at']; ?></h4>
            <p><?php echo htmlspecialchars($tweet['content']); ?></p>
            <?php if ($tweet['image_url']): ?>
                <img src="<?php echo $tweet['image_url']; ?>" alt="Tweet Image">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h1>There are currently no tweets from our users.</h1>
<?php endif; ?>
        </div> 
    </div>
    <div class="modal" id="modal">
        <div class="modal-content">
            <form action="tweets_to_db.php" method="POST" enctype="multipart/form-data">
                <textarea placeholder="What happened?" name="content" required></textarea>
                <input type="file" name="image" accept="image/*">
                <button type="submit" id="post_modal" name="post_tweet" class="btn post">Post Tweet</button>
            </form>
            <button id="close_modal" class="btn close">Close</button>
        </div>
    </div>
</body>
</html>