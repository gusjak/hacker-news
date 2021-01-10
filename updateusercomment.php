<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = getCommentById($_POST['postid'], $pdo);
?>

<article>
    <h4>Here you may edit your comment.</h4>

    <br>

    <form action="app/comments/update.php" method="post">
        <input type="hidden" name="postid" value="<?php echo $_POST['postid']; ?>">

        <div class="form-group">
            <textarea class="form-control rounded-0" name="edit-comment" placeholder="<?php echo $postId['content'] ?>" rows=" 5"></textarea>
            <small class="form-text text-muted">You may change this by filling out this field.</small>
        </div><!-- /form-group -->

        <button type="submit" name="submit" class="btn btn-primary">Edit Post</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>