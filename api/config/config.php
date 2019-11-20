<?php

/**
 * This is the main configuration file for "WillyTube"
 * 
 */
define("DB_FILE", "data.db");
define("FILE_STORAGE", "H:/");

// Upload parameters

define("UPLOAD_MAX_SIZE", 100000000); # 10 Gigabytes

define("UPLOAD_ALLOWED_FILE_TYPES", [ # Allowed file extensions
    "mp4"
]);

// Watch parameters
define("WATCH_MIME_TYPES", [
    "video/mp4"
]);

define("WATCH_FILE_EXTENSIONS", [
    "mp4"
]);