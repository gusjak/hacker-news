<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = getUserById($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
$userPosts = displayUserPosts($id, $pdo);
?>

<?php if (loggedIn()) : ?>
    <article>
        <h4><?php echo $user['username'] ?>'s posts</h4>

        <br>

        <?php foreach ($userPosts as $post) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $userPostId = $post['user_id']; ?>
            <img loading="lazy" src="<?= '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $post['username'] ?></small>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Posted: <?php echo $post['date']; ?></small>
            <small class="form-text text-muted">
                <form action="" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Comment</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
                <?php if ($currentUserId === $userPostId) : ?>
                    <form action="/updateuserpost.php" method="post">
                        <button class="btn btn-link" type="submit" name="submit">Edit</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                    </form>
                <?php endif; ?>
            </small>
            <br>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>