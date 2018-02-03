<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="en">
		<title>Camagru - Settings</title>
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
						<form class="column is-half" method="POST" action="signin.php">
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter new username" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help">4-15 letters and optional digits</p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
								</p>
								<p class="help">Enter valid email</p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="password" name="password" placeholder="Enter new password" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
								</p>
								<p class="help">8-12 lower/uppercase letters and digits</p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="password" name="password" placeholder="Confirm new password" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
								</p>
								<p class="help">8-12 lower/uppercase letters and digits</p>
							</div>
							<div class="control field has-text-centered">
								<p><button class="button is-white is-medium" type="submit" name="submit">Register</button></p>
							</div>
						</form>
					</div>
					<div class="container has-text-centered">
						<div class="columns is-centered">
							<div class="column is-half">
								<p style="color: #ec407a;"><?php echo $username_error; ?></p>
								<p style="color: #ec407a;"><?php echo $email_error; ?></p>
								<p style="color: #ec407a;"><?php echo $password_error; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>