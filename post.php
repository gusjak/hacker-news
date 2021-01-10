<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$comments = getComments($_POST['postid'], $pdo,);
?>

<?php if (loggedIn()) : ?>
    <p><?php $message ?></p>
    <article>
        <form action="app/comments/store.php" method="post">
            <div class="form-group">
                <small class="form-text text-muted">Comment</small>
                <textarea class="form-control rounded-0" name="comment" rows="5"></textarea>
            </div><!-- /form-group -->
            <input type="hidden" name="postid" value="<?php echo $_POST['postid']; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </article>
<?php endif; ?>

<br>

<article>
    <h4><strong>Comment section</strong></h4>

    <br>

    <?php foreach ($comments as $comment) : ?>
        <?php $currentUserId = $_SESSION['user']['id']; ?>
        <?php $userPostId = $comment['user_id']; ?>
        <img loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
        <small class="form-text text-muted"><?php echo $comment['username'] ?></small>
        <small class="form-text"><?php echo $comment['content'] ?></small>
        <small class="form-text text-muted">Posted: <?php echo $comment['date']; ?></small>
        <?php if ($currentUserId === $userPostId) : ?>
            <form action="" method="post">
                <button class="btn btn-link" type="submit" name="submit">Edit</button>
                <input type="hidden" name="postid" value="<?php echo $comment['id']; ?>">
            </form>
            <form action="" method="post">
                <button class="btn btn-link" type="submit" name="submit">Delete</button>
                <input type="hidden" name="postid" value="<?php echo $comment['id']; ?>">
            </form>
        <?php endif; ?>
        <br>
    <?php endforeach; ?>
</article>