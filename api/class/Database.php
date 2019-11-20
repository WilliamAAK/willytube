<?php

class Database 
{
    public static function connect()
    {
    // Create Connection
    $db = new SQlite3(DB_FILE);
    // Test Connection
    if (!$db) 
        Api::error(500, "Could not connect to database");
        return $db;
    }
}