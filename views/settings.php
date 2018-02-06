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
		<script type="text/javascript" src="resources/js/topnav.js"></script>
	</head>

	<body>
		<!-- NAVIGATION -->
		<?php include('controllers/navbar.php'); ?>

		<section class="hero is-fullheight">
			<div class="hero-body">
				<div class="container">
					<div class="columns is-centered">
						<form class="column is-half" enctype="multipart/form-data" method="POST" name="settings">
							<div class="column">
								<p class="control has-icons-left">
									<input class="input" type="text" name="username" value="" placeholder="Enter new username" autocomplete="on" autofocus>
									<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
								</p>
								<p class="help" id="infos_username"></p>
							</div>
							<div class="column">
								<p class="control has-icons-left">
									<input class="input" type="email" name="email" value="" placeholder="Enter new email" autocomplete="on">
									<span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
								</p>
								<p class="help" id="infos_email"></p>
							</div>
							<div class="column">
								<p class="control has-icons-left">
									<input class="input" type="password" name="password" placeholder="Enter new password" autocomplete="on">
									<span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
								</p>
								<p class="help" id="infos_password"></p>
							</div>
							<div class="control column has-text-centered">
								<p><label class="checkbox"><input type="checkbox" name="switch_notifs" <?php echo ($notifs_state == 1 ? 'checked' : '');?>> Enable email notifications</label></p>
								<p class="help" id="infos_notifs"></p>
							</div>
							<div class="control column has-text-centered">
								<p><button class="button is-white is-medium" type="submit">Update</button></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>

<script>

var form = document.forms.namedItem("settings")
form.addEventListener('submit', function(e) {
	var
	infos_username = document.getElementById("infos_username"),
	infos_email = document.getElementById("infos_email"),
	oData = new FormData(document.forms.namedItem("settings"))

	var oReq = new XMLHttpRequest();
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			var data = JSON.parse(this.responseText)

			// Username
			if (data['invalid_username'] == true) {
				infos_username.innerHTML = '4-15 characters, minimum 4 letters (e.g., amerej87)'
				infos_username.style.color = "#ec407a";
			} else if (data['exists_username'] == true) {
				infos_username.innerHTML = "Username already exists"
				infos_username.style.color = "#ec407a";
			} else if (data['updated_username'] == true) {
				infos_username.innerHTML = "Username successfuly updated"
				document.getElementById("nav_username").innerHTML = data['new_username']
				infos_username.style.color = "#42f4a1";
			} else {
				infos_username.innerHTML = ""
			}
			
			// Email
			if (data['invalid_email'] == true) {
				infos_email.innerHTML = 'Invalid email'
				infos_email.style.color = "#ec407a";
			} else if (data['exists_email'] == true) {
				infos_email.innerHTML = "Email already exists"
				infos_email.style.color = "#ec407a";
			} else if (data['updated_email'] == true) {
				infos_email.innerHTML = "Email successfuly updated"
				infos_email.style.color = "#42f4a1";
			} else {
				infos_email.innerHTML = ""
			}

			// Password
			if (data['invalid_password'] == true) {
				infos_password.innerHTML = '8-12 lower/uppercase letters and digits'
				infos_password.style.color = "#ec407a";
			} else if (data['updated_password'] == true) {
				infos_password.innerHTML = "Password successfuly updated"
				infos_password.style.color = "#42f4a1";
			} else {
				infos_password.innerHTML = ""
			}
			
			// Notifications
			if (data['notifs_enabled'] == true) {
				infos_notifs.innerHTML = "Notifications successfuly enabled"
				infos_notifs.style.color = "#42f4a1";
			}
			else {
				infos_notifs.innerHTML = "Notifications successfuly disabled"
				infos_notifs.style.color = "#42f4a1";
			}
		} else {
			console.log("Error " + oReq.status + " occurred uploading your file.")
		}
	}
	oReq.open("POST", "controllers/settings.php", true);
	oReq.send(oData)
	e.preventDefault()
}, false)

</script>