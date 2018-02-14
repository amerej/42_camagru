<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/index.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="en">
		<title>Camagru - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="vendors/css/bulma-0.6.2/css/bulma.css">
		<link rel="stylesheet" type="text/css" href="resources/css/test.css">
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
								<canvas id="canvas" width="640" height="480"></canvas>
							</div>
							<?php include('filters.php'); ?>
							<div class="field takeSnap">
								<input id="snap" type="image" src="resources/img/icons/tequila.png" alt="Submit" width="48" value="camera_on">
							</div>
							<div class="field" id="no_camera"></div>
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
let file_upload = document.querySelector('#file_upload')
let snapshot = document.querySelector('#snapshot')
let user_snap = document.querySelector('#usersSnap')
let context = canvas.getContext('2d')

var flag = false

document.getElementById("snap").addEventListener("click", function() {

	var snap = document.querySelector("#snap")

	if (filters.length == 0 || snap.value == 'no_media')
		return
	
	if (snap.value == 'camera_off') {
		var image = document.querySelector('#my_img')
	}
	else {
		context.drawImage(video, 0, 0, 640, 480)
		var image = new Image()
		image.src = canvas.toDataURL("image/png")
	}

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
	video.src = window.URL.createObjectURL(stream)
}

function videoError(e) {
	snapshot.innerHTML = '<img src=\'resources/img/icons/lock.png\'>'
	no_camera.innerHTML = '<input id=\'file\' type=\'file\' multiple />' +
		'<a id=\'file_upload\' onclick=\'fileUpload()\' class=\'button is-white\'>Upload</a>'
	snap.setAttribute('value', 'no_media')
}

function fileUpload () {
	var input = document.querySelector('#file')

	if (input.files && input.files[0]) {
		if (!input.files[0].name.match(/.(png)$/i)) {
			return
		}
		var reader = new FileReader()

		reader.onload = function (e) {
			snapshot.innerHTML = '<img id=\'my_img\' src=\'#\' alt="your image" />'
			var myImg = document.querySelector('#my_img')
			myImg.setAttribute('src', e.target.result)
		}
		reader.readAsDataURL(input.files[0])
		snap.setAttribute('value', 'camera_off')
	}
}

</script>
