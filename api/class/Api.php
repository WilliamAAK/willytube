<?php

class Api
{
    public static function error($res, $msg): void
    {
        header('Content-Type: application/json');
        header($_SERVER["SERVER_PROTOCOL"] . " " . $res);
        die(json_encode([
            "responseStatus" => $res,
            "message"        => $msg
        ]));
    }
}