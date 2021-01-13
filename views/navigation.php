<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/index.php"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav mr-auto">
        <div class="d-flex flex-row">
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/new.php' ? 'active' : ''; ?>" href="/new.php">New</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/submit.php' ? 'active' : ''; ?>" href="/submit.php">Submit</a>
                <?php else : ?>
                    <!-- Hide submit nav-item if user is nog logged in -->
                <?php endif; ?>
            </li><!-- /nav-item -->
        </div>
    </ul><!-- /navbar-nav -->

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- Hide register nav-item if user is logged in -->
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/register.php' ? 'active' : ''; ?>" href="/register.php">Register</a>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- Hide login nav-item if user is already logged in -->
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item dropdown dropleft">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo '/app/users/images/' . $_SESSION['user']['avatar'] ?>" width="50px" class="rounded-circle" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item <?php echo $_SERVER['SCRIPT_NAME'] === '/userposts.php' ? 'active' : ''; ?>" href="/userposts.php?id=<?php echo $_SESSION['user']['id'] ?>">My Posts</a>
                    <a class="dropdown-item <?php echo $_SERVER['SCRIPT_NAME'] === '/settings.php' ? 'active' : ''; ?>" href="/settings.php?id=<?php echo $_SESSION['user']['id'] ?>">Settings</a>
                    <a class="dropdown-item" href="/app/users/logout.php">Logout</a>
                </div>
            </li>
        <?php endif; ?>

        <button type="button" class="btn btn-link toggle">🌙</button>

    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->