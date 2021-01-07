<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$allPosts = displayAllPosts($pdo);
?>


<article>
    <?php foreach ($allPosts as $post) : ?>
        <?php $authorID = $post['user_id']; ?>
        <img loading="lazy" src="<?= '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
        <small class="form-text text-muted"><?php echo $post['username'] ?></small>
        <br>
        <h6><?php echo $post['title'] ?></h6>
        <a href="#"><?php echo $post['url'] ?></a>
        <p><?php echo $post['text'] ?></p>
        <small class="form-text text-muted">Posted: <?php echo $post['date'] . "\n"; ?>
            <?php if (loggedIn()) : ?>
                <a href="">Comment</a>
            <?php endif; ?></small>
        <br>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>