<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Register</h1>
    <p><?php $message ?><p>

            <form action="app/users/register.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="username" name="username" id="username" required>
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="comfirm_password">Comfirm password</label>
                    <input class="form-control" type="password" name="comfirm_password" id="password" required>
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>