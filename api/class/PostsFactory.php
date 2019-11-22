<?php

class PostsFactory
{
    public static function getVideosByRecent()
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT id, uid, title FROM videos ORDER BY id desc");
        while ($dbs_row = $results->fetchArray(SQLITE3_ASSOC)) {
            $assoc_array[] = $dbs_row;
        }
        $db->close();

        if(empty($assoc_array))
        {
            return null;
        }

        return $assoc_array;
    }
}