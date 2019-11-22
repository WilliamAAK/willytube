<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

include_once("class/Api.php");
include_once("class/Upload.php");
include_once("config/config.php");
include_once("class/Database.php");
include_once("class/UploadFactory.php");

$upload = new Upload;

for ($i = 0; $i < count($_FILES["file"]["name"]); ++$i)
{
    $upload->start($i);
}

$array = $upload->upload_statuses;

print(json_encode($array));