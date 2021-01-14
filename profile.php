<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = getUserById($_GET['id'], $pdo);
?>

<article>
    <p><?php $message ?></p>
    <div class="card shadow p-4 mb-4 bg-card mw-100">
        <img loading="lazy" src="<?php echo '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar" width="75px">
        <div class="py-3"></div>
        <h4>Username: <?php echo $user['username']; ?></h4>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Name: <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
        <p>About: <?php echo $user['biography']; ?></p>
        <br>
        <a href="/index.php">
            < Back </a>
    </div>
</article>


<?php require __DIR__ . '/views/footer.php'; ?>