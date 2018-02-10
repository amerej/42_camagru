<?php for ($i = 0; $i < count($pictures); $i++): ?>
<?php if ($i % 4 == 0) : ?>
	<div class="columns is-centered">
<?php endif; ?>
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
<?php if ($i % 4 == 3) : ?>
	</div>
<?php endif; ?>
<?php endfor; ?>