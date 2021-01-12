<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$user = getUserById($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
?>

<article>
    <p><?php $message ?></p>
    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <h4>Username: <?php echo $user['username'] ?></h4>

        <br>

        <?php if (loggedIn()) : ?>
            <img loading="lazy" src="<?php echo '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar" width="100px">
        <?php endif; ?>

        <br>
        <br>

        <form action="app/users/updateavatar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" accept=".jpg, .jpeg, .png" name="avatar" required>
                <small class="form-text text-muted">Accepted formats are jpg, jpeg & png.</small>
            </div>

            <button type="submit" class="btn btn-secondary">Save changes</button>
        </form>
    </div>

    <br>

    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <form action="app/users/settings.php" method="post">
            <div class="form-group">
                <small class="form-text text-muted">First name</small>
                <input class="form-control" type="text" name="edit-first-name" placeholder="<?php echo $user['first_name'] ?>">
                <small class="form-text text-muted">You may change this by filling out this field.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <small class="form-text text-muted">Last name</small>
                <input class="form-control" type="text" name="edit-last-name" placeholder="<?php echo $user['last_name'] ?>">
                <small class="form-text text-muted">You may change this by filling out this field.</small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-secondary">Save changes</button>
        </form>
    </div>

    <br>

    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <h3>About</h3>
        <form action="app/users/settings.php" method="post">
            <div class="form-group">
                <textarea class="form-control rounded-0" name="biography" rows="5"><?php echo $user['biography'] ?></textarea>
                <small class="form-text text-muted">You may change this by filling out this field.</small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-secondary">Save changes</button>
        </form>
    </div>

    <br>

    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <h3>Change email</h3>
        <form action="app/users/updateemail.php" method="post">
            <div class="form-group">
                <input class="form-control" type="email" name="current-email" placeholder="<?php echo $user['email'] ?>">
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
    </div>

    <br>

    <div class="card shadow p-4 mb-4 bg-white mw-100">
        <h3>Change password</h3>
        <form action="app/users/updatepassword.php" method="post">
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
    </div>
    <br>
    <button type="button" class="btn btn-danger">Delete Account</button>
    <div class="pb-5"></div>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>