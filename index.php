<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/index.php';

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
		<script type="text/javascript" src="resources/js/topnav.js"></script>
	</head>
	
	<body>
		<!-- NAVIGATION -->
		<?php include('navbar.php'); ?>

		<!-- SNAP SECTION -->
		<section class="snapTest">
			<div class="container has-text-centered">
				<div class="columns is-centered">
					<div class="column is-half">
						<?php include('snap.php'); ?>
						<div class="field">
							<div class="video" id="snapshot">
								<video id="video" autoplay="true"></video>
							</div>
							<canvas id="canvas" width="640" height="480"></canvas>
							<?php include('filters.php'); ?>
							<div class="field takeSnap">
								<input id="snap" type="image" src="resources/img/icons/tequila.png" alt="Submit" width="48">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>

<script>

let video = document.querySelector("#video")
let canvas = document.querySelector('#canvas')
let user_snap = document.querySelector('#usersSnap')
let context = canvas.getContext('2d')

document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 640, 480)
	var image = new Image()
	image.src = canvas.toDataURL("image/png")

	var formData = new FormData()

	formData.append("image", image.src)
	formData.append("filters", JSON.stringify(filters))
	
	var oReq = new XMLHttpRequest()

	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			user_snap.innerHTML = oReq.responseText
		}
	}
	oReq.open("POST", "snap.php", true)
	oReq.send(formData)
}, false)

navigator.getUserMedia = 
navigator.getUserMedia || 
navigator.webkitGetUserMedia || 
navigator.mozGetUserMedia || 
navigator.msGetUserMedia || 
navigator.oGetUserMedia

if (navigator.getUserMedia) {
	navigator.getUserMedia({video: true}, handleVideo, videoError)
}

function handleVideo(stream) {
	video.src = window.URL.createObjectURL(stream);
}

function videoError(e) {
	console.log("bite")
}
</script>
