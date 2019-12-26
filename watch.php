<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'common/head.html'; ?>
    <title id="pageTitle">WillyTube™</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php include 'common/nav.html'; ?>

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
    <?php include 'common/jsInclude.html'; ?>
</body>
</html>