<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/filters.php'; 
?>

<div class="field filters" id="filters">
	<?php foreach ($images as $img) : ?>
		<img class="filter" onclick="select(this)" src="<?php echo $img; ?>">
	<?php endforeach; ?>
</div>

<script>

var filters = []

function select(elem) {
	var container = document.getElementById("snapshot");
	var elements = container.getElementsByClassName("overlay");

	while (elements[0]) {
		elements[0].parentNode.removeChild(elements[0]);
	}
	
	filters.length === 0 ? filters.push(elem.src) : filters.includes(elem.src) ? filters.splice(filters.indexOf(elem.src), 1) : filters.push(elem.src)
	
	for (i in filters) {
		var newElem = document.createElement("img");
		newElem.setAttribute("src", filters[i]);
		newElem.setAttribute('class', 'overlay');
		document.getElementById("snapshot").appendChild(newElem);
	}
}

</script>