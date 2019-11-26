<?php

include_once("config/config.php");
include_once("config/database.php");

spl_autoload_register(function ($class_name) {
    include_once "class/" . $class_name . '.php';
});