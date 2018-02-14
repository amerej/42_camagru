<?php
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/navbar.php';
?>

<nav class="navbar is-transparent" role="navigation" aria-label="dropdown navigation">
	<div class="navbar-brand">
		<p class="navbar-item">Camagru</p>
		<div class="navbar-burger burger" data-target="navMenu">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="navbar-menu" id="navMenu">
		<div class="navbar-end">
			<?php if (isset($username)) : ?>
				<a class="navbar-item" href="index.php">Snap</a>
				<a class="navbar-item" href="gallery.php">Gallery</a>
				<div class="navbar-item has-dropdown is-hoverable">
					<a class="navbar-link" id="nav_username"><?php echo $username ?></a>
					<div class="navbar-dropdown is-right">
						<a class="navbar-item" href="settings.php">Settings</a>
						<hr class="navbar-divider">
						<div class="navbar-item">
							<a href="logout.php">Logout</a>
						</div>
					</div>
				</div>
			<?php else : ?>
				<a class="navbar-item" href="login.php">Login</a>
				<a class="navbar-item" href="signin.php">Create account</a>
			<?php endif; ?>
		</div>
	</div>
</nav>