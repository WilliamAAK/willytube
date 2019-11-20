<?php

# This is the main configuration file for "WillyTube"
define("DB_FILE", "data.db");
define("FILE_STORAGE", "../video/");

define("UPLOAD_ALLOWED_FILE_TYPES", [
    "mp4"
]);

define("WATCH_MIME_TYPES", [
    "video/mp4"
]);
# Child of WATCH_MIME_TYPES
define("WATCH_FILE_EXTENSIONS", [
    "mp4"
]);