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
						<form class="column is-half" enctype="multipart/form-data" method="POST" name="forgot_password">
							<div class="field">
								<p id="email_sent"></p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input" type="email" name="email" placeholder="Enter email" autocomplete="email" required>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help" id="infos_email"></p>
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

<script>

var form = document.forms.namedItem("forgot_password")
form.addEventListener('submit', function(e) {
	var
	infos_email = document.getElementById("infos_email"),
	email_sent = document.getElementById("email_sent")
	oData = new FormData(document.forms.namedItem("forgot_password"))

	var oReq = new XMLHttpRequest()
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			var data = JSON.parse(this.responseText)

			// Username
			if (data['invalid_email'] == true) {
				infos_email.innerHTML = 'You must provide a valid email'
				infos_email.style.color = "#ec407a";
			} else if (data['notfound_email'] == true) {
				infos_email.innerHTML = "Email not found"
				infos_email.style.color = "#ec407a";
			} else if (data['email_sent'] == true) {
				email_sent.innerHTML = "Hey, i just sent you an email at " + data['email_account'] + " please follow the instructions to renew your password."
				infos_email.innerHTML = ""
			} else {
				infos_email.innerHTML = ""
				email_sent.innerHTML = ""
			}
		} else {
			console.log("Error " + oReq.status)
		}
	}
	oReq.open("POST", "controllers/forgot_password.php", true);
	oReq.send(oData)
	e.preventDefault()
}, false)

</script>