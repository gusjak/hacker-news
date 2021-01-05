<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) :
    redirect('/');
endif;
?>


<article>
    <h1><?php echo $_SESSION['user']['username']; ?>'s profile</h1>
    <p>Here you will be able to make changes to your personal information later.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>