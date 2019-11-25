<?php

# This is definitely not how to use factories.

class VideoFactory
{
    /**
     * Returns uid and videotype
     *
     * @return array/null
     */
    public static function getVideoParamsByUid($uid)
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
     * Returns video title
     *
     * @return array/null
     */
    public static function getVideoDetailsByUid($uid)
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT uid, title, date, videotype FROM videos WHERE uid = '" . $db->escapeString($uid) . "'");
        $results = $results->fetchArray(SQLITE3_ASSOC);
        $db->close();

        if(empty($results))
        {
            return null;
        }

        $results["date"] = date('M d Y',$results["date"]);;

        return $results;
    }

}