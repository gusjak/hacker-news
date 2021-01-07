<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
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

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/posts.php' ? 'active' : ''; ?>" href="/posts.php">Your Posts</a>
            <?php else : ?>
                <!-- Hide submit nav-item if user is nog logged in -->
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- Hide register nav-item if user is logged in -->
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/register.php' ? 'active' : ''; ?>" href="/register.php">Register</a>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/settings.php' ? 'active' : ''; ?>" href="/settings.php">Settings</a>
            <?php else : ?>
                <!-- Hide profile nav-item if user is nog logged in -->
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/app/users/logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>
        </li><!-- /nav-item -->
    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->