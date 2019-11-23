<?php

class Database
{

    public static function connect()
    {
        # Create Connection
        $conn = new SQlite3("data.db");

        # Test Connection
        if (!$conn)
        {
            Api::error(500, "Could not connect to database in Database.connect()");
        }

        return $conn;
    }
}

class PostsFactory
{
    public static function getVideosByRecent()
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT * FROM videos ORDER BY id desc");
        while ($dbs_row = $results->fetchArray(SQLITE3_ASSOC)) {
            $assoc_array[] = $dbs_row;
        }
        $db->close();

        if(empty($assoc_array))
        {
            return null;
        }

        print(json_encode($assoc_array));
    }
}

PostsFactory::getVideosByRecent();