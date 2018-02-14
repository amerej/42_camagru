<?php
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/picture.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="en">
		<title>Camagru - Snaps</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="vendors/css/bulma-0.6.2/css/bulma.css">
		<link rel="stylesheet" type="text/css" href="resources/css/test.css">
		<script type="text/javascript" src="resources/js/topnav.js"></script>
	</head>
	<body>
		<!-- NAVIGATION -->
		<?php include('navbar.php'); ?>
		
		<section class="picture">
			<div class="container">
				<div class="columns is-centered">
					<div class="column is-two-thirds">
						<div class="column">
							<div class="card">
								<div class="card-image">
									<figure class="image is-4by3">
										<img class="" src="<?php echo $picture['filename']; ?>"/>
									</figure>
								</div>
								<div class="card-content">
									<div class="media">
										<div class="media-content">
											<p>
												<strong>
													<?php echo $picture['username'] ?>
												</strong>
												<small>
													<?php echo $picture['date'] ?>
												</small>
											</p>
										</div>
										<div class="media-right">
											<?php include('like.php'); ?>
										</div>
										<div class="media-right">
											<figure class="image is-32x32">
												<img id="submit_like" src="resources/img/icons/heart.png" alt="Like">
											</figure>
										</div>
										<?php if (isset($user_id) && $user_id == $picture['idUser']) : ?>
											<div class="media-right">
												<figure class="image is-32x32">
													<img onclick="deleteImg();" src="resources/img/icons/rubbish.png" alt="Delete">
												</figure>
											</div>
											<div class="media-right">
											<a 
  												href="https://twitter.com/intent/tweet?text=http%3A%2F%2Flocalhost%3A8080%2Fcamagru%2F<?php echo $filename; ?>">
													Tweet</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="card">
								<div class="card-content">
									<div class="media">
										<div class="media-content">
											<textarea class="textarea" id="content" name="content" placeholder="Enter your comment here..." rows="1"></textarea>
										</div>
										<div class="media-right">
											<figure class="image is-32x32">
												<img id="submit" src="resources/img/icons/send.png" alt="Send">
											</figure>
										</div>
									</div>
								</div>
							</div>
							<div class="column comments" id="comments">
								<?php include('comment.php'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>

<script>

window.ajaxready = true
let offset = 10

function deleteImg() {

	var oReq = new XMLHttpRequest();
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			location.href = 'gallery.php'
		}
	}
	oReq.open("POST", "picture.php?id=<?php echo $picture_id ?>", true);
	oReq.send()
}

document.getElementById("submit_like").addEventListener("click", function() {

	var likes = document.querySelector('#likes')

	var formData = new FormData()
	formData.append("picture_id", <?php echo $picture_id ?>)
	formData.append("user_id", <?php echo $_SESSION['user']['id'] ?>)

	var oReq = new XMLHttpRequest()
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			likes.innerHTML = oReq.responseText
		}
	}
	oReq.open("POST", "like.php?id=<?php echo $picture_id ?>", true)
	oReq.send(formData)
}, false)

document.getElementById("submit").addEventListener("click", function() {
	
	var content = document.querySelector('#content')
	var comments = document.querySelector('#comments')

	var formData = new FormData()
	formData.append("picture_id", <?php echo $picture_id ?>)
	formData.append("user_id", <?php echo $_SESSION['user']['id'] ?>)
	formData.append("content", content.value)

	var oReq = new XMLHttpRequest()
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			comments.innerHTML = oReq.responseText
			content.value = ""
			// window.ajaxready = true
		}
	}
	offset += 1
	window.ajaxready = true
	oReq.open("POST", "comment.php?id=<?php echo $picture_id ?>&limit=" + offset, true);
	oReq.send(formData)
}, false)

// Infinite scroll comments
let comments = document.querySelector('#comments')
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
					offset += 10
					comments.innerHTML += oReq.responseText
					window.ajaxready = true
				}
			}
		}
		oReq.open("GET", "comment.php?id=<?php echo $picture_id ?>&offset=" + offset, true)
		oReq.send()
	}
})


function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms))
}

</script>