<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = getPostById($_POST['postid'], $pdo);
?>

<article>
    <h4>Here you may edit your post "<?php echo $_POST['postid']; ?>".</h4>

    <br>

    <form action="app/posts/update.php" method="post">
        <input type="hidden" name="postid" value="<?php echo $_POST['postid']; ?>">
        <div class="form-group">
            <label for="title"><?php echo $postId['title']; ?></label>
            <input class="form-control" type="text" name="new-title" id="new-title" required>
            <small class="form-text text-muted">You may change the title by filling out this field.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="url"><a href="<?php echo $postId['url']; ?>"><?php echo $postId['url']; ?></a></label>
            <input class="form-control" type="text" name="new-url" id="new-url" required>
            <small class="form-text text-muted">You may change the url by filling out this field.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <textarea class="form-control rounded-0" name="new-text" placeholder="<?php echo $postId['text']; ?>" rows="5"></textarea>
            <small class="form-text text-muted">You may change this by filling out this field.</small>
        </div><!-- /form-group -->

        <button type="submit" name="submit" class="btn btn-primary">Edit Post</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>