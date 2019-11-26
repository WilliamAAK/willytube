<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

include_once("config/autoloader.php");

if (!isset($_GET["action"]))
{
    Api::error(400,"action is not defined");
}

switch(strtolower($_GET["action"])) 
{
    case 'listrecent':
        Posts::listRecent();
    break;
    default:
        Api::error(422, "hmm something is missing");
    break;
}