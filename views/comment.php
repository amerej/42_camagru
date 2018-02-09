<?php foreach($comments as $comment) : ?>
<div class="box comments" id="comments">
	<article class="media">
		<div class="media-content">
			<div class="content">
				<p>
					<strong><?php echo $comment['username'] ?></strong> <small><?php echo $comment['date'] ?></small>
					<br>
					<?php echo $comment['content'] ?>
				</p>
			</div>
		</div>
	</article>
</div>
<?php endforeach; ?>
