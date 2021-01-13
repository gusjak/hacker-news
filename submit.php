<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <p><?php $message ?></p>
    <h1>Submit</h1>
    <div class="card shadow p-4 mb-4 bg-card mw-100">
        <form action="app/posts/store.php" method="post">
            <div class="form-group">
                <small class="form-text text-muted">Title</small>
                <input class="form-control" type="text" name="title" id="title" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <small class="form-text text-muted">Url</small>
                <input class="form-control" type="url" name="url" id="url" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <small class="form-text text-muted">Text</small>
                <textarea class="form-control rounded-0" name="text-content" rows="5"></textarea>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>