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
    <h1><?php echo $_SESSION['user']['username']; ?>'s profile settings.</h1>
    <p><?php $message ?><p>

            <?php if (loggedIn()) : ?>
                <img loading="lazy" src="<?= '/app/users/images/' . $user['avatar'] ?>" alt="user-avatar">
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user-avatar">Change profile avatar.</label>
                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="user-avatar" required>
                    <small class="form-text text-muted">Accepted formats are jpg, jpeg & png.</small>
                    <button type="submit" class="btn btn-secondary">Upload image</button>
                </div>
            </form>

            <form action="/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="first-name" name="edit-first-name" placeholder="<?= $user['first_name'] ?>">
                    <small class="form-text text-muted">Change first name</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <input class="form-control" type="last-name" name="edit-last-name" placeholder="<?= $user['last_name'] ?>">
                    <small class="form-text text-muted">Change last name</small>
                </div><!-- /form-group -->
            </form>

            <h3>About</h3>
            <form action="/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control rounded-0" name="biography" placeholder="<?= $user['biography'] ?>" rows="10"></textarea>
                </div><!-- /form-group -->
            </form>

            <h3>Change password</h3>
            <form action="/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email">
                    <small class="form-text text-muted">Current Email</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email">
                    <small class="form-text text-muted">New Email</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email">
                    <small class="form-text text-muted">Comfirm New Email</small>
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-secondary">Save changes</button>
            </form>

            <br>

            <h3>Change password</h3>
            <form action="/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="password">
                    <small class="form-text text-muted">Current Password</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="password">
                    <small class="form-text text-muted">New Password</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <input class="form-control" type="password" name="comfirm_password" id="password">
                    <small class="form-text text-muted">Comfirm New Password</small>
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-secondary">Save changes</button>
            </form>

            <br>
            <br>

            <button type="button" class="btn btn-danger">Delete Account</button>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>