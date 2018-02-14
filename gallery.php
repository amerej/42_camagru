<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/gallery.php';

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
		
		<section class="gallery">
			<div class="container has-text-centered" id="gallery">
				<?php include('gallery_snap.php'); ?>
			</div>
		</section>
	</body>
</html>

<script>

window.ajaxready = true
let offset = 20

// Infinite scroll comments
let pictures = document.querySelector('#gallery')
let windowHeight = window.innerHeight

document.addEventListener("scroll", function (event) {
	
	if (window.ajaxready == false) return
	var scrollTop = document.documentElement.scrollTop
	var bodyHeight = document.body.clientHeight - windowHeight
	var scrollPercentage = (scrollTop / bodyHeight)

	if(scrollPercentage > 0.8) {
		// Load content
		window.ajaxready = false
		var oReq = new XMLHttpRequest()
		oReq.onload = async function(oEvent) {
			if (oReq.status == 200) {
				await sleep(1000)
				if (oReq.responseText != '') {
					offset += 20
					pictures.innerHTML += oReq.responseText
					window.ajaxready = true
				}
			}
		}
		oReq.open("GET", "gallery_snap.php?offset=" + offset, true)
		oReq.send()
	}
})

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms))
}

</script>