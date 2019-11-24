<?php

# I still dont know how to use factories

class UploadFactory
{
    public static function addVideoToDatabase($uid, $title, $videotype): void
    {
        # Connects to sqlite database
        $db = Database::connect();

        if (strlen($title) > 100)
        {
            $title = substr($title, 0, 100) . "...";
        }

        # Query database and fetch results to array
        $db->query("INSERT INTO videos (uid, title, videotype, date) VALUES ('" . $db->escapeString($uid) . "', '" . $db->escapeString($title) . "', '" . $db->escapeString($videotype) . "', '" . $db->escapeString(time()) . "');");
        $db->close();
    }
}