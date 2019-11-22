<?php

class Database
{

    public static function connect()
    {
        # Create Connection
        $conn = new SQlite3(DB_FILE);

        # Test Connection
        if (!$conn)
        {
            Api::error(500, "Could not connect to database in Database.connect()");
        }

        return $conn;
    }
}