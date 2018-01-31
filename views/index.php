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
		<?php include('controllers/navbar.php'); ?>

		<!-- SNAP SECTION -->
		<section class="snapTest">
			<div class="container has-text-centered">
				<div class="columns is-centered">
					<div class="column is-half">
						<?php include('views/snap.php'); ?>
						<div class="field">
							<div class="video" id="snapshot">
								<video id="video" autoplay="true"></video>
							</div>
							<canvas id="canvas" width="640" height="480"></canvas>
							<?php include('views/filters.php'); ?>
							<div class="field takeSnap">
								<input id="snap" type="image" src="resources/img/icons/tequila.png" alt="Submit" width="48">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script>
			var canvas = document.querySelector('#canvas');
			var video = document.querySelector('#video');
			var context = canvas.getContext('2d');

			document.getElementById("snap").addEventListener("click", function() {
				context.drawImage(video, 0, 0, 640, 480);
				var image = new Image();
				image.src = canvas.toDataURL("image/png");

				var formData = new FormData()

				formData.append("image", image.src)
				formData.append("filters", JSON.stringify(filters))
				
				var xmlhttp = new XMLHttpRequest();
	
				xmlhttp.onreadystatechange = function() {
		
					if (this.readyState == 4 && this.status == 200) {
						var test = new XMLHttpRequest();
						test.onreadystatechange = function() {
		
						if (this.readyState == 4 && this.status == 200) {
							var t = document.querySelector('#usersSnap');
							t.innerHTML = test.responseText;
						}
					};
					test.open("GET", "views/snap.php", true);
					test.send();
					}
				};
				xmlhttp.open("POST", "controllers/snap.php", true);
				xmlhttp.send(formData);
			});
		</script>
	</body>
</html>

<script>
	var video = document.querySelector("#video");
 
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
 
if (navigator.getUserMedia) {    
	navigator.getUserMedia({video: true}, handleVideo, videoError);
}
 
function handleVideo(stream) {
	video.src = window.URL.createObjectURL(stream);
}
 
function videoError(e) {
	// do something
}
</script>

