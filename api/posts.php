<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

include_once("class/Api.php");
include_once("class/Posts.php");
include_once("config/config.php");
include_once("class/Database.php");
include_once("class/PostsFactory.php");


if (!isset($_GET["action"]))
{
    Api::error(400,"action is not defined");
}

switch($_GET["action"]) 
{
    case 'listRecent':
        Posts::listRecent();
    break;
    default:
        Api::error(422, "hmm something is missing");
    break;
}