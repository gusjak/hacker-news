<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$allPosts = displayAllPosts($pdo);
?>

<?php if (loggedIn()) : ?>
    <article>
        <?php foreach ($allPosts as $post) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $postId = $post['user_id']; ?>
            <img loading="lazy" src="<?= '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $post['username'] ?></small>
            <br>
            <h6><?php echo $post['title'] ?></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Posted: <?php echo $post['date'] . "\n"; ?>
                <a href="">Comment</a>
                <?php if ($currentUserId === $postId) : ?>
                    <a href="">Edit</a>
                <?php endif; ?>
            </small>
            <br>
        <?php endforeach; ?>
    </article>

<?php else : ?>
    <article>
        <?php foreach ($allPosts as $post) : ?>
            <img loading="lazy" src="<?= '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $post['username'] ?></small>
            <br>
            <h6><?php echo $post['title'] ?></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Posted: <?php echo $post['date'] . "\n"; ?></small>
            <br>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>