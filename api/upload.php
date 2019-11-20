<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");

include_once("class/Api.php");
include_once("class/Upload.php");
include_once("config/config.php");
include_once("class/Database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    Api::error(405, "Request method not allowed");

print_r($_FILES["file"]);

if (isset($_POST["submit"])) 
{
    $file          = $_FILES["file"];
    $file_name     = $_FILES["file"]["name"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    $file_size     = $_FILES["file"]["size"];
    $file_error    = $_FILES["file"]["error"];
    $file_type     = $_FILES["file"]["type"];

    $file_ext        = explode(".", $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    # Can be found in config.php
    $allowed = UPLOAD_ALLOWED_FILE_TYPES;

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0)
        {
            if ($file_size < 100000000) # 10 Gigabytes
            {

                $file_name_new    = str_shuffle(uniqid()) . "." . "$file_actual_ext";
                $file_name_new    = substr($file_name_new, 5);
                $file_destination = FILE_STORAGE . $file_name_new;
                move_uploaded_file($file_tmp_name, $file_destination);

            } else {
                Api::error(400, "Filesize too big");
            }
        } else {
            Api::error(422, "There was an error uploading your file");
        }
    } else {
        Api::error(415, "You cannot upload files of this type");
    }
}