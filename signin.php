<?php
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/signin.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="en">
		<title>Camagru - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="vendors/css/bulma-0.6.2/css/bulma.css">
		<link rel="stylesheet" type="text/css" href="resources/css/test.css">
	</head>

	<body>
		<section class="hero is-fullheight">
			<div class="hero-body">
				<div class="container">
					<div class="columns is-centered">
						<form class="column is-half" method="POST" action="signin.php">
							<div class="field">
								<p class="control">
									<input class="input" type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter username" autocomplete="on" required>
								</p>
								<p class="help">Already username ? <a href="login.php">login</a></p>
							</div>
							<div class="field">
								<p class="control">
									<input class="input" type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" autocomplete="email" required>
								</p>
								<p class="help">Enter valid email</p>
							</div>
							<div class="field">
								<p class="control">
									<input class="input" type="password" name="password" placeholder="Enter password" autocomplete="on" required>
								</p>
								<p class="help">8 characters, numbers and letters</p>
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