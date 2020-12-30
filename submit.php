<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Submit</h1>

    <form action="app/posts/store.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Url</label>
            <input class="form-control" type="url" name="url" id="url" required>
        </div><!-- /form-group -->

        <small class="form-text text-muted">or</small>
        <br>

        <div class="form-group">
            <label for="test">Text</label>
            <textarea class="form-control rounded-0" id="textarea" rows="5"></textarea>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>