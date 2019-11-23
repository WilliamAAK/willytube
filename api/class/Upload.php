<?php

class Upload
{
    public $file;
    public $upload_statuses = [];

    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS")
        {
            Api::error(200, "Yes you can my baby ;)");
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            Api::error(405, "Request method not allowed");
        }
        
        if (!isset($_FILES["file"]))
        {
            Api::error(400, "file is not defined");
        }

        $this->file = $_FILES["file"];

    }

    public function start($i): void
    {

        $file_name     = $this->file["name"][$i];
        $file_tmp_name = $this->file["tmp_name"][$i];
        $file_size     = $this->file["size"][$i];
        $file_error    = $this->file["error"][$i];
        $file_type     = $this->file["type"][$i];
    
        $file_ext        = explode(".", $file_name);
        $file_actual_ext = strtolower(end($file_ext));
    
        # Can be found in config.php
        $allowed      = UPLOAD_ALLOWED_FILE_TYPES;
        $max_filesize = UPLOAD_MAX_SIZE;
        $storage      = FILE_STORAGE;
    
        if (empty($file_name))
        {
            Api::error(400, "File cannot be empty");
        }

        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0)
            {
                if ($file_size < $max_filesize)
                {
    
                    $uid = str_shuffle(uniqid());
                    $uid = substr($uid, 5);

                    $file_name_new    = $uid . "." . "$file_actual_ext";
                    $file_destination = $storage . $file_name_new;
                    if (file_exists($file_destination))
                    {
                        $this->log("File already exists", $file_name, 1);
                    }
                    move_uploaded_file($file_tmp_name, $file_destination);

                    for ($i = 0; $i < count($allowed); ++$i) 
                    {
                        if($allowed[$i] == $file_actual_ext)
                        {
                            $videotype = $i;
                            break;
                        }
                    } 

                    if (!isset($videotype))
                    {
                        Api::error(500, "No videotype match in Upload.start()");
                    }

                    $title = basename($file_name, "." . $file_actual_ext);

                    UploadFactory::addVideoToDatabase($uid, $title, $videotype);

                    $this->log("Successful", $file_name, 0, $uid);
    
                } else {
                    $this->log("Filesize too big", $file_name, 1);
                }
            } else {
                $this->log("There was an error uploading your file", $file_name, 1);
            }
        } else {
            $this->log("You cannot upload files of this type", $file_name, 1);
        }

    }

    public function log($msg, $file_name, $status, $uid=null)
    {
        
        if (strlen($file_name) > 40)
        {
            $file_name = substr($file_name, 0, 40) . "...";
        }

        if ($status == 0)
        {
            array_push($this->upload_statuses, [
                "status"  => $status,
                "file"    => $file_name,
                "message" => $msg,
                "video"=> $uid
            ]);
        } else {
            array_push($this->upload_statuses, [
                "status"  => $status,
                "file"    => $file_name,
                "message" => $msg,
            ]);
        }

    }

}