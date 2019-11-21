<?php

class Watch
{   
    /**
     * Checks if supplied uid matches any videos
     *
     * @return void
     */
    public static function initializeStream(): void
    {
        if (!isset($_GET["video"])) 
        {
            Api::error(400,"video is not defined");
        }

        # Returns uid and videotype else null
        $current_video = VideoFactory::getVideoParamsByUid($_GET["video"]);

        # If uid is not returned. Video can not be found
        if (empty($current_video["uid"]))
        {
            Api::error(404, "Video not found");
        }

        # Can be found in config.php
        $storage         = FILE_STORAGE;
        $mime_types      = WATCH_MIME_TYPES;
        $file_extensions = WATCH_FILE_EXTENSIONS;

        # Check if videotype is an undefined offset
        if ($current_video["videotype"] > count($mime_types))
        {
            Api::error(500, "Undefined offset in Watch.getVideo()");
        }

        # Gets mime type offset
        $mime_type      = $mime_types[$current_video["videotype"]];
        $file_extension = $file_extensions[$current_video["videotype"]];
        $file_location  = $storage . $current_video["uid"] . "." . $file_extension;

        if (!file_exists($file_location))
        {
            Api::error(500, "File not found in Watch.getVideo()");
        }

        if (empty($mime_type))
        {
            Api::error(500, "Mime-type not found in Watch.getVideo()");
        }

        # Start streaming video file
        Watch::streamVideo($file_location, $mime_type);
            
    }

    /**
     * Streams video
     * Support for partial content.
     *
     * @return void
     * @api
     */
    public static function streamVideo($file_location, $mime_type): void
    {
        $server_protocol = $_SERVER["SERVER_PROTOCOL"];
        $file   = $file_location;
        $fp     = @fopen($file, 'rb');
        $size   = filesize($file); // File size
        $length = $size;           // Content length
        $start  = 0;               // Start byte
        $end    = $size - 1;       // End byte
        
        header("Accept-Ranges: 0-$length");
        header("Content-Type: " . $mime_type);
        header("Accept-Ranges: bytes");
        if (isset($_SERVER['HTTP_RANGE'])) {
            $c_start = $start;
            $c_end   = $end;
            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
            if (strpos($range, ',') !== false) {
                header($server_protocol .' 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $start-$end/$size");
                exit;
            }
            if ($range == '-') {
                $c_start = $size - substr($range, 1);
            }else{
                $range   = explode('-', $range);
                $c_start = $range[0];
                $c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
            }
            $c_end = ($c_end > $end) ? $end : $c_end;
            if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
                header($server_protocol . ' 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $start-$end/$size");
                exit;
            }
            $start  = $c_start;
            $end    = $c_end;
            $length = $end - $start + 1;
            fseek($fp, $start);
            header($server_protocol . ' 206 Partial Content');
        }
        header("Content-Range: bytes $start-$end/$size");
        header("Content-Length: ".$length);
        $buffer = 1024 * 8;
        while(!feof($fp) && ($p = ftell($fp)) <= $end) {
            if ($p + $buffer > $end) {
                $buffer = $end - $p + 1;
            }
            set_time_limit(0);
            echo fread($fp, $buffer);
            flush();
        }
        fclose($fp);
        exit();
    }

    /**
     * Prints video title and description
     *
     * @return void
     * @api
     */
    public static function videoDetails(): void
    {
        if (!isset($_GET["video"]))
        {
            Api::error(400,"video is not defined");
        }

        # Returns video title and description else null
        $current_video = VideoFactory::getVideoDetailsByUid($_GET["video"]);

        if (!empty($current_video))
        {
            header('Content-Type: application/json');
            print(json_encode($current_video));
        } else {
            Api::error(404, "Video not found");
        }
    }
}