<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = $_GET['id'];
$post = getPostById($postId, $pdo);
$comments = getComments($postId, $pdo);
?>

<?php if (loggedIn()) : ?>
    <p><?php $message ?></p>
    <article>
        <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
        <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
        <small class="form-text text-muted"><?php echo $post['username'] ?></small>
        <br>
        <h6><?php echo $post['title'] ?></h6>
        <a href="#"><?php echo $post['url'] ?></a>
        <p><?php echo $post['text'] ?></p>
        <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
        <small class="form-text text-muted">Posted: <?php echo $post['date']; ?></small>
        <br>
    </article>
    <article>
        <form action="app/comments/store.php?id=<?php echo $post['id']; ?>" method="post">
            <div class="form-group">
                <small class="form-text text-muted">Comment</small>
                <textarea class="form-control" rows="5" cols="5" type="text" name="comment" id="comment"></textarea>
            </div><!-- /form-group -->
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
        <?php $userCommentId = $comment['user_id']; ?>
        <img loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
        <small class="form-text text-muted"><?php echo $comment['username'] ?></small>
        <p><?php echo $comment['content'] ?></p>
        <small class="form-text text-muted">Posted: <?php echo $comment['date']; ?></small>
        <?php if ($currentUserId === $userCommentId) : ?>
            <small class="form-text text-muted">
                <a href="updateusercomment.php?id=<?php echo $comment['post_id']; ?>&comment-id=<?php echo $comment['id']; ?>">Edit</a>
                <a href="/app/comments/delete.php?comment-id=<?php echo $comment['id']; ?>&id=<?php echo $comment['post_id']; ?>">Delete</a>
            </small>
        <?php endif; ?>
        <br>
    <?php endforeach; ?>
</article>