<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WillyTube™</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="vendor/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <?php
    include 'common/nav.html';
    ?>
    <div class="row wrapper">
        <div class="col s12">
            <h5 style="display: inline-block;" class="subheader flow-text">Nylige opplastinger</h5>
            <div class="card">
                <div class="card-content">
                    <div class="overflow-auto">
                        <div>
                            <table id="Table" class="table">
    
                                <thead>
                                    <tr>
                                        <th>Tittel</th>
                                        <th>Dato</th>
                                    </tr>
                                </thead>
    
                                <tbody>
    
                                </tbody>
    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/materialize/js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/index.js"></script>
</body>
</html>