<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'common/head.html'; ?>
    <title>WillyTube™</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php include 'common/nav.html'; ?>
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
    <?php include 'common/jsInclude.html'; ?>
    <script src="js/index.js"></script>
</body>
</html>