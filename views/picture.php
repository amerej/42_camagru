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
					<div class="column is-half">
                        <div class="column">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img class="" src="<?php echo $picture[0]['filename']; ?>"/>
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content">
                                            <p class="title is-5"><?php echo $picture[0]['username'] ?></p>
                                            <p class="subtitle is-6"><?php echo $picture[0]['date'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="columns">
                                <div class="column is-10">
                                    <textarea class="textarea" id="content" name="content" placeholder="Enter your comment here..." rows="2"></textarea>
                                </div>
                                <div class="control column has-text-centered">
								    <p><button id="submit" type="submit" class="button is-white is-medium">Send</button></p>
							    </div>
                            </div>
                            <?php include('views/comment.php'); ?>
                        </div>
                    </div>
				</div>
			</div>
		</section>
	</body>
</html>

<script>

    document.getElementById("submit").addEventListener("click", function() {
        
        var content = document.getElementById("content").value
        var formData = new FormData()
        var id_picture = "<?php echo $id_picture; ?>"

        formData.append("idPicture", <?php echo $id_picture ?>)
        formData.append("content", content)
		formData.append("idUserComment", <?php echo $_SESSION['user']['id'] ?>)

        var xmlhttp = new XMLHttpRequest()
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
				var data = new XMLHttpRequest();
				var content = document.querySelector('#content')
				content.value = ""
                data.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    var comments = document.querySelector('#comments')
					comments.innerHTML = data.responseText
				}
            }
            data.open("GET", "views/comment.php", true)
            data.send();
			}
        };
		xmlhttp.open("POST", "controllers/comment.php", true)
        xmlhttp.send(formData);
    })
</script>