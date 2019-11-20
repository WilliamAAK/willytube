<?php

class Watch
{   
    /**
     * Gets video...
     *
     * @return void
     * @api
     */
    public static function getVideo(): void
    {
        if (!isset($_GET["video"])) 
        {
            Api::error(400,"video is not defined");
        }

        /*

        $current_video = VideoFactory::getVideoByUid($_GET["video"]);

        */

        # Connects to sqlite database
        $db = Database::connect();

        # Gets url parameters/args example: api.php/watch=videoTag
        $uid = $_GET["video"];
        
        # Query database and fetch results to array
        $current_video = $db->query("SELECT uid, videotype FROM videos WHERE uid = '" . $db->escapeString($uid) . "'");
        $current_video = $current_video->fetchArray(SQLITE3_ASSOC);
        
        # If tag is not returned. Video should not exist
        if (empty($current_video))
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
            Api::error(500, "Undefined offset in Watch.videoStream()");
        }

        # Gets mime type offset
        $mime_type      = $mime_types[$current_video["videotype"]];
        $file_extension = $file_extensions[$current_video["videotype"]];
        $file_location  = $storage . $current_video["uid"] . "." . $file_extension;

        if (empty($mime_type))
        {
            Api::error(500, "Mime-type not found in Watch.videoStream()");
        }

        # Start streaming video file
        Watch::streamVideo($file_location, $mime_type);
            
    }

    /**
     * Streams raw video bytes
     *
     * @return void
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
        header("Content-Type: " . $mime_type);
        //header("Accept-Ranges: 0-$length");
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
     * Prints out video details
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

        # Connects to sqlite database.
        $db = Database::connect();

        # Gets url parameters/args example: api.php/watch=videoTag
        $tag = $_GET["video"];
        
        # Query database and fetch results to array
        $current_video = $db->query("SELECT title, desc FROM videos WHERE tag = '" . $db->escapeString($tag) . "'");
        $current_video = $current_video->fetchArray(SQLITE3_ASSOC);

        if (!empty($current_video))
        {
            header('Content-Type: application/json');
            print(json_encode($current_video));
        } else {
            Api::error(404, "Video not found");
        }
    }
}