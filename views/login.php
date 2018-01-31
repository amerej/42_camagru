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
						<form class="column is-half" method="POST" action="login.php">
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" id="username" name="username" type="text" placeholder="Enter username" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help">No username ?<a href="signin.php"> Create account</a></p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" id="password" name="password" type="password" placeholder="Enter password" autocomplete="on" required>
									<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
								</p>
								<p class="help">Forgot password ?<a href="#"> Click here</a></p>
							</div>
							<div class="control field has-text-centered">
								<p><button id="submit" type="submit" class="button is-white is-medium">Login</button></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>