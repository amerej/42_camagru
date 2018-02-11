<form enctype="multipart/form-data">
	<input type="file" name="file" id="file" placeholder="" required/><br/>
	<input type="submit" onclick="uploadFile()" value="Save file"/>
</form>

<script>

function uploadFile() {

	var inputFile = document.querySelector('#file')
	var formData = new FormData();

	formData.append('file', inputFile.files[0])

	var oReq = new XMLHttpRequest();
	
	oReq.onload = function() {
		if (oReq.status == 200) {
			location.href = 'home.php';
		}
	}
	oReq.open("POST", "upload.php", true)
	oReq.send(formData)
}

</script>