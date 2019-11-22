<?php

/**
 * This is the main configuration file for "WillyTube"
 */

// Local parameters
define("DB_FILE", "data.db");
define("FILE_STORAGE", "H:/");
define("API_ALLOW_ERROR_MESSAGES", true);

// Upload parameters
define("UPLOAD_MAX_SIZE", 10000000000); # 10 Gigabytes

define("UPLOAD_ALLOWED_FILE_TYPES", [
    "mp4",
    "m4v",
    "mkv"
]);

// Watch parameters
define("WATCH_MIME_TYPES", [
    "video/mp4",
    "video/mp4",
    "video/mp4"
]);

define("WATCH_FILE_EXTENSIONS", [
    "mp4",
    "m4v",
    "mkv"
]);