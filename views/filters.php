<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/filters.php';

?>

<div class="overlay">
    <?php foreach ($images as $img) : ?>
        <img class="imgFilters" src="<?php echo $img; ?>">
    <?php endforeach;  ?>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var img;
    var i;
    var x = document.getElementsByClassName("imgFilters");
    if (n > x.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        x[i].setAttribute('id', '');
    }
    x[slideIndex-1].style.display = "initial";
    x[slideIndex-1].setAttribute('id', 'curFilter');
}
</script>
