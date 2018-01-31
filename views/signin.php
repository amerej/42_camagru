<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="en">
		<title>Camagru - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
		<link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css">
		<link rel="stylesheet" type="text/css" href="resources/css/test.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
	</head>

	<body>
		<section class="hero is-fullheight">
			<!-- Hero content: will be in the middle -->
			<div class="hero-body">
				<div class="container">
					<div class="columns is-centered">
						<form class="column is-half" method="GET" action="signin.php">
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" id="username" name="username" type="text" placeholder="Enter username" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help">Already username ? <a href="login.php">login</a></p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" id="email" name="email" type="email" placeholder="Enter Email" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
								</p>
								<p class="help">Enter valid email</p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" id="password" name="password" type="password" placeholder="Enter password" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
								</p>
								<p class="help">8 characters, numbers and letters</p>
							</div>
							<div class="control field has-text-centered">
								<p><button id="submit" type="submit" class="button is-white is-medium">Register</button></p>
							</div>
						</form>
					</div>
					<div class="container has-text-centered">
						<div class="columns is-centered">
							<div class="column is-half">
								<?php if (isset($_GET['username']) && $_GET['username'] == 'exists') : ?>
									<p style="color: #ec407a;">Username already exists ! Choose another.</p>
								<?php endif; ?>
								<?php if (isset($_GET['email']) && $_GET['email'] == 'exists') : ?>
									<p style="color: #ec407a;">Email already exists ! Choose another.</p>
								<?php endif; ?>
								<?php if (isset($_GET['password']) && $_GET['password'] == 'weak') : ?>
									<p style="color: #ec407a;">Password too weak ! Need at least 8 characters, must include one number and one letter.</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>