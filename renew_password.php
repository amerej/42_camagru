<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/renew_password.php';
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
						<form class="column is-half" method="POST" enctype="multipart/form-data" name="renew_password">
						<div class="field"><p id="updated_password"></p></div>
						<div class="field">
							<p class="control has-icons-left">
								<input class="input" type="password" name="password" placeholder="Enter new password" autocomplete="on" required>
								<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
							</p>
							<p class="help" id="infos_password"></p>
						</div>
							<div class="control field has-text-centered">
								<p><button class="button is-white is-medium" type="submit">Submit</button></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>

<script>

var form = document.forms.namedItem("renew_password")
form.addEventListener('submit', function(e) {
	var
	infos_password = document.getElementById("infos_password"),
	updated_password = document.getElementById("updated_password"),
	oData = new FormData(document.forms.namedItem("renew_password"))
	oData.append('email', '<?php echo $_GET['email']; ?>');
	oData.append('token', '<?php echo $_GET['token']; ?>');

	var oReq = new XMLHttpRequest()
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			var data = JSON.parse(this.responseText)

			// Username
			if (data['invalid_password']) {
				infos_password.innerHTML = '8-12 lower/uppercase letters and digits'
				infos_password.style.color = "#ec407a";
			} else if (data['bad_token']) {
				updated_password.innerHTML = "You're so ugly"
				infos_password.innerHTML = ''
			} else if (data['updated_password']) {
				window.location = "login.php";
			} else {
				infos_password.innerHTML = ""
				updated_password.innerHTML = ""
			}
		} else {
			console.log("Error " + oReq.status)
		}
	}
	oReq.open("POST", "controllers/renew_password.php", true);
	oReq.send(oData)
	e.preventDefault()
}, false)

</script>