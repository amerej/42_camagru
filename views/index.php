<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="en">
        <meta name="viewport" content="width=device-width, maximum-scale=1">
        <title>Camagru - Home</title>
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico|Passion+One|Raleway" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    </head>
    
    <?php if (!(isset($_SESSION['user']['id']) && isset($_SESSION['user']['login']))) : ?>
        <script type="text/javascript">
            window.location.href = 'login.php?login=error';
        </script>
        <!-- <?php exit(header('Location: login.php?login=error')); ?> -->
    <?php endif; ?>
    
    <body>

        <!-- MENU -->
        <header>
            <nav class="topnav" id="topnav">
                <script src="resources/js/topnav.js"></script>

                <div class="row">
                    <div class="logo-section"><a class="logo">Camagru</a></div>
                    
                    <div class="nav-section" id="nav-section">
                        <a href="#snap" onclick="closeOnClick()">Take Snap</a>
                        <a href="#gallery" onclick="closeOnClick()">Gallery</a>
                        <a href="logout.php">Logout</a>
                        <a href="javascript:void(0);" class="icon" onclick="addResponsiveClass()">&#9776;</a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- SNAP SECTION -->
        <section id="snapShot">
            <div class="row" style="line-height: 0px;">
                
            <div class="switcher">
                <button class="" id="prevFilter" onclick="plusDivs(-1)">&#10094;</button>
                <button class="" id="nextFilter" onclick="plusDivs(1)">&#10095;</button>
            </div>
                
                
                <div class="video">
                    <?php include('views/filters.php'); ?>
                    <video id="video" autoplay="true"></video>
                </div>

                <div class="latest" id="usersSnap">
                    <?php include('views/latest.php'); ?>
                </div>

                <canvas id="canvas" width="640" height="480"></canvas>

                <div class="row takeSnap">
                    <input id="snap" type="image" src="resources/img/icons/camera.png" alt="Submit" width="64">
                </div>
            </div>
        </section>

        <script>
            var canvas = document.querySelector('#canvas');
            var video = document.querySelector('#video');
            var context = canvas.getContext('2d');

            document.getElementById("snap").addEventListener("click", function() {
                var filter = document.querySelector("#curFilter").src;
                context.drawImage(video, 0, 0, 640, 480);
                var image = new Image();
                image.src = canvas.toDataURL("image/png");

                var formData = new FormData();

                formData.append("image", image.src);
                formData.append("filter", filter);
                
                var xmlhttp = new XMLHttpRequest();
    
                xmlhttp.onreadystatechange = function() {
        
                    if (this.readyState == 4 && this.status == 200) {
                        var test = new XMLHttpRequest();
                        test.onreadystatechange = function() {
        
                        if (this.readyState == 4 && this.status == 200) {
                            var t = document.querySelector('#usersSnap');
                            t.innerHTML = test.responseText;
                        }
                    };
                    test.open("GET", "views/latest.php", true);
                    test.send();
                    }
                };
                xmlhttp.open("POST", "controllers/snap.php", true);
                xmlhttp.send(formData);
            });
        </script>


        <section id="gallery">
        <?php include('views/gallery.php'); ?>
        
        <div id="myModal" class="modal" style="display:none;">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Some text in the Modal..</p>
            </div>
        </div>
        <script src="resources/js/gallery_modal.js"></script>
        </section>
        
        <!-- <?php include('views/upload.php'); ?> -->

    </body>
</html>


<script>
    var video = document.querySelector("#video");
 
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
 
if (navigator.getUserMedia) {       
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}
 
function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
}
 
function videoError(e) {
    // do something
}
</script>

