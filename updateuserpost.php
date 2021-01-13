<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = $_GET['id'];
$post = getPostById($postId, $pdo)
?>

<article>
    <h4>Edit your post <a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?>.</a></h4>
    <br>
    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <form action="app/posts/update.php?id=<?php echo $post['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="new-title" id="new-title" value="<?php echo $post['title']; ?>">
                <small class="form-text text-muted">You may change the title by filling out this field.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="url">URL: <a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a></label>
                <input class="form-control" type="url" name="new-url" id="new-url" value="<?php echo $post['url']; ?>">
                <small class="form-text text-muted">You may change the url by filling out this field.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="content">Text</label>
                <textarea class="form-control rounded-0" name="new-text" rows="5" cols="10"><?php echo $post['text']; ?></textarea>
                <small class="form-text text-muted">You may change the text by filling out this field.</small>
            </div><!-- /form-group -->
            <button type="submit" class="btn btn-primary">Edit Post</button>
        </form>
        <br>
        <form action="app/posts/delete.php?id=<?php echo $post['id']; ?>" method="post">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </div><!-- /form-group -->
        </form>
    </div>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>