<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");

include_once("class/Api.php");
include_once("class/Watch.php");
include_once("config/config.php");
include_once("class/Database.php");
include_once("class/VideoFactory.php");

if (!isset($_GET["action"])) 
    Api::error(400,"action is not defined");

switch($_GET["action"]) 
{
    case 'stream':
        Watch::getVideo();
    break;
    case 'details':
        Watch::videoDetails();
    break;
    default:
        Api::error(422, "hmm something is missing");
    break;
}