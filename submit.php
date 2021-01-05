<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Submit</h1>

    <form action="app/posts/store.php" method="post">
        <div class="form-group">
            <input class="form-control" type="text" name="title" id="title" required>
            <small class="form-text text-muted">Title</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="url" name="url" id="url" required>
            <small class="form-text text-muted">Url</small>
        </div><!-- /form-group -->

        <br>
        <small class="form-text text-muted">or</small>
        <br>

        <div class="form-group">
            <textarea class="form-control rounded-0" name="post-submit" rows="5"></textarea>
            <small class="form-text text-muted">Text</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>