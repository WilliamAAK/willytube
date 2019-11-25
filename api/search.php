<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");

include_once("class/Api.php");
include_once("class/Search.php");
include_once("config/config.php");
include_once("class/Database.php");
include_once("class/SearchFactory.php");

if (!isset($_GET["action"]))
{
    Api::error(400,"action is not defined");
}

switch(strtolower($_GET["action"])) 
{
    case 'orderbyrecent':
        Search::orderByRecent($_GET["s"]);
    break;
    default:
        Api::error(422, "hmm something is missing");
    break;
}