<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$id = (int) $_SESSION['user']['id'];
$user = getUserById($id, $pdo);
$userPosts = displayUserPosts($id, $pdo);
?>

<?php if (loggedIn()) : ?>
    <article>
        <h4><?php echo $user['username'] ?>'s posts</h4>

        <br>
        <?php foreach ($userPosts as $userPost) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $userPostId = $userPost['user_id']; ?>
            <img loading="lazy" src="<?php echo '/app/users/images/' . $userPost['avatar'] ?>" alt="user-avatar" width="50px">
            <small class="form-text text-muted"><?php echo $userPost['username'] ?></small>
            <br>
            <h6><strong><?php echo $userPost['title'] ?></strong></h6>
            <a href="#"><?php echo $userPost['url'] ?></a>
            <p><?php echo $userPost['text'] ?></p>
            <small class="form-text text-muted">Posted: <?php echo $userPost['date']; ?></small>
            <br>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>