<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Camagru</title>
</head>
<body>
	<center>
		<header>
			<h1>
				Camagru
			</h1>
			<nav>
				<a href="#">Sign In</a>
				<a href="#">Sign Up</a>
			</nav>
		</header>
		<fieldset style="width: 40vw; display: inline-block;">
      <legend>Webcam</legend>
      <video autoplay></video><br />
      <button onclick="takephoto();">Prendre une photo</button>
    </fieldset>

    <fieldset style="width: 40vw; display: inline-block;">
      <legend>Photo</legend>
      <img src="about:blank" alt="Photo" title="Photo" />
    </fieldset>

    <canvas style="display: none;" width="640" height="480"></canvas>

    <script type="text/javascript">
      var video = document.querySelector('video');
      var canvas = document.querySelector('canvas');
      var photo = document.querySelector('img');

      navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
      navigator.getMedia({ video: { mandatory: { maxWidth: 640, maxHeight: 480 } } }, function(stream) {
        video.src = window.URL.createObjectURL(stream);
      }, function(e) {
        console.log("Failed!", e);
      });

      function takephoto() {
        var ctx = canvas.getContext("2d").drawImage(video, 0, 0, 640, 480);
        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
      }
    </script>
	</center>
</body>
</html>
