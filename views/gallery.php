<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/gallery.php';

?>

<div class="row">
    <?php foreach ($result as $res) : ?>
            <div class="gallery-grid"><img class="resize" onclick="openModal()" src="<?php echo $res['filename']; ?>"/></div>
        <?php endforeach; ?>
</div>
