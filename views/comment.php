<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/comment.php';

?>

<div class="field comments" id="comments">
    <?php foreach($comments as $c) : ?>
    <div class="box comments" id="comments">
        <article class="media">
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><?php echo $c['username'] ?></strong> <small><?php echo $c['date'] ?></small>
                        <br>
                        <?php echo $c['content'] ?>
                    </p>
                </div>
            </div>
        </article>
    </div>
    <?php endforeach; ?>
</div>
