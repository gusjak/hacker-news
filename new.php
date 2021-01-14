<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php $allPosts = getAllPosts($pdo); ?>

<?php if (loggedIn()) : ?>
    <article>
        <h4><strong>Most recent posts</strong></h4>
        <p><?php $message ?></p>
        <br>
        <?php foreach ($allPosts as $post) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $userPostId = $post['user_id']; ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <?php $alreadyUpvoted = alreadyUpvoted($post['id'], $currentUserId, $pdo); ?>
            <?php $numberOfComments = countNumberOfComments($post['id'], $pdo); ?>

            <div class="card shadow p-4 mb-4 bg-card mw-100">
                <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
                <?php if ($currentUserId === $userPostId) : ?>
                    <small class="text-muted"><a href="/settings.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <?php endif; ?>
                <br>
                <h6><strong><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></strong></h6>
                <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
                <p><?php echo $post['text'] ?></p>
                <small class="text-muted">Upvotes: <?php echo $upvotes; ?></small>
                <?php if ($alreadyUpvoted) : ?>
                    <form action="app/posts/upvotesnew.php" method="post">
                        <svg width="11" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.5902 7.7696a.5112.5112 0 00.1789.1693A.4743.4743 0 005.0013 8a.4742.4742 0 00.2322-.0611.5112.5112 0 00.1788-.1693L9.9127.8367A.5563.5563 0 0010.001.566a.5625.5625 0 00-.056-.2804.5204.5204 0 00-.1843-.2088A.4763.4763 0 009.5017 0H.5008a.478.478 0 00-.2582.0777.522.522 0 00-.1835.2087.5642.5642 0 00-.0564.2797.558.558 0 00.087.2706l4.5004 6.9329z" fill="#BC3636" />
                        </svg>
                        <button class="btn btn-link text-decoration-none" type="submit" name="submit"> Downvote</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                    </form>
                <?php else : ?>
                    <form action="app/posts/upvotesnew.php" method="post">
                        <svg width="10" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M.4998 8h9.0003a.4773.4773 0 00.2583-.0777.5227.5227 0 00.1838-.209.5664.5664 0 00.0564-.2803.5599.5599 0 00-.087-.2713L5.4115.216c-.1866-.288-.6356-.288-.8226 0L.0888 7.1617a.5579.5579 0 00-.0883.2713.5645.5645 0 00.056.281.521.521 0 00.1843.2091A.4757.4757 0 00.4998 8z" fill="#50C14D" />
                        </svg>
                        <button class="btn btn-link text-decoration-none" type="submit" name="submit"> Upvote</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                    </form>
                <?php endif; ?>
                <small class="text-muted">Posted: <?php echo $post['date']; ?></small>
                <?php if ($numberOfComments == 1) : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comment</a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comments</a></small>
                <?php endif; ?>
                <small class="text-muted">
                    <?php if ($currentUserId === $userPostId) : ?>
                        <a href="/updateuserpost.php?id=<?php echo $post['id']; ?>">Edit Post</a>
                    <?php endif; ?>
                </small>
            </div>
            <div class="py-1"></div>
        <?php endforeach; ?>
    </article>

<?php else : ?>
    <article>
        <h4><strong>Most recent posts</strong></h4>
        <br>
        <?php foreach ($allPosts as $post) : ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <?php $numberOfComments = countNumberOfComments($post['id'], $pdo); ?>

            <div class="card shadow p-4 mb-4 bg-card mw-100">
                <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
                <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <br>
                <h6><strong><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></strong></h6>
                <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
                <p><?php echo $post['text'] ?></p>
                <small class="text-muted">Upvotes: <?php echo $upvotes; ?></small>
                <small class="text-muted">Posted: <?php echo $post['date']; ?></small>
                <?php if ($numberOfComments == 1) : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comment</a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comments</a></small>
                <?php endif; ?>
            </div>
            <div class="py-1"></div>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>