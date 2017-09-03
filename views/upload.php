<script>

function uploadFile() {

    var inputFile = document.querySelector('#file');
    var formData = new FormData();

    formData.append('file', inputFile.files[0]);

    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            location.href = 'home.php';
        }
    };
    xmlhttp.open("POST", "controllers/upload.php", true);
    xmlhttp.send(formData);
}

</script>

<form enctype="multipart/form-data">
    <input type="file" name="file" id="file" placeholder="" required/><br/>
    <input type="submit" onclick="uploadFile()" value="Save file"/>
</form>
