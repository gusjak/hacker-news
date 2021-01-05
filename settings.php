<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
if (!isset($_SESSION['user'])) :
    redirect('/');
endif;
?>

<?php
$user = getUserById($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
?>

<article>
    <p><?php $message ?>
    <h2><?php echo $_SESSION['user']['username']; ?>'s profile settings.</h2>

    <br>

    <?php if (loggedIn()) : ?>
        <img loading="lazy" src="<?= '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar" width="100px">
    <?php endif; ?>

    <br>

    <form action="app/users/updateavatar.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="avatar">Change profile avatar</label>
            <small class="form-text text-muted">Accepted formats are jpg, jpeg & png.</small>
            <input type="file" accept=".jpg, .jpeg, .png" name="avatar" required>
        </div>

        <button type="submit" class="btn btn-secondary">Upload image</button>
    </form>

    <br>

    <form action="app/users/settings.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="text" name="edit-first-name" placeholder="<?= $user['first_name'] ?>">
            <small class="form-text text-muted">Change first name</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="text" name="edit-last-name" placeholder="<?= $user['last_name'] ?>">
            <small class="form-text text-muted">Change last name</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-secondary">Save changes</button>
    </form>

    <br>

    <h3>About</h3>
    <form action="app/users/settings.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <textarea class="form-control rounded-0" name="biography" placeholder="<?= $user['biography'] ?>" rows="10"></textarea>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-secondary">Save changes</button>
    </form>

    <br>

    <h3>Change email</h3>
    <form action="app/users/updateemail.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="email" name="current-email" placeholder="<?= $user['email'] ?>">
            <small class="form-text text-muted">Current Email</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="email" name="new-email">
            <small class="form-text text-muted">New Email</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="email" name="comfirm-email">
            <small class="form-text text-muted">Comfirm New Email</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-secondary">Save changes</button>
    </form>

    <br>

    <h3>Change password</h3>
    <form action="app/users/updatepassword.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="password" name="current-password" id="password">
            <small class="form-text text-muted">Current Password</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="password" name="new-password" id="password">
            <small class="form-text text-muted">New Password</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="password" name="comfirm-password" id="password">
            <small class="form-text text-muted">Comfirm New Password</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-secondary">Save changes</button>
    </form>

    <br>

    <button type="button" class="btn btn-danger">Delete Account</button>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>