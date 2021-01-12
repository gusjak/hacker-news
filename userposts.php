<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = $_SESSION['user'];
$userId = $_SESSION['user']['id'];
$allUserPosts = getUserPosts($userId, $pdo);
?>

<?php if (loggedIn()) : ?>
    <article>
        <div class="card shadow p-4 mb-4 bg-white mw-100">
            <h4><?php echo $user['username']; ?>'s submitted posts</h4>
            <?php if (!$allUserPosts) : ?>
                <br>
                <p>You haven't submitted anything yet.</p>
            <?php else : ?>
                <br>
                <?php foreach ($allUserPosts as $userPost) : ?>
                    <?php $currentUserId = $_SESSION['user']['id']; ?>
                    <?php $userPostId = $userPost['user_id']; ?>
                    <?php $upvotes = countUpvotes($userPost['id'], $pdo); ?>
                    <?php $alreadyUpvoted = alreadyUpvoted($userPost['id'], $currentUserId, $pdo); ?>
                    <?php $numberOfComments = countNumberOfComments($userPost['id'], $pdo); ?>

                    <div class="card shadow-sm p-4 mb-4 bg-light mw-100">
                        <img loading="lazy" src="<?php echo '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar" width="50px">
                        <small class="form-text text-muted"><?php echo $user['username'] ?></small>
                        <br>
                        <h6><strong><?php echo $userPost['title'] ?></strong></h6>
                        <a href="#"><?php echo $userPost['url'] ?></a>
                        <p><?php echo $userPost['text'] ?></p>
                        <small class="form-text text-muted">Posted: <?php echo $userPost['date']; ?></small>
                        <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>
                        <small class="form-text"><a href="/post.php?id=<?php echo $userPost['id']; ?>"><?php echo $numberOfComments; ?> comments</a></small>
                        <small class="form-text">
                            <?php if ($currentUserId === $userPostId) : ?>
                                <a href="/updateuserpost.php?id=<?php echo $userPost['id']; ?>">Edit</a>
                            <?php endif; ?>
                        </small>
                    </div>
                    <div class="py-1"></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>