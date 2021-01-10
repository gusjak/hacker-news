<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php $allPosts = sortByUpvotes($pdo); ?>

<?php if (loggedIn()) : ?>
    <article>
        <h4><strong>Most upvoted posts</strong></h4>

        <br>

        <?php foreach ($allPosts as $post) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $userPostId = $post['user_id']; ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <?php $alreadyUpvoted = alreadyUpvoted($post['id'], $currentUserId, $pdo); ?>
            <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $post['username'] ?></small>
            <br>
            <h6><strong><?php echo $post['title'] ?></strong></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
            <?php if ($alreadyUpvoted) : ?>
                <form action="app/posts/upvotes.php" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Downvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php else : ?>
                <form action="app/posts/upvotes.php" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Upvote</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php endif; ?>
            <small class="form-text text-muted">Posted: <?php echo $post['date']; ?></small>
            <form action="/post.php" method="post">
                <button class="btn btn-link" type="submit" name="submit">Comment</button>
                <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
            </form>

            <?php if ($currentUserId === $userPostId) : ?>
                <form action="/updateuserpost.php" method="post">
                    <button class="btn btn-link" type="submit" name="submit">Edit</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
    </article>

<?php else : ?>
    <article>

        <h4><strong>Most upvoted posts</strong></h4>

        <br>

        <?php foreach ($allPosts as $post) : ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <img loading="lazy" src="<?= '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $post['username'] ?></small>
            <br>
            <h6><?php echo $post['title'] ?></h6>
            <a href="#"><?php echo $post['url'] ?></a>
            <p><?php echo $post['text'] ?></p>
            <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
            <small class="form-text text-muted">Posted: <?php echo $post['date']; ?></small>
            <br>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>