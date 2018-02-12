<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/forgot_password.php';
?>

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
			<div class="hero-body">
				<div class="container">
					<div class="columns is-centered">
						<!-- Submit form -->
						<form class="column is-half" method="POST" action="forgot_password.php">
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="email" name="email" placeholder="Enter email" autocomplete="email" required>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help">Enter your email</p>
							</div>
							<div class="control field has-text-centered">
								<p><button class="button is-white is-medium" type="submit">Send</button></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>