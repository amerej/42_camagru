<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/users_snap.php';

?>

<div class="latest">
    <?php foreach($result as $res) : ?>
        <img src="<?php echo $res['filename']; ?>" />
    <?php endforeach; ?>
</div>
