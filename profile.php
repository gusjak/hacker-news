<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = getUserById($_GET['id'], $pdo);
?>

<article>
    <p><?php $message ?></p>
    <div class="card shadow p-4 mb-4 bg-card mw-100">
        <img class="rounded-circle" loading="lazy" src="<?php echo '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar" width="75px">
        <div class="py-3"></div>
        <h4>Username: <?php echo $user['username']; ?></h4>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Name: <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
        <p>About: <?php echo $user['biography']; ?></p>

        <?php if (loggedIn() && $_SESSION['user']['id'] === $user['id']) : ?>
            <a href="/settings.php?id=<?php echo $user['id']; ?>">
                <button type="submit" class="btn btn-success">Edit Settings</button>
            </a>
        <?php endif; ?>
        <div class="py-1"></div>
        <a href="/index.php">
            <button type="submit" class="btn btn-primary">Back</button>
        </a>
    </div>
</article>


<?php require __DIR__ . '/views/footer.php'; ?>