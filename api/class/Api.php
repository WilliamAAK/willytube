<?php

class Api
{
    public static function error($res, $msg): void
    {
        header($_SERVER["SERVER_PROTOCOL"] . " " . $res);
        if (API_ALLOW_ERROR_MESSAGES == true)
        {
            header('Content-Type: application/json');
            die(json_encode([
                "responseStatus" => $res,
                "message"        => $msg
            ]));
        }
        die();
    }
}