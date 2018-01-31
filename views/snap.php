<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/snap.php';

?>

<div class="field latest" id="usersSnap">
    <?php foreach($pictures as $p) : ?>
        <img src="<?php echo $p['filename']; ?>" />
    <?php endforeach; ?>
</div>
