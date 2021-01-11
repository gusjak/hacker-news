<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = $_GET['id'];
$post = getPostById($postId, $pdo);
$comments = getCommentById($postId, $pdo);
?>

<article class="comments">
    <?php foreach ($comments as $comment) : ?>
        <form action="/app/comments/update.php?id=<?php echo $comment['post_id']; ?>&comment-id=<?php echo $comment['id']; ?>" method="post">
            <div class="form-group">
                <textarea class="form-control" type="text" name="edit-comment" rows="5" cols="10" required><?php echo $comment['content']; ?></textarea>
                <small class="form-text text-muted">You may change the text by filling out this field.</small>
            </div><!-- /form-group -->
            <button type="submit" class="btn btn-primary">Edit Comment</button>
        </form>
    <?php endforeach; ?>

    <?php require __DIR__ . '/views/footer.php'; ?>