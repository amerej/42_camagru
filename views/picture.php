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
		
		<section class="picture">
			<div class="container">
				<div class="columns is-centered">
					<div class="column is-two-thirds">
						<div class="column">
							<div class="card">
								<div class="card-image"><figure class="image is-4by3"><img class="" src="<?php echo $picture['filename']; ?>"/></figure></div>
								<div class="card-content">
									<div class="media">
										<div class="media-content"><p><strong><?php echo $picture['username'] ?></strong> <small><?php echo $picture['date'] ?></small></p></div>
										<div class="media-right"><?php include('like.php'); ?></div>
										<div class="media-right"><figure class="image is-32x32"><img id="submit_like" src="resources/img/icons/heart.png" alt="Like"></figure></div>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="card">
								<div class="card-content">
									<div class="media">
										<div class="media-content"><textarea class="textarea" id="content" name="content" placeholder="Enter your comment here..." rows="1"></textarea></div>
										<div class="media-right"><figure class="image is-32x32"><img id="submit" src="resources/img/icons/send.png" alt="Send"></figure></div>
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
var offset = 2

document.getElementById("submit_like").addEventListener("click", function() {

	var likes = document.querySelector('#likes')

	var formData = new FormData()
	formData.append("picture_id", <?php echo $picture_id ?>)
	formData.append("user_id", <?php echo $_SESSION['user']['id'] ?>)

	var oReq = new XMLHttpRequest();
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			likes.innerHTML = oReq.responseText
		}
	}
	oReq.open("POST", "like.php?id=<?php echo $picture_id ?>", true);
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
			window.ajaxready = true
			//console.log(offset)
			//offset++
		}
	}
	console.log(offset)
	oReq.open("POST", "comment.php?id=<?php echo $picture_id ?>&limit=" + offset, true);
	oReq.send(formData)
}, false)

// Infinite scroll comments


document.addEventListener("scroll", function (event) {
	var scrollTop = document.documentElement.scrollTop
	var windowHeight = window.innerHeight
	var bodyHeight = document.body.clientHeight - windowHeight
	var scrollPercentage = (scrollTop / bodyHeight)
	var comments = document.querySelector('#comments')
	
	if (window.ajaxready == false) return

	if(scrollPercentage > 0.9) {
		// Load content
		window.ajaxready = false
		var oReq = new XMLHttpRequest()
		oReq.onload = function(oEvent) {
			if (oReq.status == 200) {
				if (oReq.responseText != '') {
					offset += 2
					comments.innerHTML += oReq.responseText
					window.ajaxready = true
				}
			}
		}
		oReq.open("GET", "comment.php?id=<?php echo $picture_id ?>&offset=" + offset, true)
		oReq.send()
	}
})

</script>