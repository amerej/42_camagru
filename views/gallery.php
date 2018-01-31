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
		
		<section class="gallery">
			<div class="container has-text-centered">
				<?php for ($i = 0; $i < count($pictures); $i++): ?>
				<?php if ($i % 4 == 0) : ?>
				<?php if ($i != 0) : ?>
				</div>
				<?php endif; ?>
				<div class="columns is-centered">
					<div class="column">
						<div class="card">
							<div class="card-image">
								<figure class="image is-4by3">
									<?php if (isset($username) && isset($id_user)) : ?>
									<a href="picture.php?id=<?php echo $pictures[$i]['idPicture']; ?>">
										<img class="" src="<?php echo $pictures[$i]['filename']; ?>"/>
									</a>
									<?php else: ?>
									<img class="" src="<?php echo $pictures[$i]['filename']; ?>"/>
									<?php endif; ?>
								</figure>
							</div>
							<div class="card-content">
								<div class="media">
									<div class="media-content">
										<p class="title is-5"><?php echo $pictures[$i]['username'] ?></p>
										<p class="subtitle is-6"><?php echo $pictures[$i]['date'] ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
				<div class="column">
					<div class="card">
						<div class="card-image">
							<figure class="image is-4by3">
								<?php if (isset($username) && isset($id_user)) : ?>
								<a href="picture.php?id=<?php echo $pictures[$i]['idPicture']; ?>">
									<img class="" src="<?php echo $pictures[$i]['filename']; ?>"/>
								</a>
								<?php else: ?>
								<img class="" src="<?php echo $pictures[$i]['filename']; ?>"/>
								<?php endif; ?>
							</figure>
						</div>
						<div class="card-content">
							<div class="media">
								<div class="media-content">
									<p class="title is-5"><?php echo $pictures[$i]['username'] ?></p>
									<p class="subtitle is-6"><?php echo $pictures[$i]['date'] ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php endfor; ?>
			</div>
		</section>
	</body>
</html>
