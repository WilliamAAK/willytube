<!DOCTYPE html>
<html lang="en">
<head>
    <title>Opplasting | WillyTube™</title>
    <?php include 'common/head.html'; ?>
</head>
<body>
    <?php include 'common/nav.html'; ?>
    <div class="row wrapper">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Video opplasting</span>
                    <p>Her kan du laste opp video til WillyTube™</p>
                    <div class="progress" id="progressBar">
                        <div class="determinate"></div>
                    </div>

                    <form id="uploadForm">

                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input id="inpFile" type="file" name="file[]" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Last opp en eller flere filer">
                            </div>
                        </div>

                        <input class="btn" type="submit" value="Last opp" name="submit">

                    </form>


                
                </div>
            </div>
        </div>

        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="">
                        <div>
                            <table id="Table" class="table">
    
                                <thead>
                                    <tr>
                                        <th style="width:50%;">Filnavn</th>
                                        <th style="width:50%;">Status</th>
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
    <script src="js/upload.js"></script>
</body>
</html>