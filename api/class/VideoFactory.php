<?php

# This is definitely not how to use factories.

class VideoFactory
{
    /**
     * Returns uid and videotype
     *
     * @return array
     */
    public static function getVideoParamsByUid($uid): array
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT uid, videotype FROM videos WHERE uid = '" . $db->escapeString($uid) . "'");
        $results = $results->fetchArray(SQLITE3_ASSOC);
        $db->close();

        if(empty($results))
        {
            return null;
        }

        return $results;
    }

    /**
     * Returns video title and description
     *
     * @return array
     */
    public static function getVideoDetailsByUid($uid): array
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT title FROM videos WHERE uid = '" . $db->escapeString($uid) . "'");
        $results = $results->fetchArray(SQLITE3_ASSOC);
        $db->close();

        if(empty($results))
        {
            return null;
        }

        return $results;
    }

    public static function getPostsByRecent()
    {
        
    }
}