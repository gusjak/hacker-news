<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = getUserById($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
$posts = displayUserPosts($id, $pdo);
?>

<article>
    <p><?php $message ?></p>

    <h4><?= $user['username'] ?>'s submitted posts.</h4>

    <?php foreach ($posts as $post) : ?>
        <?php $currentUserId = $_SESSION['user']['id']; ?>
        <?php $postId = $post['user_id']; ?>
        <br>
        <form action="app/posts/update.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="edit-title"><?php echo $post['title'] ?></label>
                <input class="form-control" type="text" name="edit-title" id="edit-title">
                <small class=" form-text text-muted">You may change the title by filling out this field.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="edit-url"><a href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></label>
                <input class="form-control" type="url" name="edit-url" id="edit-url">
                <small class=" form-text text-muted">You may change the url by filling out this field.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="edit-text-content">Text Content</label>
                <textarea class="form-control rounded-0" name="edit-text-content" id="edit-text-content" rows="5" placeholder="<?= $post['text'] ?>"></textarea>
            </div><!-- /form-group -->

            <small class="form-text text-muted">Posted: <?php echo $post['date'] . "\n"; ?>
                <a href="">Comment</a>
            </small>
            <br>

            <button type="submit" class="btn btn-secondary">Edit post</button>
            <button type="button" class="btn btn-danger">Delete post</button>
        </form>
        <br>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>