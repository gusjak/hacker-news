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

        <div class="card shadow p-4 mb-4 bg-card mw-100">
            <img class="rounded-circle" loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <?php if ($currentUserId === $userPostId) : ?>
                <small class="text-muted"><a href="/settings.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <?php else : ?>
                <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <?php endif; ?>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
            <p><?php echo $post['text'] ?></p>
            <small class="text-muted">Upvotes: <strong class="text-success"><?php echo $upvotes; ?></strong></small>
            <?php if ($alreadyUpvoted) : ?>
                <form action="app/posts/upvotespost.php" method="post">
                    <svg width="11" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5902 7.7696a.5112.5112 0 00.1789.1693A.4743.4743 0 005.0013 8a.4742.4742 0 00.2322-.0611.5112.5112 0 00.1788-.1693L9.9127.8367A.5563.5563 0 0010.001.566a.5625.5625 0 00-.056-.2804.5204.5204 0 00-.1843-.2088A.4763.4763 0 009.5017 0H.5008a.478.478 0 00-.2582.0777.522.522 0 00-.1835.2087.5642.5642 0 00-.0564.2797.558.558 0 00.087.2706l4.5004 6.9329z" fill="#BC3636" />
                    </svg>
                    <button class="btn btn-link text-decoration-none" type="submit" name="submit"> Downvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php else : ?>
                <form action="app/posts/upvotespost.php" method="post">
                    <svg width="10" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M.4998 8h9.0003a.4773.4773 0 00.2583-.0777.5227.5227 0 00.1838-.209.5664.5664 0 00.0564-.2803.5599.5599 0 00-.087-.2713L5.4115.216c-.1866-.288-.6356-.288-.8226 0L.0888 7.1617a.5579.5579 0 00-.0883.2713.5645.5645 0 00.056.281.521.521 0 00.1843.2091A.4757.4757 0 00.4998 8z" fill="#50C14D" />
                    </svg>
                    <button class="btn btn-link text-decoration-none" type="submit" name="submit"> Upvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php endif; ?>
            <small class="text-muted">Created: <?php echo $post['date']; ?></small>
            <small class="text-muted">
                <?php if ($currentUserId === $userPostId) : ?>
                    <a href="/updateuserpost.php?id=<?php echo $post['id']; ?>">Edit Post</a>
                <?php endif; ?>
            </small>
            <br>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-card mw-100">
            <form action="app/comments/store.php?id=<?php echo $post['id']; ?>" method="post">
                <div class="form-group">
                    <small class="text-muted">Comment</small>
                    <textarea class="form-control" rows="5" cols="5" type="text" name="comment" id="comment"></textarea>
                </div><!-- /form-group -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </article>

    <article>
        <div class="card shadow p-4 mb-4 bg-card mw-100">
            <h4><strong>Comment section</strong></h4>
            <?php if (!$comments) : ?>
                <p>Be the first to comment on this post!</p>
            <?php endif; ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $currentUserId = $_SESSION['user']['id']; ?>
                <?php $userCommentId = $comment['user_id']; ?>

                <div class="card shadow-sm p-4 mb-4 bg-card-darker mw-100">
                    <img class="rounded-circle" loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
                    <?php if ($currentUserId === $userCommentId) : ?>
                        <small class="text-muted"><a href="/settings.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <?php else : ?>
                        <small class="text-muted"><a href="/profile.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <?php endif; ?>
                    <p><?php echo $comment['content'] ?></p>
                    <small class="text-muted">Created: <?php echo $comment['date']; ?></small>
                    <?php if ($currentUserId === $userCommentId) : ?>
                        <small class="text-muted">
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

        <div class="card shadow p-4 mb-4 bg-card mw-100">
            <img class="rounded-circle" loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
            <p><?php echo $post['text'] ?></p>
            <small class="text-muted">Upvotes: <strong class="text-success"><?php echo $upvotes; ?></strong></small>
            <small class="text-muted">Created: <?php echo $post['date']; ?></small>
            <br>
        </div>
    </article>

    <div class="py-5"></div>

    <article>
        <div class="card shadow-sm p-4 mb-4 bg-light mw-100">
            <h4><strong>Comment section</strong></h4>
            <?php if (!$comments) : ?>
                <p><a href="/login.php">Log in</a> and be the first to comment on this post!</p>
            <?php else : ?>
                <p><a href="/login.php">Log in</a> to take part in the discussion!</p>
            <?php endif; ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $userCommentId = $comment['user_id']; ?>

                <div class="card shadow-sm p-4 mb-4 bg-card-darker mw-100">
                    <img class="rounded-circle" loading="lazy" src="<?php echo '/app/users/images/' . $comment['avatar'] ?>" alt="user-avatar" width="25px">
                    <small class="text-muted"><a href="/profile.php?id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></small>
                    <p><?php echo $comment['content'] ?></p>
                    <small class="text-muted">Created: <?php echo $comment['date']; ?></small>
                </div>
                <div class="py-1"></div>
            <?php endforeach; ?>
        </div>
    </article>
<?php endif; ?>