<?php

class PostsFactory
{
    public static function getVideosByRecent()
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT uid, title, date FROM videos ORDER BY id desc");
        while ($dbs_row = $results->fetchArray(SQLITE3_ASSOC)) {
            $assoc_array[] = $dbs_row;
        }
        $db->close();

        if (empty($assoc_array))
        {
            return null;
        }

        for ($i = 0; $i < count($assoc_array); ++$i)
        {
            $assoc_array[$i]["date"] = date('M d Y',$assoc_array[$i]["date"]);;
        }

        return $assoc_array;
    }
}