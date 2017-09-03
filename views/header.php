<header>
    <div class="hero-text-box">
        <h1>Welcome to my awesome Camagru !</h1>
    </div>
	<nav>
        <?php if (!(isset($_SESSION['username']))) : ?>
            <a href="login.php">Login</a>
        <?php else : ?>
		    <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>
