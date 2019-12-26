<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="pageTitle">WillyTube™</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="vendor/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <?php
    include 'common/nav.html';
    ?>

    <div class="row wrapper">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-image">
                    <video class="video" id="video" poster="" controls>
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="card-video">
                    <p id="videoTitle" class="video-title flow-text"></p>
                    <p id="videoDate" class="video-description flow-text"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/materialize/js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/video.js"></script>
</body>
</html>