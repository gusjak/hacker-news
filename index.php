<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<article>
    <h1><?php echo $config['title']; ?></h1>
    <p><?php $message ?><p>
            <p>This is the homepage section with the top rated posts.</p>
            <?php if (loggedIn()) : ?>
                <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
            <?php else : ?>
                <p>Welcome, guest!</p>
            <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>