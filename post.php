<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = $_GET['id'];
$post = getPostById($postId, $pdo);
$comments = getComments($postId, $pdo);
?>

<?php if (loggedIn()) : ?>
    <article>
        <p><?php $message ?></p>
        <?php $currentUserId = $_SESSION['user']['id']; ?>
        <?php $userPostId = $post['user_id']; ?>
        <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
        <?php $alreadyUpvoted = alreadyUpvoted($post['id'], $currentUserId, $pdo); ?>

        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <?php if ($currentUserId === $userPostId) : ?>
                <small class="form-text text-muted"><a href="/settings.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <?php else : ?>
                <small class="form-text text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <?php endif; ?>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
            <?php if ($alreadyUpvoted) : ?>
                <form action="app/posts/upvotespost.php" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Downvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php else : ?>
                <form action="app/posts/upvotespost.php" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Upvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php endif; ?>
            <small class="form-text text-muted">Created: <?php echo $post['date']; ?></small>
            <br>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <form action="app/comments/store.php?id=<?php echo $post['id']; ?>" method="post">
                <div class="form-group">
                    <small class="form-text text-muted">Comment</small>
                    <textarea class="form-control" rows="5" cols="5" type="text" name="comment" id="comment"></textarea>
                </div><!-- /form-group -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <h4><strong>Comment section</strong></h4>
            <?php if (!$comments) : ?>
                <p>Be the first to comment on this post!</p>
            <?php endif; ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $currentUserId = $_SESSION['user']['id']; ?>
                <?php $userCommentId = $comment['user_id']; ?>

                <div class="card shadow-sm p-4 mb-4 bg-light mw-100">
                    <img loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
                    <?php if ($currentUserId === $userCommentId) : ?>
                        <small class="form-text text-muted"><a href="/settings.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <?php else : ?>
                        <small class="form-text text-muted"><a href="/profile.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <?php endif; ?>
                    <p><?php echo $comment['content'] ?></p>
                    <small class="form-text text-muted">Created: <?php echo $comment['date']; ?></small>
                    <?php if ($currentUserId === $userCommentId) : ?>
                        <small class="form-text text-muted">
                            <a href="updateusercomment.php?id=<?php echo $comment['post_id']; ?>&comment-id=<?php echo $comment['id']; ?>">Edit</a>
                            <a href="/app/comments/delete.php?comment-id=<?php echo $comment['id']; ?>&id=<?php echo $comment['post_id']; ?>">Delete</a>
                        </small>
                    <?php endif; ?>
                </div>
                <div class="py-1"></div>
            <?php endforeach; ?>
        </div>
    </article>

<?php else : ?>
    <article>
        <p><?php $message ?></p>

        <?php $upvotes = countUpvotes($post['id'], $pdo); ?>

        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <a href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
            <small class="form-text text-muted">Created: <?php echo $post['date']; ?></small>
            <br>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <form action="app/comments/store.php?id=<?php echo $post['id']; ?>" method="post">
                <div class="form-group">
                    <small class="form-text text-muted">Comment</small>
                    <textarea class="form-control" rows="5" cols="5" type="text" name="comment" id="comment"></textarea>
                </div><!-- /form-group -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <h4><strong>Comment section</strong></h4>
            <?php if (!$comments) : ?>
                <p><a href="/login.php">Log in</a> and be the first to comment on this post!</p>
            <?php else : ?>
                <p><a href="/login.php">Log in</a> to take part in the discussion!</p>
            <?php endif; ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $userCommentId = $comment['user_id']; ?>

                <div class="card shadow-sm p-4 mb-4 bg-light mw-100">
                    <img loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
                    <small class="form-text text-muted"><a href="/profile.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <p><?php echo $comment['content'] ?></p>
                    <small class="form-text text-muted">Created: <?php echo $comment['date']; ?></small>
                </div>
                <div class="py-1"></div>
            <?php endforeach; ?>
        </div>
    </article>
<?php endif; ?>